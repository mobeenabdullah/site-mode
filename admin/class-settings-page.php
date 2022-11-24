<?php

/**
 * Load during plugin options page
 *
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/includes
 */
require_once plugin_dir_path(__DIR__) . 'admin/fields/general-fields.php';
require_once plugin_dir_path(__DIR__) . 'admin/fields/content-fields.php';
require_once plugin_dir_path(__DIR__) . 'admin/fields/social-fields.php';
require_once plugin_dir_path(__DIR__) . 'admin/fields/design-fields.php';
require_once plugin_dir_path(__DIR__) . 'admin/fields/seo-fields.php';
require_once plugin_dir_path(__DIR__) . 'admin/fields/advanced-fields.php';


require_once plugin_dir_path(__DIR__) . 'admin/settings/general-setting.php';
require_once plugin_dir_path(__DIR__) . 'admin/settings/content-settings.php';
require_once plugin_dir_path(__DIR__) . 'admin/settings/social-settings.php';
require_once plugin_dir_path(__DIR__) . 'admin/settings/design-settings.php';
require_once plugin_dir_path(__DIR__) . 'admin/settings/seo-settings.php';
require_once plugin_dir_path(__DIR__) . 'admin/settings/advanced-settings.php';


require_once plugin_dir_path(__DIR__) . 'admin/sections/general-section.php';
require_once plugin_dir_path(__DIR__) . 'admin/sections/content-section.php';
require_once plugin_dir_path(__DIR__) . 'admin/sections/design-section.php';
require_once plugin_dir_path(__DIR__) . 'admin/sections/social-section.php';
require_once plugin_dir_path(__DIR__) . 'admin/sections/seo-section.php';
require_once plugin_dir_path(__DIR__) . 'admin/sections/advanced-section.php';

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

    public function  __construct() {}

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
