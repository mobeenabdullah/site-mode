<?php

class Template_Load {
	protected $general_settings;

    protected $advanced_settings;

	protected $template;
	public function __construct() {
		$this->general_settings     = get_option( 'site_mode_general' );
        $this->advanced_settings    = get_option('site_mode_advanced');
		$this->template             = get_option( 'site_mode_design' );
	}
	public function template_initialize() {

		$mode_type   = isset( $this->advanced_settings['mode_type'] ) ? $this->advanced_settings['mode_type'] : 'maintenance';
        $active_template = $this->template['page_setup']['active_page'] ?? '';

		if ( is_user_logged_in() && isset( $_GET['site-mode-preview'] ) == 'true' ) {
			return true;
		} elseif ( $active_template && $this->check_user_role() && $this->check_whitelist_pages() && $this->check_redirect_status() ) {
			if ( $mode_type === 'maintenance') {
				status_header( 200 );
				nocache_headers();
				return true;
			} else {
				status_header( 503 );
				nocache_headers();
				return true;
			}
		}
	}

    public function sm_is_gutenberg_editor() {

        if(empty($this->template['page_setup']) && empty($this->template['page_setup']['active_page'])) {
            return false;
        }

        // Gutenberg plugin is installed and activated.
        $gutenberg = ! ( false === has_filter( 'replace_editor', 'gutenberg_init' ) );

        // Block editor since 5.0.
        $block_editor = version_compare( $GLOBALS['wp_version'], '5.0-beta', '>' );

        if ( ! $gutenberg && ! $block_editor ) {
            return false;
        }

        update_option( 'show_on_front', 'page' );
        return true;

    }

	public function check_user_role() {
		$current_user_roles = wp_get_current_user()->roles;
		$wp_user_roles      = $this->advanced_settings['user_roles'] ?? [];

		$role_exist = array_intersect( $current_user_roles, $wp_user_roles );

		if ( ! empty( $role_exist ) ) {
			return false;
		}
		return true;
	}

	public function check_whitelist_pages() {
		$whitelist_pages     = $this->advanced_settings['whitelist_pages'] ?? [];
		$get_current_page_ID = get_the_ID();

		if ( in_array( $get_current_page_ID, $whitelist_pages ) ) {
			return false;
		}
		return true;
	}
	public function check_redirect_status() {
		$mode_type      = $this->advanced_settings['mode_type'] ?? '';
		$redirect_url   = $this->advanced_settings['redirect_url'] ?? '';
		$redirect_delay = $this->advanced_settings['redirect_delay'] ?? '';

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
		wp_enqueue_style( 'default_template', SITE_MODE_PUBLIC_URL . 'css/default_template.css', [], '1.0.0', 'all' );
		require_once SITE_MODE_PUBLIC . 'templates/default_template.php';
		exit;
	}

    public function pre_option_redirect_page($value) {
        if(!empty($this->template['page_setup']) && !empty($this->template['page_setup']['active_page']) && $this->template_initialize()){
            return $this->template['page_setup']['active_page'];
        } else {
            return $value;
        }
    }
}

