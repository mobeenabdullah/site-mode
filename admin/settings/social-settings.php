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
class Social_Settings
{


    public function __construct()
    {
        $this->add_settings();
    }

    public function add_settings()
    {
        //Settings for Social Section
        register_setting('rex-maintenance-setting-social-group', 'show-social-icons-setting');
        register_setting('rex-maintenance-setting-social-group', 'content-social-fb-settings',[ 'default' => 'username' ]);
        register_setting('rex-maintenance-setting-social-group','content-social-fb-checkbox-settings');
        register_setting('rex-maintenance-setting-social-group', 'content-social-linkedin-settings',[ 'default' => 'username' ]);
        register_setting('rex-maintenance-setting-social-group','content-social-linkedin-checkbox-settings');
        register_setting('rex-maintenance-setting-social-group', 'content-social-twitter-settings',[ 'default' => 'username' ]);
        register_setting('rex-maintenance-setting-social-group','content-social-twitter-checkbox-settings');
    }
}