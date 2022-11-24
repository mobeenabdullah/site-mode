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
        <div class="um_input_cover">
            <label class="screen-reading" for="headline">Headline</label>
            <textarea id="w3review" name="w3review" rows="6" cols="80"><?php esc_attr_e(get_option('advanced-wp-rest-api-settings'),'rex-maintenance-mode'); ?></textarea>
        </div>
        <?php
    }
    public function rex_maintenance_advance_wp_rest_api_cb() {
        ?>
        <div class="um_input_cover">
            <label class="screen-reading" for="headline">Headline</label>
            <input type="checkbox" id="headline" name="advanced-wp-rest-api-settings" value="<?php esc_attr_e(get_option('advanced-wp-rest-api-settings'),'rex-maintenance-mode'); ?>" />
        </div>
        <?php
    }
    public function rex_maintenance_advance_rss_feed_cb() {
        ?>
        <div class="um_input_cover">
            <label class="screen-reading" for="headline">Headline</label>
            <input type="checkbox" id="headline" name="advanced-wp-rest-api-settings" value="<?php esc_attr_e(get_option('advanced-wp-rest-api-settings'),'rex-maintenance-mode'); ?>" />
        </div>
        <?php
    }
    public function rex_maintenance_page_whitelist_include_cb() {
        ?>
        <label for="gender">Include Pages</label>
        <?php
        $all_pages = get_pages();
        ?>
        <select name="exclude">
            <?php foreach($all_pages as $value ) {

            } ?>
            <option value="<?php echo $value->post_name; ?>" selected><?php echo $value->post_title; ?></option>
        </select>
        <?php
    }
    public function rex_maintenance_page_exclude_cb() {
        ?>
        <label for="gender">Exclude Pages</label>
        <?php
        $pages = get_pages();
        ?>
        <select name="exclude">
            <?php foreach($pages as $value ) {

            } ?>
            <option value="<?php echo $value->post_name; ?>" selected><?php echo $value->post_title; ?></option>
        </select>
        <?php
    }
    public function rex_maintenance_header_code_cb() {
        ?>
        <div class="um_input_cover">
            <label class="screen-reading" for="headline">Headline</label>
            <textarea id="w3review" name="w3review" rows="6" cols="80"><?php esc_attr_e(get_option('advanced-wp-rest-api-settings'),'rex-maintenance-mode'); ?></textarea>
        </div>
        <?php
    }
    public function rex_maintenance_footer_code_cb() {
        ?>
        <div class="um_input_cover">
            <label class="screen-reading" for="headline">Headline</label>
            <textarea id="w3review" name="w3review" rows="6" cols="80"><?php esc_attr_e(get_option('advanced-wp-rest-api-settings'),'rex-maintenance-mode'); ?></textarea>
        </div>
        <?php
    }
    public function rex_maintenance_advance_user_role_cb() {
        global  $wp_roles;
        foreach ( $wp_roles->roles as $key=>$value ): ?>
            <div class="um_checkbox_wrapper">
                <input type="checkbox" id="status" name="advanced-user-roles-settings" value="<?php echo $key; ?>"/>
                <label for="status"><?php echo $value['name']; ?></label>
            </div>
        <?php endforeach;
    }
}