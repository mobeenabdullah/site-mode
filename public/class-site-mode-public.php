<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://mobeenabdullah.com
 * @since      0.0.2
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
class Site_Mode_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.2
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.2
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;


	protected $site_mode_design;

	protected $enable_template;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.2
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		$this->site_mode_design = get_option( 'site_mode_design' );

		// check if value is set or not if not set then set default value.
		$this->enable_template = isset( $this->site_mode_design['enable_template'] ) ? $this->site_mode_design['enable_template'] : '1';

		add_filter( 'style_loader_tag', [ $this, 'my_style_loader_tag_filter' ], 10, 2 );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    0.0.2
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( 'fontawsome', SITE_MODE_PUBLIC_URL . 'css/all.min.css', [], $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, SITE_MODE_PUBLIC_URL . 'css/site-mode-public.css', [], $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    0.0.2
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, SITE_MODE_PUBLIC_URL . 'js/site-mode-public.js', [ 'jquery' ], $this->version, false );
	}

	public function my_style_loader_tag_filter( $html, $handle ) {
		if ( $handle === 'preconnect-font' ) {
			return str_replace(
				"rel='stylesheet'",
				"rel='preconnect'",
				$html
			);
		}
		if ( $handle === 'preconnect-static' ) {
			return str_replace(
				"rel='stylesheet'",
				"rel='preconnect' crossorigin",
				$html
			);
		}
		return $html;
	}
}
