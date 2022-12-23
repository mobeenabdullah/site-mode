<div class="rex__wrap--cover-content-form">   
    <form method="post" class="rex_form general_form" id="rex-general" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">     
        <?php
            $template =  get_option('rex_general');    
            $un_data = unserialize($template);
        //check if the values are set or not and then assign them to the variables
            $rex_title      = isset($un_data['rex_title']) ? $un_data['rex_title'] : '';
            $status         = isset($un_data['status'] ) ? $un_data['status']  : '';
            $url            = isset($un_data['url'] ) ? $un_data['url']  : '';
            $delay          = isset($un_data['delay'] ) ? $un_data['delay']  : '';
            $login_icon     = isset($un_data['login_icon'] ) ? $un_data['login_icon']  : '';
            $login_url      = isset($un_data['login_url'] ) ? $un_data['login_url']  : '';


        ?>
        <!-- Status Setting -->
        <div class="option__row">
            <div class="option__row--label">
                <span><?php _e('Status','rex-maintenance-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="um_checkbox_wrapper">
                    <input type="checkbox" id="status" name="wprex-status-settings" value="1" <?php checked(1, $status, true); ?> />
                    <label for="status" aria-label="<?php _e('Status','rex-maintenance-mode');?>"></label>
                </div>
            </div>
        </div>

        <!-- Mode Setting -->
        <div class="option__row">
            <div class="option__row--label">
                <span><?php _e('Mode','rex-maintenance-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="um_select">
                    <label for="site_mode" class="screen-reading"><?php _e('Mode','rex-maintenance-mode');?></label>
                    <select name="wprex-mode-settings" id="site_mode">
                        <option value="maintenance" ><?php _e('Maintenance - Returns HTTP 200 OK response','rex-maintenance-mode');?></option>
                        <option value="coming-soon"><?php _e('Coming Soon - Returns 503 HTTP Service response','rex-maintenance-mode');?></option>
                        <option value="redirect"  id="direct-item"><?php _e('Redirect - Returns HTTP 301 response and redirect to a URL','rex-maintenance-mode');?></option>
                    </select>
                    <span class="arrow-down"></span>
                </div>
                 <!-- Hidden fields -->
                 <div class="redirect_options">
                    <div class="um_input_cover label_top">
                        <label for="redirect_url"><?php _e('Redirect Url','rex-maintenance-mode');?></label>
                        <input type="text" id="redirect_url" name="wprex-redirect-url-settings" value="<?php echo $url; ?>" <?php checked(1, $url, true); ?> />
                    </div>
                    <div class="um_input_cover label_top">
                        <label for="delay_seconds"><?php _e('Delay (Seconds)','rex-maintenance-mode');?></label>
                        <div class="um_number-cover">
                            <input type="number" min="0" max="9" id="delay_seconds" data-inc="1" name="wprex-delay-settings" value="<?php echo $delay; ?>" <?php checked(1, $delay, true); ?> />
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        
        <!-- Logo Setting -->
        <div class="option__row">
            <div class="option__row--label">
                <span><?php _e('Login Icon','rex-maintenance-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="um_checkbox_wrapper">
                    <input type="checkbox" id="login_icon" class="enable_login_icon" name="wprex-login-icon-setting" value="1" <?php checked(1, $login_icon, true); ?> />
                    <label for="login_icon"><?php _e('Login Icon','rex-maintenance-mode');?></label>
                </div>
                <div class="um_input_cover label_top login_url_field">
                    <label for="redirect_url"><?php _e('Login URL','rex-maintenance-mode');?></label>
                    <input type="text" id="redirect_url" name="wprex-login-url-setting" value="<?php echo esc_attr($login_url); ?>"/>
                </div>
            </div>
        </div>
        <?php wp_nonce_field('general_settings_action', 'general_section_field'); ?>

        <!-- Submit setting -->
        <div class="option__row">
            <div class="option__row--label submit_button">                
                <?php submit_button(); ?>
            </div>            
        </div>
        
    </form>
</div>