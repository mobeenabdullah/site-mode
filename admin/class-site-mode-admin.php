<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.0.5
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
class Site_Mode_Admin {

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
	/**
	 * Style buffering.
	 *
	 * @var
	 */
	protected $site_mode_buffer_style;

	/**
	 * General settings.
	 *
	 * @var
	 */
	protected $general_settings;

	/**
	 * Design settings.
	 *
	 * @var
	 */
	protected $design_settings;
	/**
	 * SEO settings.
	 *
	 * @var
	 */
	protected $seo_settings;
	/**
	 * Advanced settings.
	 *
	 * @var
	 */
	protected $advanced_settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.5
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		require_once SITE_MODE_ADMIN . 'classes/class-init.php';

		// Enqueueing media
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_media' ) );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @return void
	 */
	public function enqueue_media() {
		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @return void
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'fontawsome', SITE_MODE_ADMIN_URL . 'assets/css/all.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'select-2', SITE_MODE_ADMIN_URL . 'assets/css/select-2.css', array(), $this->version, 'all' );
		// wp_enqueue_style( $this->plugin_name, SITE_MODE_ADMIN_URL . 'assets/css/site-mode-admin.css', [], $this->version, 'all' );
		wp_enqueue_style( 'site-mode-dashboard', SITE_MODE_ADMIN_URL . 'assets/css/site-mode-dashboard.css', array(), $this->version, 'all' );

		if ( isset( $_GET['page'] ) && $_GET['page'] === 'site-mode' && ( ( isset( $_GET['design'] ) && $_GET['design'] === 'true' ) || empty( get_option( 'sm-fresh-installation' ) ) ) ) {
			wp_enqueue_style( 'site-mode-wizard', SITE_MODE_ADMIN_URL . 'assets/css/wizard.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {

		if ( ! did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		wp_enqueue_script( 'select-2', SITE_MODE_ADMIN_URL . 'assets/js/select-2.js', array( 'jquery' ), null, true );
		wp_enqueue_script( $this->plugin_name, SITE_MODE_ADMIN_URL . 'assets/js/site-mode-admin.js', array( 'jquery' ), $this->version, true );
		wp_localize_script(
			$this->plugin_name,
			'ajaxObj',
			array(
				'ajax_url'   => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( 'site_mode_nonce_field' ),
			)
		);

		if ( isset( $_GET['page'] ) && $_GET['page'] === 'site-mode' && ( ( isset( $_GET['design'] ) && $_GET['design'] === 'true' ) || empty( get_option( 'sm-fresh-installation' ) ) ) ) {
			wp_enqueue_script( 'sm-wizard', plugin_dir_url( __FILE__ ) . 'assets/js/sm-wizard.js', array( 'jquery' ), $this->version, true );
			wp_localize_script(
				'sm-wizard',
				'ajaxObj',
				array(
					'ajax_url' => admin_url( 'admin-ajax.php' ),
				)
			);
		}
	}

	/**
	 * Add display post status.
	 *
	 * @return void
	 */
	public function add_display_post_states( $post_states, $post ) {

		$design_data      = get_option( 'site_mode_design' );
		$maintenance_page = isset( $design_data['page_setup']['maintenance_page_id'] ) ? $design_data['page_setup']['maintenance_page_id'] : '';
		$coming_soon_page = isset( $design_data['page_setup']['coming_soon_page_id'] ) ? $design_data['page_setup']['coming_soon_page_id'] : '';
		$error_404_page   = isset( $design_data['page_setup']['404_page_id'] ) ? $design_data['page_setup']['404_page_id'] : '';

		if ( $coming_soon_page === $post->ID ) {
			$post_states['sm_coming_soon_status'] = 'Coming Soon';
		}

		if ( $maintenance_page === $post->ID ) {
			$post_states['sm_maintenance_status'] = 'Maintenance';
		}

		if ( $error_404_page === $post->ID ) {
			$post_states['sm_404_status'] = '404 Page';
		}

		return $post_states;
	}

	/**
	 * SM plugin redirect.
	 *
	 * @return void
	 */
	public function sm_plugin_redirect() {
		if ( get_option( 'sm_activation_redirect', false ) ) {
			delete_option( 'sm_activation_redirect' );
			wp_redirect( admin_url( 'admin.php?page=site-mode&design=true' ) );
		}
	}

	/**
	 * SM admin bar.
	 *
	 * @return void
	 */
	public function sm_admin_bar() {
		global $wp_admin_bar;

		$design_settings  = get_option( 'site_mode_design' );
		$is_status_active = isset( $design_settings['page_setup'] ) && ! empty( $design_settings['page_setup']['active_page'] ) && get_post_status( $design_settings['page_setup']['active_page'] ) === 'publish' ? $design_settings['page_setup']['active_page'] : '';
		$maintenance_page = isset( $design_settings['page_setup'] ) && ! empty( $design_settings['page_setup']['maintenance_page_id'] ) && get_post_status( $design_settings['page_setup']['maintenance_page_id'] ) === 'publish' ? $design_settings['page_setup']['maintenance_page_id'] : '';
		$coming_soon_page = isset( $design_settings['page_setup'] ) && ! empty( $design_settings['page_setup']['coming_soon_page_id'] ) && get_post_status( $design_settings['page_setup']['coming_soon_page_id'] ) === 'publish' ? $design_settings['page_setup']['coming_soon_page_id'] : '';

		if ( $is_status_active ) {
			if ( $is_status_active === $maintenance_page ) {
				$text = '<span style="background: #fe4773; color: #fff; display: flex; justify-content: center; padding: 0 10px;" class="sm-admin-bar-status" >Maintenance Mode is Enabled</span>';
			} elseif ( $is_status_active === $coming_soon_page ) {
				$text = '<span style="background: #fe4773; color: #fff; display: flex; justify-content: center; padding: 0 10px;" class="sm-admin-bar-status">Coming Soon Mode Enabled</span>';
			} else {
				return;
			}

			$wp_admin_bar->add_node(
				array(
					'id'    => 'site-mode',
					'title' => $text,
					'href'  => admin_url( 'admin.php?page=site-mode' ),
					'meta'  => array(
						'class' => 'site-mode-admin-bar',
					),
				)
			);
		}
	}

	/**
	 * Add maintenance template.
	 *
	 * @return void
	 */
	public function add_maintenance_template( $templates ) {
		return array_merge(
			$templates,
			array(
				'templates/sm-page-template.php' => __( 'Site Mode template', 'site-mode' ),
			)
		);
	}

	/**
	 * Use maintenance template.
	 *
	 * @return void
	 */
	public function use_maintenance_template( $template ) {
		global $post;
		$sm_template_file     = SITE_MODE_ADMIN . 'assets/templates/sm-page-template.php';
		$sm_404_template_file = SITE_MODE_ADMIN . 'assets/templates/sm-404-page-template.php';

		$sm_design_data         = get_option( 'site_mode_design' );
		$sm_404_template_active = isset( $sm_design_data['page_setup']['404_template_active'] ) ? $sm_design_data['page_setup']['404_template_active'] : '';

		if ( is_404() && $sm_404_template_active ) {
			if ( is_file( $sm_404_template_file ) ) {
				return $sm_404_template_file;
			}
		}

		if ( empty( $post ) ) {
			return $template;
		}

		$current_template = get_post_meta( $post->ID, '_wp_page_template', true );

		if ( empty( $current_template ) ) {
			return $template;
		}
		if ( 'templates/sm-page-template.php' !== $current_template ) {
			return $template;
		}

		global $post;
		if ( empty( $post ) ) {
			return $template;
		}

		$current_template = get_post_meta( $post->ID, '_wp_page_template', true );

		if ( empty( $current_template ) ) {
			return $template;
		}
		if ( 'templates/sm-page-template.php' !== $current_template ) {
			return $template;
		}

		if ( is_file( $sm_template_file ) ) {
			return $sm_template_file;
		}

		return $template;
	}

	/**
	 * SM add body class.
	 *
	 * @return void
	 */
	public function sm_add_body_class( $classes ) {
		if ( isset( $_GET['page'] ) && $_GET['page'] === 'site-mode' && ( empty( get_option( 'sm-fresh-installation' ) ) || ( isset( $_GET['design'] ) && $_GET['design'] === 'true' ) ) ) {
			$classes .= ' sm__wizard-mode ';
			return $classes;
		} elseif ( isset( $_GET['page'] ) && $_GET['page'] === 'site-mode' ) {
			$classes .= ' sm__dashboard ';
			return $classes;
		} else {
			return $classes;
		}
	}

	/**
	 * SM remember fse style.
	 *
	 * @return void
	 */
	public function sm_remember_fse_style() {
		ob_start();
		wp_head();
		$output = ob_get_contents();
		ob_end_clean();

		echo $output;

		$doc = new DOMDocument();
		$doc->loadHTML( '<html>' . $output . '</html>' );
		$this->site_mode_buffer_style = $doc->getElementsByTagName( 'style' );
	}

	/**
	 * SM fse style.
	 *
	 * @return void
	 */
	public function sm_fse_style() {
		ob_start();
		wp_head();
		$output = ob_get_contents();
		ob_end_clean();

		$doc = new DOMDocument();
		$doc->loadHTML( '<html>' . $output . '</html>' );
		$elems = $doc->getElementsByTagName( 'style' );
		$css   = '';

		$common_positions = array();

		foreach ( $elems as $i => $elem ) {
			foreach ( $this->site_mode_buffer_style as $style ) {
				if ( $elems->item( $i )->C14N() === $style->C14N() ) {
					$common_positions[] = $i;
				}
			}
		}

		foreach ( $elems as $i => $elem ) {
			if ( in_array( $i, $common_positions ) ) {
				continue;
			}

			$css .= $elems->item( $i )->C14N();
		}

		echo $css;
	}
}
