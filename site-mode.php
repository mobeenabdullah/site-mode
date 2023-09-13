<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mobeenabdullah.com
 * @since             0.0.2
 * @package           Site_Mode
 *
 * @wordpress-plugin
 * Plugin Name:       Site Mode - Coming Soon Page, Maintenance Mode & Under Construction Page
 * Plugin URI:        https://github.com/mobeenabdullah/site-mode
 * Description:       Create a beautiful Coming Soon page or switch to Maintenance Mode with ease for your WordPress site
 * Version:           0.0.2
 * Author:            Mobeen Abdullah
 * Author URI:        https://github.com/mobeenabdullah
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       site-mode
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'SITE_MODE_VERSION', '0.0.2' );
define('SITE_MODE_INC', plugin_dir_path( __FILE__ ) . 'includes/');
define('SITE_MODE_ADMIN', plugin_dir_path(__FILE__ ) . 'admin/');
define('SITE_MODE_BLOCKS', plugin_dir_path(__FILE__  ) . 'blocks/');
define('SITE_MODE_PUBLIC', plugin_dir_path( __FILE__ ) . 'public/');
define('SITE_MODE_ADMIN_URL', plugin_dir_url(__FILE__ ) . 'admin/');
define('SITE_MODE_PUBLIC_URL', plugin_dir_url( __FILE__ ) . 'public/');


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-site-mode-activator.php
 */
function activate_site_mode() {
	require_once SITE_MODE_INC . 'class-site-mode-activator.php';
	Site_Mode_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-site-mode-deactivator.php
 */
function deactivate_site_mode() {
	require_once SITE_MODE_INC . 'class-site-mode-deactivator.php';
	Site_Mode_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_site_mode' );
register_deactivation_hook( __FILE__, 'deactivate_site_mode' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require SITE_MODE_INC . 'class-site-mode.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.2
 */


function run_site_mode() {
	$plugin = new Site_Mode();
	$plugin->run();
}
run_site_mode();
