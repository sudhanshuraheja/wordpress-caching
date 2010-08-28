<?php

	/*
		Plugin Name: 88things
		Plugin URI: http://vxtindia.com
		Description: This plugin will take care of everything
		Author: Sudhanshu Raheja
		Version : 0.0.1
		Author URI: http://vxtindia.com
	*/

	/*
		This plugin needs to take care of the following functionality
			1. Redirect all javascript, css and images to maxcdn
	*/

	class WordPress88 {

		private $site_url;
		private $cdn_url;

		public function __construct() {
			$this->site_url = str_replace('http://', '', get_bloginfo('wpurl'));
			$this->cdn_url = 'pvxtindianet.vercingetorixtec.netdna-cdn.com';
		}

		public function init() {
			$this->useCDN();
		}

		public function display($data) {
			echo '<pre style="font-size: 12px; background-color: #F7F7F7; border: 1px solid #CECECE; margin: 3px 3px 0px; padding: 6px;">';
			var_dump($data);
			echo '</pre>';
		}

		private function useCDN() {
			$this->rewriteJavascript();
			$this->rewriteCSS();
		}

		private function rewriteJavascript() {
			add_action('script_loader_src', array($this, 'filterJavascriptForCDN'));
		}

		public function filterJavascriptForCDN($url) {
			return str_replace($this->site_url, $this->cdn_url, $url);
		}

		private function rewriteCSS() {
			add_action('style_loader_src', array($this, 'filterCSSForCDN'));
		}

		public function filterCSSForCDN($url) {
			return str_replace($this->site_url, $this->cdn_url, $url);
		}

	}

	$wordpress88 = new WordPress88();
	$wordpress88->init();

?>
