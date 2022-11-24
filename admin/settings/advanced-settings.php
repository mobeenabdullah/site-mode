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
class Advanced_Settings
{


    public function __construct()
    {
        $this->add_settings();
    }

    public function add_settings()
    {
        // Settings for Advance Section
        register_setting('rex-maintenance-setting-seo-group', 'advanced-ga-id-settings');
        register_setting('rex-maintenance-setting-seo-group', 'advanced-custom-css-settings');
        register_setting('rex-maintenance-setting-seo-group', 'advanced-wp-rest-api-settings');
        register_setting('rex-maintenance-setting-seo-group', 'advanced-rss-feed-settings');
        register_setting('rex-maintenance-setting-seo-group', 'advanced-page-whitelist-include-settings');
        register_setting('rex-maintenance-setting-seo-group', 'advanced-page-whitelist-exclude-settings');
        register_setting('rex-maintenance-setting-seo-group', 'advanced-header-code-settings');
        register_setting('rex-maintenance-setting-seo-group', 'advanced-footer-code-settings');
        register_setting('rex-maintenance-setting-seo-group', 'advanced-user-roles-settings');
    }
}