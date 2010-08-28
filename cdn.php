<?php

	class Cdn88 extends Base88 {

		public function __construct() {
			parent::init();
		}

		public function init() {
			if($this->enable_cdn) {
				add_action('script_loader_src', array($this, 'replaceSiteURLWithCDNURL'));
				add_action('style_loader_src', array($this, 'replaceSiteURLWithCDNURL'));
				add_action('theme_root_uri', array($this, 'replaceSiteURLWithCDNURL'));
			}
		}

		public function replaceSiteURLWithCDNURL($url) {
			return str_replace($this->site_uri, $this->cdn_uri, $url);
		}

	}


