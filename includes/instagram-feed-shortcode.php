<?php
  // [instafeed]
  function instafeed_shortcode( $input ) {
    return "this shortcode now takes an input {$input[0]}";
  }

  add_shortcode('instafeed', 'instafeed_shortcode');