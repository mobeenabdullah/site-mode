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
class Advanced_Field
{


    public function __construct()
    {
        $this->add_fields();
    }
    public function add_fields()
    {

        // Advance Section Fields
        add_settings_field('rex_maintenance_advanced_ga_id', 'GA (ID/Code)', [$this, 'rex_maintenance_advance_ga_id_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_advanced_custom_css', 'Custom CSS', [$this, 'rex_maintenance_advance_custom_css_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_wp_rest_api', 'WP Rest API.', [$this, 'rex_maintenance_advance_wp_rest_api_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_rss_feed', 'RSS Feed', [$this, 'rex_maintenance_advance_rss_feed_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_whitelist_include', 'Page Whitelist Include', [$this, 'rex_maintenance_page_whitelist_include_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_page_exclude', 'Page Exclude', [$this, 'rex_maintenance_page_exclude_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_header_code', 'Header Code', [$this, 'rex_maintenance_header_code_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_footer_code', 'Footer Code', [$this, 'rex_maintenance_footer_code_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_advanced_image', 'Show site to these roles', [$this, 'rex_maintenance_advance_user_role_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
    }
    //Advance Section fields callback
    public function rex_maintenance_advance_ga_id_cb() { ?>
        <div class="um_input_cover">
            <label class="screen-reading" for="headline">Headline</label>
            <input type="text" id="headline" name="advanced-ga-id-settings" value="<?php esc_attr_e(get_option('advanced-ga-id-settings'),'rex-maintenance-mode'); ?>" />
        </div>
        <?php
    }
    public function rex_maintenance_advance_custom_css_cb() {
        ?>
        <div class="um_textarea_cover">
            <label class="screen-reading" for="headline">Headline</label>
            <textarea id="w3review" name="w3review" rows="6" cols="80"><?php esc_attr_e(get_option('advanced-wp-rest-api-settings'),'rex-maintenance-mode'); ?></textarea>
        </div>
        <?php
    }
    public function rex_maintenance_advance_wp_rest_api_cb() {
        ?>
        <div class="um_checkbox_wrapper">
            <input type="checkbox" id="custom_css" name="advanced-wp-rest-api-settings" value="<?php esc_attr_e(get_option('advanced-wp-rest-api-settings'),'rex-maintenance-mode'); ?>" />
            <label for="custom_css">Enable/Disable</label>
        </div>
        <?php
    }
    public function rex_maintenance_advance_rss_feed_cb() {
        ?>
        <div class="um_checkbox_wrapper">
            <input type="checkbox" id="rest_api" name="advanced-wp-rest-api-settings" value="<?php esc_attr_e(get_option('advanced-wp-rest-api-settings'),'rex-maintenance-mode'); ?>" />
            <label for="rest_api">Enable/Disable</label>
        </div>
        <?php
    }
    public function rex_maintenance_page_whitelist_include_cb() {
        ?>
<!--        <div class="label_top">-->
<!--            <label for="whitelist_include">Page Whitelist Include</label>-->
<!--        </div>-->

        <?php
        $all_pages = get_pages();
        ?>
        <div class="um_select">
            <select name="wprex-mode-settings" id="whitelist_include">
                <?php foreach($all_pages as $value ) : ?>
                    <option value="<?php echo $value->post_name; ?>" selected><?php echo $value->post_title; ?></option>
                <?php endforeach; ?>
            </select>
            <span class="arrow-down"></span>
        </div>
        <?php
    }
    public function rex_maintenance_page_exclude_cb() {
        ?>
<!--        <div class="label_top">-->
<!--            <label for="page_exclude">Page Exclude</label>-->
<!--        </div>-->
        <?php
        $pages = get_pages();
        ?>
        <div class="um_select label_top">
            <select name="wprex-mode-settings" id="page_exclude">
                <?php foreach($pages as $value ) : ?>
                    <option value="<?php echo $value->post_name; ?>" selected><?php echo $value->post_title; ?></option>
                <?php endforeach; ?>
            </select>
            <span class="arrow-down"></span>
        </div>
        <?php
    }
    public function rex_maintenance_header_code_cb() {
        ?>
        <div class="um_textarea_cover">
            <label class="screen-reading" for="headline">Headline</label>
            <textarea id="w3review" name="w3review" rows="6" cols="80"><?php esc_attr_e(get_option('advanced-wp-rest-api-settings'),'rex-maintenance-mode'); ?></textarea>
        </div>
        <?php
    }
    public function rex_maintenance_footer_code_cb() {
        ?>
        <div class="um_textarea_cover">
            <label class="screen-reading" for="headline">Headline</label>
            <textarea id="w3review" name="w3review" rows="6" cols="80"><?php esc_attr_e(get_option('advanced-wp-rest-api-settings'),'rex-maintenance-mode'); ?></textarea>
        </div>
        <?php
    }
    public function rex_maintenance_advance_user_role_cb() {
        global  $wp_roles;
        foreach ( $wp_roles->roles as $key=>$value ):
            ?>
            <div class="um_checkbox_wrapper">
                <input type="checkbox" id="<?php echo $key; ?>" name="advanced-user-<?php echo $key; ?>-role-settings" value="<?php echo $key; ?>"/>
                <label for="<?php echo $key; ?>"><?php echo $value['name']; ?></label>
            </div>
        <?php endforeach;
    }
}