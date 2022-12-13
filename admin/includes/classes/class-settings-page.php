<?php

/**
 * Load during plugin options page
 *
 * This class defines all code necessary to run during the plugin's options page
 *
 * @since      1.0.0
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Rex_Maintenance_Mode_Setting_page
{

    public function  __construct() {
        $this->load_files();
    }

    public function load_files() {
        $files = [
            'general',
            'content',
            'social',
            'design',
            'seo',
            'advanced',
        ];
        /**
         * Load during plugin options page
         *
         * @link       https://https://mobeenabdullah.com
         * @since      1.0.0
         *
         * @package    Rex_Maintenance_Mode
         * @subpackage Rex_Maintenance_Mode/includes
         */

        foreach ($files as $file) {
            require_once plugin_dir_path(__FILE__) . "fields/{$file}.php";
            require_once plugin_dir_path(__FILE__) . "settings/{$file}.php";
            require_once plugin_dir_path(__FILE__) . "sections/{$file}.php";
        }
    }

    public function rex_maintenance_mode_init()
    {

        $general_settings = new General_Settings();
        $content_settings = new Content_Settings();
        $social_settings = new Social_Settings();
        $design_settings = new Design_Settings();
        $seo_settings = new SEO_Settings();
        $advanced_settings = new Advanced_Settings();

        $content_section = new Content_Section();
        $content_section = new General_Section();
        $social_section = new Social_Section();
        $design_section = new Design_Section();
        $seo_section = new SEO_Section();
        $advanced_section = new Advanced_Section();

        $general_fields = new General_Field();
        $content_fields = new Content_Field();
        $social_fields = new Social_Field();
        $design_fields = new Design_Field();
        $seo_fields = new SEO_Field();
        $advanced_fields = new Advanced_Field();

    }

}
