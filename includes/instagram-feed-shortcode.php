<?php
  // instafeed utility functions
  function sanitize_instagrams( $instagrams = array() ) {
		if ( empty( $instagrams ) ) {
			return $instagrams;
    }
    $posts = array();
    
		foreach ( $instagrams as $post ) {
      $images = array();
      
			// Sanitize the individual image sizes.
			foreach ( $post['images'] as $size => $instagram ) {
				$images[ $size ] = array(
					'width'  => absint( $instagram['width'] ),
					'height' => absint( $instagram['height'] ),
					'url'    => esc_url_raw( $instagram['url'] ),
				);
      }
      
			// Sanitize the entire instagram object.
			$posts[] = array(
				'link'    => isset( $post['link'] ) ? esc_url_raw( $post['link'] ) : '',
				'images'  => $images,
				'caption' => isset( $post['caption']['text'] ) ? sanitize_text_field( $post['caption']['text'] ) : '',
			);
    }
    
		return $posts;
	}

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
    return $response['data'];

    // $instagrams = isset( $response['data'] ) ? sanitize_instagrams( $response['data'] ) : array();
    
		// return $instagrams;
  }

  function format_media($input) {
    static $content = "<div>";
    static $count = 0;

    foreach($input as $key => $gram) {
      $content .= "<h1>Start of gram number: " . $count . " with key: " . $key . "</h1>";
      $count += 1;
      
      $content .= "<div><p>\n[instagram url=" . $gram['link'] . "]\n<p></div>";

    }

    $content .= "</div>";
    return $content;
  }

  // [instafeed]
  function instafeed_shortcode() {
    return format_media(get_recent_media());
  }

  add_shortcode('instafeed', 'instafeed_shortcode');