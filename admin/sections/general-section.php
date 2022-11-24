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
class General_Section
{


    public function __construct()
    {
        $this->add_Section();
    }
    public function add_Section() {
        add_settings_section('wprex-maintenance-general-section', 'Primary Settings', [$this, 'rex_maintenance_general_settings_section_callback'], 'wprex-maintenance-general-page');
    }
    public function rex_maintenance_general_settings_section_callback($args)
    {

    }
}



