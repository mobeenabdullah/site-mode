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
        $ga_code            = isset($uns_data['ga_code']) ? $uns_data['ga_code'] : 'google analytics code';
        $custom_css         = isset($uns_data['custom_css']) ? $uns_data['custom_css'] : 'custom css';
        $enable_rest_api    = isset($uns_data['enable_rest_api']) ? $uns_data['enable_rest_api'] : 'enable';
        $enable_feed        = isset($uns_data['enable_feed']) ? $uns_data['enable_feed'] : 'enable';
        $include_pages      = isset($uns_data['include_pages']) ? $uns_data['include_pages'] : '';
        $exclude_pages      = isset($uns_data['exclude_pages']) ? $uns_data['exclude_pages'] : '';
        $header_code        = isset($uns_data['header_code']) ? $uns_data['header_code'] : 'header code';
        $footer_code        = isset($uns_data['footer_code']) ? $uns_data['footer_code'] : 'footer code';
        $admin_role         = isset($uns_data['admin_role']) ? $uns_data['admin_role'] : 'administrator';
        $editor_role        = isset($uns_data['editor_role']) ? $uns_data['editor_role'] : 'editor';
        $author_role        = isset($uns_data['author_role']) ? $uns_data['author_role'] : 'author';
        $contributor_role   = isset($uns_data['contributor_role']) ? $uns_data['contributor_role'] : 'contributor';
        $subscriber_role    = isset($uns_data['subscriber_role']) ? $uns_data['subscriber_role'] : 'subscriber';
        $user_role          = isset($uns_data['user_role']) ? $uns_data['user_role'] : 'user';
    ?>

    <form id="site-mode-advanced" method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="google_analytics"><?php _e('Google Analytics','site-mode');?></label></span>                
            </div>
            <div class="option__row--field">
                <div class="sm_select">                    
                    <select name="advanced-analytics-type-setting" id="google_analytics">
                        <option value="analytics-id" <?php selected( $analytics_type =='analytics-id', 1 ); ?>><?php _e('Analytics ID','site-mode');?></option>
                        <option value="analytics-code" <?php selected( $analytics_type ==='analytics-code', 1 ); ?>><?php _e('Analytics Code','site-mode');?></option>
                    </select>
                    <span class="arrow-down"></span>
                </div>
            </div>
        </div>
        <div class="option__row analytic_id <?php echo ($mode !== 'analytics-id') ? 'sm_hide_field' : ''; ?>">
            <div class="option__row--label">
                <span><label for="google_analytic_id"><?php _e(' Enter just the ID', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_input_cover">                    
                    <input type="text" id="google_analytic_id" name="advanced-ga-id-setting" value="<?php echo esc_attr($ga_id); ?>" />
                </div>
            </div>
        </div>
        <div class="option__row analytic_code <?php echo ($mode !== 'analytics-code') ? 'sm_hide_field' : ''; ?>">
            <div class="option__row--label">
                <span><label for="custom-ga-code"><?php _e(' Inject all code', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_textarea_cover">                    
                    <textarea id="custom-ga-code" name="advanced-ga-code-setting" rows="6" cols="80"><?php echo esc_attr($ga_code); ?></textarea>
                </div>
            </div>
        </div>

    </form>
</div>
