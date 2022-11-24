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
class Advanced_Section
{


    public function __construct()
    {
        $this->add_Section();
    }
    public function add_Section() {
        //Advance Section
        add_settings_section('rex-maintenance-advanced-section', 'Advance Section',[$this,'rex_maintenance_advanced_section_callback'], 'rex-maintenance-advanced-page');
    }

    public function rex_maintenance_advanced_section_callback() {

    }
}