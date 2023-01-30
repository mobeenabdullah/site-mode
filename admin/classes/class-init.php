<?php

class init {

    public $admin_menu;
    protected $general_settings;
    protected $content_settings;
    protected $social_settings;
    protected $design_settings;
    protected $seo_settings;
    protected $advanced_settings;
    protected $import_settings;
    protected $export_settings;

    public function __construct() {

        $this->files_loader();

        $this->admin_menu           = new Site_Mode_Menu();
        $this->general_settings     = new Site_Mode_General();
        $this->content_settings     = new Site_Mode_Content();
        $this->social_settings      = new Site_Mode_Social();
        $this->design_settings      = new Site_Mode_Design();
        $this->seo_settings         = new Site_Mode_Seo();
        $this->advanced_settings    = new Site_Mode_Advanced();
        $this->import_settings      = new Site_Mode_Import();
        $this->export_settings      = new Site_Mode_Export();
    }

    public function files_loader() {
        require_once plugin_dir_path(dirname(__FILE__)) . 'classes/class-plugin-menu.php';
	    require_once plugin_dir_path(dirname(__FILE__)) . 'classes/class-settings.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'classes/class-site-mode-general.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'classes/class-site-mode-content.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'classes/class-site-mode-social.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'classes/class-site-mode-design.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'classes/class-site-mode-seo.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'classes/class-site-mode-advanced.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'classes/class-site-mode-import.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'classes/class-site-mode-export.php';
    }

    public function get_general() {
        return new Site_Mode_General();
    }

    public function get_content() {
        return new Site_Mode_Content();
    }

    public function get_social() {
        return new Site_Mode_Social();
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

    public function get_import() {
        return new Site_Mode_Import();
    }

    public function get_export() {
        return new Site_Mode_Export();
    }
}