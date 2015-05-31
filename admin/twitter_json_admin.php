<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Creates our admin html
 * @return html
 */
function twitter_json_settings_page (){
	include dirname(__FILE__).'/options.php' ;
}

/**
 * Addss menu link for settings page to wp admin
 */
function twitter_json_add_menu() {
    add_management_page(
            'Twiter JSON',
            'Twitter JSON Settings',
            'manage_options',
            'twitter-json',
            'twitter_json_settings_page'
        );
}
add_action('admin_menu', 'twitter_json_add_menu'); 

/**
 * Registers options, this allows wordpress to use automatically generate/associate form elements w
 */
function twitter_json_register_settings(){
	register_setting( 'twitter_json', 'twitter_json_oauth_access_token' );
  	register_setting( 'twitter_json', 'twitter_json_oauth_access_token_secret' );
  	register_setting( 'twitter_json', 'twitter_json_consumer_key' );
  	register_setting( 'twitter_json', 'twitter_json_consumer_secret' );

}
add_action( 'admin_init', 'twitter_json_register_settings' );




?>