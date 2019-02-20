<?php
  // instafeed utility functions
  function get_recent_media() {
    $api_url = "https://api.instagram.com/v1/users/self/media/recent/?access_token=" . get_option('kt_instagram_access_token');

    $response = wp_remote_get( add_query_arg( array(
			'access_token' => get_option('kt_instagram_access_token'),
			'count'        => 5,
    ), $api_url ) );
    
    if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
			return $instagrams;
    }
    
    $response = json_decode( wp_remote_retrieve_body( $response ), 1 );
    return $response;

    // $instagrams = isset( $response['data'] ) ? $this->sanitize_instagrams( $response['data'] ) : array();
    
		// return $instagrams;
  }

  // [instafeed]
  function instafeed_shortcode() {
    return "this shortcode now has access to the users recent media: " . get_recent_media();
  }

  add_shortcode('instafeed', 'instafeed_shortcode');