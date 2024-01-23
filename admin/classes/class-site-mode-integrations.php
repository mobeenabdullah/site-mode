<?php
/**
 * Responsible for plugin Integrations settings
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for settings.
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
 * Responsible for Integrations settings
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.1.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Integrations extends Settings {
	/**
	 * The Key of integration tab settings in the options table.
	 *
	 * @since    1.1.1
	 * @access   protected
	 * @var      string    $option_name    The Key of settings in the options table.
	 */
	protected $option_name = 'site_mode_integrations';
	/**
	 * Google Analytics ID.
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var mixed|string $ga_id Google Analytics ID.
	 */
	protected $ga_id;
	/**
	 * Facebook Pixel ID.
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var mixed|string $fb_id Facebook Pixel ID.
	 */
	protected $fb_id;

	/**
	 * Site Mode Integrations.
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var array $site_mode_intergrations Site Mode Integrations.
	 */
	protected $site_mode_intergrations = array();


	/**
	 * Site_Mode_Integrations constructor.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->site_mode_intergrations = get_option( 'site_mode_integrations' );
		if ( $this->site_mode_intergrations ) {
			$this->ga_id = isset( $this->site_mode_intergrations['ga_id'] ) ? $this->site_mode_intergrations['ga_id'] : '';
			$this->fb_id = isset( $this->site_mode_intergrations['fb_id'] ) ? $this->site_mode_intergrations['fb_id'] : '';
		}
	}

	/**
	 * AJAX for site mode integration.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return mixed
	 */
	public function ajax_site_mode_intergrations() {

		$this->verify_nonce( 'intergrations_field', 'intergrations_action' );

		// validate using isset and sanitize inputs before storing in database.
		$data          = array();
		$data['ga_id'] = $this->get_post_data( 'ga-id', 'intergrations_action', 'intergrations_field', 'text' );
		$data['fb_id'] = $this->get_post_data( 'facebook-id', 'intergrations_action', 'intergrations_field', 'text' );

		return $this->save_data( $this->option_name, $data );

		wp_die();
	}

	/**
	 * Render the integration settings page for this plugin.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return void
	 */
	public function render() {
		$this->display_settings_page( 'intergrations' );
	}
}
