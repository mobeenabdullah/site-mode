<div class="site_mode__wrap-form">
    <?php
        // error message
        settings_errors();
        
        // get data from database
        $site_mode_advanced = get_option('site_mode_advanced');
        
        //uniseralize data
        $uns_data = unserialize($site_mode_advanced);
        
        //check if value is set or not and set default value
        $analytics_type     = isset($uns_data['analytics_type']) ? $uns_data['analytics_type'] : 'analytics-id';
        $ga_id              = isset($uns_data['ga_id']) ? $uns_data['ga_id'] : 'google analytics id';
        $fb_id              = isset($uns_data['fb_id']) ? $uns_data['fb_id'] : 'facebook pixel id';
        $custom_css         = isset($uns_data['custom_css']) ? $uns_data['custom_css'] : 'custom css';
        $enable_rest_api    = isset($uns_data['enable_rest_api']) ? $uns_data['enable_rest_api'] : 'enable';
        $enable_feed        = isset($uns_data['enable_feed']) ? $uns_data['enable_feed'] : 'enable';
        $header_code        = isset($uns_data['header_code']) ? $uns_data['header_code'] : 'Header code';
        $footer_code        = isset($uns_data['footer_code']) ? $uns_data['footer_code'] : 'Footer code';
        $admin_role         = isset($uns_data['admin_role']) ? $uns_data['admin_role'] : 'administrator';
        $editor_role        = isset($uns_data['editor_role']) ? $uns_data['editor_role'] : 'editor';
        $author_role        = isset($uns_data['author_role']) ? $uns_data['author_role'] : 'author';
        $contributor_role   = isset($uns_data['contributor_role']) ? $uns_data['contributor_role'] : 'contributor';
        $subscriber_role    = isset($uns_data['subscriber_role']) ? $uns_data['subscriber_role'] : 'subscriber';
        $user_role          = isset($uns_data['user_role']) ? $uns_data['user_role'] : 'user';
    ?>

    <form id="site-mode-advanced" method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
        <!-- <div class="option__row">
            <div class="option__row--label">
                <span><label for="google_analytics"><?php _e('Google Analytics','site-mode');?></label></span>                
            </div>
            <div class="option__row--field">
                <div class="sm_select">                    
                    <select name="advanced-analytics-type-setting" id="google_analytics">
                        <option value="ga-id" <?php selected( $analytics_type =='ga-id', 1 ); ?>><?php _e('Analytics ID','site-mode');?></option>
                        <option value="pixel-id" <?php selected( $analytics_type ==='pixel-id', 1 ); ?>><?php _e('Pixel ID','site-mode');?></option>
                    </select>
                    <span class="arrow-down"></span>
                </div>
            </div>
        </div> -->
        
            <div class="option__row <?php echo ($analytics_type !== 'ga-id') ? 'sm_hide_field' : ''; ?>">
                <div class="option__row--label">
                    <span><label for="google_analytic_id"><?php _e('Google Analytic ID', 'site-mode')?></label></span>
                </div>
                <div class="option__row--field">
                    <div class="sm_input_cover">                    
                        <input type="text" id="google_analytic_id" name="advanced-ga-id-setting" value="<?php echo esc_attr($ga_id); ?>" />
                    </div>
                </div>
            </div>
        
        
            <div class="option__row <?php echo ($analytics_type !== 'pixel-id') ? 'sm_hide_field' : ''; ?>">
                <div class="option__row--label">
                    <span><label for="facebook_pixel_id"><?php _e('Facebook Pixel ID', 'site-mode')?></label></span>
                </div>
                <div class="option__row--field">
                    <div class="sm_input_cover">
                        <input type="text" id="facebook_pixel_id" name="advanced-facebook-id-setting" value="<?php echo esc_attr($fb_id); ?>" />
                    </div>
                </div>
            </div>
        

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="rest_api"><?php _e('Rest API Enable/Disable', 'site-mode')?></label></span>                
            </div>
            <div class="option__row--field">
                <div class="sm_checkbox_wrapper">                    
                    <input type="checkbox" id="rest_api" name="advanced-wp-rest-api-setting" value="1" <?php checked(1,$enable_rest_api,true); ?> />
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
                <input type="checkbox" id="feed_enable" name="advanced-wp-feed-setting" value="1" <?php checked(1,$enable_feed,true); ?>/>
                    <label for="feed_enable"></label>
                </div>
            </div>
        </div>    

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="header-code"><?php _e('Header Code', 'site-mode')?></label></span>                
            </div>
            <div class="option__row--field">
                <div class="sm_textarea_cover">                    
                    <textarea id="header_code" name="advanced-header-code-setting" rows="6" cols="80">
                        <?php echo $header_code; ?>                            
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
                <div class="sm_textarea_cover">                    
                    <textarea id="footer-code" name="advanced-footer-code-setting" rows="6" cols="80"><?php echo $footer_code; ?></textarea>
                </div>
            </div>
        </div>
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="custom-css"><?php _e('Custom CSS', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_textarea_cover">
                    <textarea id="custom-css" name="advanced-custom-css-setting" rows="6" cols="80"><?php echo esc_attr($custom_css); ?></textarea>
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
