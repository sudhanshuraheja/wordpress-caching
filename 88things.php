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
			// Using get_header because init gets called even when using admin
			add_action('get_header', array($this, 'beforePage'), PHP_INT_MAX);
			add_action('wp_footer', array($this, 'afterPage'), PHP_INT_MAX);

			$cdn88 = new Cdn88();
			$cdn88->init();
		}

		public function beforePage() {
			$this->display($_SERVER['REQUEST_URI']);
			$this->display('starting now', 90);
			ob_start();
		}

		public function afterPage() {
			$page = ob_get_contents();
			ob_end_clean();
			$this->display('ending now', 90);

			echo $page;
		}

	}

	$wordpress88 = new WordPress88();
	$wordpress88->init();

