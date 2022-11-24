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
class Design_Settings
{


    public function __construct()
    {
        $this->add_settings();
    }

    public function add_settings()
    {
        // Settings for Design Section
        register_setting('rex-maintenance-setting-design-group', 'content-content-template-settings');

    }
}