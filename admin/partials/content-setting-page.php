<div class="site_mode__wrap-form">
        <?php
            // Show error/update messages
            settings_errors();
            //if logo_setting is image-logo then disable text logo field
        ?>
    <form method="post" id="site-mode-content" class="site_mode_form content_form" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">

        <div class="option__row">
            <div class="option__row--label">
                <span><?php _e('Logo Type','site-mode');?></span>
            </div>

            <div class="option__row--field">
                <div class="logo_type_wrapper">
                    <div class="radio_wrapper logo_radio_wrapper">
                        <input type="radio" id="text-logo" class="logo_type_selector" name="content-logo-settings" value="text" <?php checked($this->logo_setting === 'text',true,true); ?> />
                        <label for="text-logo"><?php _e('Text','site-mode');?></label>
                        <div class="check"><div class="inside"></div></div>
                    </div>

                    <div class="radio_wrapper logo_radio_wrapper">
                        <input type="radio" id="image-logo" class="logo_type_selector" name="content-logo-settings" value="image" <?php checked($this->logo_setting === 'image',true, true); ?> />
                        <label for="image-logo"><?php _e('Image','site-mode');?></label>
                        <div class="check"><div class="inside"></div></div>
                    </div>
                    <div class="radio_wrapper logo_radio_wrapper">
                        <input type="radio" id="disable-logo" class="logo_type_selector" name="content-logo-settings" value="disable" <?php checked($this->logo_setting === 'disable',true, true); ?> />
                        <label for="disable-logo"><?php _e('Disable','site-mode');?></label>
                        <div class="check"><div class="inside"></div></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Todo: Move Below Temporary CSS -->
        <style>
            .logo_wrapper {
                display: none;
            }
            .show_logo_wrapper {
                display: block !important;
            }
        </style>
        <div class="logo_wrapper image_logo_wrapper <?php echo $this->logo_setting === 'image' ? 'show_logo_wrapper' : ''; ?>">
            <div class="option__row">
                <div class="option__row--label">
                    <span>
                        <label for="logo-image"><?php _e('Select Logo','site-mode');?></label>
                    </span>
                </div>
	            <?php
	                $image_url = wp_get_attachment_image_url($this->image_logo, 'medium');
                    $image_alt_text = get_post_meta($this->image_logo, '_wp_attachment_image_alt', true);
                    if(!$image_alt_text){
	                    $image_alt_text = get_the_title( $this->image_logo );
                    }
                ?>
                <div class="option__row--field">
                    <div class="upload_image_cover">

                        <?php if ($image_url) : ?>

                            <!-- Todo: Remove inline CSS and adjust structure accordingly -->
                            <div class="sm_image_wrapper">
                                <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />
                            </div>

                            <div class="sm-image-fields" style="display: flex; gap: 10px;">
                                <button type="button" id="logo-image" class="button sm-upload-image" data-image-type="Logo">
                                    <?php esc_html_e('Change Logo', 'site-mode'); ?>
                                </button>
                                <button type="button" class="button sm-remove-image" data-image-type="Logo">
                                    <?php esc_html_e('Remove Logo', 'site-mode'); ?>
                                </button>
                                <input type="hidden" name="content-image-logo-setting" value="<?php echo esc_attr($this->image_logo); ?>">
                            </div>

                        <?php else : ?>

                            <div class="sm_image_wrapper"></div>

                            <div class="sm-image-fields" style="display: flex; gap: 10px;">
                                <button type="button" id="logo-image" class="button sm-upload-image" data-image-type="Logo">
                                    <?php esc_html_e('Upload Logo', 'site-mode'); ?>
                                </button>
                                <button type="button" class="button sm-remove-image" data-image-type="Logo" style="display: none;">
                                    <?php esc_html_e('Remove Logo', 'site-mode'); ?>
                                </button>
                                <input type="hidden" name="content-image-logo-setting" value="<?php echo esc_attr($this->image_logo); ?>">
                            </div>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="logo_wrapper text_logo_wrapper <?php echo $this->logo_setting === 'text' ? 'show_logo_wrapper' : ''; ?>">
            <div class="option__row">
                <div class="option__row--label">
                    <span><label for="text_logo"><?php _e('Logo text','site-mode');?></label></span>
                </div>
                <div class="option__row--field">
                    <div class="sm_input_cover label_top">
                        <input type="text" id="text_logo" name="content-text-logo-setting" value="<?php esc_attr_e($this->text_logo,'site-mode'); ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="heading"><?php _e('Heading','site-mode');?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_input_cover">
                    <input type="text" id="heading" name="content-heading-setting" value="<?php esc_attr_e($this->heading,'site-mode'); ?>" />
                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="description"><?php _e('Description','site-mode');?></label></span>
            </div>
            <div class="option__row--field">
                <div class="description_editor" id="description">
                    <?php
                        $content = $this->description;
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
        <?php
            $bg_img_url = wp_get_attachment_image_url($this->bg_image, 'full');
            $bg_image_alt_text = get_post_meta($this->bg_image, '_wp_attachment_image_alt', true);

            if(!$bg_image_alt_text){
	            $bg_image_alt_text = get_the_title( $this->bg_image );
            }
        ?>
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="background-image"><?php _e('Background Image','site-mode');?></label></span>
            </div>
            <div class="option__row--field">
                <div class="upload_image_cover">

		            <?php if ($bg_img_url) : ?>

                        <!-- Todo: Remove inline CSS and adjust structure accordingly -->
                        <div class="sm_image_wrapper">
                            <img src="<?php echo esc_url($bg_img_url) ?>" alt="<?php echo esc_attr($bg_image_alt_text); ?>" />
                        </div>

                        <div class="sm-image-fields" style="display: flex; gap: 10px;">
                            <button type="button" id="background-image" class="button sm-upload-image" data-image-type="Background Image">
					            <?php esc_html_e('Change Background Image', 'site-mode'); ?>
                            </button>
                            <button type="button" class="button sm-remove-image" data-image-type="Background Image">
					            <?php esc_html_e('Remove Background Image', 'site-mode'); ?>
                            </button>
                            <input type="hidden" name="content-bg-image-setting" value="<?php echo esc_attr($this->bg_image); ?>">
                        </div>

		            <?php else : ?>

                        <div class="sm_image_wrapper"></div>

                        <div class="sm-image-fields" style="display: flex; gap: 10px;">
                            <button type="button" id="background-image" class="button sm-upload-image" data-image-type="Background Image">
					            <?php esc_html_e('Upload Background Image', 'site-mode'); ?>
                            </button>
                            <button type="button" class="button sm-remove-image" data-image-type="Background Image" style="display: none;">
					            <?php esc_html_e('Remove Background Image', 'site-mode'); ?>
                            </button>
                            <input type="hidden" name="content-bg-image-setting" value="<?php echo esc_attr($this->bg_image); ?>">
                        </div>

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


