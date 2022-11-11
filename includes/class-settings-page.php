<?php

/**
 * Load during plugin options page
 *
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Oh_My_Page
 * @subpackage Oh_My_Page/includes
 */

/**
 * Load during plugin options page
 *
 * This class defines all code necessary to run during the plugin's options page
 *
 * @since      1.0.0
 * @package    Oh_My_Page
 * @subpackage Oh_My_Page/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Oh_My_Page_Setting_page
{

    public function  __construct()
    {

        add_action('admin_init', [$this, 'oh_my_page_init']);
    }

    public function oh_my_page_init()
    {
        $this->oh_my_page_settings_registration();
        $this->oh_my_page_section_registration();
        $this->oh_my_page_section_fields_registration();
    }

    public function oh_my_page_settings_registration()
    {
        // Settings Registeration
        register_setting('oh-my-page-setting-group', 'enable-disable-settings');
        register_setting('oh-my-page-setting-content-group', 'content-headline-settings');
        register_setting('oh-my-page-setting-content-group', 'content-subheading-settings');
        register_setting('oh-my-page-setting-content-group', 'content-content-settings');
        register_setting('oh-my-page-setting-content-group', 'content-logo-settings');
        register_setting('oh-my-page-setting-content-group', 'content-bg-image-settings');
        register_setting('oh-my-page-setting-content-group', 'content-social-fb-settings');
        register_setting('oh-my-page-setting-content-group', 'content-social-linkedin-settings');
        register_setting('oh-my-page-setting-content-group', 'content-social-twitter-settings');
        register_setting('oh-my-page-setting-design-group', 'content-content-template-settings');
    }

    public function oh_my_page_section_registration()
    {

        add_settings_section('oh-my-page-section', 'Primary Settings', [$this, 'oh_my_page_settings_section_callback'], 'oh-my-page-options');
        add_settings_section('oh-my-page-content-section', 'Content Customization', [$this, 'oh_my_page_content_customization_section_callback'], 'oh-my-page-options-one');
        add_settings_section('oh-my-page-design-section', 'Design Templates', [$this, 'oh_my_page_design_section_callback'], 'oh-my-page-design');
    }

    public function oh_my_page_section_fields_registration()
    {
        add_settings_field('oh_my_page_disable', 'Disable / Enable', [$this, 'oh_my_page_disable_enable_cb'], 'oh-my-page-options', 'oh-my-page-section');
        add_settings_field('oh_my_page_content_headline', 'Headline', [$this, 'oh_my_page_content_headline_cb'], 'oh-my-page-options-one', 'oh-my-page-content-section');
        add_settings_field('oh_my_page_content_subdeading', 'Sub Heading', [$this, 'oh_my_page_content_subheading_cb'], 'oh-my-page-options-one', 'oh-my-page-content-section');
        add_settings_field('oh_my_page_content_area', 'Content Area', [$this, 'oh_my_page_content_area_cb'], 'oh-my-page-options-one', 'oh-my-page-content-section');
        add_settings_field('oh_my_page_content_logo', 'Change Logo', [$this, 'oh_my_page_content_logo_cb'], 'oh-my-page-options-one', 'oh-my-page-content-section');
        add_settings_field('oh_my_page_content_bg_image', 'Change Background Image', [$this, 'oh_my_page_content_bg_image_cb'], 'oh-my-page-options-one', 'oh-my-page-content-section');
        add_settings_field('oh_my_page_content_social_fb', 'Facebook Username', [$this, 'oh_my_page_content_social_fb_cb'], 'oh-my-page-options-one', 'oh-my-page-content-section');
        add_settings_field('oh_my_page_content_social_linkedIn', 'LinkedIn Username', [$this, 'oh_my_page_content_social_linkedin_cb'], 'oh-my-page-options-one', 'oh-my-page-content-section');
        add_settings_field('oh_my_page_content_social_twitter', 'Twitter Username', [$this, 'oh_my_page_content_social_twitter_cb'], 'oh-my-page-options-one', 'oh-my-page-content-section');
        add_settings_field('oh_my_page_design_templates', 'Design ', [$this, 'oh_my_page_design_template_cb'], 'oh-my-page-design', 'oh-my-page-design-section');
    }

    public function oh_my_page_settings_section_callback()
    {
        echo '<p>You can simply enable or disable the coming soon page here.</p>';
    }
    public function oh_my_page_content_customization_section_callback()
    {
        echo '<p>You can change content of the coming soon here. </p>';
    }

    public function oh_my_page_design_section_callback()
    {
        echo '<p>select pre-design template from the design list.</p>';
    }

    public function oh_my_page_disable_enable_cb()
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

    public function oh_my_page_content_headline_cb()
    {
    ?>
        <div>
            <input type="text" name="content-headline-settings" value="<?php echo get_option('content-headline-settings') ?>" />
        </div>
    <?php
    }

    public function oh_my_page_content_subheading_cb()
    {
    ?>
        <div>
            <input type="text" name="content-subheading-settings" value="<?php echo  get_option('content-subheading-settings') ?>" />
        </div>
    <?php
    }
    public function oh_my_page_content_area_cb()
    {
    ?>
        <div>
            <input type="textarea" rows="4" cols="50" name="content-content-settings" value="<?php echo  get_option('content-content-settings') ?>" />
        </div>
    <?php
    }

    public function oh_my_page_content_logo_cb()
    {

        $logo_url = wp_get_attachment_image_url(get_option('content-logo-settings'), 'medium'); ?>
        <div>
            <?php if ($logo_url) : ?>
                <a href="#" class="Logo-upload test">
                    <img src="<?php echo esc_url($logo_url) ?>" width="150" height="150" />
                    <?php
                    ?>
                </a>
                <a href="#" class="logo-remove"><?php esc_html_e('Remove Logo', 'oh-my-page'); ?></a>
                <input type="hidden" name="content-logo-settings" value="<?php echo esc_attr(get_option('content-logo-settings')); ?>">
            <?php else : ?>
                <a href="#" class="button logo-upload"><?php esc_html_e('Upload Logo', 'oh-my-page'); ?></a>
                <a href="#" class="logo-remove" style="display:none"><?php esc_html_e('Remove Logo', 'oh-my-page'); ?></a>
                <input type="hidden" name="content-logo-settings" value=<?php echo esc_attr(get_option('content-logo-settings')); ?>>
            <?php endif; ?>
        </div>
    <?php
    }

    public function oh_my_page_content_bg_image_cb()
    {

        $bg_img_id = wp_get_attachment_image_url(get_option('content-bg-image-settings'), 'full');
        ?>
        <div>
            <?php if ($bg_img_id) : ?>
                <a href="#" class="bg-image-upload">
                    <img src="<?php echo esc_url($bg_img_id) ?>" width="350" height="350" alt="background Image"/>
                    <?php
                    ?>
                </a>
                <a href="#" class="bg-image-remove"><?php esc_html_e('Remove Background Image', 'oh-my-page'); ?></a>
                <input type="hidden" name="content-bg-image-settings" value="<?php echo esc_attr(get_option('content-bg-image-settings'));?>">
            <?php else : ?>
                <a href="#" class="button bg-image-upload"><?php esc_html_e('Upload Background Image', 'oh-my-page'); ?></a>
                <a href="#" class="bg-image-remove" style="display:none"><?php esc_html_e('Remove Background Image', 'oh-my-page'); ?></a>
                <input type="hidden" name="content-bg-image-settings" value=<?php echo esc_attr(get_option('content-bg-image-settings')); ?>>
            <?php endif; ?>
        </div>
        <div class="setting__page_image">

        </div>
    <?php
    }

    public function oh_my_page_content_social_fb_cb()
    {
    ?>
        <div>
            <input type="text" name="content-social-fb-settings" value="<?php esc_attr_e(get_option('content-bg-social-fb-settings'), 'oh-my-page') ?>" />
        </div>
    <?php
    }

    public function oh_my_page_content_social_linkedin_cb()
    {
    ?>
        <div>
            <input type="text" name="content-social-linkedin-settings" value="<?php esc_attr_e(get_option('content-social-linkedin-settings'), 'oh-my-page') ?>" />
        </div>
    <?php
    }

    public function oh_my_page_content_social_twitter_cb()
    {
    ?>
        <div>
            <input type="text" name="content-social-twitter-settings" value="<?php esc_attr_e(get_option('content-social-twitter-settings'), 'oh-my-page') ?>" />
        </div>
    <?php
    }

    public function oh_my_page_design_template_cb()
    {
    ?>
        <div class="template__wrapper">
            <div class="template_options">
                <div>
                    <label class="radio-img">
                        <input type="radio" id="one" name="content-content-template-settings" value="1" <?php checked(1, esc_attr_e(get_option('content-content-template-settings'), 'oh-my-page'), true); ?> />
                        <div class="image" style="background-image: url(http://loremflickr.com/620/440/london)"></div>
                    </label>
                </div>
                <div>
                    <label class="radio-img">
                        <input type="radio" id="two" name="content-content-template-settings" value="2" <?php checked(2, esc_attr_e(get_option('content-content-template-settings'), 'oh-my-page'), true); ?> />
                        <div class="image" style="background-image: url(http://loremflickr.com/620/440/london)"></div>
                    </label>
                </div>
                <div>
                    <label class="radio-img">
                        <input type="radio" id="three" name="content-content-template-settings" value="3" <?php checked(3, esc_attr_e(get_option('content-content-template-settings'), 'oh-my-page'), true); ?> />
                        <div class="image" style="background-image: url(http://loremflickr.com/620/440/london)"></div>
                    </label>
                </div>
                <div>
                    <label class="radio-img">
                        <input type="radio" id="four" name="content-content-template-settings" value="4" <?php checked(4, esc_attr_e(get_option('content-content-template-settings'), 'oh-my-page'), true); ?> />
                        <div class="image" style="background-image: url(http://loremflickr.com/620/440/london)"></div>
                    </label>
                </div>
            </div>
        </div>
<?php
    }
}
