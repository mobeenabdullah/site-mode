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
		$this->get_settings_page();
		add_action('template_redirect', [$this, 'load_template_on_call']);

//		add_action('wp_head', [$this, 'load_internal_css']);
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
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-rex-maintenance-mode-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-rex-maintenance-mode-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the options page of the plugin
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-settings-page.php';

		/**
		 * The class responsible for defining all actions that occur in the Menu of the plugin
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-plugin-menu.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rex-maintenance-mode-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-rex-maintenance-mode-public.php';





		$this->loader = new Rex_Maintenance_Mode_Loader();
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

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
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
	}


	// settings

	public function get_settings_page()
	{
		$settings_page = new Rex_Maintenance_Mode_Setting_page();
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



	public function load_templates()
	{
		$selected_template = get_option('content-content-template-settings');
		if ($selected_template == '1') {
			require_once plugin_dir_path(dirname(__FILE__)) . 'public/templates/rex-maintenance-mode-template-one.php';
			exit;
		} elseif ($selected_template == '2') {
			require_once plugin_dir_path(dirname(__FILE__)) . 'public/templates/rex-maintenance-mode-template-two.php';
			exit;
		} elseif ($selected_template == '3') {
			require_once plugin_dir_path(dirname(__FILE__)) . 'public/templates/rex-maintenance-mode-template-three.php';
			exit;
		} elseif ($selected_template == '4') {
			require_once plugin_dir_path(dirname(__FILE__)) . 'public/templates/rex-maintenance-mode-template-four.php';
			exit;
		} else {
			require_once plugin_dir_path(dirname(__FILE__)) . 'public/templates/rex-maintenance-mode-template-default.php';
			exit;
		}
	}


	function load_internal_css()
	{
		if (!is_user_logged_in() && !empty(get_option('enable-disable-settings'))) {
			$image_url = wp_get_attachment_image_url(get_option('content-bg-image-settings'), 'full');
			echo $image_url . 'testdata';
?>
			<style>
				body {
					background-image: url("<?php echo $image_url ?>") !important;
					background-repeat: no-repeat;
					background-position: center;
					background-size: cover !important;
				}
			</style>
<?php
		}
	}

	public function load_template_on_call()
	{
		if (!is_user_logged_in() && !empty(get_option('enable-disable-settings'))) {

			esc_html($this->load_templates());
			exit;
		}
	}



}
