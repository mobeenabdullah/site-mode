<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.1.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.1.1
	 * @access   protected
	 * @var      Site_Mode_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;


	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.1.1
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.1.1
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Initialize classes.
	 *
	 * @var string $classes_loader Init classes.
	 */
	protected $classes_loader = '';

	/**
	 * Utilities.
	 *
	 * @var string $utilities Utilities.
	 */
	protected $utilities = '';

	/**
	 * Status.
	 *
	 * @var string $status Status.
	 */
	protected $status = '';

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.1.1
	 */
	public function __construct() {

		if ( defined( 'SITE_MODE_VERSION' ) ) {
			$this->version = SITE_MODE_VERSION;
		} else {
			$this->version = '1.1.1';
		}
		$this->plugin_name = 'site-mode';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->get_menu();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Site_Mode_Loader. Orchestrates the hooks of the plugin.
	 * - Site_Mode_I18n. Defines internationalization functionality.
	 * - Site_Mode_Admin. Defines all hooks for the admin area.
	 * - Site_Mode_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.1.1
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * This is responsible for loading all blocks.
		 */
		require_once SITE_MODE_BLOCKS . 'site-mode-blocks-init.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */

		require_once SITE_MODE_INC . 'class-site-mode-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once SITE_MODE_INC . 'class-site-mode-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once SITE_MODE_ADMIN . 'class-site-mode-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-menu.php';

		/**
		 * The class responsible for defining advanced settings page of the plugin.
		 */
		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-advanced.php';

		require_once SITE_MODE_INC . 'class-template-load.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once SITE_MODE_PUBLIC . 'class-site-mode-public.php';

		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-subscribe.php';

		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-contact-form.php';

		$this->loader = new Site_Mode_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Site_Mode_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.1.1
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Site_Mode_I18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.1.1
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin         = new Site_Mode_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->classes_loader = new Site_Mode_Init();

		$this->loader->add_action( 'init', $plugin_admin, 'sm_plugin_redirect' );
		$this->loader->add_action( 'wp_before_admin_bar_render', $plugin_admin, 'sm_admin_bar' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $this->classes_loader->admin_menu, 'site_mode_submenu_settings_page' );
		$this->loader->add_filter( 'display_post_states', $plugin_admin, 'add_display_post_states', 10, 2 );
		$this->loader->add_action( 'admin_menu', $this->classes_loader->admin_menu, 'site_mode_menu' );

		// Adding FSE Theme Styles in Site Mode Template.
		$this->loader->add_action( 'wpsm_head', $plugin_admin, 'sm_remember_fse_style' );
		$this->loader->add_action( 'wpsm_footer', $plugin_admin, 'sm_fse_style' );

		// Add body class.
		$this->loader->add_filter( 'admin_body_class', $plugin_admin, 'sm_add_body_class' );

		/**
		 * Ajax calling.
		 */
		$this->loader->add_filter( 'theme_page_templates', $plugin_admin, 'add_maintenance_template' );
		$this->loader->add_filter( 'template_include', $plugin_admin, 'use_maintenance_template' );
		$this->loader->add_action( 'wp_ajax_ajax_site_mode_skip_wizard', $this->classes_loader->get_design(), 'ajax_site_mode_skip_wizard' );
		$this->loader->add_action( 'wp_ajax_ajax_site_mode_template_init', $this->classes_loader->get_design(), 'ajax_site_mode_template_init' );
		$this->loader->add_action( 'wp_ajax_ajax_site_mode_page_setup', $this->classes_loader->get_design(), 'ajax_site_mode_page_setup' );
		$this->loader->add_action( 'wp_ajax_ajax_site_mode_intergrations', $this->classes_loader->get_integrations(), 'ajax_site_mode_intergrations' );
		$this->loader->add_action( 'wp_ajax_ajax_site_mode_general', $this->classes_loader->get_general(), 'ajax_site_mode_general' );
		$this->loader->add_action( 'wp_ajax_ajax_site_mode_seo', $this->classes_loader->get_seo(), 'ajax_site_mode_seo' );
		$this->loader->add_action( 'wp_ajax_ajax_site_mode_advanced', $this->classes_loader->get_advanced(), 'ajax_site_mode_advanced' );
		$this->loader->add_action( 'wp_ajax_insert_subscribes', $this->classes_loader->get_subscribes(), 'insert_subscribes' );
		$this->loader->add_action( 'wp_ajax_nopriv_insert_subscribes', $this->classes_loader->get_subscribes(), 'insert_subscribes' );
		$this->loader->add_action( 'wp_ajax_subscribe_export_csv', $this->classes_loader->get_subscribes(), 'subscribe_export_csv' );
		$this->loader->add_action( 'wp_ajax_delete_subscribe', $this->classes_loader->get_subscribes(), 'delete_subscribe' );
		$this->loader->add_action( 'wp_ajax_send_email_cb', $this->classes_loader->get_contact_form(), 'send_email_cb' );
		$this->loader->add_action( 'wp_ajax_nopriv_send_email_cb', $this->classes_loader->get_contact_form(), 'send_email_cb' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.1.1
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Site_Mode_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_filter( 'rest_authentication_errors', $this->classes_loader->get_advanced(), 'site_mode_rest_api' );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'add_login_icon' );

		// feeds.
		$this->loader->add_action( 'do_feed', $this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed' );
		$this->loader->add_action( 'do_feed_rdf', $this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1 );
		$this->loader->add_action( 'do_feed_rss', $this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1 );
		$this->loader->add_action( 'do_feed_rss2', $this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1 );
		$this->loader->add_action( 'do_feed_atom', $this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1 );
		$this->loader->add_action( 'do_feed_rss2_comments', $this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1 );
		$this->loader->add_action( 'do_feed_atom_comments', $this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1 );

		// Template load.
		$template_load = new Template_Load();

		if ( $template_load->is_site_mode_active() ) {
			$this->loader->add_filter( 'pre_option_page_on_front', $template_load, 'pre_option_redirect_page' );
		}
	}

	// menu.
	/**
	 * Get Menu.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return void
	 */
	public function get_menu() {
		$settings_menu = new Site_Mode_Menu();
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.1.1
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.1.1
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.1.1
	 * @return    Site_Mode_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.1.1
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
