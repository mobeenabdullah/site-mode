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

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-settings.php';
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
class Site_Mode_Advanced extends Settings {
		protected $option_name = 'site_mode_advanced';
		protected $ga_id;
		protected $fb_id;
		protected $disable_rest_api;
		protected $disable_rss_feed;
		protected $header_code;
		protected $footer_code;
		protected $custom_css;
		protected $site_mode_advanced = [];

	public function __construct() {
		$this->site_mode_advanced = unserialize( get_option( 'site_mode_advanced' ) );
		if ( $this->site_mode_advanced ) {
			$this->ga_id            = isset( $this->site_mode_advanced['ga_id'] ) ? $this->site_mode_advanced['ga_id'] : '';
			$this->fb_id            = isset( $this->site_mode_advanced['fb_id'] ) ? $this->site_mode_advanced['fb_id'] : '';
			$this->disable_rest_api = isset( $this->site_mode_advanced['disable_rest_api'] ) ? $this->site_mode_advanced['disable_rest_api'] : 0;
			$this->disable_rss_feed = isset( $this->site_mode_advanced['disable_rss_feed'] ) ? $this->site_mode_advanced['disable_rss_feed'] : '0';
			$this->header_code      = isset( $this->site_mode_advanced['header_code'] ) ? $this->site_mode_advanced['header_code'] : '';
			$this->footer_code      = isset( $this->site_mode_advanced['footer_code'] ) ? $this->site_mode_advanced['footer_code'] : '';
			$this->custom_css       = isset( $this->site_mode_advanced['custom_css'] ) ? $this->site_mode_advanced['custom_css'] : '';
		}
	}

	public function site_mode_remove_rss_feed() {
		wp_die( 'RSS feed is disabled' );
	}


	public function ajax_site_mode_advanced() {

		$this->verify_nonce( 'advance-custom-message', 'advance-settings-save' );

		// validate using isset and sanitize inputs before storing in database.
		$data                     = [];
		$data['ga_id']            = $this->get_post_data( 'ga-id', 'advance-settings-save', 'advance-custom-message', 'text' );
		$data['fb_id']            = $this->get_post_data( 'facebook-id', 'advance-settings-save', 'advance-custom-message', 'text' );
		$data['custom_css']       = $this->get_post_data( 'custom-css', 'advance-settings-save', 'advance-custom-message', 'text' );
		$data['disable_rest_api'] = $this->get_post_data( 'disable-rest-api', 'advance-settings-save', 'advance-custom-message', 'text' );
		$data['disable_rss_feed'] = $this->get_post_data( 'disable-rss-feed', 'advance-settings-save', 'advance-custom-message', 'text' );
		$data['header_code']      = $this->get_post_data( 'header-code', 'advance-settings-save', 'advance-custom-message', 'code' );
		$data['footer_code']      = $this->get_post_data( 'footer-code', 'advance-settings-save', 'advance-custom-message', 'code' );

		$data['header_code'] = str_replace( "\'", "'", $data['header_code'] );
		$data['footer_code'] = str_replace( "\'", "'", $data['footer_code'] );

		return $this->save_data( $this->option_name, $data );

		wp_die();
	}

	public function site_mode_rest_api( $access ) {

		if ( empty( $this->disable_rest_api ) ) {
			return $access;
		} else {
			return new WP_Error( 'rest_cannot_access', __( 'The REST API on this site has been disabled.', 'site-mode' ), [ 'status' => rest_authorization_required_code() ] );
		}
	}



	public function render() {
		$this->display_settings_page( 'advanced' );
	}
}
