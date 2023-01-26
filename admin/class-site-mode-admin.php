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

    protected $general_settings;
    protected $content_settings;
    protected $social_settings;
    protected $design_settings;
    protected $seo_settings;
    protected $advanced_settings;
    protected $import_settings;
    protected $export_settings;

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

        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/classes/class-init.php';

        // Enqueueing media
        add_action('admin_enqueue_scripts', [$this,'enqueue_media']);

    }


    /**
     * @return void
     */
    public function enqueue_media() {
        if( function_exists( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }
    }

	/**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() {

		wp_enqueue_style('select-2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' );
		wp_enqueue_style( 'range-slider', plugin_dir_url( __FILE__ ) . 'assets/css/rangeslider.css', array(), $this->version, 'all' );

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'assets/css/site-mode-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script('jquery-ui-draggable', array('jquery'), $this->version, false);
        if (!did_action('wp_enqueue_media')) {
            wp_enqueue_media();
        }
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'assets/js/site-mode-admin.js', array('jquery'), $this->version, false);
        wp_localize_script( $this->plugin_name,'ajaxObj',array(
            'ajax_url'      => admin_url( 'admin-ajax.php' ),
            'ajax_nonce'    =>wp_create_nonce('site_mode_nonce_field'),
        ));

		wp_enqueue_script ( 'select-2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), '1.0.0', false );
		wp_enqueue_script ( 'ace-editor', 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.14.0/ace.js', array('jquery'), '1.0.0', false );
		wp_enqueue_script('range-slider', plugin_dir_url(__FILE__) . 'assets/js/rangeslider.js', array( 'jquery' ), '1.0.0', false);
    }
}
