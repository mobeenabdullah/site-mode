<?php

/**
 * Load during plugin options page
 *
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/includes
 */

/**
 * Load during plugin options page
 *
 * This class defines all code necessary to run during the plugin's options page
 *
 * @since      1.0.0
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Rex_Maintenance_Mode_Setting_page
{

    public function  __construct()
    {

        add_action('admin_init', [$this, 'rex_maintenance_mode_init']);
    }

    public function rex_maintenance_mode_init()
    {
        $this->rex_maintenance_mode_settings_registration();
        $this->rex_maintenance_mode_section_registration();
        $this->rex_maintenance_mode_section_fields_registration();
    }

    public function rex_maintenance_mode_settings_registration()
    {
        // Settings for general section
        register_setting('wprex-maintenance-general-group', 'wprex-status-settings');
        register_setting('wprex-maintenance-general-group', 'wprex-mode-settings');
        register_setting('wprex-maintenance-general-group', 'wprex-redirect-url-settings');
        register_setting('wprex-maintenance-general-group', 'wprex-delay-settings');
        register_setting('wprex-maintenance-general-group', 'wprex-login-icon-setting');


        // Settings for content section
        register_setting('rex-maintenance-setting-content-group', 'content-logo-type-setting');
        register_setting('rex-maintenance-setting-content-group', 'content-logo-settings');
        register_setting('rex-maintenance-setting-content-group', 'text-logo-setting',[ 'default' => bloginfo('name') ]);
        register_setting('rex-maintenance-setting-content-group', 'disable-logo-setting');
        register_setting('rex-maintenance-setting-content-group', 'content-headline-settings',[ 'default' => 'Headline Here' ]);
        register_setting('rex-maintenance-setting-content-group', 'content-content-settings',[ 'default' => 'Write some content' ]);
        register_setting('rex-maintenance-setting-content-group', 'content-bg-image-settings');

        //Settings for Social Section
        register_setting('rex-maintenance-setting-social-group', 'show-social-icons-setting');
        register_setting('rex-maintenance-setting-social-group', 'content-social-fb-settings',[ 'default' => 'username' ]);
        register_setting('rex-maintenance-setting-social-group','content-social-fb-checkbox-settings');
        register_setting('rex-maintenance-setting-social-group', 'content-social-linkedin-settings',[ 'default' => 'username' ]);
        register_setting('rex-maintenance-setting-social-group','content-social-linkedin-checkbox-settings');
        register_setting('rex-maintenance-setting-social-group', 'content-social-twitter-settings',[ 'default' => 'username' ]);
        register_setting('rex-maintenance-setting-social-group','content-social-twitter-checkbox-settings');

    // Settings for Design Section
        register_setting('rex-maintenance-setting-design-group', 'content-content-template-settings');

    //Settings for SEO Section
        register_setting('rex-maintenance-setting-seo-group', 'soe-meta-title-setting');
        register_setting('rex-maintenance-setting-seo-group', 'seo-meta-description-setting');
        register_setting('rex-maintenance-setting-seo-group', 'soe-meta-favicon-setting');
        register_setting('rex-maintenance-setting-seo-group', 'soe-meta-image-setting');

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

    public function rex_maintenance_mode_section_registration()
    {
        //  General section
        add_settings_section('wprex-maintenance-general-section', 'Primary Settings', [$this, 'rex_maintenance_general_settings_section_callback'], 'wprex-maintenance-general-page');

        //Content Section
        add_settings_section('rex-maintenance-content-logo-section', 'Content Logo Area', [$this, 'rex_maintenance_content_logo_section_callback'], 'rex-maintenance-options-one');
        add_settings_section('rex-maintenance-content-text-section', 'Content textarea', [$this, 'rex_maintenance_content_customization_section_callback'], 'rex-maintenance-options-one');

        //Design Section
        add_settings_section('rex-maintenance-design-section', 'Design Templates', [$this, 'rex_maintenance_design_section_callback'], 'rex-maintenance-design-page');

        //Social Section
        add_settings_section('rex-maintenance-social-section', 'Social Section',[$this,'rex_maintenance_social_section_callback'], 'rex-maintenance-social-page');

        //SEO Section
        add_settings_section('rex-maintenance-seo-section', 'SEO Section',[$this,'rex_maintenance_seo_section_callback'], 'rex-maintenance-seo-page');

        //Advance Section
        add_settings_section('rex-maintenance-advanced-section', 'Advance Section',[$this,'rex_maintenance_advance_section_callback'], 'rex-maintenance-advanced-page');


    }

    public function rex_maintenance_mode_section_fields_registration()
    {
        // General section fields


        add_settings_field('rex_maintenance_status_disable', 'Status', [$this, 'rex_maintenance_status_cb'], 'wprex-maintenance-general-page', 'wprex-maintenance-general-section');
        add_settings_field('rex_maintenance_mode', 'Mode', [$this, 'rex_maintenance_mode_cb'], 'wprex-maintenance-general-page', 'wprex-maintenance-general-section');
        add_settings_field('rex_maintenance_login_log','Login Icon', [$this, 'rex_maintenance_login_cb'],'wprex-maintenance-general-page','wprex-maintenance-general-section');



        add_settings_field('rex_maintenance_content_disable_logo','Disable Logo', [$this, 'rex_maintenance_content_disable_logo_cb'],'rex-maintenance-options-one', 'rex-maintenance-content-logo-section');
        add_settings_field('rex_maintenance_content_logo_type', 'Logo Type', [$this, 'rex_maintenance_content_logo_type_cb'],'rex-maintenance-options-one', 'rex-maintenance-content-logo-section');
        add_settings_field('rex_maintenance_content_logo', 'Image Logo', [$this, 'rex_maintenance_content_logo_type_cb'], 'rex-maintenance-options-one', 'rex-maintenance-content-section');


        add_settings_field('rex_maintenance_content_headline', 'Headline', [$this, 'rex_maintenance_content_headline_cb'], 'rex-maintenance-options-one', 'rex-maintenance-content-text-section');
        add_settings_field('rex_maintenance_content_area', 'Content Area', [$this, 'rex_maintenance_content_area_cb'], 'rex-maintenance-options-one', 'rex-maintenance-content-text-section');
        add_settings_field('rex_maintenance_content_bg_image', 'Change Background Image', [$this, 'rex_maintenance_content_bg_image_cb'], 'rex-maintenance-options-one', 'rex-maintenance-content-text-section');

        //Social Section Field

        add_settings_field('rex_maintenance_social_icons_show_section_field', 'Show Social Icons', [$this,'rex_maintenance_social_icons_show_cb'],'rex-maintenance-social-page','rex-maintenance-social-section');
        add_settings_field('rex_maintenance_content_social_fb', 'Facebook Username', [$this, 'rex_maintenance_content_social_fb_cb'], 'rex-maintenance-social-page', 'rex-maintenance-social-section');
        //add_settings_field('rex_maintenance_content_social_checkbox_fb', '', [$this, 'rex_maintenance_content_social_fb_checkbox_cb'], 'rex-maintenance-social-page', 'rex-maintenance-social-section');
        add_settings_field('rex_maintenance_content_social_linkedIn', 'LinkedIn Username', [$this, 'rex_maintenance_content_social_linkedin_cb'], 'rex-maintenance-social-page', 'rex-maintenance-social-section');
        //add_settings_field('rex_maintenance_content_social_checkbox_linkedIn', '', [$this, 'rex_maintenance_content_social_linkedIn_checkbox_cb'], 'rex-maintenance-social-page', 'rex-maintenance-social-section');
        add_settings_field('rex_maintenance_content_social_twitter', 'Twitter Username', [$this, 'rex_maintenance_content_social_twitter_cb'], 'rex-maintenance-social-page', 'rex-maintenance-social-section');
        //add_settings_field('rex_maintenance_content_social_checkbox_twitter', '', [$this, 'rex_maintenance_content_social_twitter_checkbox_cb'], 'rex-maintenance-social-page', 'rex-maintenance-social-section');
        //Design Section
        add_settings_field('rex_maintenance_design_templates', 'Design ', [$this, 'rex_maintenance_design_template_cb'], 'rex-maintenance-design-page', 'rex-maintenance-design-section');

        // SEO Section fields
        add_settings_field('rex_maintenance_seo_title', 'SEO Meta Title ', [$this, 'rex_maintenance_seo_meta_title_cb'], 'rex-maintenance-seo-page', 'rex-maintenance-seo-section');
        add_settings_field('rex_maintenance_seo_description', 'SEO Meta Description ', [$this, 'rex_maintenance_seo_meta_description_cb'], 'rex-maintenance-seo-page', 'rex-maintenance-seo-section');
        add_settings_field('rex_maintenance_seo_favicon', 'SEO Meta Favicon', [$this, 'rex_maintenance_seo_meta_favicon_cb'], 'rex-maintenance-seo-page', 'rex-maintenance-seo-section');
        add_settings_field('rex_maintenance_seo_image', 'Social Share Image', [$this, 'rex_maintenance_seo_meta_image_cb'], 'rex-maintenance-seo-page', 'rex-maintenance-seo-section');

        // Advance Section Fields

        add_settings_field('rex_maintenance_advanced_ga_id', 'GA (ID/Code)', [$this, 'rex_maintenance_advance_ga_id_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_advanced_custom_css', 'Custom CSS', [$this, 'rex_maintenance_advance_custom_css_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_wp_rest_api', 'Custom CSS', [$this, 'rex_maintenance_advance_wp_rest_api_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_rss_feed', 'RSS Feed', [$this, 'rex_maintenance_advance_rss_feed_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_whitelist_include', 'Page Whitelist Include', [$this, 'rex_maintenance_page_whitelist_include_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_page_exclude', 'Page Exclude', [$this, 'rex_maintenance_page_exclude_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_header_code', 'Header Code', [$this, 'rex_maintenance_header_code_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_footer_code', 'Footer Code', [$this, 'rex_maintenance_footer_code_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
        add_settings_field('rex_maintenance_advanced_image', 'Show site to these roles', [$this, 'rex_maintenance_advance_user_role_cb'], 'rex-maintenance-advanced-page', 'rex-maintenance-advanced-section');
    }

    public function rex_maintenance_general_settings_section_callback($args)
    {

    }
    public function rex_maintenance_content_customization_section_callback()
    {

    }
    public function rex_maintenance_social_section_callback() {
        
    }
    public function rex_maintenance_content_logo_section_callback() {

    }

    public function rex_maintenance_design_section_callback()
    {

    }
    public function rex_maintenance_seo_section_callback () {

    }

    public function rex_maintenance_advance_section_callback() {

    }

    public function rex_maintenance_status_cb()
    {
        //print_r(get_option('wprex-status-settings'));
?>
        <div class="um_checkbox_wrapper">
            <input type="checkbox" id="status" name="wprex-status-settings" value="1" <?php checked(1, get_option('wprex-status-settings'), true); ?> />
            <label for="status">Enable/Disable</label>
        </div>
    <?php
    }

    public function rex_maintenance_mode_cb()
    {
//        print_r(get_option('wprex-mode-settings'));
        ?>
            <div class="um_select">
                <label for="site_mode" class="screen-reading">Mode</label>
                <select name="wprex-mode-settings" id="site_mode">
                    <option value="maintenance" >Maintenance</option>
                    <option value="coming-soon">Coming Soon</option>
                    <option value="redirect"  id="direct-item">Redirect</option>
                </select>
                <span class="arrow-down"></span>
            </div>
            <div class="redirect_options">
                <div class="um_input_cover label_top">
                    <label for="redirect_url">Redirect Url</label>
                    <input type="text" id="redirect_url" name="wprex-redirect-url-settings" value="1" <?php checked(1, get_option('wprex-redirect-url-settings'), true); ?> />
                </div>
                <div class="um_input_cover label_top">
                    <label for="delay_seconds">Delay Seconds</label>
                    <div class="um_number-cover">
                        <input type="number" min="0" max="9" id="delay_seconds" data-inc="1" name="wprex-delay-settings" value="1" <?php checked(1, get_option('wprex-delay-settings'), true); ?> />
                    </div>
                </div>

            </div>
        <?php
    }

    public function rex_maintenance_login_cb() {
        ?>
        <div class="um_checkbox_wrapper">
            <input type="checkbox" id="login_icon" name="wprex-login-icon-setting" value="1" <?php checked(1, get_option('wprex-login-icon-setting'), true); ?> />
            <label for="login_icon">Show Login Icon</label>
        </div>
    <?php
        }

    public function rex_maintenance_content_logo_type_cb() {
        ?>

        <div class="um_radio_wrapper">
            <input type="radio" id="image-logo" name="content-logo-settings" value="image-type"  <?php checked(1, get_option('wprex-login-icon-setting'), true); ?> />
            <label for="image-logo">Image Type</label>
        </div>
        <div class="um_radio_wrapper">
            <input type="radio" id="text-logo" name="content-logo-settings" value="text-type"  <?php checked(1, get_option('wprex-login-icon-setting'), true); ?> />
            <label for="text-logo">Text Type</label>
        </div>
        <?php
        $logo_url = wp_get_attachment_image_url(get_option('content-logo-settings'), 'medium'); ?>
        <div class="image_logo_wrapper">
            <?php if ($logo_url) : ?>
                <a href="#" class="Logo-upload test">
                    <img src="<?php echo esc_url($logo_url) ?>" width="150" height="150" />
                    <?php
                    ?>
                </a>
                <a href="#" class="logo-remove"><?php esc_html_e('Remove Logo', 'rex-maintenance-mode'); ?></a>
                <input type="hidden" name="content-logo-settings" value="<?php esc_attr_e(get_option('content-logo-settings'),'rex-maintenance-mode'); ?>">
            <?php else : ?>
                <a href="#" class="button um_btn logo-upload"><?php esc_html_e('Upload Logo', 'rex-maintenance-mode'); ?></a>
                <a href="#" class="button um_btn logo-remove" style="display:none"><?php esc_html_e('Remove Logo', 'rex-maintenance-mode'); ?></a>
                <input type="hidden" name="content-logo-settings" value=<?php esc_attr_e(get_option('content-logo-settings'),'rex-maintenance-mode'); ?>>
            <?php endif; ?>
        </div>
        <div class="um_input_cover label_top text_logo_wrapper">
            <label for="text_logo">Type Logo text</label>
            <input type="text" id="text_logo" name="text-logo-setting" value="<?php esc_attr_e(get_option('content-subheading-settings'),'rex-maintenance-mode'); ?>" />
        </div>

    <?php
}

    public function rex_maintenance_content_disable_logo_cb() {
        ?>
    <div class="um_checkbox_wrapper">
        <input type="checkbox" id="disable_logo_settings" class="enable_disable-rows" name="disable-logo-setting" value="<?php esc_attr_e(get_option('disable-logo-setting'),'rex-maintenance-mode'); ?>" />
        <label for="disable_logo_settings">Enable/Disable</label>
    </div>
    <?php
}

    public function rex_maintenance_content_headline_cb()
    {
    ?>
        <div class="um_input_cover">
            <label class="screen-reading" for="headline">Headline</label>
            <input type="text" id="headline" name="content-headline-settings" value="<?php esc_attr_e(get_option('content-headline-settings'),'rex-maintenance-mode'); ?>" />
        </div>
    <?php
    }

    public function rex_maintenance_content_area_cb()
    {
    ?>
        <div>
            <?php
            $content = get_option('content-content-settings');
            $custom_editor_id = "editorid";
            $custom_editor_name = "content-content-settings";
            $args = array(
                'media_buttons' => false, // This setting removes the media button.
                'textarea_name' => $custom_editor_name, // Set custom name.
                'textarea_rows' => get_option('default_post_edit_rows', 10), //Determine the number of rows.
                'quicktags' => false, // Remove view as HTML button.
                'tinymce' => true,
                'teeny' => true,
            );
            wp_editor( $content, $custom_editor_id, $args );
            ?>
        </div>
    <?php
    }


    public function rex_maintenance_content_bg_image_cb()
    {

        $bg_img_id = wp_get_attachment_image_url(get_option('content-bg-image-settings'), 'full');
    ?>
        <div>
            <?php if ($bg_img_id) : ?>
                <a href="#" class="bg-image-upload">
                    <img src="<?php echo esc_url($bg_img_id) ?>" width="350" height="350" alt="background Image" />
                    <?php
                    ?>
                </a>
                <a href="#" class="button um_btn bg-image-remove"><?php esc_html_e('Remove Background Image', 'rex-maintenance-mode'); ?></a>
                <input type="hidden" name="content-bg-image-settings" value="<?php esc_attr_e(get_option('content-bg-image-settings'),'rex-maintenance-mode'); ?>">
            <?php else : ?>
                <a href="#" class="button um_btn bg-image-upload"><?php esc_html_e('Upload Background Image', 'rex-maintenance-mode'); ?></a>
                <a href="#" class="button um_btn bg-image-remove" style="display:none"><?php esc_html_e('Remove Background Image', 'rex-maintenance-mode'); ?></a>
                <input type="hidden" name="content-bg-image-settings" value=<?php esc_attr_e(get_option('content-bg-image-settings'),'rex-maintenance-mode'); ?>>
            <?php endif; ?>
        </div>
        <div class="setting__page_image">

        </div>
    <?php
    }

    public function rex_maintenance_social_icons_show_cb() { ?>
    <div class="um_checkbox_wrapper">
        <input type="checkbox" id="disable_enable_social_icons_settings" class="enable_disable-rows" name="show-social-icons-setting" value="<?php esc_attr_e(get_option('show-social-icons-setting'),'rex-maintenance-mode'); ?>" />
        <label for="disable_enable_social_icons_settings">Enable/Disable</label>
    </div>
    <?php
}

    public function rex_maintenance_content_social_fb_cb()
    {
    ?>
        <div class="social_media_field_wrapper">
            <input type="text" name="content-social-fb-settings" value="<?php esc_attr_e(get_option('content-bg-social-fb-settings'), 'rex-maintenance-mode') ?>" />
            <div class="um_checkbox_wrapper">
                <input type="checkbox" id="content_social_fb_checkbox_settings" class="disable_media" name="content-social-fb-checkbox-settings" value="<?php esc_attr_e(get_option('content-social-fb-checkbox-settings'),'rex-maintenance-mode'); ?>" />
                <label for="content_social_fb_checkbox_settings">Disable</label>
            </div>
        </div>
    <?php
    }

    public function rex_maintenance_content_social_linkedin_cb()
    {
    ?>
        <div class="social_media_field_wrapper">
            <input type="text" name="content-social-linkedin-settings" value="<?php esc_attr_e(get_option('content-social-linkedin-settings'), 'rex-maintenance-mode') ?>" />
            <div class="um_checkbox_wrapper">
                <input type="checkbox" id="content_social_linkedin_checkbox_settings" class="disable_media" name="content-social-linkedin-checkbox-settings" value="<?php esc_attr_e(get_option('content-social-linkedin-checkbox-settings'),'rex-maintenance-mode'); ?>" />
                <label for="content_social_linkedin_checkbox_settings">Disable</label>
            </div>

        </div>
    <?php
    }

    public function rex_maintenance_content_social_twitter_cb()
    {
    ?>
        <div class="social_media_field_wrapper">
            <input type="text" name="content-social-twitter-settings" value="<?php esc_attr_e(get_option('content-social-twitter-settings'), 'rex-maintenance-mode') ?>" />
            <div class="um_checkbox_wrapper">
                <input type="checkbox" id="content_social_twitter_checkbox_settings" class="disable_media" name="content-social-twitter-checkbox-settings" value="<?php esc_attr_e(get_option('content-social-twitter-checkbox-settings'),'rex-maintenance-mode'); ?>" />
                <label for="content_social_twitter_checkbox_settings">Disable</label>
            <div>
        </div>
    <?php
    }

    public function rex_maintenance_design_template_cb()
    {
    ?>
        <div class="template__wrapper">
            <?php $template = get_option('content-content-template-settings');
            ?>
            <div class="template_options">
                <div class="template_thumb <?php echo ($template == '1') ? 'activated_template' : '' ?>">
                    <div class="radio-img">
                        <div class="image" style="background-image: url(<?php echo plugin_dir_url( __DIR__ ).'admin/img/template-1.jpg'; ?>)"></div>
                    </div>
                    <div class="template_actions">
                        <div class="template_title">
                            <h2 class="template_title-title">Food Template</h2>
                        </div>
                       <label class="um_toggle">
                            <input type="radio" class="toggle_input" id="one" name="content-content-template-settings" value="1" <?php echo (get_option('content-content-template-settings') == '1') ? 'checked' : ''?> />
                           <div class="toggle-control"></div>
                       </label>
                    </div>
                </div>
                <div class="template_thumb <?php echo ($template == '2') ? 'activated_template' : '' ?>">
                    <div class="radio-img">
                        <div class="image" style="background-image: url(<?php echo plugin_dir_url( __DIR__ ).'admin/img/template-2.jpg'; ?>)"></div>
                    </div>
                    <div class="template_actions">
                        <div class="template_title">
                            <h2 class="template_title-title">Construction Template</h2>
                        </div>
                        <label class="um_toggle">
                            <input type="radio" class="toggle_input" id="two" name="content-content-template-settings" value="2" <?php echo (get_option('content-content-template-settings') == '2') ? 'checked' : ''?> />
                            <div class="toggle-control"></div>
                        </label>
                    </div>

                </div>
                <div class="template_thumb <?php echo ($template == '3') ? 'activated_template' : '' ?>">
                    <div class="radio-img">
                        <div class="image" style="background-image: url(<?php echo plugin_dir_url( __DIR__ ).'admin/img/template-3.jpg'; ?>)"></div>
                    </div>
                    <div class="template_actions">
                        <div class="template_title">
                            <h2 class="template_title-title">Fashion Template</h2>
                        </div>

                        <label class="um_toggle">
                            <input type="radio" class="toggle_input" id="three" name="content-content-template-settings" value="3" <?php echo (get_option('content-content-template-settings') == '3') ? 'checked' : ''?> />
                            <div class="toggle-control"></div>
                        </label>
                    </div>
                </div>
                <div class="template_thumb <?php echo ($template == '4') ? 'activated_template' : '' ?>">
                    <div class="radio-img">
                        <div class="image" style="background-image: url(<?php echo plugin_dir_url( __DIR__ ).'admin/img/template-4.jpg'; ?>)"></div>
                    </div>
                    <div class="template_actions">
                        <div class="template_title">
                            <h2 class="template_title-title">Travel Template</h2>
                        </div>
                        <label class="um_toggle">
                            <input type="radio" class="toggle_input" id="four" name="content-content-template-settings" value="4" <?php echo (get_option('content-content-template-settings') == '4') ? 'checked' : ''?> />
                            <div class="toggle-control"></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
<?php
    }


// SEO Section Fields callbacks

    public function rex_maintenance_seo_meta_title_cb() { ?>
        <div class="um_input_cover">
            <label class="screen-reading" for="headline">SEO Meta Title</label>
            <input type="text" id="seo-meta-title" name="soe-meta-title-setting" value="<?php esc_attr_e(get_option('soe-meta-title-setting'),'rex-maintenance-mode'); ?>" />
        </div>
    <?php
    }

    public function rex_maintenance_seo_meta_description_cb() { ?>
        <div class="um_input_cover">
            <label class="screen-reading" for="headline">SEO Meta Title</label>
            <input type="text" id="seo-meta-description" name="soe-meta-title-setting" value="<?php esc_attr_e(get_option('soe-meta-title-setting'),'rex-maintenance-mode'); ?>" />
        </div>
        <?php
    }

    public function rex_maintenance_seo_meta_favicon_cb() {
        $favicon_url = wp_get_attachment_image_url(get_option('soe-meta-favicon-setting'), 'medium'); ?>
        <div>
            <?php if ($favicon_url) : ?>
                <a href="#" class="Logo-upload">
                    <img src="<?php echo esc_url($favicon_url) ?>" width="150" height="150" />
                    <?php
                    ?>
                </a>
                <a href="#" class="logo-remove"><?php esc_html_e('Remove Favicon', 'rex-maintenance-mode'); ?></a>
                <input type="hidden" name="soe-meta-favicon-setting" value="<?php esc_attr_e(get_option('soe-meta-favicon-setting'),'rex-maintenance-mode'); ?>">
            <?php else : ?>
                <a href="#" class="button um_btn"><?php esc_html_e('Upload Favicon', 'rex-maintenance-mode'); ?></a>
                <a href="#" class="button um_btn" style="display:none"><?php esc_html_e('Remove Favicon', 'rex-maintenance-mode'); ?></a>
                <input type="hidden" name="soe-meta-favicon-setting" value=<?php esc_attr_e(get_option('soe-meta-favicon-setting'),'rex-maintenance-mode'); ?>>
            <?php endif; ?>
        </div>
        <?php
    }
    public function rex_maintenance_seo_meta_image_cb() {

        $image_url = wp_get_attachment_image_url(get_option('soe-meta-image-setting'), 'medium'); ?>
        <div>
            <?php if ($image_url) : ?>
                <a href="#" class="Logo-upload">
                    <img src="<?php echo esc_url($image_url) ?>" width="150" height="150" />
                    <?php
                    ?>
                </a>
                <a href="#" class="logo-remove"><?php esc_html_e('Remove Image', 'soe-meta-image-setting'); ?></a>
                <input type="hidden" name="soe-meta-image-setting" value="<?php esc_attr_e(get_option('soe-meta-image-setting'),'rex-maintenance-mode'); ?>">
            <?php else : ?>
                <a href="#" class="button um_btn"><?php esc_html_e('Upload Image', 'rex-maintenance-mode'); ?></a>
                <a href="#" class="button um_btn" style="display:none"><?php esc_html_e('Remove Image', 'rex-maintenance-mode'); ?></a>
                <input type="hidden" name="soe-meta-image-setting" value=<?php esc_attr_e(get_option('soe-meta-image-setting'),'rex-maintenance-mode'); ?>>
            <?php endif; ?>
        </div>
        <?php
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
        <div class="um_select label_top">
            <label for="site_mode" class="screen-reading">Mode</label>
            <select name="wprex-mode-settings" id="site_mode">
                 <option value="none" selected>Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">other</option>
            </select>
            <span class="arrow-down"></span>
        </div>
        <?php
    }
    public function rex_maintenance_page_exclude_cb() {
        ?>
        <div class="um_select label_top">
            <label for="site_mode" class="screen-reading">Mode</label>
            <select name="wprex-mode-settings" id="site_mode">
                 <option value="none" selected>Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">other</option>
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
         foreach ( $wp_roles->roles as $key=>$value ): ?>
            <div class="um_checkbox_wrapper">
                <input type="checkbox" id="<?php echo $key; ?>" name="advanced-user-<?php echo $key; ?>-role-settings" value="<?php echo $key; ?>"/>
                <label for="<?php echo $key; ?>"><?php echo $value['name']; ?></label>
            </div>
        <?php endforeach;
    }

}
