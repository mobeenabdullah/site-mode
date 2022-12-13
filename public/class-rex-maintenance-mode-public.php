<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/public
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Rex_Maintenance_Mode_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

        add_filter('style_loader_tag', [$this, 'my_style_loader_tag_filter'], 10, 2);

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rex_Maintenance_Mode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rex_Maintenance_Mode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        wp_enqueue_style('preconnect-font', 'https://fonts.googleapis.com');
        wp_enqueue_style('preconnect-static', 'https://fonts.gstatic.com');
        wp_enqueue_style('open-sans-font', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap');
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/rex-maintenance-mode-public.css', array(), $this->version, 'all');

        $selected_template = get_option('content-content-template-settings');

        switch (true) {
            case ($selected_template == '1'):
                wp_enqueue_style('template-one', plugin_dir_url(__FILE__) . 'css/template-1.css', array(), $this->version, 'all');
                break;
            case ($selected_template == '2'):
                wp_enqueue_style('template-one', plugin_dir_url(__FILE__) . 'css/template-2.css', array(), $this->version, 'all');
                break;
            case ($selected_template == '3'):
                wp_enqueue_style('template-one', plugin_dir_url(__FILE__) . 'css/template-3.css', array(), $this->version, 'all');
                break;
            case ($selected_template == '4'):
                wp_enqueue_style('template-one', plugin_dir_url(__FILE__) . 'css/template-4.css', array(), $this->version, 'all');
                break;
            default:
                wp_enqueue_style('template-one', plugin_dir_url(__FILE__) . 'css/template-1.css', array(), $this->version, 'all');

        }
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rex_Maintenance_Mode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rex_Maintenance_Mode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/rex-maintenance-mode-public.js', array('jquery'), $this->version, false);
	}

   public function my_style_loader_tag_filter($html, $handle) {
        if ($handle === 'preconnect-font') {
            return str_replace("rel='stylesheet'",
                "rel='preconnect'", $html);
        }
        if ($handle === 'preconnect-static') {
            return str_replace("rel='stylesheet'",
                "rel='preconnect' crossorigin", $html);
        }
        return $html;
    }

    public function load_template_on_call()
    {
        if (!is_user_logged_in() && !empty(get_option('enable-disable-settings'))) {

            esc_html($this->load_templates());
            exit;
        }
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
            require_once plugin_dir_path(dirname(__FILE__)) . 'public/templates/rex-maintenance-mode-template-one.php';
            exit;
        }
    }

}
