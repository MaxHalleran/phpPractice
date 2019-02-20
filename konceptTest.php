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
require_once(plugin_dir_path(__FILE__) . '/includes/konceptTest-scripts.php');

// Set variables
$client_id = '906b05d7cd2f4642bd9f1086b31c0dfd';

// Add settings link and admin page
add_action('admin_menu', 'add_admin_page');
function add_admin_page() {
  add_menu_page('KonceptTest Settings', 'Koncept Test', 'manage_options', 'kt_plugin', 'admin_index', 'dashicons-store', 110);
}

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'add_plugin_page_settings_link');
function add_plugin_page_settings_link( $links ) {
  $links[] = '<a href ="' .
    admin_url( 'options-general.php?page=kt_plugin' ) .
    '">' . __('Settings') . '</a>';
  return $links;
}

function admin_index( $client_id ) {
  require_once(plugin_dir_path(__FILE__) . '/templates/admin_index.php');
}

// Add test shortcode
require( plugin_dir_path(__FILE__) . '/includes/test-shortcode.php');
// Add insta shortcode
require( plugin_dir_path(__FILE__) . '/includes/instagram-feed-shortcode.php');