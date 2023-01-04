<div class="site_mode__wrap-form">    
        <?php
            // Show error/update messages
            settings_errors();
            //get content data
            $content = get_option('site_mode_content');
            //unserialize data
            $uns_data = unserialize($content);

            // check values are set or not if not assign default values
            $text_logo      = isset($uns_data['text_logo']) ? $uns_data['text_logo'] : '';
            $image_logo     = isset($uns_data['image_logo']) ? $uns_data['image_logo'] : '';
            $logo_setting   = isset($uns_data['logo_settings']) ? $uns_data['logo_settings'] : 'image-logo';
            $heading        = isset($uns_data['heading']) ? $uns_data['heading'] : ' heading goes here';
            $description    = isset($uns_data['description']) ? $uns_data['description'] : 'description goes here';
            $bg_image       = isset($uns_data['bg_image']) ? $uns_data['bg_image'] : '';

            //if logo_setting is image-logo then disable text logo field
        echo $bg_image;
        ?>
    <form method="post" id="site-mode-content" class="site_mode_form content_form" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">        

        <?php $logo_url = wp_get_attachment_image_url($image_logo, 'medium'); ?>
        
        <div class="option__row">
            <div class="option__row--label">
                <span><?php _e('Logo Type','site-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="logo_type_wrapper">
                    <div class="um_radio_wrapper">
                        <input type="radio" id="text-logo" name="content-logo-settings" value="type-text" <?php checked($logo_setting=='type-text',true,true); ?> />
                        <label for="text-logo"><?php _e('Text','site-mode');?></label>
                    </div>
                    <div class="um_radio_wrapper">
                        <input type="radio" id="image-logo" name="content-logo-settings" value="type-image"  <?php checked($logo_setting=='type-image',true, true); ?> />
                        <label for="image-logo"><?php _e('Image','site-mode');?></label>
                    </div>
                    <div class="um_radio_wrapper">
                        <input type="radio" id="disable-logo" name="content-logo-settings" value="type-disable"  checked <?php checked($logo_setting=='type-disable',true, true); ?> />
                        <label for="disable-logo"><?php _e('disable','site-mode');?></label>
                    </div>
                </div>
                <div class="image_logo_wrapper">
                    <?php if ($logo_url) : ?>
                        <div class="bg_image_wrapper">
                            <a href="#" class="logo-upload image_btn"></a>
                            <div class="display_logo_img">
                                <img src="<?php echo esc_url($logo_url) ?>" width="150" height="150" />
                            </div>
                        </div>
                        <a href="#" class="button um_btn_outline logo-remove"><?php esc_html_e('Remove Logo', 'site-mode'); ?></a>
                        <input type="hidden" name="content-image-logo-setting" value="<?php esc_attr_e(get_option('content-image-logo-setting'),'site-mode'); ?>">
                    <?php else : ?>
                        <a href="#" class="logo-upload button"><?php esc_html_e('Upload Logo', 'site-mode'); ?></a>
                        <a href="#" class="logo-remove um_btn_outline button" style="display: none;"><?php esc_html_e('Remove Logo', 'site-mode'); ?></a>
                        <input type="hidden" name="content-image-logo-setting" value=<?php esc_attr_e($image_logo,'site-mode'); ?>>
                    <?php endif; ?>
                </div>
                <div class="um_input_cover label_top text_logo_wrapper">
                    <label for="text_logo"><?php _e('Logo text','site-mode');?></label>
                    <input type="text" id="text_logo" name="content-text-logo-setting" value="<?php esc_attr_e($image_logo,'site-mode'); ?>" />
                </div>               
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><?php _e('Heading','site-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="um_input_cover">
                    <label class="screen-reading" for="headline"><?php _e('Headline','site-mode');?></label>
                    <input type="text" id="headline" name="content-heading-setting" value="<?php esc_attr_e($heading,'site-mode'); ?>" />
                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><?php _e('Description','site-mode');?></span>
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
        <?php $bg_img_url = wp_get_attachment_image_url($bg_image, 'full'); ?>
        <div class="option__row">
            <div class="option__row--label">
                <span><?php _e('Background Image','site-mode');?></span>
            </div>
            <div class="option__row--field">
                <div>
                    <?php if ($bg_img_url) : ?>
                        <img src="<?php echo esc_url($bg_img_url) ?>" width="150" height="150" />
                        <a href="#" class="button bg-image-upload"><?php esc_html_e('Upload Background Image', 'site-mode'); ?></a>
                        <a href="#" class="button um_btn_outline bg-image-remove"><?php esc_html_e('Remove Background Image', 'site-mode'); ?></a>
                        <input type="hidden" name="content-bg-image-setting" value="<?php esc_attr_e($bg_image,'site-mode'); ?>">
                        <?php else : ?>
                        <a href="#" class="button bg-image-upload"><?php esc_html_e('Upload Background Image', 'site-mode'); ?></a>
                        <a href="#" class="button um_btn_outline bg-image-remove" style="display:none"><?php esc_html_e('Remove Background Image', 'site-mode'); ?></a>
                        <input type="hidden" name="content-bg-image-setting" value=<?php esc_attr_e($bg_image,'site-mode'); ?>>
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


