<div class="site_mode__wrap-form">
    <?php
        // error message
        settings_errors();

    ?>

    <form id="site-mode-advanced" method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
            <div class="option__row <?php echo (esc_attr($this->analytics_type) !== 'ga-id') ? 'sm_hide_field' : ''; ?>">
                <div class="option__row--label">
                    <span><label for="google_analytic_id"><?php _e('Google Analytic ID', 'site-mode')?></label></span>
                </div>
                <div class="option__row--field">
                    <div class="sm_input_cover">
                        <input type="text" id="google_analytic_id" name="advanced-ga-id-setting" value="<?php echo esc_attr($this->ga_id); ?>" />
                    </div>
                </div>
            </div>


            <div class="option__row <?php echo (esc_attr($this->analytics_type) !== 'pixel-id') ? 'sm_hide_field' : ''; ?>">
                <div class="option__row--label">
                    <span><label for="facebook_pixel_id"><?php _e('Facebook Pixel ID', 'site-mode')?></label></span>
                </div>
                <div class="option__row--field">
                    <div class="sm_input_cover">
                        <input type="text" id="facebook_pixel_id" name="advanced-facebook-id-setting" value="<?php echo esc_attr($this->fb_id); ?>" />
                    </div>
                </div>
            </div>


        <div class="option__row">
            <div class="option__row--label">
                <span><label for="rest_api"><?php _e('Rest API Enable/Disable', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_checkbox_wrapper">
                    <input type="checkbox" id="rest_api" name="advanced-wp-rest-api-setting" value="1" <?php checked(1,$this->enable_rest_api,true); ?> />
                    <label for="rest_api"></label>
                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="feed_enable"><?php _e('Feeds Enable/Disable', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_checkbox_wrapper">
                <input type="checkbox" id="feed_enable" name="advanced-wp-feed-setting" value="1" <?php checked(1,$this->enable_feed,true); ?>/>
                    <label for="feed_enable"></label>
                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="header-code"><?php _e('Header Code', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_textarea_cover header_code">
                    <textarea id="header_code" name="advanced-header-code-setting" rows="6" cols="80">
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
                    <textarea id="footer_code" name="advanced-footer-code-setting" rows="6" cols="80"><?php echo esc_attr($this->footer_code); ?></textarea>
                </div>
            </div>
        </div>
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="custom-css"><?php _e('Custom CSS', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_textarea_cover custom_css">
                    <textarea id="custom_css" name="advanced-custom-css-setting" rows="6" cols="80"><?php echo esc_attr($this->custom_css); ?></textarea>
                </div>
            </div>
        </div>

        <?php
        wp_nonce_field('advance-settings-save', 'advance-custom-message');
        ?>
         <div class="option__row">
            <div class="option__row--label submit_button">
                <?php submit_button(); ?>
            </div>
        </div>

    </form>
</div>
