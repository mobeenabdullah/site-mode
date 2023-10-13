<?php

/**
 * Responsible for plugin menu
 *
 * @link       https://mobeenabdullah.com
 * @since      1.0.2
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.0.2
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_General extends Settings {
	protected $option_name = 'site_mode_general';
	protected $show_login_icon;
	protected $custom_login_url;


	public function __construct() {
		$this->site_mode_general = $this->get_data( $this->option_name );
		$this->show_login_icon   = isset( $this->site_mode_general['show_login_icon'] ) ? $this->site_mode_general['show_login_icon'] : false;
		$this->custom_login_url  = isset( $this->site_mode_general['custom_login_url'] ) ? $this->site_mode_general['custom_login_url'] : '';
	}

	public function ajax_site_mode_general() {
		$this->verify_nonce( 'general_section_field', 'general_settings_action' );

		$data                     = [];
		$data['show_login_icon']  = $this->get_post_data( 'site-mode-show-login-icon', 'general_settings_action', 'general_section_field', 'text' );
		$data['custom_login_url'] = $this->get_post_data( 'site-mode-custom-login-url', 'general_settings_action', 'general_section_field', 'text' );

		return $this->save_data( $this->option_name, $data );

		wp_die();
	}

	// function to display the template
	public function render() {
		$this->display_settings_page( 'general' );
	}
}
