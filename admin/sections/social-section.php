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
class Social_Section
{


    public function __construct()
    {
        $this->add_Section();
    }
    public function add_Section() {
        //Social Section
        add_settings_section('rex-maintenance-social-section', 'Social Section',[$this,'rex_maintenance_social_section_callback'], 'rex-maintenance-social-page');
    }
    public function rex_maintenance_social_section_callback() {

    }
}