<div class="site_mode__wrap-form">
    <?php settings_errors(); ?>

    <form id="site-mode-advanced" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="google_analytic_id"><?php _e('Google Analytic ID', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_input_cover">
                    <input type="text" id="google_analytic_id" name="ga-id" value="<?php echo esc_attr($this->ga_id); ?>" />
                </div>
            </div>
        </div>


        <div class="option__row">
            <div class="option__row--label">
                <span><label for="facebook_pixel_id"><?php _e('Facebook Pixel ID', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_input_cover">
                    <input type="text" id="facebook_pixel_id" name="facebook-id" value="<?php echo esc_attr($this->fb_id); ?>" />
                </div>
            </div>
        </div>


        <div class="option__row">
            <div class="option__row--label">
                <span><label for="rest_api"><?php _e('Disable REST API', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_checkbox_wrapper">
                    <input type="checkbox" id="rest_api" name="disable-rest-api" value="1" <?php checked(1,$this->disable_rest_api,true); ?> />
                    <label for="rest_api"></label>
                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="feed_enable"><?php _e('Disable RSS Feed', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_checkbox_wrapper">
                <input type="checkbox" id="feed_enable" name="disable-rss-feed" value="1" <?php checked(1,$this->disable_rss_feed,true); ?>/>
                    <label for="feed_enable"></label>
                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="header_code"><?php _e('Header Code', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_textarea_cover header_code">
                    <textarea id="header_code" name="header-code" rows="6" cols="80">
                        <?php echo esc_attr($this->header_code); ?>
                    </textarea>
                </div>
            </div>
        </div>
        <style>

        </style>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="footer-code"><?php _e('Footer Code', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_textarea_cover footer_code">
                    <textarea id="footer_code" name="footer-code" rows="6" cols="80"><?php echo esc_html($this->footer_code); ?></textarea>
                </div>
            </div>
        </div>
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="custom-css"><?php _e('Custom CSS', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_textarea_cover custom_css">
                    <textarea id="custom_css" name="custom-css" rows="6" cols="80"><?php echo esc_html($this->custom_css); ?></textarea>
                </div>
            </div>
        </div>

        <?php
        wp_nonce_field('advance-settings-save', 'advance-custom-message');
        ?>
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
