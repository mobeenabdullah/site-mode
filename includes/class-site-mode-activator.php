<?php
/**
 * Fired during plugin activation
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.1.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Activator {

	/**
	 * Activate plugin.
	 *
	 * @since    1.1.1
	 * @return   void
	 */
	public static function activate() {
		// Add default options to database for general settings.
		$general_settings = array(
			'mode_status'      => 0,
			'redirect_url'     => '',
			'redirect_delay'   => 0,
			'show_login_icon'  => 1,
			'custom_login_url' => get_home_url( '', 'wp-login.php' ),
		);

		// add default options to database for SEO settings fields with placeholder text.
		$seo_settings = array(
			'meta_title'       => '',
			'meta_description' => '',
			'meta_favicon'     => '',
			'meta_image'       => '',
		);

		// adding default options to database for advanced settings.
		$advance_settings = array(
			'enable_rest_api'  => '0',
			'disable_rss_feed' => '0',
			'enable_feed'      => '1',
			'mode_type'        => 'maintenance',
			'whitelist_pages'  => array(),
			'user_roles'       => array( 'administrator' ),
		);

		$integrations_settings = array(
			'ga_id' => '',
			'fb_id' => '',
		);

		// Add default options to database for general settings.
		$settings = array(
			'site_mode_general'      => $general_settings,
			'site_mode_seo'          => $seo_settings,
			'site_mode_advanced'     => $advance_settings,
			'site_mode_integrations' => $integrations_settings,
			'sm_activation_redirect' => true,
		);

		foreach ( $settings as $key => $value ) :
			add_option( $key, $value );
		endforeach;
	}
}
