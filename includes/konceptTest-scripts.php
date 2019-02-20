<?php
  // Add Scripts
  function kt_add_scripts() {
    // Add main css
    wp_enqueue_style('kt-main-style', plugins_url() . '/konstructTest/css/style.css');
    // Add main js
    wp_enqueue_script('kt-main-script', plugins_url() . '/konstructTest/js/main.js');
  }

  add_action('wp_enqueue_scripts', 'kt_add_scripts');