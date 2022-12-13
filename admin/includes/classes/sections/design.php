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
class Design_Section
{


    public function __construct()
    {
        $this->add_Section();
    }
    public function add_Section() {
        //Design Section
        add_settings_section('rex-maintenance-design-section', '', [$this, 'rex_maintenance_design_section_callback'], 'rex-maintenance-design-page');
    }

    public function rex_maintenance_design_section_callback()
    {

    }
}