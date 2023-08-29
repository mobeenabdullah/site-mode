<?php

class init {

	public $admin_menu;
	protected $general_settings;
	protected $seo_settings;
	protected $advanced_settings;

	public function __construct() {

		$this->files_loader();

		$this->admin_menu        = new Site_Mode_Menu();
		$this->general_settings  = new Site_Mode_General();
		$this->design_settings   = new Site_Mode_Design();
		$this->seo_settings      = new Site_Mode_Seo();
		$this->advanced_settings = new Site_Mode_Advanced();
	}

	public function files_loader() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-plugin-menu.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-settings.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-site-mode-general.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-site-mode-design.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-site-mode-seo.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-site-mode-advanced.php';
	}

	public function get_general() {
		return new Site_Mode_General();
	}

	public function get_design() {
		return new Site_Mode_Design();
	}

	public function get_seo() {
		return new Site_Mode_Seo();
	}

	public function get_advanced() {
		return new Site_Mode_Advanced();
	}
}
