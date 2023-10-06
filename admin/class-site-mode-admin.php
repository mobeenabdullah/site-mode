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
    protected $site_mode_buffer_style;

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
        $maintenance_page = isset($design_data['page_setup']['maintenance_page_id']) ? $design_data['page_setup']['maintenance_page_id'] : '';
        $coming_soon_page = isset($design_data['page_setup']['coming_soon_page_id']) ? $design_data['page_setup']['coming_soon_page_id'] : '';

        if($coming_soon_page == $post->ID) {
            $post_states['sm_coming_soon_status'] = 'Coming Soon';
        }

        if($maintenance_page == $post->ID) {
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

        $design_settings = get_option( 'site_mode_design' );
        $is_status_active     = isset( $design_settings['page_setup'] ) && isset($design_settings['page_setup']['active_page']) && !empty($design_settings['page_setup']['active_page']);
        $maintenance_page =  isset( $design_settings['page_setup'] ) && isset($design_settings['page_setup']['maintenance_page_id']) && !empty($design_settings['page_setup']['maintenance_page_id']);
        $coming_soon_page = isset( $design_settings['page_setup'] ) && isset($design_settings['page_setup']['coming_soon_page_id']) && !empty($design_settings['page_setup']['coming_soon_page_id']);

        if($is_status_active) {
            if ($is_status_active == $maintenance_page) {
                $text = '<span style="background: #fe4773; color: #fff; display: flex; justify-content: center; padding: 0 10px;" class="sm-admin-bar-status" >Maintenance Mode is Enabled</span>';
            } elseif ($is_status_active == $coming_soon_page) {
                $text = '<span style="background: #fe4773; color: #fff; display: flex; justify-content: center; padding: 0 10px;" class="sm-admin-bar-status">Coming Soon Mode Enabled</span>';
            } else {
                return;
            }

            $wp_admin_bar->add_node([
                'id' => 'site-mode',
                'title' => $text,
                'href' => admin_url('admin.php?page=site-mode'),
                'meta' => [
                    'class' => 'site-mode-admin-bar',
                ],
            ]);
        }

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
        if(isset($_GET['page']) && $_GET['page'] === 'site-mode' && (empty(get_option('sm-fresh-installation')) || (isset($_GET['design']) && $_GET['design'] === 'true') )) {
            return  $classes . 'sm__wizard-mode';
        } elseif(isset($_GET['page']) && $_GET['page'] === 'site-mode') {
            return  $classes . 'sm__dashboard';
        } else {
            return $classes;
        }
    }

    public function site_mode_filter_theme_json_theme( $theme_json ){
        $preset_scheme = 'default';
        $default_theme_data = $theme_json->get_data();
        $default_colors = $default_theme_data['settings']['color']['palette']['theme'];
        $scheme_file = SITE_MODE_ADMIN . 'assets/color-scheme.json';
        $scheme_content         = json_decode(file_get_contents($scheme_file))->content;
        $design_settings = get_option('site_mode_design');

        if(!empty($design_settings['preset'])) {
            $preset_scheme = $design_settings['preset'];
        }

        $base = $scheme_content->$preset_scheme->base;
        $contrast = $scheme_content->$preset_scheme->contrast;
        $primary = $scheme_content->$preset_scheme->primary;

        $new_data = array(
            'version'  => 2,
            'settings' => array(
                'color' => array(
                    'palette'    => array(
                        ...$default_colors,
                        array(
                            'slug'  => 'sm-base',
                            'color' => $base,
                            'name'  => __( 'Site Mode Base', 'site-mode' ),
                        ),
                        array(
                            'slug'  => 'sm-contrast',
                            'color' => $contrast,
                            'name'  => __( 'Site Mode Contrast', 'site-mode' ),
                        ),
                        array(
                            'slug'  => 'sm-primary',
                            'color' => $primary,
                            'name'  => __( 'Site Mode Primary', 'site-mode' ),
                        )
                    ),
                ),
            ),
        );

        return $theme_json->update_with( $new_data );
    }

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
                if ( $elems->item( $i )->C14N() == $style->C14N() ) {
                    $common_positions[] = $i;
                };
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
