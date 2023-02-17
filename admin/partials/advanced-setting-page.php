<div class="site_mode__wrap-form">
    <?php settings_errors(); ?>

    <form id="site-mode-advanced" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="google_analytic_id"><?php esc_html_e('Google Analytics ID', 'site-mode')?></label></span>
                <span class="info_text"><?php esc_html_e('Enter your Google Analytics tracking ID to integrate website analytics and monitor traffic','site-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="sm_input_cover">
                    <input type="text" id="google_analytic_id" name="ga-id" value="<?php echo esc_attr($this->ga_id); ?>" placeholder="e.g. G-XXXXXXXXXX" />
                </div>
            </div>
        </div>


        <div class="option__row">
            <div class="option__row--label">
                <span><label for="facebook_pixel_id"><?php esc_html_e('Facebook Pixel ID', 'site-mode')?></label></span>
                <span class="info_text"><?php esc_html_e('Enter your Facebook Pixel ID to enable tracking and measurement of your website\'s performance on Facebook','site-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="sm_input_cover">
                    <input type="text" id="facebook_pixel_id" name="facebook-id" value="<?php echo esc_attr($this->fb_id); ?>" placeholder="e.g. xxxxxxxxxxxxxxx" />
                </div>
            </div>
        </div>


        <div class="option__row">
            <div class="option__row--label">
                <span><label for="rest_api"><?php esc_html_e('Disable REST API', 'site-mode')?></label></span>
                <span class="info_text"><?php esc_html_e('Activate to disable the REST API, which can enhance security and prevent unauthorized access','site-mode');?></span>
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
                <span><label for="feed_enable"><?php esc_html_e('Disable RSS Feed', 'site-mode')?></label></span>
                <span class="info_text"><?php esc_html_e('Activate to disable the RSS feed, which can improve website security and prevent unauthorized access to content','site-mode');?></span>
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
                <span><label for="header_code"><?php esc_html_e('Header Code', 'site-mode')?></label></span>
                <span class="info_text"><?php esc_html_e('Enter custom code to be inserted into the header of your website','site-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="sm_textarea_cover header_code">
                    <textarea id="header_code" name="header-code" rows="6" cols="80"><?php echo $this->header_code; ?></textarea>
                </div>
            </div>
        </div>
        <style>

        </style>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="footer-code"><?php esc_html_e('Footer Code', 'site-mode')?></label></span>
                <span class="info_text"><?php esc_html_e('Enter custom code to be inserted into the footer of your website','site-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="sm_textarea_cover footer_code">
                    <textarea id="footer_code" name="footer-code" rows="6" cols="80"><?php echo $this->footer_code; ?></textarea>
                </div>
            </div>
        </div>
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="custom-css"><?php esc_html_e('Custom CSS', 'site-mode')?></label></span>
                <span class="info_text"><?php esc_html_e('Enter custom CSS code to override or modify the default styles of the maintenance page','site-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="sm_textarea_cover custom_css">
                    <textarea id="custom_css" name="custom-css" rows="6" cols="80"><?php echo wp_kses_post($this->custom_css); ?></textarea>
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
                    <?php esc_html_e('Save Changes', 'site-mode'); ?>
                </button>
            </div>
        </div>

    </form>
</div>
