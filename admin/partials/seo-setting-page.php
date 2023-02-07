<div class="site_mode__wrap-form">

    <form id="site-mode-seo" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" >
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="seo-meta-title"><?php esc_html_e('SEO Meta Title', 'site-mode'); ?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_input_cover">
                    <input type="text" id="seo-meta-title" name="soe-meta-title-setting" value="<?php esc_attr_e($this->meta_title,'site-mode'); ?>" />
                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="seo-meta-description"><?php esc_html_e('SEO Meta Title', 'site-mode'); ?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_input_cover">
                <input type="text" id="seo-meta-description" name="soe-meta-description-setting" value="<?php esc_attr_e($this->meta_title,'site-mode'); ?>" />
                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="favicon-image"><?php esc_html_e('Upload Favicon', 'site-mode'); ?></label></span>
            </div>
	        <?php
                $favicon_url = wp_get_attachment_image_url($this->meta_favicon, 'medium');
                $favicon_alt_text = get_post_meta($this->meta_favicon, '_wp_attachment_image_alt', true);
                if(!$favicon_alt_text){
                    $favicon_alt_text = get_the_title( $this->meta_favicon );
                }
	        ?>
            <div class="option__row--field">
                <div class="upload_image_cover favicon_display">

			        <?php if ($favicon_url) : ?>

                        <!-- Todo: Remove inline CSS and adjust structure accordingly -->
                        <div class="sm_image_wrapper">
                            <img src="<?php echo esc_url($favicon_url) ?>" alt="<?php echo esc_attr($favicon_alt_text); ?>" />
                        </div>

                        <div class="sm-image-fields" style="display: flex; gap: 10px;">
                            <button type="button" id="favicon-image" class="btn btn_outline btn_sm sm-upload-image" data-image-type="Favicon">
						        <?php esc_html_e('Change Favicon', 'site-mode'); ?>
                            </button>
                            <button type="button" class="btn btn_outline btn_sm sm-remove-image" data-image-type="Favicon">
						        <?php esc_html_e('Remove Favicon', 'site-mode'); ?>
                            </button>
                            <input type="hidden" name="seo-meta-favicon-setting" value="<?php echo esc_attr($this->meta_favicon); ?>">
                        </div>

			        <?php else : ?>

                        <div class="sm_image_wrapper"></div>

                        <div class="sm-image-fields" style="display: flex; gap: 10px;">
                            <button type="button" id="favicon-image" class="btn btn_outline btn_sm sm-upload-image" data-image-type="Favicon">
						        <?php esc_html_e('Upload Favicon', 'site-mode'); ?>
                            </button>
                            <button type="button" class="btn btn_outline btn_sm sm-remove-image" data-image-type="Favicon" style="display: none;">
						        <?php esc_html_e('Remove Favicon', 'site-mode'); ?>
                            </button>
                            <input type="hidden" name="seo-meta-favicon-setting" value="<?php echo esc_attr($this->meta_favicon); ?>">
                        </div>

			        <?php endif; ?>

                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="seo-image" ><?php esc_html_e('SEO Image', 'site-mode'); ?></label></span>
            </div>
	        <?php
	        $seo_image_url = wp_get_attachment_image_url($this->meta_image, 'medium');
	        $seo_image_alt_text = get_post_meta($this->meta_image, '_wp_attachment_image_alt', true);
	        if(!$seo_image_alt_text){
		        $seo_image_alt_text = get_the_title( $this->meta_image );
	        }
	        ?>
            <div class="option__row--field">
                <div class="upload_image_cover seo_image_display">

			        <?php if ($seo_image_url) : ?>

                        <!-- Todo: Remove inline CSS and adjust structure accordingly -->
                        <div class="sm_image_wrapper">
                            <img src="<?php echo esc_url($seo_image_url) ?>" alt="<?php echo esc_attr($seo_image_url); ?>" />
                        </div>

                        <div class="sm-image-fields" style="display: flex; gap: 10px;">
                            <button type="button" id="seo-image" class="btn btn btn_outline btn_sm sm-upload-image" data-image-type="SEO Image">
						        <?php esc_html_e('Change SEO Image', 'site-mode'); ?>
                            </button>
                            <button type="button" class="btn btn_outline btn_sm sm-remove-image" data-image-type="SEO Image">
						        <?php esc_html_e('Remove SEO Image', 'site-mode'); ?>
                            </button>
                            <input type="hidden" name="seo-meta-image-setting" value="<?php echo esc_attr($this->meta_image); ?>">
                        </div>

			        <?php else : ?>

                        <div class="sm_image_wrapper"></div>

                        <div class="sm-image-fields" style="display: flex; gap: 10px;">
                            <button type="button" id="seo-image" class="btn btn_outline btn_sm sm-upload-image" data-image-type="SEO Image">
						        <?php esc_html_e('Upload SEO Image', 'site-mode'); ?>
                            </button>
                            <button type="button" class="btn btn_outline btn_sm sm-remove-image" data-image-type="SEO Image" style="display: none;">
						        <?php esc_html_e('Remove SEO Image', 'site-mode'); ?>
                            </button>
                            <input type="hidden" name="seo-meta-image-setting" value="<?php echo esc_attr($this->meta_image); ?>">
                        </div>

			        <?php endif; ?>

                </div>
            </div>
        </div>

        <?php wp_nonce_field('seo-settings-save', 'seo-custom-message'); ?>
        <div class="option__row">
            <div class="option__row--label submit_button">
                <?php submit_button(); ?>
            </div>
        </div>
    </form>
</div>
