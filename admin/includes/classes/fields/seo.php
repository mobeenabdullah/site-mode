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
class SEO_Field
{


    public function __construct()
    {
        $this->add_fields();
    }
    public function add_fields()
    {
        // SEO Section fields
        add_settings_field('rex_maintenance_seo_title', 'SEO Meta Title ', [$this, 'rex_maintenance_seo_meta_title_cb'], 'rex-maintenance-seo-page', 'rex-maintenance-seo-section');
        add_settings_field('rex_maintenance_seo_description', 'SEO Meta Description ', [$this, 'rex_maintenance_seo_meta_description_cb'], 'rex-maintenance-seo-page', 'rex-maintenance-seo-section');
        add_settings_field('rex_maintenance_seo_favicon', 'SEO Meta Favicon', [$this, 'rex_maintenance_seo_meta_favicon_cb'], 'rex-maintenance-seo-page', 'rex-maintenance-seo-section');
        add_settings_field('rex_maintenance_seo_image', 'Social Share Image', [$this, 'rex_maintenance_seo_meta_image_cb'], 'rex-maintenance-seo-page', 'rex-maintenance-seo-section');
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
}