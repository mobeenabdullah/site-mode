<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
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
 * @since      1.0.0
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Site_Mode_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;


	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;
    protected $classes_loader = '';

    protected $utilities = '';


	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{

//        require_once plugin_dir_path(dirname(__FILE__)) . '/admin/includes/classes/utilities.php';
//        $this->utilities = new Utilities();

		if (defined('SITE_MODE_VERSION')) {
			$this->version = SITE_MODE_VERSION;
		} else {
			$this->version = '1.0.0';
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
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'core/class-site-mode-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'core/class-site-mode-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-site-mode-admin.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/includes/classes/class-plugin-menu.php';

        /**
         * The class responsible for defining advanced settings page of the plugin
         */
        require_once plugin_dir_path(dirname(__FILE__)) . '/admin/includes/classes/class-site-mode-advanced.php';



		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-site-mode-public.php';

		$this->loader = new Site_Mode_Loader();

        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/includes/classes-loader.php';
        $this->classes_loader = new Site_Mode_Classes_loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Site_Mode_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Site_Mode_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new Site_Mode_Admin($this->get_plugin_name(), $this->get_version());
        $plugin_menu = new Site_Mode_Menu();

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action('admin_menu', $plugin_menu, 'site_mode_menu');
        $this->loader->add_action('admin_menu', $plugin_menu, 'site_mode_submenu_settings_page');

        // ajax calling

        // general
        $this->loader->add_action('wp_ajax_ajax_site_mode_general',$this->classes_loader->get_general(),'ajax_site_mode_general');

        // content
        $this->loader->add_action('wp_ajax_ajax_site_mode_content',$this->classes_loader->get_content(), 'ajax_site_mode_content');

        // social
        $this->loader->add_action('wp_ajax_ajax_site_mode_social',$this->classes_loader->get_social(),'ajax_site_mode_social');

        //design
        $this->loader->add_action('wp_ajax_ajax_site_mode_design',$this->classes_loader->get_design(), 'ajax_site_mode_design');
        $this->loader->add_action('wp_ajax_ajax_site_mode_design_lb',$this->classes_loader->get_design(),'ajax_site_mode_design_lb');
        $this->loader->add_action('wp_ajax_ajax_site_mode_design_font',$this->classes_loader->get_design(),'ajax_site_mode_design_font');
        $this->loader->add_action('wp_ajax_ajax_site_mode_design_color_section',$this->classes_loader->get_design(),'ajax_site_mode_design_color_section');


        // SEO settings
        $this->loader->add_action('wp_ajax_ajax_site_mode_seo',$this->classes_loader->get_seo(),'ajax_site_mode_seo');
        // advanced settings
        $this->loader->add_action('wp_ajax_ajax_site_mode_advanced',$this->classes_loader->get_advanced(),'ajax_site_mode_advanced');

        //export  and export settings
        $this->loader->add_action('wp_ajax_ajax_site_mode_export',$this->classes_loader->get_export(),'ajax_site_mode_export');
        $this->loader->add_action('wp_ajax_ajax_site_mode_import',$this->classes_loader->get_import(),'ajax_site_mode_import');



	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new Site_Mode_Public($this->get_plugin_name(), $this->get_version());
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
//        $this->loader->add_action('template_redirect', $this->classes_loader->get_design(), 'load_template_on_call');

        $this->loader->add_action('wp_head', $this->classes_loader->get_advanced(), 'site_mode_custom_css_include');
        $this->loader->add_action('wp_head', $this->classes_loader->get_advanced(), 'header_code_include');
//        $this->loader->add_action('wp_head', $this->classes_loader->get_advanced(), 'site_mode_google_analytics_code');
        $this->loader->add_action('wp_head', $this->classes_loader->get_advanced(), 'site_mode_google_analytics_id');
        $this->loader->add_action('wp_footer', $this->classes_loader->get_advanced(), 'footer_code_include');
        $this->loader->add_filter('rest_authentication_errors',$this->classes_loader->get_advanced(), 'site_mode_rest_api');


        //feeds
        $this->loader->add_action('do_feed', $this->classes_loader->get_advanced(),'site_mode_remove_rss_feed');
        $this->loader->add_action('do_feed_rdf',$this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1);
        $this->loader->add_action('do_feed_rss',$this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1);
        $this->loader->add_action('do_feed_rss2',$this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1);
        $this->loader->add_action('do_feed_atom',$this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1);
        $this->loader->add_action('do_feed_rss2_comments',$this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1);
        $this->loader->add_action('do_feed_atom_comments',$this->classes_loader->get_advanced(), 'site_mode_remove_rss_feed', 1);
        // init hook

	}

	// menu

	public function get_menu()
	{
		$settings_menu = new Site_Mode_Menu();
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Site_Mode_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}




}

