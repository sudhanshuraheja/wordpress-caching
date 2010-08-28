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
			2. Cache Pages
	*/

	/*
		TODO Later
			1. Create pull zone when activating plugin
			2. Load files like tinymce via cdn
	*/

	require_once(ABSPATH . 'wp-content/plugins/88things/base.php');
	require_once(ABSPATH . 'wp-content/plugins/88things/cdn.php');
	require_once(ABSPATH . 'wp-content/plugins/88things/cache.php');

	class WordPress88 extends Base88 {

		public function __construct() {
			parent::init();
		}

		public function init() {
			$cache88 = new Cache88();
			$cache88->init();

			$cdn88 = new Cdn88();
			$cdn88->init();
		}

	}

	$wordpress88 = new WordPress88();
	$wordpress88->init();

