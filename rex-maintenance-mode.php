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
 * @package           Rex_Maintenance_Mode
 *
 * @wordpress-plugin
 * Plugin Name:       REX Maintenance Mode
 * Plugin URI:        https://https://mobeenabdullah.com/plugins
 * Description:       This is a minimalistic coming soon or Maintenance plugin. 
 * Version:           1.0.0
 * Author:            Mobeen Abdullah
 * Author URI:        https://https://mobeenabdullah.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rex-maintenance-mode
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
define('REX_MAINTENANCE_MODE_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rex-maintenance-mode-activator.php
 */
function activate_rex_maintenance_mode()
{
	require_once plugin_dir_path(__FILE__) . 'core/class-rex-maintenance-mode-activator.php';
	Rex_Maintenance_Mode_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rex-maintenance-mode-deactivator.php
 */
function deactivate_rex_maintenance_mode()
{
	require_once plugin_dir_path(__FILE__) . 'core/class-rex-maintenance-mode-deactivator.php';
	Rex_Maintenance_Mode_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_rex_maintenance_mode');
register_deactivation_hook(__FILE__, 'deactivate_rex_maintenance_mode');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'core/class-rex-maintenance-mode.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */





function run_rex_maintenance_mode()
{

	$plugin = new Rex_Maintenance_Mode();
	$plugin->run();
}
run_rex_maintenance_mode();



