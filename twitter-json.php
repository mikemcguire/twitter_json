<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*
Plugin Name: Twittr JSON
Plugin URI:  https://github.com/mikemcguire/twitter_json
Description: Twitter JSON provides a basic interface for retrieving tweets with a semi-RESTFUL API.
Version:     0.0.1
Author:      Overexposed Design
Author URI:  http://overexposeddesign.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: twitter_json

Twitter JSON is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Twitter JSON is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Twitter JSON. If not, see http://www.gnu.org/licenses/gpl.html.
*/

/**** REQUIRE FILES ******/
require_once( dirname(__FILE__).'/vendor/twitter-api-php/TwitterAPIExchange.php' );
require_once( dirname(__file__).'/front/twitter_json_front_end.php' );


define( 'TWITTER_JSON_API_VERSION', '0.0.1' );
if( is_admin() && file_exists(  dirname( __FILE__ ) . '/admin/twitter_json_admin.php' ) )
{
	require_once( dirname(__file__).'/admin/twitter_json_admin.php' );
}


/**
 * Adds our api to wp_rewrite rules and sets a query variable
 * @param type $wp_rules
 * @global $wp Wordpress instance
 */
function json_rewrites() {
	add_rewrite_rule( '^twitter_json/?$','index.php?twitter_json=/','top' );
	add_rewrite_rule( '^twitter_json(.*)?','index.php?twitter_json=$matches[1]','top' );
	global $wp;
	$wp->add_query_var( 'twitter_json' );
}
add_filter('init', 'json_rewrites', 10);

/**
 * Activates plugin updates rewrite rules
 */
function twitter_json_activate(){
	json_rewrites();
	update_option( 'twitter_json_api_plugin_version', null );
}
register_activation_hook( __FILE__, 'twitter_json_activate' );

/**
 * Deactivates plugin flushes rewrites
 */
function twitter_json_deactivate(){
	delete_option( 'twitter_json_api_plugin_version');
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'twitter_json_deactivate' );

/**
 * Determine if the rewrite rules should be flushed.
 */
function json_api_maybe_flush_rewrites() {
	$version = get_option( 'twitter_json_api_plugin_version', null );
	if ( empty( $version ) ||  $version !== TWITTER_JSON_API_VERSION ) {
		flush_rewrite_rules();
		update_option( 'twitter_json_api_plugin_version', TWITTER_JSON_API_VERSION );
	}

}
add_action( 'init', 'json_api_maybe_flush_rewrites', 999 );

/**
 * Loads the front-end of plugin that will result in JSON response
 */
function twitter_json_load() {
	if ( empty( $GLOBALS['wp']->query_vars['twitter_json'] ) )
		return;
	$tweets_json_responder = new Tweets_JSON_Responder();
	$tweets_json_responder->serve_request($GLOBALS['wp']->query_vars['twitter_json']);
}
add_action( 'template_redirect', 'twitter_json_load', -100 );

?>