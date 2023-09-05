<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://mobeenabdullah.com
 * @since      0.0.2
 *
 * @package    Site_Mode
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Options cleanup during uninstall plugin

$options = [
	'site_mode_advanced',
	'site_mode_content',
	'site_mode_design',
	'site_mode_design_lb',
	'site_mode_design_colors',
	'site_mode_seo',
	'site_mode_social',
	'site_mode_settings',
	'site_mode_general',
	'site_mode_design_fonts',
	'site_mode_design_social',
	'site_mode_default_images',
];

if ( ! empty( $options ) ) {
	foreach ( $options as $option ) :
		delete_option( $option );
	endforeach;
}
