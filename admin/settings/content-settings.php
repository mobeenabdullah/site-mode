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
class Content_Settings
{


    public function __construct()
    {
        $this->add_settings();
    }

    public function add_settings()
    {
        register_setting('rex-maintenance-setting-content-group', 'content-logo-type-setting');
        register_setting('rex-maintenance-setting-content-group', 'content-logo-settings');
        register_setting('rex-maintenance-setting-content-group', 'text-logo-setting', ['default' => bloginfo('name')]);
        register_setting('rex-maintenance-setting-content-group', 'disable-logo-setting');
        register_setting('rex-maintenance-setting-content-group', 'content-headline-settings', ['default' => 'Headline Here']);
        register_setting('rex-maintenance-setting-content-group', 'content-content-settings', ['default' => 'Write some content']);
        register_setting('rex-maintenance-setting-content-group', 'content-bg-image-settings');
    }

}


