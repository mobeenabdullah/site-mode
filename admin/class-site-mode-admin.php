<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mobeenabdullah.com
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
class Site_Mode_Admin {

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

	protected $design_settings;
	protected $seo_settings;
	protected $advanced_settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		require_once SITE_MODE_ADMIN . 'classes/class-init.php';

		// Enqueueing media
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_media' ] );

	}


	/**
	 * @return void
	 */
	public function enqueue_media() {
		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}
	}

	/**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() {
        wp_enqueue_style( 'fontawsome', SITE_MODE_ADMIN_URL . 'assets/css/all.min.css', [], $this->version, 'all' );
		wp_enqueue_style( 'select-2', SITE_MODE_ADMIN_URL . 'assets/css/select-2.css', [], $this->version, 'all' );        
//		wp_enqueue_style( $this->plugin_name, SITE_MODE_ADMIN_URL . 'assets/css/site-mode-admin.css', [], $this->version, 'all' );
        wp_enqueue_style( 'site-mode-dashboard', SITE_MODE_ADMIN_URL . 'assets/css/site-mode-dashboard.css', [], $this->version, 'all' );

        if(isset($_GET['page']) && $_GET['page'] === 'site-mode' && ((isset($_GET['design']) && $_GET['design'] == 'true') || empty(get_option('sm-fresh-installation')) )) {
            wp_enqueue_style( 'site-mode-wizard', SITE_MODE_ADMIN_URL  . 'assets/css/wizard.css', [], $this->version, 'all' );
        }

        // Enqueue Site Mode Color Paltte theme
        $sm_design_data = get_option('site_mode_design');
        if(isset($sm_design_data) && isset($sm_design_data['preset']) && $sm_design_data['preset']) {
            $preset = $sm_design_data['preset'];
            wp_enqueue_style( 'site-mode-'. $preset , SITE_MODE_ADMIN_URL  . 'assets/css/' . $preset . '.css', [], $this->version, 'all' );
        }
	}

	/**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {

		if ( ! did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		wp_enqueue_script( 'select-2', SITE_MODE_ADMIN_URL . 'assets/js/select-2.js', [ 'jquery' ], null, true );
		wp_enqueue_script( $this->plugin_name, SITE_MODE_ADMIN_URL . 'assets/js/site-mode-admin.js', [ 'jquery' ], $this->version, true );
        wp_enqueue_script( 'site-mode-dashboard', SITE_MODE_ADMIN_URL . 'assets/js/site-mode-dashboard.js', [ 'jquery' ], $this->version, true );
		wp_localize_script(
			$this->plugin_name,
			'ajaxObj',
			[
				'ajax_url'   => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( 'site_mode_nonce_field' ),
			]
		);

        if(isset($_GET['page']) && $_GET['page'] === 'site-mode' && ((isset($_GET['design']) && $_GET['design'] == 'true') || empty(get_option('sm-fresh-installation')) )) {
            wp_enqueue_script( 'sm-wizard', plugin_dir_url( __FILE__ ) . 'assets/js/sm-wizard.js', [ 'jquery' ], $this->version, true );
            wp_localize_script(
                'sm-wizard',
                'ajaxObj',
                [
                    'ajax_url'   => admin_url( 'admin-ajax.php' ),
                ]
            );
        }
	}

    public function add_display_post_states( $post_states, $post ) {

        $design_data = get_option( 'site_mode_design' );

        if(!empty($design_data) && isset($design_data['page_id']) && $design_data['page_id'] == $post->ID){
            $post_states['sm_maintenance_status'] = 'Maintenance';
        }

        return $post_states;
    }

    public function sm_plugin_redirect() {
        if (get_option('sm_activation_redirect', false)) {
            delete_option('sm_activation_redirect');
            wp_redirect(admin_url('admin.php?page=site-mode&design=true'));
        }
    }
    
    public function sm_admin_bar () {
        global $wp_admin_bar;

        $general_settings = get_option( 'site_mode_general' );
        $mode_status      = isset( $general_settings['mode_status'] ) ? $general_settings['mode_status'] : false;

        if($mode_status) {
            $text = '<span style="background: red; display: flex; justify-content: center; padding: 0 10px;" class="sm-admin-bar-status" >Site Mode is Enabled</span>';
        } else {
            $text = '<span style="background: lightgrey; color: black; display: flex; justify-content: center; padding: 0 10px;" class="sm-admin-bar-status">Site Mode is Disabled</span>';
        }

        $wp_admin_bar->add_node([
            'id'    => 'site-mode',
            'title' => $text,
            'href'  => admin_url( 'admin.php?page=site-mode' ),
            'meta'  => [
                'class' => 'site-mode-admin-bar',
            ],
        ]);

    }

    public function add_maintenance_template( $templates ) {
        return array_merge(
            $templates,
            array(
                'templates/sm-page-template.php' => __( 'Site Mode template', 'site-mode' ),
            )
        );
    }

    public function use_maintenance_template( $template ) {
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


        $file = SITE_MODE_ADMIN . 'assets/templates/sm-page-template.php';

        if ( is_file( $file ) ) {
            return $file;
        }

        return $template;
    }

    public function sm_add_body_class ($classes ) {
        if(isset($_GET['page']) && $_GET['page'] === 'site-mode' && empty(get_option('sm-fresh-installation'))) {
            return  $classes . 'sm__wizard-mode';
        } elseif(isset($_GET['page']) && $_GET['page'] === 'site-mode') {
            return  $classes . 'sm__dashboard';
        } else {
            return $classes;
        }
    }

    public function site_mode_filter_theme_json_theme( $theme_json ){

        $default_theme_data = $theme_json->get_data();
        $default_colors = $default_theme_data['settings']['color']['palette']['theme'];

        $new_data = array(
            'version'  => 2,
            'settings' => array(
                'color' => array(
                    'palette'    => array(
                        ...$default_colors,
                        array(
                            'slug'  => 'sm-base',
                            'color' => 'white',
                            'name'  => __( 'Site Mode Base', 'site-mode' ),
                        ),
                        array(
                            'slug'  => 'sm-contrast',
                            'color' => 'black',
                            'name'  => __( 'Site Mode Contrast', 'site-mode' ),
                        ),
                        array(
                            'slug'  => 'sm-primary',
                            'color' => '#9DFF20',
                            'name'  => __( 'Site Mode Primary', 'site-mode' ),
                        ),
                        array(
                            'slug'  => 'sm-secondary',
                            'color' => '#345C00',
                            'name'  => __( 'Site Mode Secondary', 'site-mode' ),
                        ),
                        array(
                            'slug'  => 'sm-tertiary',
                            'color' => '#F6F6F6',
                            'name'  => __( 'Site Mode Tertiary', 'site-mode' ),
                        ),
                    ),
                ),
            ),
        );

        return $theme_json->update_with( $new_data );
    }

}
