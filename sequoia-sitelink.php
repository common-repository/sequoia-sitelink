<?php
/*
	Plugin Name: Sequoia SiteLink
	Plugin URI: http://sitelink.sequoiaims.com/
	Description: Sequoia SiteLink allows for the easy syndication of brand marketing content from Carrier and Bryant to the network of distributors and authorized dealers. The sequoia-sitelink plugin provides native WordPress integration with the SiteLink embed code. 
	Version: 1.3
	Author: Nik Chanda, Ryan Olson
	Author URI: http://sequoiaims.com
	License: 
		Copyright 2011-2012 Sequoia Technologies IMS, LLC
		All rights reserverved by Sequoia Technologies IMS, LLC
*/

function sequoia_sitelink($atts, $content) {

	extract( shortcode_atts( array(
	      'class' => '',
	      'deploy' => '',
		  'type' => 'sqsl_products',
		  'protocol' => 'http',
		  'target' => 'sitelink.sequoiaims.com',
		  'path' => '/public/ws/'
	      ), $atts ) );
	$deploy = $deploy ? $deploy ."-" : '';

// Define the embed code for the SiteLink script 
$sitelink_code = "
<!-- /* SITELINK EMBED CODE */ -->
<script src='${protocol}://{$deploy}{$target}{$path}'></script>
<div id='{$type}' class='{$class}'></div>
<!-- /* END SITELINK EMBED CODE */ -->
";
	return $sitelink_code;
}

// Register the shortcode
add_shortcode( 'sitelink', 'sequoia_sitelink');

// Add a button to the visual editor
add_action('init', 'add_button'); 

// If user is allowed, show the button on the editor
function add_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'add_plugin');  
     add_filter('mce_buttons', 'register_button');  
   }  
}

// Publish the custom button
function register_button($buttons) {  
   array_push($buttons, "sitelink");  
   return $buttons;  
}

// Add in the jQuery needed for tinymce button addition
function add_plugin($plugin_array) {  
   $plugin_array['sitelink'] = plugins_url('sequoia_sitelink').'/js/sitelink.js';  
   return $plugin_array;  
}
   
?>

