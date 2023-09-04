<?php

class Template_Load {
	protected $general_settings;

	protected $template;
	public function __construct() {
		$this->general_settings = get_option( 'site_mode_general' );
		$this->template         = get_option( 'site_mode_design' );
	}
	public function template_initialize() {

		$mode_status = isset( $this->general_settings['mode_status'] ) ? $this->general_settings['mode_status'] : false;
		$mode_type   = isset( $this->general_settings['mode_type'] ) ? $this->general_settings['mode_type'] : 'maintenance';

		if ( is_user_logged_in() && isset( $_GET['site-mode-preview'] ) == 'true' ) {
			return true;
		} elseif ( $mode_status && $this->check_user_role() && $this->check_whitelist_pages() && $this->check_redirect_status() ) {
//			if ( $mode_type === 'maintenance' && ! empty( $this->template ) ) {
				status_header( 200 );
				nocache_headers();
				return true;
//			} elseif ( ! empty( $this->template ) ) {
//				status_header( 503 );
//				nocache_headers();
//				return true;
//			}
		}
	}

    public function sm_is_gutenberg_editor() {

        if(empty($this->template['page_id'])) {
            return false;
        }

        // Gutenberg plugin is installed and activated.
        $gutenberg = ! ( false === has_filter( 'replace_editor', 'gutenberg_init' ) );

        // Block editor since 5.0.
        $block_editor = version_compare( $GLOBALS['wp_version'], '5.0-beta', '>' );

        if ( ! $gutenberg && ! $block_editor ) {
            return false;
        }

        if ( $this->is_sm_classic_editor_plugin_active() ) {
            return false;
        } else {
            update_option( 'show_on_front', 'page' );
            return true;
        }
    }

    public function is_sm_classic_editor_plugin_active() {
        if ( ! function_exists( 'is_plugin_active' ) ) {
            include_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        if ( is_plugin_active( 'classic-editor/classic-editor.php' ) ) {
            return true;
        }

        return false;
    }

	public function check_user_role() {
		$current_user_roles = wp_get_current_user()->roles;
		$wp_user_roles      = isset( $this->general_settings['user_roles'] ) ? $this->general_settings['user_roles'] : [];

		$role_exist = array_intersect( $current_user_roles, $wp_user_roles );

		if ( ! empty( $role_exist ) ) {
			return false;
		}
		return true;
	}

	public function check_whitelist_pages() {
		$whitelist_pages     = isset( $this->general_settings['whitelist_pages'] ) ? $this->general_settings['whitelist_pages'] : [];
		$get_current_page_ID = get_the_ID();

		if ( in_array( $get_current_page_ID, $whitelist_pages ) ) {
			return false;
		}
		return true;
	}
	public function check_redirect_status() {
		$mode_type      = $this->general_settings['mode_type'];
		$redirect_url   = $this->general_settings['redirect_url'];
		$redirect_delay = $this->general_settings['redirect_delay'];

		if ( $mode_type === 'redirect' ) {
			if ( $redirect_url ) {
				sleep( $redirect_delay );
				wp_redirect( $redirect_url, 301 );
				exit();
			}
			return false;
		} else {
			return true;
		}

	}

    public function load_classic_template() {
        if($this->template_initialize()) {
            $this->load_template();
        }
    }

	public function load_template() {
		wp_enqueue_style( 'default_template', plugin_dir_url( __FILE__ ) . '../public/css/default_template.css', [], '0.0.2', 'all' );
		require_once plugin_dir_path( __DIR__ ) . 'public/templates/default_template.php';
		exit;
	}

    public function pre_option_redirect_page($value) {
        $page_id = isset( $this->template['page_id'] ) ? $this->template['page_id'] : '';
        if(!empty($page_id) && $this->template_initialize()){
            return $page_id;
        } else {
            return $value;
        }
    }
}

