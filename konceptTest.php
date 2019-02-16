<?php
/*
Plugin Name: Koncept Test
Plugin URI: https://maxhalleran.github.io
Description: A simple plugin that adds a [test] shortcode that outputs 'TEST SUCCEEDED'
Version: 1.0.0
Author: Max Halleran
Author URI: https://maxhalleran.github.io
*/

// Exit if accessed directly
if(!defined('ABSPATH')) {
  exit;
}

// Load scripts
require_once(plugin_dir_path(__FILE__).'/includes/konceptTest-scripts.php');

require( plugin_dir_path(__FILE__) . '/includes/test-shortcode.php');