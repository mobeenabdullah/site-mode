<?php
/**
 * Responsible for Site Mode Advanced Settings
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.1.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
require_once SITE_MODE_ADMIN . 'classes/class-settings.php';

/**
 * Class Site_Mode_Advanced
 *
 * @since      1.1.1
 * @package    Site_Mode
 * @subpackage Site_Mode/Advanced
 */
class Site_Mode_Advanced extends Settings {
	/**
	 * The Key of Advance tab settings in the options table.
	 *
	 * @since    1.1.1
	 * @access   protected
	 * @var      string    $option_name    The Key of settings in the options table.
	 */
	protected $option_name = 'site_mode_advanced';

	/**
	 * Redirect URL.
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var string $redirect_url Redirect URL.
	 */
	protected $redirect_url;

	/**
	 * Redirect delay.
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var int|mixed $redirect_delay Redirect delay.
	 */
	protected $redirect_delay;

	/**
	 * Disable REST API.
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var int|mixed $disable_rest_api Disable REST API.
	 */
	protected $disable_rest_api;

	/**
	 * Disable RSS feed.
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var mixed|int $disable_rss_feed Disable RSS feed.
	 */
	protected $disable_rss_feed;

	/**
	 * Redirect.
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var false|mixed $redirect Redirect.
	 */
	protected $redirect;

	/**
	 * Advanced settings.
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var array|string $site_mode_advanced Advanced settings.
	 */
	protected $site_mode_advanced = array();

	/**
	 * Whitelist pages.
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var array|mixed $whitelist_pages Whitelist pages.
	 */
	protected $whitelist_pages;

	/**
	 * User roles.
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var array|mixed $user_roles User roles.
	 */
	protected $user_roles;

	/**
	 * Site_Mode_Advanced constructor.
	 *
	 * @since 1.1.1
	 * @access public
	 */
	public function __construct() {
		$this->site_mode_advanced = get_option( 'site_mode_advanced' );
		if ( $this->site_mode_advanced ) {
			$this->disable_rest_api = isset( $this->site_mode_advanced['disable_rest_api'] ) ? $this->site_mode_advanced['disable_rest_api'] : 0;
			$this->disable_rss_feed = isset( $this->site_mode_advanced['disable_rss_feed'] ) ? $this->site_mode_advanced['disable_rss_feed'] : '0';
			$this->redirect         = isset( $this->site_mode_advanced['redirect'] ) ? $this->site_mode_advanced['redirect'] : false;
			$this->redirect_url     = isset( $this->site_mode_general['redirect_url'] ) ? $this->site_mode_general['redirect_url'] : '';
			$this->redirect_delay   = isset( $this->site_mode_general['redirect_delay'] ) ? $this->site_mode_general['redirect_delay'] : 2;
			$this->whitelist_pages  = isset( $this->site_mode_advanced['whitelist_pages'] ) ? $this->site_mode_advanced['whitelist_pages'] : array();
			$this->user_roles       = isset( $this->site_mode_advanced['user_roles'] ) ? $this->site_mode_advanced['user_roles'] : array();
		}
	}

	/**
	 * Remove RSS feed.
	 *
	 * @since 1.1.1
	 * @access public
	 */
	public function site_mode_remove_rss_feed() {
		wp_die( 'RSS feed is disabled' );
	}

	/**
	 * AJAX for site mode advance settings.
	 *
	 * @since 1.1.1
	 * @access public
	 */
	public function ajax_site_mode_advanced() {

		$this->verify_nonce( 'advance-custom-message', 'advance-settings-save' );

		// validate using isset and sanitize inputs before storing in database.
		$data                     = array();
		$data['disable_rest_api'] = $this->get_post_data( 'disable-rest-api', 'advance-settings-save', 'advance-custom-message', 'text' );
		$data['disable_rss_feed'] = $this->get_post_data( 'disable-rss-feed', 'advance-settings-save', 'advance-custom-message', 'text' );
		$data['redirect']         = $this->get_post_data( 'redirect', 'advance-settings-save', 'advance-custom-message', 'text' );
		$data['redirect_url']     = $this->get_post_data( 'site-mode-redirect-url', 'advance-settings-save', 'advance-custom-message', 'text' );
		$data['redirect_delay']   = $this->get_post_data( 'site-mode-redirect-delay', 'advance-settings-save', 'advance-custom-message', 'number' );

		if ( isset( $_POST['site-mode-whitelist-pages'] ) && isset( $_POST['advance-custom-message'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['advance-custom-message'] ) ), 'advance-settings-save' ) ) {
			$data['whitelist_pages'] = array_map( 'sanitize_text_field', wp_unslash( $_POST['site-mode-whitelist-pages'] ) );
		}
		if ( isset( $_POST['site-mode-user-roles'] ) && isset( $_POST['advance-custom-message'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['advance-custom-message'] ) ), 'advance-settings-save' ) ) {
			$data['user_roles'] = array_map( 'sanitize_text_field', wp_unslash( $_POST['site-mode-user-roles'] ) );
		}

		return $this->save_data( $this->option_name, $data );

		wp_die();
	}

	/**
	 * Rest API.
	 *
	 * @since 1.1.1
	 * @access public
	 * @param mixed $access Access.
	 */
	public function site_mode_rest_api( $access ) {

		if ( empty( $this->disable_rest_api ) ) {
			return $access;
		} else {
			return new WP_Error( 'rest_cannot_access', __( 'The REST API on this site has been disabled.', 'site-mode' ), array( 'status' => rest_authorization_required_code() ) );
		}
	}

	/**
	 * Render.
	 *
	 * @since 1.1.1
	 * @access public
	 */
	public function render() {
		$this->display_settings_page( 'advanced' );
	}
}
