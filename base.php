<?php

	class Base88 {

		public $debug;
		public $debug_level;

		public $enable_cdn;

		public $site_uri;
		public $cdn_uri;

		public function init() {
			$this->debug = true;
			$this->debug_level = 100;

			if($this->debug && $this->debug_level == 100) {
				ini_set('display_errors', 1);
				error_reporting(E_ALL);
			}

			$this->enable_cdn = true;

			$this->site_uri = str_replace('http://', '', get_bloginfo('wpurl'));
			$this->cdn_uri = 'pvxtindianet.vercingetorixtec.netdna-cdn.com';
		}

		public function display($data, $level = 90) {
			if($this->debug && ($level <= $this->debug_level)) {
				echo '<pre style="font-size: 12px; background-color: #F7F7F7; border: 1px solid #CECECE; margin: 3px 3px 0px; padding: 6px;">';
				var_dump($data);
				echo '</pre>';
			}
		}

	}

