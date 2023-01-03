<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://mobeenabdullah.com
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
class Site_Mode_Classes_loader
{
     protected $general_settings = '';
     protected $content_settings = '';
     protected $social_settings = '';
     protected $design_settings = '';
     protected $seo_settings = '';
     protected $advanced_settings = '';
     protected $import_settings = '';
     protected $emport_settings = '';




    public function __construct()
    {
        $this->files_loader();
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
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-site-mode-general.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-site-mode-content.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-site-mode-social.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-site-mode-design.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-site-mode-seo.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-site-mode-advanced.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-site-mode-import.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-site-mode-export.php';
    }

    public function get_general()
    {
        return $this->general_settings;
    }

    public function get_content()
    {
        return $this->content_settings;
    }

    public function get_social()
    {
        return $this->social_settings;
    }

    public function get_design()
    {
        return $this->design_settings;
    }

    public function get_seo()
    {
        return $this->seo_settings;
    }

    public function get_advanced()
    {
        return $this->advanced_settings;
    }

    public function get_import()
    {
        return $this->import_settings;
    }

    public function get_export()
    {
        return $this->export_settings;
    }


}







