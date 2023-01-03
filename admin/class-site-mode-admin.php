<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/admin
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Admin
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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        add_action('admin_enqueue_scripts', [$this,'enqueue_media']);

    }

    public function enqueue_media() {
        if( function_exists( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }
    }

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'assets/css/site-mode-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
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

        //enqueue jquery
        wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-draggable', array('jquery'), $this->version, false);
        if (!did_action('wp_enqueue_media')) {
            wp_enqueue_media();
        }
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'assets/js/site-mode-admin.js', array('jquery'), $this->version, false);
        wp_localize_script( $this->plugin_name,'ajaxObj',array(
            'ajax_url'      => admin_url( 'admin-ajax.php' ),
            'ajax_nonce'    =>wp_create_nonce('site_mode_nonce_field'),
        ));

    }

}
