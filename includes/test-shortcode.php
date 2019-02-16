<?php
// [test]
function test_shortcode() {
  return 'TEST SUCCEEDED';
}

add_shortcode('test', 'test_shortcode');