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
        // Settings Registeration
        register_setting('rex-maintenance-mode-setting-group', 'enable-disable-settings');
        register_setting('rex-maintenance-mode-setting-content-group', 'content-headline-settings',[ 'default' => 'Headline Here' ]);
        register_setting('rex-maintenance-mode-setting-content-group', 'content-subheading-settings',[ 'default' => 'Sub Heading Here' ]);
        register_setting('rex-maintenance-mode-setting-content-group', 'content-content-settings',[ 'default' => 'Write some content' ]);
        register_setting('rex-maintenance-mode-setting-content-group', 'content-logo-settings');
        register_setting('rex-maintenance-mode-setting-content-group', 'content-bg-image-settings');
        register_setting('rex-maintenance-mode-setting-content-group', 'content-social-fb-settings',[ 'default' => 'username' ]);
        register_setting('rex-maintenance-mode-setting-content-group', 'content-social-linkedin-settings',[ 'default' => 'username' ]);
        register_setting('rex-maintenance-mode-setting-content-group', 'content-social-twitter-settings',[ 'default' => 'username' ]);
        register_setting('rex-maintenance-mode-setting-design-group', 'content-content-template-settings');
    }

    public function rex_maintenance_mode_section_registration()
    {

        add_settings_section('rex-maintenance-mode-section', 'Primary Settings', [$this, 'rex_maintenance_mode_settings_section_callback'], 'rex-maintenance-mode-options');
        add_settings_section('rex-maintenance-mode-content-section', 'Content Customization', [$this, 'rex_maintenance_mode_content_customization_section_callback'], 'rex-maintenance-mode-options-one');
        add_settings_section('rex-maintenance-mode-design-section', 'Design Templates', [$this, 'rex_maintenance_mode_design_section_callback'], 'rex-maintenance-mode-design');
    }

    public function rex_maintenance_mode_section_fields_registration()
    {
        add_settings_field('rex_maintenance_mode_disable', 'Disable / Enable', [$this, 'rex_maintenance_mode_disable_enable_cb'], 'rex-maintenance-mode-options', 'rex-maintenance-mode-section');
        add_settings_field('rex_maintenance_mode_content_headline', 'Headline', [$this, 'rex_maintenance_mode_content_headline_cb'], 'rex-maintenance-mode-options-one', 'rex-maintenance-mode-content-section');
        add_settings_field('rex_maintenance_mode_content_subdeading', 'Sub Heading', [$this, 'rex_maintenance_mode_content_subheading_cb'], 'rex-maintenance-mode-options-one', 'rex-maintenance-mode-content-section');
        add_settings_field('rex_maintenance_mode_content_area', 'Content Area', [$this, 'rex_maintenance_mode_content_area_cb'], 'rex-maintenance-mode-options-one', 'rex-maintenance-mode-content-section');
        add_settings_field('rex_maintenance_mode_content_logo', 'Change Logo', [$this, 'rex_maintenance_mode_content_logo_cb'], 'rex-maintenance-mode-options-one', 'rex-maintenance-mode-content-section');
        add_settings_field('rex_maintenance_mode_content_bg_image', 'Change Background Image', [$this, 'rex_maintenance_mode_content_bg_image_cb'], 'rex-maintenance-mode-options-one', 'rex-maintenance-mode-content-section');
        add_settings_field('rex_maintenance_mode_content_social_fb', 'Facebook Username', [$this, 'rex_maintenance_mode_content_social_fb_cb'], 'rex-maintenance-mode-options-one', 'rex-maintenance-mode-content-section');
        add_settings_field('rex_maintenance_mode_content_social_linkedIn', 'LinkedIn Username', [$this, 'rex_maintenance_mode_content_social_linkedin_cb'], 'rex-maintenance-mode-options-one', 'rex-maintenance-mode-content-section');
        add_settings_field('rex_maintenance_mode_content_social_twitter', 'Twitter Username', [$this, 'rex_maintenance_mode_content_social_twitter_cb'], 'rex-maintenance-mode-options-one', 'rex-maintenance-mode-content-section');
        add_settings_field('rex_maintenance_mode_design_templates', 'Design ', [$this, 'rex_maintenance_mode_design_template_cb'], 'rex-maintenance-mode-design', 'rex-maintenance-mode-design-section');
    }

    public function rex_maintenance_mode_settings_section_callback()
    {
        echo '<p>You can simply enable or disable the coming soon page here.</p>';
    }
    public function rex_maintenance_mode_content_customization_section_callback()
    {
        echo '<p>You can change content of the coming soon here. </p>';
    }

    public function rex_maintenance_mode_design_section_callback()
    {
        echo '<p>select pre-design template from the design list.</p>';
    }

    public function rex_maintenance_mode_disable_enable_cb()
    {
        $setting = get_option('settings_one');
        $setting_two = get_option('enable-disable-settings');
        $options = get_option('settings_one');
?>
        <div>
            <input type="checkbox" name="enable-disable-settings" value="1" <?php checked(1, get_option('enable-disable-settings'), true); ?> />
        </div>
    <?php
    }

    public function rex_maintenance_mode_content_headline_cb()
    {
    ?>
        <div>
            <input type="text" name="content-headline-settings" value="<?php esc_attr_e(get_option('content-headline-settings'),'rex-maintenance-mode'); ?>" />
        </div>
    <?php
    }

    public function rex_maintenance_mode_content_subheading_cb()
    {
    ?>
        <div>
            <input type="text" name="content-subheading-settings" value="<?php esc_attr_e(get_option('content-subheading-settings'),'rex-maintenance-mode'); ?>" />
        </div>
    <?php
    }
    public function rex_maintenance_mode_content_area_cb()
    {
    ?>
        <div>
            <textarea rows="10" cols="50" name="content-content-settings" ><?php esc_html_e(get_option('content-content-settings'),'rex-maintenance-mode'); ?></textarea>
        </div>
    <?php
    }

    public function rex_maintenance_mode_content_logo_cb()
    {

        $logo_url = wp_get_attachment_image_url(get_option('content-logo-settings'), 'medium'); ?>
        <div>
            <?php if ($logo_url) : ?>
                <a href="#" class="Logo-upload test">
                    <img src="<?php echo esc_url($logo_url) ?>" width="150" height="150" />
                    <?php
                    ?>
                </a>
                <a href="#" class="logo-remove"><?php esc_html_e('Remove Logo', 'rex-maintenance-mode'); ?></a>
                <input type="hidden" name="content-logo-settings" value="<?php esc_attr_e(get_option('content-logo-settings'),'rex-maintenance-mode'); ?>">
            <?php else : ?>
                <a href="#" class="button logo-upload"><?php esc_html_e('Upload Logo', 'rex-maintenance-mode'); ?></a>
                <a href="#" class="logo-remove" style="display:none"><?php esc_html_e('Remove Logo', 'rex-maintenance-mode'); ?></a>
                <input type="hidden" name="content-logo-settings" value=<?php esc_attr_e(get_option('content-logo-settings'),'rex-maintenance-mode'); ?>>
            <?php endif; ?>
        </div>
    <?php
    }

    public function rex_maintenance_mode_content_bg_image_cb()
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
                <a href="#" class="bg-image-remove"><?php esc_html_e('Remove Background Image', 'rex-maintenance-mode'); ?></a>
                <input type="hidden" name="content-bg-image-settings" value="<?php esc_attr_e(get_option('content-bg-image-settings'),'rex-maintenance-mode'); ?>">
            <?php else : ?>
                <a href="#" class="button bg-image-upload"><?php esc_html_e('Upload Background Image', 'rex-maintenance-mode'); ?></a>
                <a href="#" class="bg-image-remove" style="display:none"><?php esc_html_e('Remove Background Image', 'rex-maintenance-mode'); ?></a>
                <input type="hidden" name="content-bg-image-settings" value=<?php esc_attr_e(get_option('content-bg-image-settings'),'rex-maintenance-mode'); ?>>
            <?php endif; ?>
        </div>
        <div class="setting__page_image">

        </div>
    <?php
    }

    public function rex_maintenance_mode_content_social_fb_cb()
    {
    ?>
        <div>
            <input type="text" name="content-social-fb-settings" value="<?php esc_attr_e(get_option('content-bg-social-fb-settings'), 'rex-maintenance-mode') ?>" />
        </div>
    <?php
    }

    public function rex_maintenance_mode_content_social_linkedin_cb()
    {
    ?>
        <div>
            <input type="text" name="content-social-linkedin-settings" value="<?php esc_attr_e(get_option('content-social-linkedin-settings'), 'rex-maintenance-mode') ?>" />
        </div>
    <?php
    }

    public function rex_maintenance_mode_content_social_twitter_cb()
    {
    ?>
        <div>
            <input type="text" name="content-social-twitter-settings" value="<?php esc_attr_e(get_option('content-social-twitter-settings'), 'rex-maintenance-mode') ?>" />
        </div>
    <?php
    }

    public function rex_maintenance_mode_design_template_cb()
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
                       <label class="label toggle">
                            <input type="radio" class="toggle_input" id="one" name="content-content-template-settings" value="1" <?php checked(1, esc_attr_e(get_option('content-content-template-settings'), 'rex-maintenance-mode'), true); ?> />
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
                        <label class="label toggle">
                            <!--                                   <input type="checkbox" class="toggle_input" />-->
                            <input type="radio" class="toggle_input" id="two" name="content-content-template-settings" value="2" <?php checked(2, esc_attr_e(get_option('content-content-template-settings'), 'rex-maintenance-mode'), true); ?> />
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

                        <label class="label toggle">
                            <input type="radio" class="toggle_input" id="three" name="content-content-template-settings" value="3" <?php checked(3, esc_attr_e(get_option('content-content-template-settings'), 'rex-maintenance-mode'), true); ?> />
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
                        <label class="label toggle">
                            <input type="radio" class="toggle_input" id="four" name="content-content-template-settings" value="4" <?php checked(4, esc_attr_e(get_option('content-content-template-settings'), 'rex-maintenance-mode'), true); ?> />
                            <div class="toggle-control"></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
