<?php

	class Base88 {

		public $debug = true;
		public $debug_level = 100;

		public $enable_cdn = true;
		public $enable_cache = true;

		public $site_uri;
		public $cdn_uri;

		public function init() {
			if($this->debug && $this->debug_level == 100) {
				ini_set('display_errors', 1);
				error_reporting(E_ALL);
			}

			$this->site_uri = str_replace('http://', '', get_bloginfo('wpurl'));
			$this->cdn_uri = 'pvxtindianet.vercingetorixtec.netdna-cdn.com';
		}

		public function path($path) {
			return ABSPATH . 'wp-content/plugins/88things/' . $path;
		}

		public function display($data, $level = 90) {
			if($this->debug && ($level <= $this->debug_level)) {
				echo '<pre style="font-size: 12px; background-color: #F7F7F7; border: 1px solid #CECECE; margin: 3px 3px 0px; padding: 6px;">';
				var_dump($data);
				echo '</pre>';
			}
		}

		public function error($data) {
			$this->display($data);
		}

		public function checkPerms($path, $perms) {
			if(file_exists($this->path($path)) && is_dir($this->path($path))) {
				return (substr(sprintf('%o', fileperms($this->path($path))), -3) == $perms);
			} else {
				$this->error('The cache direcotry does not exist [' . $this->path($path) . ']');
			}
		}

		public function getReadableTime($seconds) {
			$mult = 1;
			if($seconds < 0) {
				$mult = -1;
				$seconds = $seconds * (-1);
			}
			if($seconds < 60) {
				if($seconds == 1)
					return ($seconds * $mult) . " second";
				return ($seconds * $mult) . " seconds";
			}
			$minutes = round($seconds / 60);
			if($minutes < 60) {
				if($minutes == 1)
					return ($minutes * $mult) . " minute";
				return ($minutes * $mult) . " minutes";
			}
			$hours = round($minutes / 60);
			if($hours < 24) {
				if($hours == 1)
					return ($hours * $mult) . " hour";
				return ($hours * $mult) . " hours";
			}
			$days = round($hours / 24);
			if($days < 30) {
				if($days == 1)
					return ($days * $mult) . " day";
				return ($days * $mult) . " days";
			}
			$months = round($days / 30);
			if($months < 12) {
				if($months == 1)
					return ($months * $mult) . " month";
				return ($months * $mult) . " months";
			}
			$years = round($months / 12);
			if($years == 1)
				return ($years * $mult) . " year";
			return ($years * $mult) . " years";
		}
	}

