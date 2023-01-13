<div class="site_mode__wrap-form">   
    <form method="post" class="site_mode_form general_form" id="site-mode-general" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">     
        <?php
            $template =  get_option('site_mode_general');    
            $un_data = unserialize($template);

        //check if the values are set or not and then assign them to the variables
            $site_mode_title        = isset($un_data['site_mode_title']) ? $un_data['site_mode_title'] : '';
            $status                 = isset($un_data['status'] ) ? $un_data['status']  : '';
            $include_pages          = isset($uns_data['include_pages']) ? $uns_data['include_pages'] : '';
            $mode                   = isset($un_data['mode'] ) ? $un_data['mode']  : '';
            $url                    = isset($un_data['url'] ) ? $un_data['url']  : '';
            $delay                  = isset($un_data['delay'] ) ? $un_data['delay']  : '0';
            $login_icon             = isset($un_data['login_icon'] ) ? $un_data['login_icon']  : '';
            $login_url              = isset($un_data['login_url'] ) ? $un_data['login_url']  : 'example.com';

    ?>
        
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="status"><?php _e('Status','site-mode');?></label></span>                
            </div>
            <div class="option__row--field">
                <div class="sm_checkbox_wrapper">
                    <input type="checkbox" id="status" name="site-mode-status-settings" value="1" <?php checked(1, $status, true); ?> />                    
                    <label for="status"></label>
                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><?php _e('Show site to these roles', 'site-mode')?></span>
            </div>
            <div class="option__row--field">
                <?php  global  $wp_roles; ?>
                <?php foreach ( $wp_roles->roles as $key=>$value ): ?>
                    <div class="sm_checkbox_wrapper role_checkbox">
                        <input type="checkbox" id="<?php echo $key; ?>" name="site-mode-<?php echo $key; ?>-role-setting" value="<?php echo $key; ?>" <?php checked($key,isset($user_role[$key]) ? $user_role[$key] : 'administrator'); ?> />
                        <label for="<?php echo $key; ?>"><?php echo $value['name']; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="whitelist_include"><?php _e('Whitelist Pages', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <?php $all_pages = get_pages(); ?>
                <div class="sm_select">
                    <select class="js-example-basic-multiple" name="states[]" multiple="multiple" id="whitelist_include_">                    
                        <?php foreach($all_pages as $value ) : ?>
                            <option value="<?php echo $value->post_name; ?>" <?php selected($value->post_name, $include_pages);?>><?php echo $value->post_name;?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="arrow-down"></span>
                </div>
            </div>
        </div>

        <!-- Mode Setting -->
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="site_mode"><?php _e('Mode','site-mode');?></label></span>
                <span class="info_text"><?php _e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ultricies risus at eros tincidunt elementum.','site-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="sm_select">                    
                    <select name="site-mode-mode-settings" id="site_mode">
                        <option value="maintenance" <?php selected( $mode==='maintenance', 1 ); ?>><?php _e('Maintenance - Returns HTTP 200 OK response','site-mode');?></option>
                        <option value="coming-soon" <?php selected( $mode==='coming-soon', 1 ); ?>><?php _e('Coming Soon - Returns 503 HTTP Service response','site-mode');?></option>
                        <option value="redirect" <?php selected( $mode==='redirect', 1 ); ?> id="direct-item"><?php _e('Redirect - Returns HTTP 301 response and redirect to a URL','site-mode');?></option>
                    </select>
                    <span class="arrow-down"></span>
                </div>
            </div>
        </div>

        <div class="redirect_options <?php echo ($mode === 'redirect') ? '' : 'sm_hide_field'; ?>">
            <div class="option__row">
                <div class="option__row--label">
                    <span><label for="redirect_url"><?php _e('Redirect Url','site-mode');?></label></span>
                </div>
                <div class="option__row--field">
                    <div class="sm_input_cover">
                        <input type="text" id="redirect_url" name="site-mode-redirect-url-settings" value="<?php echo $url; ?>" <?php checked(1, $url, true); ?> />
                    </div>
                </div>
            </div>
            <div class="option__row">
                <div class="option__row--label">
                    <span><label for="delay_seconds"><?php _e('Delay (Seconds)','site-mode');?></label></span>
                </div>
                <div class="option__row--field">
                    <div class="sm_input_cover">
                        <input type="number" min="0" max="9" id="delay_seconds" class="number" data-inc="1" name="site-mode-delay-settings" value="<?php echo $delay; ?>" <?php checked(1, $delay, true); ?> />
                    </div>
                </div>
            </div>        
        </div>

        <!-- Logo Setting -->
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="login_icon"><?php _e('Login Icon','site-mode');?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_checkbox_wrapper">
                    <input type="checkbox" id="login_icon" class="enable_login_icon" name="site-mode-login-icon-setting" value="1" <?php checked(1, $login_icon, true); ?> />                    
                    <label for="login_icon"></label>
                </div>          
            </div>
        </div>
        <div class="login_url_field <?php echo (!empty($login_icon)) ? '' : 'hide_url'; ?>">
            <div class="option__row">
                <div class="option__row--label">
                    <span><label for="redirect_url_field"><?php _e('Login URL','site-mode');?></label></span>                    
                </div>
                <div class="option__row--field">
                    <div class="sm_input_cover">                    
                        <input type="text" id="redirect_url_field" name="site-mode-login-url-setting" value="<?php echo esc_attr($login_url); ?>" />                                           
                    </div>
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
