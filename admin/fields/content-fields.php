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
class Content_Field
{


    public function __construct()
    {
        $this->add_fields();
    }
    public function add_fields()
    {



        add_settings_field('rex_maintenance_content_logo_type', 'Logo Type', [$this, 'rex_maintenance_content_logo_type_cb'], 'rex-maintenance-options-one', 'rex-maintenance-content-logo-section');
        add_settings_field('rex_maintenance_content_headline', 'Headline', [$this, 'rex_maintenance_content_headline_cb'], 'rex-maintenance-options-one', 'rex-maintenance-content-text-section');
        add_settings_field('rex_maintenance_content_area', 'Content Area', [$this, 'rex_maintenance_content_area_cb'], 'rex-maintenance-options-one', 'rex-maintenance-content-text-section');
        add_settings_field('rex_maintenance_content_bg_image', 'Change Background Image', [$this, 'rex_maintenance_content_bg_image_cb'], 'rex-maintenance-options-one', 'rex-maintenance-content-text-section');
    }
    public function rex_maintenance_content_logo_type_cb() {
        ?>
            <div class="logo_type_wrapper">
                <div class="um_radio_wrapper">
                    <input type="radio" id="text-logo" name="content-logo-settings" value="type-text"  <?php checked(1, get_option('wprex-login-icon-setting'), true); ?> />
                    <label for="text-logo">Text</label>
                </div>
                <div class="um_radio_wrapper">
                    <input type="radio" id="image-logo" name="content-logo-settings" value="type-image"  <?php checked(1, get_option('wprex-login-icon-setting'), true); ?> />
                    <label for="image-logo">Image</label>
                </div>
                <div class="um_radio_wrapper">
                    <input type="radio" id="disable-logo" name="content-logo-settings" value="type-disable"  <?php checked(1, get_option('wprex-login-icon-setting'), true); ?> />
                    <label for="disable-logo">disable</label>
                </div>
            </div>
        <?php
        $logo_url = wp_get_attachment_image_url(get_option('content-logo-settings'), 'medium'); ?>
        <div class="image_logo_wrapper">
            <?php if ($logo_url) : ?>
                <div class="bg_image_wrapper">
                    <a href="#" class="Logo-upload um_btn_outline image_btn"></a>
                    <div class="display_logo_img">
                        <img src="<?php echo esc_url($logo_url) ?>" width="150" height="150" />
                    </div>
                </div>
                <a href="#" class="button um_btn_outline logo-remove"><?php esc_html_e('Remove Logo', 'rex-maintenance-mode'); ?></a>
                <input type="hidden" name="content-logo-settings" value="<?php esc_attr_e(get_option('content-logo-settings'),'rex-maintenance-mode'); ?>">
            <?php else : ?>
                <a href="#" class="button um_btn_outline logo-upload"><?php esc_html_e('Upload Logo', 'rex-maintenance-mode'); ?></a>
                <a href="#" class="button um_btn_outline logo-remove" style="display: none;"><?php esc_html_e('Remove Logo', 'rex-maintenance-mode'); ?></a>
                <input type="hidden" name="content-logo-settings" value=<?php esc_attr_e(get_option('content-logo-settings'),'rex-maintenance-mode'); ?>>
            <?php endif; ?>
        </div>

        <div class="um_input_cover label_top text_logo_wrapper">
            <label for="text_logo">Type Logo text</label>
            <input type="text" id="text_logo" name="text-logo-setting" value="<?php esc_attr_e(get_option('content-subheading-settings'),'rex-maintenance-mode'); ?>" />
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
        <div class="description_editor">
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
                <div class="bg_image_wrapper">
                    <a href="#" class="bg-image-upload um_btn_outline image_btn"></a>
                    <div class="display_bg_img">
                        <img src="<?php echo esc_url($bg_img_id) ?>" width="350" height="350" alt="background Image" />
                    </div>
                </div>
                <a href="#" class="button um_btn_outline bg-image-remove"><?php esc_html_e('Remove Background Image', 'rex-maintenance-mode'); ?></a>
                <input type="hidden" name="content-bg-image-settings" value="<?php esc_attr_e(get_option('content-bg-image-settings'),'rex-maintenance-mode'); ?>">
            <?php else : ?>
                <a href="#" class="button um_btn_outline bg-image-upload"><?php esc_html_e('Upload Background Image', 'rex-maintenance-mode'); ?></a>
                <a href="#" class="button um_btn_outline bg-image-remove" style="display:none"><?php esc_html_e('Remove Background Image', 'rex-maintenance-mode'); ?></a>
                <input type="hidden" name="content-bg-image-settings" value=<?php esc_attr_e(get_option('content-bg-image-settings'),'rex-maintenance-mode'); ?>>
            <?php endif; ?>
        </div>
        <?php
    }
}