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
        register_setting('rex-maintenance-setting-social-group', 'content-social-fb-setting',[ 'default' => 'username' ]);
        register_setting('rex-maintenance-setting-social-group', 'content-social-linkedin-setting',[ 'default' => 'username' ]);
        register_setting('rex-maintenance-setting-social-group', 'content-social-twitter-setting',[ 'default' => 'username' ]);
        register_setting('rex-maintenance-setting-social-group', 'content-social-add-setting');
        register_setting('rex-maintenance-setting-social-group', 'content-social-delete-setting');

    }
}