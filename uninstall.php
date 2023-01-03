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
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Site_Mode
 */

// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
	exit;
}

//Options cleanup during uninstall plugin

$options = [
    'advanced-ga-id-settings',
    'advanced-custom-css-settings',
    'advanced-wp-rest-api-settings',
    'advanced-rss-feed-settings',
    'advanced-page-whitelist-include-settings',
    'advanced-page-whitelist-exclude-settings',
    'advanced-header-code-settings',
    'advanced-footer-code-settings',
    'advanced-user-roles-settings',
    'content-logo-type-setting',
    'content-logo-settings',
    'text-logo-setting',
    'disable-logo-setting',
    'content-headline-settings',
    'content-content-settings',
    'content-bg-image-settings',
    'content-content-template-settings',
    'site-mode-status-settings',
    'site-mode-mode-settings',
    'site-mode-redirect-url-settings',
    'site-mode-delay-settings',
    'site-mode-login-icon-setting'
];


if (!empty($options)) {

	foreach ($options as $option) {

		delete_option($option);
	}
}
