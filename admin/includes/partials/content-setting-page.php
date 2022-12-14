<div class="rex__wrap--cover-content-form">    

    <form method="post" id="rex-content" class="rex_form content_form" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">        

        <?php $logo_url = wp_get_attachment_image_url($image_logo, 'medium'); ?>
        
        <div class="option__row">
            <div class="option__row--label">
                <span><?php _e('Logo Type','rex-maintenance-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="logo_type_wrapper">
                    <div class="um_radio_wrapper">
                        <input type="radio" id="text-logo" name="content-logo-settings" value="type-text" <?php checked(1,!empty($text_logo), true); ?> />
                        <label for="text-logo"><?php _e('Text','rex-maintenance-mode');?></label>
                    </div>
                    <div class="um_radio_wrapper">
                        <input type="radio" id="image-logo" name="content-logo-settings" value="type-image"  <?php checked(1, !empty($image_logo), true); ?> />
                        <label for="image-logo"><?php _e('Image','rex-maintenance-mode');?></label>
                    </div>
                    <div class="um_radio_wrapper">
                        <input type="radio" id="disable-logo" name="content-logo-settings" value="type-disable"  <?php checked(1,!empty($disable_logo), true); ?> />
                        <label for="disable-logo"><?php _e('disable','rex-maintenance-mode');?></label>
                    </div>
                </div>
                <div class="image_logo_wrapper">
                    <?php if ($logo_url) : ?>
                        <div class="bg_image_wrapper">
                            <a href="#" class="logo-upload um_btn_outline image_btn"></a>
                            <div class="display_logo_img">
                                <img src="<?php echo esc_url($logo_url) ?>" width="150" height="150" />
                            </div>
                        </div>
                        <a href="#" class="button um_btn_outline logo-remove"><?php esc_html_e('Remove Logo', 'rex-maintenance-mode'); ?></a>
                        <input type="hidden" name="content-image-logo-setting" value="<?php esc_attr_e(get_option('content-image-logo-setting'),'rex-maintenance-mode'); ?>">
                    <?php else : ?>
                        <a href="#" class="logo-upload button um_btn_outline"><?php esc_html_e('Upload Logo', 'rex-maintenance-mode'); ?></a>
                        <a href="#" class="logo-remove button um_btn_outline" style="display: none;"><?php esc_html_e('Remove Logo', 'rex-maintenance-mode'); ?></a>
                        <input type="hidden" name="content-image-logo-setting" value=<?php esc_attr_e(get_option('content-image-logo-setting'),'rex-maintenance-mode'); ?>>
                    <?php endif; ?>
                </div>
                <div class="um_input_cover label_top text_logo_wrapper">
                    <label for="text_logo"><?php _e('Type Logo text','rex-maintenance-mode');?></label>
                    <input type="text" id="text_logo" name="content-text-logo-setting" value="<?php esc_attr_e(get_option('content-text-logo-setting'),'rex-maintenance-mode'); ?>" />
                </div>               
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><?php _e('Heading','rex-maintenance-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="um_input_cover">
                    <label class="screen-reading" for="headline"><?php _e('Headline','rex-maintenance-mode');?></label>
                    <input type="text" id="headline" name="content-heading-setting" value="<?php esc_attr_e($heading,'rex-maintenance-mode'); ?>" />
                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><?php _e('Description','rex-maintenance-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="description_editor">
                    <?php
                        $content = $description;
                        $custom_editor_id = "editorid";
                        $custom_editor_name = "content-description-setting";

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
            </div>
        </div>
        
        <?php $bg_img_id = wp_get_attachment_image_url($bg_image, 'full'); ?>

        <div class="option__row">
            <div class="option__row--label">
                <span><?php _e('Background Image','rex-maintenance-mode');?></span>
            </div>
            <div class="option__row--field">
                <div>
                    <?php if ($bg_img_id) : ?>
                        <div class="bg_image_wrapper">
                            <a href="#" class="bg-image-upload um_btn_outline image_btn"></a>
                            <div class="display_bg_img">
                                <img src="<?php echo esc_url($bg_img_id) ?>" width="350" height="350" alt="background Image" />
                            </div>
                        </div>
                        <a href="#" class="button um_btn_outline bg-image-remove"><?php esc_html_e('Remove Background Image', 'rex-maintenance-mode'); ?></a>
                        <input type="hidden" name="content-bg-image-setting" value="<?php esc_attr_e(get_option('content-bg-image-setting'),'rex-maintenance-mode'); ?>">
                        <?php else : ?>
                        <a href="#" class="button um_btn_outline bg-image-upload"><?php esc_html_e('Upload Background Image', 'rex-maintenance-mode'); ?></a>
                        <a href="#" class="button um_btn_outline bg-image-remove" style="display:none"><?php esc_html_e('Remove Background Image', 'rex-maintenance-mode'); ?></a>
                        <input type="hidden" name="content-bg-image-setting" value=<?php esc_attr_e(get_option('content-bg-image-setting'),'rex-maintenance-mode'); ?>>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <?php wp_nonce_field('design-settings-save', 'design-custom-message'); ?>

        <!-- Submit setting -->
        <div class="option__row">
            <div class="option__row--label submit_button">                
                <?php submit_button(); ?>
            </div>            
        </div>
        

    </form>
</div>