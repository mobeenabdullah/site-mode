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
class Social_Field
{


    public function __construct()
    {
        $this->add_fields();
    }
    public function add_fields()
    {
        //Social Section Field
        add_settings_field('rex_maintenance_social_icons_show_section_field', 'Show Social Icons', [$this,'rex_maintenance_social_icons_show_cb'],'rex-maintenance-social-page','rex-maintenance-social-section');
        add_settings_field('rex_maintenance_content_social_fb', 'Facebook Username', [$this, 'rex_maintenance_content_social_fb_cb'], 'rex-maintenance-social-page', 'rex-maintenance-social-section');
        //add_settings_field('rex_maintenance_content_social_checkbox_fb', '', [$this, 'rex_maintenance_content_social_fb_checkbox_cb'], 'rex-maintenance-social-page', 'rex-maintenance-social-section');
        add_settings_field('rex_maintenance_content_social_linkedIn', 'LinkedIn Username', [$this, 'rex_maintenance_content_social_linkedin_cb'], 'rex-maintenance-social-page', 'rex-maintenance-social-section');
        //add_settings_field('rex_maintenance_content_social_checkbox_linkedIn', '', [$this, 'rex_maintenance_content_social_linkedIn_checkbox_cb'], 'rex-maintenance-social-page', 'rex-maintenance-social-section');
        add_settings_field('rex_maintenance_content_social_twitter', 'Twitter Username', [$this, 'rex_maintenance_content_social_twitter_cb'], 'rex-maintenance-social-page', 'rex-maintenance-social-section');
        //add_settings_field('rex_maintenance_content_social_checkbox_twitter', '', [$this, 'rex_maintenance_content_social_twitter_checkbox_cb'], 'rex-maintenance-social-page', 'rex-maintenance-social-section');
    }
    public function rex_maintenance_social_icons_show_cb() { ?>
        <div class="um_checkbox_wrapper">
            <input type="checkbox" id="disable_enable_social_icons_settings" name="show-social-icons-setting" value="<?php esc_attr_e(get_option('show-social-icons-setting'),'rex-maintenance-mode'); ?>" />
            <label for="disable_enable_social_icons_settings">Enable/Disable</label>
        </div>
        <?php
    }

    public function rex_maintenance_content_social_fb_cb()
    {
        ?>
        <div class="container-one">
            <input type="text" name="content-social-fb-settings" value="<?php esc_attr_e(get_option('content-bg-social-fb-settings'), 'rex-maintenance-mode') ?>" />
            <input type="checkbox" id="content_social_fb_checkbox_settings" name="content-social-fb-checkbox-settings" value="<?php esc_attr_e(get_option('content-social-fb-checkbox-settings'),'rex-maintenance-mode'); ?>" />
            <label for="content_social_fb_checkbox_settings">Disable</label>
        </div>
        <?php
    }

    public function rex_maintenance_content_social_linkedin_cb()
    {
        ?>
        <div>
            <input type="text" name="content-social-linkedin-settings" value="<?php esc_attr_e(get_option('content-social-linkedin-settings'), 'rex-maintenance-mode') ?>" />
            <input type="checkbox" id="content_social_linkedin_checkbox_settings" name="content-social-linkedin-checkbox-settings" value="<?php esc_attr_e(get_option('content-social-linkedin-checkbox-settings'),'rex-maintenance-mode'); ?>" />
            <label for="content_social_linkedin_checkbox_settings">Disable</label>
        </div>
        <?php
    }

    public function rex_maintenance_content_social_twitter_cb()
    {
        ?>
        <div>
            <input type="text" name="content-social-twitter-settings" value="<?php esc_attr_e(get_option('content-social-twitter-settings'), 'rex-maintenance-mode') ?>" />
            <input type="checkbox" id="content_social_twitter_checkbox_settings" name="content-social-twitter-checkbox-settings" value="<?php esc_attr_e(get_option('content-social-twitter-checkbox-settings'),'rex-maintenance-mode'); ?>" />
            <label for="content_social_twitter_checkbox_settings">Disable</label>
        </div>
        <?php
    }
}
