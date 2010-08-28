<?php

	class Cache88 extends Base88 {

		private $cache_dir = 'cache/';
		private $cache_time = 172800;

		public function __construct() {
			parent::init();
		}

		public function init() {
			//return;
			if($this->enable_cache) {
				if(!$this->checkPerms($this->cache_dir, '0777')) {
					$this->error('The cache directory is not writable');
				} else {
					add_action('get_header', array($this, 'beforePage'), PHP_INT_MAX);
				}
			}
		}

		public function beforePage() {
			$this->getPage();
		}

		public function afterPage($page) {
			// _get_response_headers
			$this->savePage($page);
			return $page;
		}

		public function getPage() {
			$key = $this->getKey();
			$this->display('Key : ' . $key, 120);
			if(file_exists($this->path($this->cache_dir . $key))) {
				$this->display('Found in cache', 120);
				$time = time();
				$filemtime = @filemtime($this->path($this->cache_dir . $key));
				if( ($time - $filemtime) < $this->cache_time ) {
					$this->display('Getting file from cache', 120);
					echo $this->getFromCache($key);
				} else {
					$this->display('Removing file from cache', 120);
					$this->removeFromCache($key);
				}
			} else {
				$this->display('Staring ob_start');
				ob_start(array($this, 'afterPage'));
			}
		}

		public function savePage($page) {
			$this->display('Saving file to cache');
			$key = $this->getKey();
			$path = $this->path($this->cache_dir . $key);

			if(file_exists($path)) {
				$this->removeFromCache($key);
			}

			$fp = @fopen($path, 'wb');
			@fputs($fp, $page);
			@fclose($fp);

			return $data;
		}

		public function getFromCache($key) {
			$path = $this->path($this->cache_dir . $key);
			if(file_exists($path)) {
				$fp = @fopen($path, 'rb');
				$data = '';
				while(!@feof($fp)) {
					$data .= @fread($fp, 4096);
				}
				@fclose($fp);
				return $data;
			} else {
				$this->error('This page does not exist in the cache');
			}
		}

		public function removeFromCache($key) {
			if(file_exists($this->path($this->cache_dir . $key))) {
				@unlink($this->path($this->cache_dir . $key));
			}
		}

		private function getKey() {
			$key = $_SERVER['REQUEST_URI'];
			$key = preg_replace('~#.*$~', '', $key);	// Remove #about etc
			$key = urldecode($key);										// Urldecode
			$key = preg_replace('~\?.*$~', '', $key);	// Replaces query string
			$key = crc32($key);
			return $key . '.cac';
		}

	}





