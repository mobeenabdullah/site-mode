<?php

/**
 * Responsible for plugin menu
 *
 * @link       https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

require_once SITE_MODE_ADMIN . 'classes/class-settings.php';
/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.0.0
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
    protected $site_mode_advanced = [];

    protected $whitelist_pages;
    protected $user_roles;
    protected $mode_type;

	public function __construct() {
		$this->site_mode_advanced = get_option( 'site_mode_advanced' );
		if ( $this->site_mode_advanced ) {
			$this->disable_rest_api = isset( $this->site_mode_advanced['disable_rest_api'] ) ? $this->site_mode_advanced['disable_rest_api'] : 0;
			$this->disable_rss_feed = isset( $this->site_mode_advanced['disable_rss_feed'] ) ? $this->site_mode_advanced['disable_rss_feed'] : '0';
            $this->mode_type         = isset( $this->site_mode_advanced['mode_type'] ) ? $this->site_mode_advanced['mode_type'] : 'maintenance';
            $this->whitelist_pages   = isset( $this->site_mode_advanced['whitelist_pages'] ) ? $this->site_mode_advanced['whitelist_pages'] :[];
            $this->user_roles        = isset( $this->site_mode_advanced['user_roles'] ) ? $this->site_mode_advanced['user_roles'] : [];
		}
	}

	public function site_mode_remove_rss_feed() {
		wp_die( 'RSS feed is disabled' );
	}


	public function ajax_site_mode_advanced() {

		$this->verify_nonce( 'advance-custom-message', 'advance-settings-save' );

		// validate using isset and sanitize inputs before storing in database.
		$data                     = [];
		$data['disable_rest_api'] = $this->get_post_data( 'disable-rest-api', 'advance-settings-save', 'advance-custom-message', 'text' );
		$data['disable_rss_feed'] = $this->get_post_data( 'disable-rss-feed', 'advance-settings-save', 'advance-custom-message', 'text' );
        $data['mode_type']        = $this->get_post_data( 'site-mode-mode-type', 'advance-settings-save', 'advance-custom-message', 'text' );

        if ( isset( $_POST['site-mode-whitelist-pages'] ) && isset( $_POST['advance-custom-message'] ) && wp_verify_nonce( sanitize_text_field( $_POST['advance-custom-message'] ), 'advance-settings-save' ) ) {
            $data['whitelist_pages'] = array_map( 'sanitize_text_field', $_POST['site-mode-whitelist-pages'] );
        }
        if ( isset( $_POST['site-mode-user-roles'] ) && isset( $_POST['advance-custom-message'] ) && wp_verify_nonce( sanitize_text_field( $_POST['advance-custom-message'] ), 'advance-settings-save' ) ) {
            $data['user_roles'] = array_map( 'sanitize_text_field', $_POST['site-mode-user-roles'] );
        }

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
