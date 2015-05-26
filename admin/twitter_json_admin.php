<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function twitter_json_settings_page (){
	echo "<h1>Twitter JSON</h1>";
	echo "<h2>Twitter API</h2>";
}

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




?>