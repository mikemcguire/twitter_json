<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<div class="wrap">
	<h2>Twitter JSON</h2>
	<form method="post" action="options.php"> 
		<?php settings_fields( 'twitter_json' ); 
		do_settings_sections( 'twitter_json' ); ?>
		<table class="form-table">
	        <tr valign="top">
	        <th scope="row">oAuth Access Token</th>
	        <td><input type="text" name="twitter_json_oauth_access_token" value="<?php echo esc_attr( get_option('twitter_json_oauth_access_token') ); ?>" /></td>
	        </tr>
	         
	        <tr valign="top">
	        <th scope="row">oAuth Access Token Secret</th>
	        <td><input type="text" name="twitter_json_oauth_access_token_secret" value="<?php echo esc_attr( get_option('twitter_json_oauth_access_token_secret') ); ?>" /></td>
	        </tr>
	        
	        <tr valign="top">
	        <th scope="row">Consumer Key</th>
	        <td><input type="text" name="twitter_json_consumer_key" value="<?php echo esc_attr( get_option('twitter_json_consumer_key') ); ?>" /></td>
	        </tr>
	        <tr valign="top">
	        <th scope="row">Consumer Secret</th>
	        <td><input type="text" name="twitter_json_consumer_secret" value="<?php echo esc_attr( get_option('twitter_json_consumer_secret') ); ?>" /></td>
	        </tr>
	    </table>
		<?php submit_button(); ?>
	</form>
</div>