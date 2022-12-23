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
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/includes
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
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Rex_Maintenance_Mode
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Rex_Maintenance_Mode_Loader    $loader    Maintains and registers all hooks for the plugin.
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
		if (defined('REX_MAINTENANCE_MODE_VERSION')) {
			$this->version = REX_MAINTENANCE_MODE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'rex-maintenance-mode';

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
	 * - Rex_Maintenance_Mode_Loader. Orchestrates the hooks of the plugin.
	 * - Rex_Maintenance_Mode_i18n. Defines internationalization functionality.
	 * - Rex_Maintenance_Mode_Admin. Defines all hooks for the admin area.
	 * - Rex_Maintenance_Mode_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path(dirname(__FILE__)) . 'core/class-rex-maintenance-mode-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'core/class-rex-maintenance-mode-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rex-maintenance-mode-admin.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/includes/classes/class-plugin-menu.php';

        /**
         * The class responsible for defining advanced settings page of the plugin
         */
        require_once plugin_dir_path(dirname(__FILE__)) . '/admin/includes/classes/class-rex-advanced.php';




		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-rex-maintenance-mode-public.php';

		$this->loader = new Rex_Maintenance_Mode_Loader();

        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/includes/classes-loader.php';
        $this->classes_loader = new Rex_Classes_loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Rex_Maintenance_Mode_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Rex_Maintenance_Mode_i18n();

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

		$plugin_admin = new Rex_Maintenance_Mode_Admin($this->get_plugin_name(), $this->get_version());
        $plugin_menu = new Rex_Maintenance_Mode_Menu();

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action('admin_menu', $plugin_menu, 'rex_maintenance_mode_menu');
        $this->loader->add_action('admin_menu', $plugin_menu, 'rex_maintenance_mode_submenu_settings_page');
//        $this->loader->add_action('admin_init', $plugin_pages, 'rex_maintenance_mode_init');
//        add_action('admin_init', [$this, 'rex_maintenance_mode_init']);

        // ajax calling

        // general
        $this->loader->add_action('wp_ajax_ajax_rex_general',$this->classes_loader->get_general(),'ajax_rex_general');

        // content
        $this->loader->add_action('wp_ajax_ajax_rex_content',$this->classes_loader->get_content(), 'ajax_rex_content');

        // social
        $this->loader->add_action('wp_ajax_ajax_rex_social',$this->classes_loader->get_social(),'ajax_rex_social');

        //design
        $this->loader->add_action('wp_ajax_ajax_rex_design',$this->classes_loader->get_design(), 'ajax_rex_design');


        $this->loader->add_action('wp_ajax__ajax_rex_design_lb',$this->classes_loader->get_design(),'_ajax_rex_design_lb');
        $this->loader->add_action('wp_ajax_ajax_rex_design_color_section',$this->classes_loader->get_design(),'ajax_rex_design_color_section');

        // SEO settings
        $this->loader->add_action('wp_ajax_ajax_rex_seo',$this->classes_loader->get_seo(),'ajax_rex_seo');

        // advanced settings
        $this->loader->add_action('wp_ajax_ajax_rex_advanced',$this->classes_loader->get_advanced(),'ajax_rex_advanced');


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

		$plugin_public = new Rex_Maintenance_Mode_Public($this->get_plugin_name(), $this->get_version());
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
        $this->loader->add_action('template_redirect', $plugin_public, 'load_template_on_call');
        $this->loader->add_action('wp_head', $this->classes_loader->get_advanced(), 'rex_custom_css_include');
        $this->loader->add_action('wp_head', $this->classes_loader->get_advanced(), 'header_code_include');
        $this->loader->add_action('wp_footer', $this->classes_loader->get_advanced(), 'footer_code_include');

        // ajax ccalls

        //general settings
        // general
        add_action('wp_ajax_nopriv_ajax_rex_general',$this->classes_loader->get_general(),'ajax_rex_general');
        // content
        $this->loader->add_action('wp_ajax_nopriv_ajax_rex_content',$this->classes_loader->get_content(), 'ajax_rex_content');

        // social
        $this->loader->add_action('wp_ajax_nopriv_ajax_rex_social',$this->classes_loader->get_social(),'ajax_rex_social');


        //design
        $this->loader->add_action('wp_ajax_nopriv_ajax_rex_design',$this->classes_loader->get_design(), 'ajax_rex_design');
        $this->loader->add_action('wp_ajax_nopriv_ajax_rex_design_lb',$this->classes_loader->get_design(), 'ajax_rex_design_lb');
        $this->loader->add_action('wp_ajax_nopriv_ajax_rex_design_color_section',$this->classes_loader->get_design(),'ajax_rex_design_color_section');

        // SEO settings
        $this->loader->add_action('wp_ajax_nopriv_ajax_rex_seo',$this->classes_loader->get_seo(),'ajax_rex_seo');


        // advanced settings
        $this->loader->add_action('wp_ajax_nopriv_ajax_rex_advanced',$this->classes_loader->get_advanced(), 'ajax_rex_advanced');



	}

	// menu 

	public function get_menu()
	{
		$settings_menu = new Rex_Maintenance_Mode_Menu();
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
	 * @return    Rex_Maintenance_Mode_Loader    Orchestrates the hooks of the plugin.
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
