<?php
/**
 * Site Mode Init
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/admin
 */

/**
 * Site Mode Init
 *
 * This class defines all code necessary to run during the plugin's admin.
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/admin
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Init {

	/**
	 * Admin Menu.
	 *
	 * @var Site_Mode_Menu
	 */
	public $admin_menu;

	/**
	 * General Settings.
	 *
	 * @var Site_Mode_General
	 */
	protected $general_settings;

	/**
	 * Design Settings.
	 *
	 * @var Site_Mode_Design
	 */
	protected $design_settings;

	/**
	 * SEO Settings.
	 *
	 * @var Site_Mode_Seo
	 */
	protected $seo_settings;

	/**
	 * Design Settings.
	 *
	 * @var Site_Mode_Advanced
	 */
	protected $advanced_settings;

	/**
	 * Integrations Settings.
	 *
	 * @var Site_Mode_Integrations
	 */
	protected $intergrations_settings;

	/**
	 * Design Settings.
	 *
	 * @var Site_Mode_Subscribe
	 */
	protected $subscribe_settings;

	/**
	 * Constructor.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->files_loader();
		$this->admin_menu             = new Site_Mode_Menu();
		$this->general_settings       = new Site_Mode_General();
		$this->design_settings        = new Site_Mode_Design();
		$this->seo_settings           = new Site_Mode_Seo();
		$this->advanced_settings      = new Site_Mode_Advanced();
		$this->intergrations_settings = new Site_Mode_Integrations();
		$this->subscribe_settings     = new Site_Mode_Subscribe();
	}

	/**
	 * Load all files.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return void
	 */
	public function files_loader() {
		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-menu.php';
		require_once SITE_MODE_ADMIN . 'classes/class-settings.php';
		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-general.php';
		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-design.php';
		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-seo.php';
		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-advanced.php';
		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-integrations.php';
		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-subscribe.php';
		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-contact-form.php';
	}

	/**
	 * Get General Settings.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return Site_Mode_General
	 */
	public function get_general() {
		return new Site_Mode_General();
	}

	/**
	 * Get Design Settings.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return Site_Mode_Design
	 */
	public function get_design() {
		return new Site_Mode_Design();
	}

	/**
	 * Get SEO Settings.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return Site_Mode_Seo
	 */
	public function get_seo() {
		return new Site_Mode_Seo();
	}

	/**
	 * Get Advanced Settings.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return Site_Mode_Advanced
	 */
	public function get_advanced() {
		return new Site_Mode_Advanced();
	}

	/**
	 * Get Integrations Settings.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return Site_Mode_Integrations
	 */
	public function get_integrations() {
		return new Site_Mode_Integrations();
	}

	/**
	 * Get Subscribe Settings.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return Site_Mode_Subscribe
	 */
	public function get_subscribes() {
		return new Site_Mode_Subscribe();
	}

	/**
	 * Get Contact Form Settings.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return Site_Mode_Contact_Form
	 */
	public function get_contact_form() {
		return new Site_Mode_Contact_Form();
	}

}
