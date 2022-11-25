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

        register_setting('rex-maintenance-setting-content-group', 'content-text-logo-setting', ['default' => bloginfo('name')]);
        register_setting('rex-maintenance-setting-content-group', 'content-image-logo-setting');
        register_setting('rex-maintenance-setting-content-group', 'content-disable-logo-setting');
        register_setting('rex-maintenance-setting-content-group', 'content-heading-setting', ['default' => 'Under Maintenance']);
        register_setting('rex-maintenance-setting-content-group', 'content-description-setting', ['default' => 'Site will be available soon. Thank you for your patience!']);
        register_setting('rex-maintenance-setting-content-group', 'content-bg-image-setting');
    }

}


