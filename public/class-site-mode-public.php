<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.0.5
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
	 * @since    1.0.5
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.5
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;


	protected $site_mode_design;

	protected $enable_template;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.5
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		$this->site_mode_design = get_option( 'site_mode_design' );

		// check if value is set or not if not set then set default value.
		$this->enable_template = isset( $this->site_mode_design['enable_template'] ) ? $this->site_mode_design['enable_template'] : '1';

		add_filter( 'style_loader_tag', array( $this, 'my_style_loader_tag_filter' ), 10, 2 );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.5
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

		wp_enqueue_style( $this->plugin_name, SITE_MODE_PUBLIC_URL . 'css/site-mode-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.5
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

		wp_enqueue_script( $this->plugin_name, SITE_MODE_PUBLIC_URL . 'js/site-mode-public.js', array( 'jquery' ), $this->version, false );
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
	function add_login_icon() {

		$general_settings = get_option( 'site_mode_general' );
		$design_settings  = get_option( 'site_mode_design' );
		$active_page      = isset( $design_settings['page_setup']['active_page'] ) ? $design_settings['page_setup']['active_page'] : '';
		$coming_soon_page = isset( $design_settings['page_setup']['coming_soon_page_id'] ) ? $design_settings['page_setup']['coming_soon_page_id'] : '';
		$maintenance_page = isset( $design_settings['page_setup']['maintenance_page_id'] ) ? $design_settings['page_setup']['maintenance_page_id'] : '';
		$is_valid_page    = false;

		if ( ! is_admin() && ( ! is_user_logged_in() || isset( $_GET['site-mode-preview'] ) ) && ( $active_page === get_the_ID() || $coming_soon_page === get_the_ID() && $maintenance_page === get_the_ID() ) ) {
			$is_valid_page = true;
		}

		if ( ! empty( $general_settings['show_login_icon'] ) && ! empty( $general_settings['custom_login_url'] ) && $is_valid_page ) :
			?>
			<div class="login_icon_footer">
				<a href="<?php echo esc_url( $general_settings['custom_login_url'] ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="40"  height="40" viewBox="0 0 24 24" style="fill:#ffffff"><path d="M12 2C9.243 2 7 4.243 7 7v3H6c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-8c0-1.103-.897-2-2-2h-1V7c0-2.757-2.243-5-5-5zm6 10 .002 8H6v-8h12zm-9-2V7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9z" fill="#ffffff"></path></svg>
				</a>
			</div>
			<?php
		endif;
	}
}
