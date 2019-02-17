<?php
/*
Plugin Name: Koncept Test
Plugin URI: https://maxhalleran.github.io
Description: A simple plugin that adds a [test] shortcode that outputs 'TEST SUCCEEDED' and an [instafeed] shortcode that outputs the latest five images of a user.
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

// Add settings link
// add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'add_plugin_page_settings_link');
// function add_plugin_page_settings_link( $links ) {
// 	$links[] = '<a href="' .
// 		admin_url( 'options-general.php?page=my-plugin' ) .
// 		'">' . __('Settings') . '</a>';
// 	return $links;
// }

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'add_plugin_page_settings_link');

function add_plugin_page_settings_link ( $links ) {
 $mylinks = array(
 '<a href="' . admin_url( 'options-general.php?page=myplugin' ) . '">Settings</a>',
 );
return array_merge( $links, $mylinks );
}

// Add test shortcode
require( plugin_dir_path(__FILE__) . '/includes/test-shortcode.php');
// Add insta shortcode
require( plugin_dir_path(__FILE__) . '/includes/instagram-feed-shortcode.php');