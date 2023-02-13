<div class="site_mode__wrap-form">
    <?php settings_errors(); ?>
    <form method="post" id="site-mode-content" class="site_mode_form content_form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="content_heading"><?php _e('Heading','site-mode');?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_input_cover">
                    <input type="text" id="content_heading" name="content-heading" value="<?php esc_attr_e($this->content_heading,'site-mode'); ?>" />
                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="content_description"><?php _e('Description','site-mode');?></label></span>
            </div>
            <div class="option__row--field">
                <div class="description_editor" id="content_description">
                    <?php
                        $content = $this->content_description;
                        $custom_editor_id = "editorid";
                        $custom_editor_name = "content-description";

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

        <div class="option__row">
            <div class="option__row--label">
                <span><?php _e('Logo Type','site-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="logo_type_wrapper">
                    <div class="radio_wrapper logo_radio_wrapper">
                        <input type="radio" id="text-logo" class="logo_type_selector" name="logo-type" value="text" <?php checked($this->logo_type === 'text',true,true); ?> />
                        <label for="text-logo"><?php _e('Text','site-mode');?></label>
                        <div class="check"><div class="inside"></div></div>
                    </div>

                    <div class="radio_wrapper logo_radio_wrapper">
                        <input type="radio" id="image-logo" class="logo_type_selector" name="logo-type" value="image" <?php checked($this->logo_type === 'image',true, true); ?> />
                        <label for="image-logo"><?php _e('Image','site-mode');?></label>
                        <div class="check"><div class="inside"></div></div>
                    </div>
                    <div class="radio_wrapper logo_radio_wrapper">
                        <input type="radio" id="disable-logo" class="logo_type_selector" name="logo-type" value="disable" <?php checked($this->logo_type === 'disable',true, true); ?> />
                        <label for="disable-logo"><?php _e('Disable','site-mode');?></label>
                        <div class="check"><div class="inside"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="logo_wrapper image_logo_wrapper <?php echo $this->logo_type === 'image' ? 'show_logo_wrapper' : ''; ?>">
            <div class="option__row">
                <div class="option__row--label">
                    <span>
                        <label for="logo-image"><?php _e('Select Logo','site-mode');?></label>
                    </span>
                </div>
                <div class="option__row--field">
                    <div class="upload_image_cover logo_display">
					    <?php if ($this->logo_image) : ?>
                            <div class="sm_image_wrapper">
                                <img src="<?php echo esc_url($this->logo_image['url']) ?>" alt="<?php echo esc_attr($this->logo_image['alt']); ?>" />
                            </div>
                            <div class="sm-image-fields" style="display: flex; gap: 10px;">
                                <button type="button" id="logo-image" class="btn btn_outline btn_sm sm-upload-image" data-image-type="Logo">
								    <?php esc_html_e('Change Logo', 'site-mode'); ?>
                                </button>
                                <button type="button" class="btn btn_outline btn_sm sm-remove-image" data-image-type="Logo">
								    <?php esc_html_e('Remove Logo', 'site-mode'); ?>
                                </button>
                                <input type="hidden" name="logo-image" value="<?php echo esc_attr($this->logo_image['id']); ?>">
                            </div>
					    <?php else : ?>
                            <div class="sm_image_wrapper"></div>
                            <div class="sm-image-fields" style="display: flex; gap: 10px;">
                                <button type="button" id="logo-image" class="btn btn_outline btn_sm sm-upload-image" data-image-type="Logo">
								    <?php esc_html_e('Upload Logo', 'site-mode'); ?>
                                </button>
                                <button type="button" class="btn btn_outline btn_sm sm-remove-image" data-image-type="Logo" style="display: none;">
								    <?php esc_html_e('Remove Logo', 'site-mode'); ?>
                                </button>
                                <input type="hidden" name="logo-image" value="<?php echo esc_attr($this->logo_image['id']); ?>">
                            </div>

					    <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="logo_wrapper text_logo_wrapper <?php echo $this->logo_type === 'text' ? 'show_logo_wrapper' : ''; ?>">
            <div class="option__row">
                <div class="option__row--label">
                    <span><label for="text_logo"><?php _e('Logo text','site-mode');?></label></span>
                </div>
                <div class="option__row--field">
                    <div class="sm_input_cover label_top">
                        <input type="text" id="text_logo" name="logo-text" value="<?php esc_attr_e($this->logo_text,'site-mode'); ?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="background-image"><?php _e('Background Image','site-mode');?></label></span>
            </div>
            <div class="option__row--field">
                <div class="upload_image_cover bg_img_display">

		            <?php if ($this->bg_image) : ?>
                        <div class="sm_image_wrapper">
                            <img src="<?php echo esc_url($this->bg_image['url']) ?>" alt="<?php echo esc_attr($this->bg_image['alt']); ?>" />
                        </div>

                        <div class="sm-image-fields" style="display: flex; gap: 10px;">
                            <button type="button" id="background-image" class="btn btn_outline btn_sm sm-upload-image" data-image-type="Background Image">
					            <?php esc_html_e('Change Background Image', 'site-mode'); ?>
                            </button>
                            <button type="button" class="btn btn_outline btn_sm sm-remove-image" data-image-type="Background Image">
					            <?php esc_html_e('Remove Background Image', 'site-mode'); ?>
                            </button>
                            <input type="hidden" name="bg-image" value="<?php echo esc_attr($this->bg_image['id']); ?>">
                        </div>

		            <?php else : ?>

                        <div class="sm_image_wrapper"></div>

                        <div class="sm-image-fields" style="display: flex; gap: 10px;">
                            <button type="button" id="background-image" class="btn btn_outline btn_sm sm-upload-image" data-image-type="Background Image">
					            <?php esc_html_e('Upload Background Image', 'site-mode'); ?>
                            </button>
                            <button type="button" class="btn btn_outline btn_sm sm-remove-image" data-image-type="Background Image" style="display: none;">
					            <?php esc_html_e('Remove Background Image', 'site-mode'); ?>
                            </button>
                            <input type="hidden" name="bg-image" value="<?php echo esc_attr($this->bg_image['id']); ?>">
                        </div>

		            <?php endif; ?>

                </div>
            </div>
        </div>

        <?php wp_nonce_field('design-settings-save', 'design-custom-message'); ?>

        <!-- Submit setting -->
        <div class="option__row">
            <div class="option__row--label submit_button">                
                <button type="submit" name="submit" class="button button-primary site-mode-save-btn">
                    <span class="save-btn-loader" style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><circle cx="12" cy="20" r="2"></circle><circle cx="12" cy="4" r="2"></circle><circle cx="6.343" cy="17.657" r="2"></circle><circle cx="17.657" cy="6.343" r="2"></circle><circle cx="4" cy="12" r="2.001"></circle><circle cx="20" cy="12" r="2"></circle><circle cx="6.343" cy="6.344" r="2"></circle><circle cx="17.657" cy="17.658" r="2"></circle></svg>
                    </span>
                    <?php _e('Save Changes', 'site-mode'); ?>
                </button>
            </div>
        </div>
    </form>
</div>


