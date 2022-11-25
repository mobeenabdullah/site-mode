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
class Content_Section
{


    public function __construct()
    {
        $this->add_sections();
    }

    public function add_sections()
    {
        //Content Section
        add_settings_section('rex-maintenance-content-logo-section', '', [$this, 'rex_maintenance_content_logo_section_callback'], 'rex-maintenance-options-one');
        add_settings_section('rex-maintenance-content-text-section', '', [$this, 'rex_maintenance_content_customization_section_callback'], 'rex-maintenance-options-one');

    }
    public function rex_maintenance_content_customization_section_callback()
    {

    }
    public function rex_maintenance_content_logo_section_callback() {

    }
}