<?php
/**
 * Responsible for template load.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for template load.
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.1.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Template_Load {
	/**
	 * General settings for the site mode.
	 *
	 * @var array
	 */
	protected $general_settings;
	/**
	 * Advanced settings for the site mode.
	 *
	 * @var array
	 */
	protected $advanced_settings;
	/**
	 * Template settings for the site mode design.
	 *
	 * @var array
	 */
	protected $template;
	/**
	 * Constructor to initialize class properties with relevant options.
	 */
	public function __construct() {
		$this->general_settings  = get_option( 'site_mode_general' );
		$this->advanced_settings = get_option( 'site_mode_advanced' );
		$this->template          = get_option( 'site_mode_design' );
	}
	/**
	 * Initializes the site mode template.
	 *
	 * @return bool True if the site mode is active, false otherwise.
	 */
	public function template_initialize() {

		$maintenance_page = isset( $this->template['page_setup']['maintenance_page_id'] ) ? intval( $this->template['page_setup']['maintenance_page_id'] ) : '';
		$active_template  = isset( $this->template['page_setup']['active_page'] ) ? intval( $this->template['page_setup']['active_page'] ) : '';

		if ( is_user_logged_in() && isset( $_GET['site-mode-preview'] ) === true ) {
			return true;
		} elseif ( $active_template && $this->check_user_role() && $this->check_whitelist_pages() && $this->check_redirect_status() ) {
			if ( $maintenance_page === $active_template ) {
				status_header( 200 );
				nocache_headers();
				return true;
			} else {
				status_header( 503 );
				nocache_headers();
				return true;
			}
		} else {
			return false;
		}
	}
	/**
	 * Checks if the site mode is active based on template settings.
	 *
	 * @return bool True if site mode is active, false otherwise.
	 */
	public function is_site_mode_active(): bool {

		if ( empty( $this->template['page_setup'] ) && empty( $this->template['page_setup']['active_page'] ) ) {
			return false;
		}

		// Gutenberg plugin is installed and activated.
		$gutenberg = ! ( false === has_filter( 'replace_editor', 'gutenberg_init' ) );

		// Block editor since 5.0.
		$block_editor = version_compare( $GLOBALS['wp_version'], '5.0-beta', '>' );

		if ( ! $gutenberg && ! $block_editor ) {
			return false;
		}

		update_option( 'show_on_front', 'page' );
		return true;
	}

	/**
	 * Checks if the current user has the required role.
	 *
	 * @return bool True if the user role is allowed, false otherwise.
	 */
	public function check_user_role() {
		$current_user_roles = wp_get_current_user()->roles;
		$wp_user_roles      = $this->advanced_settings['user_roles'] ?? array();

		$role_exist = array_intersect( $current_user_roles, $wp_user_roles );

		if ( ! empty( $role_exist ) ) {
			return false;
		}
		return true;
	}

	/**
	 * Checks if the current page is whitelisted.
	 *
	 * @return bool True if the page is whitelisted, false otherwise.
	 */
	public function check_whitelist_pages() {
		$whitelist_pages     = $this->advanced_settings['whitelist_pages'] ?? array();
		$get_current_page_id = get_the_ID();

		if ( in_array( $get_current_page_id, $whitelist_pages ) ) {
			return false;
		}
		return true;
	}
	/**
	 * Checks the redirect status and performs redirection if necessary.
	 *
	 * @return bool True if redirection is not needed, false otherwise.
	 */
	public function check_redirect_status() {
		$redirect       = $this->advanced_settings['redirect'] ?? '';
		$redirect_url   = $this->advanced_settings['redirect_url'] ?? '';
		$redirect_delay = $this->advanced_settings['redirect_delay'] ?? '';

		if ( $redirect ) {
			if ( $redirect_url ) {
				sleep( $redirect_delay );
				wp_redirect( $redirect_url, 301 );
				exit();
			}
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Callback function for the pre_option_redirect_page filter.
	 *
	 * @param mixed $value The value to be filtered.
	 *
	 * @return mixed The filtered value.
	 */
	public function pre_option_redirect_page( $value ) {
		if ( ! empty( $this->template['page_setup'] ) && ! empty( $this->template['page_setup']['active_page'] ) && get_post_status( $this->template['page_setup']['active_page'] ) === 'publish' && $this->template_initialize() ) {
			return $this->template['page_setup']['active_page'];
		} else {
			return $value;
		}
	}
}
