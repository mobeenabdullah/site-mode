<?php



/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.0.0
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class SEO_Settings
{


    public function __construct()
    {
        $this->add_settings();
    }

    public function add_settings()
    {
        //Settings for SEO Section
        register_setting('rex-maintenance-setting-seo-group', 'soe-meta-title-setting');
        register_setting('rex-maintenance-setting-seo-group', 'seo-meta-description-setting');
        register_setting('rex-maintenance-setting-seo-group', 'soe-meta-favicon-setting');
        register_setting('rex-maintenance-setting-seo-group', 'soe-meta-image-setting');
    }
}