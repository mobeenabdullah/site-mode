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
class SEO_Section
{


    public function __construct()
    {
        $this->add_Section();
    }
    public function add_Section() {
        //SEO Section
        add_settings_section('rex-maintenance-seo-section', 'SEO Section',[$this,'rex_maintenance_seo_section_callback'], 'rex-maintenance-seo-page');
    }
    public function rex_maintenance_seo_section_callback () {

    }
}