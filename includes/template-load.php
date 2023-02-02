<?php

class Template_Load  {
	protected $general_settings;

	protected $template;
	public function __construct() {
		$this->general_settings = unserialize(get_option( 'site_mode_general' ));
		$this->template = unserialize(get_option( 'site_mode_design' ));
	}
	public function template_initialize () {

		$mode_status = $this->general_settings['mode_status'];
		$mode_type = $this->general_settings['mode_type'];

		if(is_user_logged_in() && isset($_GET['site-mode-preview']) == 'true') {
			if(isset($_GET['template'])) {
				$this->template = $_GET['template'];
				$this->load_template();
			} else {
				$this->load_template();
			}

		} elseif ($mode_status && $this->check_user_role() && $this->check_whitelist_pages() && $this->check_redirect_status()) {
			if($mode_type === 'maintenance' && !empty($this->template)) {
				status_header( 200 );
				nocache_headers();
				$this->load_template();
			} else if(!empty($this->template)) {
				status_header( 503);
				nocache_headers();
				$this->load_template();
			}
		}
	}

	public function check_user_role () {
		$current_user = wp_get_current_user()->roles;
		$user_roles = $this->general_settings['user_roles'];

		if(in_array($current_user, $user_roles)) {
			return false;
		}
		return true;
	}

	public function check_whitelist_pages () {
		$whitelist_pages = isset($this->general_settings['whitelist_pages']) ? $this->general_settings['whitelist_pages'] : [];

		$page_name = get_post_field( 'post_name', get_post() );

		if(in_array($page_name, $whitelist_pages)) {
			return false;
		}
		return true;
	}
	public function check_redirect_status () {
		$mode_type = $this->general_settings['mode_type'];
		$redirect_url = $this->general_settings['redirect_url'];
		$redirect_delay = $this->general_settings['redirect_delay'];

		if($mode_type === 'redirect') {
			if($redirect_url) {
				sleep($redirect_delay);
				wp_redirect( $redirect_url, 301 );
				exit();
			}
			return  false;
		} else {
			return true;
		}

	}
	public function load_template () {

		wp_enqueue_style('preconnect-font', 'https://fonts.googleapis.com');
		wp_enqueue_style('preconnect-static', 'https://fonts.gstatic.com');
		wp_enqueue_style('open-sans-font', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap');

		if(!empty(get_option( 'site_mode_design_font' ))) {
			$font_family = unserialize(get_option( 'site_mode_design_font' ));
			$heading_font_family     = $font_family['heading_font_family'];
			$description_font_family = $font_family['description_font_family'];

			if(!empty($heading_font_family)) {
				wp_enqueue_style($heading_font_family, "https://fonts.googleapis.com/css2?family=".$heading_font_family.":wght@300;400;500;600;700&display=swap");
			}
			if(!empty($description_font_family)) {
				wp_enqueue_style($description_font_family, "https://fonts.googleapis.com/css2?family=".$description_font_family.":wght@300;400;500;600;700&display=swap");
			}

		}
		wp_enqueue_style($this->template , plugin_dir_url(__FILE__) . '../public/css/'.$this->template .'.css', array(), '1.0.0', 'all');
		require_once plugin_dir_path(__DIR__) . 'public/templates/' . $this->template . '.php';
		exit;
	}
}

