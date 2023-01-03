<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/public
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Public
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
		 * defined in Site_Mode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Site_Mode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        wp_enqueue_style('preconnect-font', 'https://fonts.googleapis.com');
        wp_enqueue_style('preconnect-static', 'https://fonts.gstatic.com');
        wp_enqueue_style('open-sans-font', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap');
        if(!empty(get_option( 'site_mode_design_font' ))) {
            $font_family = get_option( 'site_mode_design_font' );
            //unseralize the font family
            $font_family = unserialize($font_family);
               $heading_font_family     = $font_family['heading_font_family'];
               $description_font_family = $font_family['description_font_family'];

            //            $selected_font = $font_family['font_family'];
            if(!empty($heading_font_family)) {
                wp_enqueue_style($heading_font_family, "https://fonts.googleapis.com/css2?family=".$heading_font_family.":wght@300;400;500;600;700&display=swap");
            }
            if(!empty($description_font_family)) {
                wp_enqueue_style($description_font_family, "https://fonts.googleapis.com/css2?family=".$description_font_family.":wght@300;400;500;600;700&display=swap");
            }

        }


		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/site-mode-public.css', array(), $this->version, 'all');

        $selected_template = get_option('content-content-template-settings');
        $template =  get_option('site_mode_general');
        $un_data = unserialize($template);

        //check if the values are set or not and then assign them to the variables
        $status         = isset($un_data['status'] ) ? $un_data['status']  : '';
        $mode           = isset($un_data['mode'] ) ? $un_data['mode']  : '';
        $url            = isset($un_data['url'] ) ? $un_data['url']  : '';



        $template = get_option('site_mode_design');
        // convert serialized string to array
        $un_data = unserialize($template);
        //check if value is set or not if not set then set default value.
        $enable_template = isset($un_data['enable_template']) ? $un_data['enable_template'] : '1';

        if($mode==='redirect') {
            echo 'This is redirect is working fine';
            //redirect mode to the give url
            //wp redirect method with $url as parameter.
            if(!empty($status) && !empty($url)) {
                wp_redirect( $url, 301 );
                exit;

            }
        }
        else if($mode === 'maintenance') {
                status_header( 200 );
                nocache_headers();
        }
        else if($mode==='coming-soon') {
                status_header( 503);
                nocache_headers();
            }
            else {

        }




        switch (!empty($status)) {
            case ($enable_template == '1'):
                echo $enable_template;
                wp_enqueue_style('template-one', plugin_dir_url(__FILE__) . 'css/template-1.css', array(), $this->version, 'all');
                break;
            case ($enable_template == '2'):
                echo $enable_template;
                wp_enqueue_style('template-one', plugin_dir_url(__FILE__) . 'css/template-2.css', array(), $this->version, 'all');
                break;
            case ($enable_template == '3'):
                echo $enable_template;
                wp_enqueue_style('template-one', plugin_dir_url(__FILE__) . 'css/template-3.css', array(), $this->version, 'all');
                break;
            case ($enable_template == '4'):
                echo $enable_template;
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
		 * defined in Site_Mode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Site_Mode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/site-mode-public.js', array('jquery'), $this->version, false);
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
            require_once plugin_dir_path(dirname(__FILE__)) . 'public/templates/site-mode-template-one.php';
            exit;
        } elseif ($selected_template == '2') {
            require_once plugin_dir_path(dirname(__FILE__)) . 'public/templates/site-mode-template-two.php';
            exit;
        } elseif ($selected_template == '3') {
            require_once plugin_dir_path(dirname(__FILE__)) . 'public/templates/site-mode-template-three.php';
            exit;
        } elseif ($selected_template == '4') {
            require_once plugin_dir_path(dirname(__FILE__)) . 'public/templates/site-mode-template-four.php';
            exit;
        } else {
            require_once plugin_dir_path(dirname(__FILE__)) . 'public/templates/site-mode-template-one.php';
            exit;
        }
    }

}
