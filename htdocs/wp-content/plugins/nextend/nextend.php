<?php
/*
Plugin Name: Nextend
Plugin URI: http://www.nextendweb.com
Description: Nextend Library for Accordion Menu and future plugins.
Version: 1.2.1
Author: Nextend
Author URI: http://www.nextendweb.com
License: GPL2
*/

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'wp-library.php');

$nextend_api_url = 'http://www.nextendweb.com/update/wordpress/';
$nextend_plugin_slug = basename(dirname(__FILE__));


// Take over the update check
add_filter('pre_set_site_transient_update_plugins', 'nextend_check_for_plugin_update');

function nextend_check_for_plugin_update($checked_data) {
	global $nextend_api_url, $nextend_plugin_slug, $wp_version;
	//Comment out these two lines during testing.
	if (empty($checked_data->checked))
		return $checked_data;
	
	$args = array(
		'slug' => $nextend_plugin_slug,
		'version' => $checked_data->checked[$nextend_plugin_slug .'/'. $nextend_plugin_slug .'.php'],
	);
	$request_string = array(
			'body' => array(
				'action' => 'basic_check', 
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);
	
	// Start checking for an update
	$raw_response = wp_remote_post($nextend_api_url, $request_string);
	
	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
		$response = unserialize($raw_response['body']);
	
	if (is_object($response) && !empty($response)) // Feed the update data into WP updater
		$checked_data->response[$nextend_plugin_slug .'/'. $nextend_plugin_slug .'.php'] = $response;
	
	return $checked_data;
}


// Take over the Plugin info screen
add_filter('plugins_api', 'nextend_plugin_api_call', 9, 3);

function nextend_plugin_api_call($def, $action, $args) {
	global $nextend_plugin_slug, $nextend_api_url, $wp_version;
	if (!isset($args->slug) || ($args->slug != $nextend_plugin_slug))
		return $def;
	
	// Get the current version
	$plugin_info = get_site_transient('update_plugins');
	$current_version = $plugin_info->checked[$nextend_plugin_slug .'/'. $nextend_plugin_slug .'.php'];
	$args->version = $current_version;
	
	$request_string = array(
			'body' => array(
				'action' => $action, 
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);
	
	$request = wp_remote_post($nextend_api_url, $request_string);
	
	if (is_wp_error($request)) {
		$res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
	} else {
		$res = unserialize($request['body']);
		
		if ($res === false)
			$res = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $request['body']);
	}
	
	return $res;
}
?>