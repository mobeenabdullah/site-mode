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
class General_Settings
{


    public function __construct()
    {
        $this->add_settings();
    }
    public function add_settings() {
        //         Settings for general section
        register_setting('wprex-maintenance-general-group', 'wprex-status-settings');
        register_setting('wprex-maintenance-general-group', 'wprex-mode-settings');
        register_setting('wprex-maintenance-general-group', 'wprex-redirect-url-settings');
        register_setting('wprex-maintenance-general-group', 'wprex-delay-settings');
        register_setting('wprex-maintenance-general-group', 'wprex-login-icon-setting');
        register_setting('wprex-maintenance-general-group', 'wprex-login-url-setting');
    }
}





