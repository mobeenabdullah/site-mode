<?php
/**
 * Responsible for plugin menu
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
class Site_Mode_General extends Settings {

	/**
	 * The Key of General tab settings in the options table.
	 *
	 * @since    1.1.1
	 * @access   protected
	 * @var      string    $option_name    The Key of general settings tab in the options table.
	 */
	protected $option_name = 'site_mode_general';

	/**
	 * General settings data.
	 *
	 * @since    1.1.1
	 * @access   protected
	 * @var      array    $site_mode_general    General settings data.
	 */
	public $site_mode_general;

	/**
	 * Show login icon.
	 *
	 * @since    1.1.1
	 * @access   protected
	 * @var      boolean    $show_login_icon    Show login icon.
	 */
	protected $show_login_icon;
	/**
	 * Login URL.
	 *
	 * @since    1.1.1
	 * @access   protected
	 * @var      string    $custom_login_url    Login URL.
	 */
	protected $custom_login_url;

	/**
	 * Site_Mode_General constructor.
	 *
	 * @since    1.1.1
	 * @access   public
	 * @return   void
	 */
	public function __construct() {
		$this->site_mode_general = $this->get_data( $this->option_name );
		$this->show_login_icon   = isset( $this->site_mode_general['show_login_icon'] ) ? $this->site_mode_general['show_login_icon'] : false;
		$this->custom_login_url  = isset( $this->site_mode_general['custom_login_url'] ) ? $this->site_mode_general['custom_login_url'] : '';
	}

	/**
	 * Ajax callback for general settings.
	 *
	 * @since    1.1.1
	 * @access   public
	 * @return   void|mixed  $this->save_data( $this->option_name, $data ) Return if nonce is not verified.
	 */
	public function ajax_site_mode_general() {
		$this->verify_nonce( 'general_section_field', 'general_settings_action' );

		$data                     = array();
		$data['show_login_icon']  = $this->get_post_data( 'site-mode-show-login-icon', 'general_settings_action', 'general_section_field', 'text' );
		$data['custom_login_url'] = $this->get_post_data( 'site-mode-custom-login-url', 'general_settings_action', 'general_section_field', 'text' );

		return $this->save_data( $this->option_name, $data );

		wp_die();
	}

		/**
		 * Render general settings page.
		 *
		 * @since    1.1.1
		 * @access   public
		 * @return   void
		 */
	public function render() {
		$this->display_settings_page( 'general' );
	}
}
