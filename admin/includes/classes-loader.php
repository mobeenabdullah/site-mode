<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/admin
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Rex_Classes_loader
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

        $this->general_settings     = new Rex_General();
        $this->content_settings     = new Rex_Content();
        $this->social_settings      = new Rex_Social();
        $this->design_settings      = new Rex_Design();
        $this->seo_settings         = new Rex_Seo();
        $this->advanced_settings    = new Rex_Advanced();
        $this->import_settings      = new Rex_Import();
        $this->export_settings      = new Rex_Export();
    }

    public function files_loader() {
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-rex-general.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-rex-content.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-rex-social.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-rex-design.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-rex-seo.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-rex-advanced.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-rex-import.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/classes/class-rex-export.php';
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







