<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://mobeenabdullah.com
 * @since             1.0.0
 * @package           Site_Mode
 *
 * @wordpress-plugin
 * Plugin Name:       Site Mode - Under Construction & Maintenance Mode
 * Plugin URI:        https://https://mobeenabdullah.com/plugins
 * Description:       Easily put your WordPress site into maintenance mode while you work on updates or make changes
 * Version:           1.0.0
 * Author:            Mobeen Abdullah
 * Author URI:        https://https://mobeenabdullah.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       site-mode
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('SITE_MODE_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-site-mode-activator.php
 */
function activate_site_mode()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-site-mode-activator.php';
	Site_Mode_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-site-mode-deactivator.php
 */
function deactivate_site_mode()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-site-mode-deactivator.php';
	Site_Mode_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_site_mode');
register_deactivation_hook(__FILE__, 'deactivate_site_mode');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-site-mode.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */


function run_site_mode()
{

	$plugin = new Site_Mode();
	$plugin->run();
}
run_site_mode();


