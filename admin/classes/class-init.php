<?php

class init {

	public $admin_menu;
	protected $general_settings;
	protected $seo_settings;
	protected $advanced_settings;
    protected $intergrations_settings;

    public function __construct() {
		$this->files_loader();
		$this->admin_menu        = new Site_Mode_Menu();
		$this->general_settings  = new Site_Mode_General();
		$this->design_settings   = new Site_Mode_Design();
		$this->seo_settings      = new Site_Mode_Seo();
		$this->advanced_settings = new Site_Mode_Advanced();
        $this->intergrations_settings = new Site_Mode_Integrations();
	}

	public function files_loader() {
		require_once SITE_MODE_ADMIN . 'classes/class-plugin-menu.php';
		require_once SITE_MODE_ADMIN . 'classes/class-settings.php';
		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-general.php';
		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-design.php';
		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-seo.php';
		require_once SITE_MODE_ADMIN . 'classes/class-site-mode-advanced.php';
        require_once SITE_MODE_ADMIN . 'classes/class-site-mode-integrations.php';
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

    public function get_integrations() {
        return new Site_Mode_Integrations();
    }
}
