<?php

/**
 * Responsible for plugin menu
 *
 * @link       https://mobeenabdullah.com
 * @since      0.0.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      0.0.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_General extends Settings {
	protected $option_name = 'site_mode_general';
	protected $mode_status;
	protected $mode_type;
	protected $redirect_url;
	protected $redirect_delay;
	protected $show_login_icon;
	protected $custom_login_url;
	protected $whitelist_pages;
	protected $user_roles;

	public function __construct() {
		$this->site_mode_general = $this->get_data( $this->option_name );
		$this->mode_status       = isset( $this->site_mode_general['mode_status'] ) ? $this->site_mode_general['mode_status'] : false;
		$this->mode_type         = isset( $this->site_mode_general['mode_type'] ) ? $this->site_mode_general['mode_type'] : 'maintenance';
		$this->redirect_url      = isset( $this->site_mode_general['redirect_url'] ) ? $this->site_mode_general['redirect_url'] : '';
		$this->redirect_delay    = isset( $this->site_mode_general['redirect_delay'] ) ? $this->site_mode_general['redirect_delay'] : 2;
		$this->show_login_icon   = isset( $this->site_mode_general['show_login_icon'] ) ? $this->site_mode_general['show_login_icon'] : false;
		$this->custom_login_url  = isset( $this->site_mode_general['custom_login_url'] ) ? $this->site_mode_general['custom_login_url'] : '';
		$this->whitelist_pages   = isset( $this->site_mode_general['whitelist_pages'] ) ? $this->site_mode_general['whitelist_pages'] :[];
		$this->user_roles        = isset( $this->site_mode_general['user_roles'] ) ? $this->site_mode_general['user_roles'] : [];
	}

	public function ajax_site_mode_general() {
		$this->verify_nonce( 'general_section_field', 'general_settings_action' );

		$data                     = [];
		$data['mode_status']      = $this->get_post_data( 'site-mode-mode-status', 'general_settings_action', 'general_section_field', 'text' );
		$data['mode_type']        = $this->get_post_data( 'site-mode-mode-type', 'general_settings_action', 'general_section_field', 'text' );
		$data['redirect_url']     = $this->get_post_data( 'site-mode-redirect-url', 'general_settings_action', 'general_section_field', 'text' );
		$data['redirect_delay']   = $this->get_post_data( 'site-mode-redirect-delay', 'general_settings_action', 'general_section_field', 'number' );
		$data['show_login_icon']  = $this->get_post_data( 'site-mode-show-login-icon', 'general_settings_action', 'general_section_field', 'text' );
		$data['custom_login_url'] = $this->get_post_data( 'site-mode-custom-login-url', 'general_settings_action', 'general_section_field', 'text' );

		if ( isset( $_POST['site-mode-whitelist-pages'] ) && isset( $_POST['general_section_field'] ) && wp_verify_nonce( sanitize_text_field( $_POST['general_section_field'] ), 'general_settings_action' ) ) {
			$data['whitelist_pages'] = array_map( 'sanitize_text_field', $_POST['site-mode-whitelist-pages'] );
		}
		if ( isset( $_POST['site-mode-user-roles'] ) && isset( $_POST['general_section_field'] ) && wp_verify_nonce( sanitize_text_field( $_POST['general_section_field'] ), 'general_settings_action' ) ) {
			$data['user_roles'] = array_map( 'sanitize_text_field', $_POST['site-mode-user-roles'] );
		}

		return $this->save_data( $this->option_name, $data );

		wp_die();
	}

	// function to display the template
	public function render() {
		$this->display_settings_page( 'general' );
	}
}
