<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mobeenabdullah.com
 * @since      0.0.2
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

	protected $general_settings;

	protected $design_settings;
	protected $seo_settings;
	protected $advanced_settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.2
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/classes/class-init.php';

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
        wp_enqueue_style( 'fontawsome', plugin_dir_url( __FILE__ ) . 'assets/css/all.min.css', [], $this->version, 'all' );
		wp_enqueue_style( 'select-2', plugin_dir_url( __FILE__ ) . 'assets/css/select-2.css', [], $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/site-mode-admin.css', [], $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {

		if ( ! did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		wp_enqueue_script( 'select-2', plugin_dir_url( __FILE__ ) . 'assets/js/select-2.js', [ 'jquery' ], null, true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/site-mode-admin.js', [ 'jquery' ], $this->version, true );
		wp_localize_script(
			$this->plugin_name,
			'ajaxObj',
			[
				'ajax_url'   => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( 'site_mode_nonce_field' ),
			]
		);
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
            wp_redirect(admin_url('admin.php?page=site-mode'));
        }
    }
    
    public function sm_admin_bar () {
        global $wp_admin_bar;

        $general_settings = get_option( 'site_mode_general' );
        $mode_status      = isset( $general_settings['mode_status'] ) ? $general_settings['mode_status'] : false;

        if($mode_status) {
            $text = '<span style="background: red;" class="sm-admin-bar-status">Site Mode is Enabled</span>';
        } else {
            $text = '<span style="background: lightgrey;" class="sm-admin-bar-status">Site Mode is Disabled</span>';
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

        $file = plugin_dir_url( __DIR__ ) . 'admin/assets/templates/sm-page-template.php';
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


        $file = plugin_dir_path( __FILE__ ) . 'assets/templates/sm-page-template.php';

        if ( is_file( $file ) ) {
            return $file;
        }

        return $template;
    }

}
