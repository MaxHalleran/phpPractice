<?php // Functions
  function authorize_instagram_account($code) {
    $authorization_code = $code;

    // Authenticate the authorization.
		$response = wp_remote_post( 'https://api.instagram.com/oauth/access_token', array(
			'timeout' => 30,
			'body'    => array(
				'client_id'     => '906b05d7cd2f4642bd9f1086b31c0dfd',
				'client_secret' => '2cd75fe6bd1543f4878b6a84512c814d',
				'grant_type'    => 'authorization_code',
				'code'          => $authorization_code,
				'redirect_uri'  => admin_url('admin.php?page=kt_plugin'),
			),
		) );
		if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
			return;
		}
		$data = json_decode( wp_remote_retrieve_body( $response ) );
		if ( ! isset( $data->access_token ) ) {
			return;
		}
		update_option( 'kt_instagram_access_token', sanitize_text_field( $data->access_token ) );
		wp_redirect( admin_url( 'admin.php?page=kt_plugin' ) );
		die();
  }
?>

<?php // State
  $state = $_GET['state'];
  $code = $_GET['code'];
  $access_token = get_option('kt_instagram_access_token');
  static $auth = 'nothing doing';
?>

<?php // Control flow
authorize_instagram_account($code);
  // lets check to see if there is an access token already stored.
  if ($access_token) {
    // we have an access token already stored.
    $auth = $access_token;
  } elseif ($code) {
    // Lets authorize this sucka
    $auth = $code;
  } else {
    // we have no access token or code
    $auth = "nothing's started yet :/";
  }
?>

<div id="kt-plugin-header">
  <h1>Koncept Test Plugin</h1>
  <h3>Test: <?php echo "$auth" ?></h3>
  <p>Authorize us to post your latest 5 instagram posts to your site.</p>
</div>

<div>
  <h2>Configure</h3>

  <div id="kt-plugin-config-button">
    <a href="https://api.instagram.com/oauth/authorize/?client_id=906b05d7cd2f4642bd9f1086b31c0dfd&redirect_uri=<?php echo admin_url('admin.php?page=kt_plugin'); ?>&return_uri=<?php echo admin_url('admin.php?page=kt_plugin'); ?>&response_type=code&state=<?php echo admin_url('admin.php?page=kt_plugin'); ?>"><i class="fa fa-user-plus" aria-hidden="true" style="font-size: 20px;"></i>&nbsp;Connect an instagram account using 0auth</a>
  </div>

  <?php if ($access_token) : ?>
    <div> <h3>Your instagram account has succcessfully been connected</h3> </div>
  <?php endif; ?>

  <?php if ($state) : ?>
      <div> <h1>There was a state, <?php echo $state ?></h1> </div>
  <?php endif; ?>

  <?php if ($code) : ?>
      <div> <h1>There was a code, <?php echo $code ?></h1> </div>
  <?php endif; ?>
  
</div>