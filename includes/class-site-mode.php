<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://mobeenabdullah.com
 * @since      0.0.2
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
 * @since      0.0.2
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    0.0.2
	 * @access   protected
	 * @var      Site_Mode_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;


	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    0.0.2
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    0.0.2
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;
	protected $classes_loader = '';

	protected $utilities = '';

	protected $status = '';



	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    0.0.2
	 */
	public function __construct() {

		if ( defined( 'SITE_MODE_VERSION' ) ) {
			$this->version = SITE_MODE_VERSION;
		} else {
			$this->version = '0.0.2';
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
	 * - Site_Mode_i18n. Defines internationalization functionality.
	 * - Site_Mode_Admin. Defines all hooks for the admin area.
	 * - Site_Mode_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    0.0.2
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-site-mode-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-site-mode-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-site-mode-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/classes/class-plugin-menu.php';

		/**
		 * The class responsible for defining advanced settings page of the plugin
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/classes/class-site-mode-advanced.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/template-load.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-site-mode-public.php';

		$this->loader = new Site_Mode_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Site_Mode_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    0.0.2
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Site_Mode_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    0.0.2
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin         = new Site_Mode_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->classes_loader = new init();

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        $this->loader->add_filter( 'display_post_states', $plugin_admin, 'add_display_post_states', 10, 2 );
		$this->loader->add_action( 'admin_menu', $this->classes_loader->admin_menu, 'site_mode_menu' );
		$this->loader->add_action( 'admin_menu', $this->classes_loader->admin_menu, 'site_mode_submenu_settings_page' );

		// ajax calling

        // template init
        $this->loader->add_action( 'wp_ajax_ajax_site_mode_template_skip', $this->classes_loader->get_design(), 'ajax_site_mode_template_skip' );
        $this->loader->add_action( 'wp_ajax_ajax_site_mode_template_init', $this->classes_loader->get_design(), 'ajax_site_mode_template_init' );
        $this->loader->add_action( 'wp_ajax_ajax_site_mode_design_page_init', $this->classes_loader->get_design(), 'ajax_site_mode_design_page_init' );

		// general
		$this->loader->add_action( 'wp_ajax_ajax_site_mode_general', $this->classes_loader->get_general(), 'ajax_site_mode_general' );

		// SEO settings
		$this->loader->add_action( 'wp_ajax_ajax_site_mode_seo', $this->classes_loader->get_seo(), 'ajax_site_mode_seo' );
		// advanced settings
		$this->loader->add_action( 'wp_ajax_ajax_site_mode_advanced', $this->classes_loader->get_advanced(), 'ajax_site_mode_advanced' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    0.0.2
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Site_Mode_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_filter( 'rest_authentication_errors', $this->classes_loader->get_advanced(), 'site_mode_rest_api' );

		// feeds
		$this->loader->add_action( 'do_feed', $this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed' );
		$this->loader->add_action( 'do_feed_rdf', $this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1 );
		$this->loader->add_action( 'do_feed_rss', $this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1 );
		$this->loader->add_action( 'do_feed_rss2', $this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1 );
		$this->loader->add_action( 'do_feed_atom', $this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1 );
		$this->loader->add_action( 'do_feed_rss2_comments', $this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1 );
		$this->loader->add_action( 'do_feed_atom_comments', $this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1 );

		// Template load
		$template_load = new Template_Load();

        if($template_load->sm_is_gutenberg_editor()) {
            $this->loader->add_filter( 'pre_option_page_on_front', $template_load, 'pre_option_redirect_page');
        } else {
            $this->loader->add_action( 'template_redirect', $template_load, 'load_classic_template' );
        }

	}

	// menu

	public function get_menu() {
		$settings_menu = new Site_Mode_Menu();
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    0.0.2
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     0.0.2
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     0.0.2
	 * @return    Site_Mode_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     0.0.2
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}

