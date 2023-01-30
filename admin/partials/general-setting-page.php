<div class="site_mode__wrap-form">
    <form method="post" class="site_mode_form general_form" id="site-mode-general" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="status"><?php _e('Status','site-mode');?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_checkbox_wrapper">
                    <input type="checkbox" id="status" name="site-mode-mode-status" value="1" <?php checked(1, $this->mode_status, true); ?> />
                    <label for="status"></label>
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
                    <select name="site-mode-mode-type" id="site_mode">
                        <option value="maintenance" <?php selected( $this->mode_type === 'maintenance', 1 ); ?>><?php _e('Maintenance - Returns HTTP 200 OK response','site-mode');?></option>
                        <option value="coming-soon" <?php selected( $this->mode_type === 'coming-soon', 1 ); ?>><?php _e('Coming Soon - Returns 503 HTTP Service response','site-mode');?></option>
                        <option value="redirect" <?php selected( $this->mode_type === 'redirect', 1 ); ?> id="direct-item"><?php _e('Redirect - Returns HTTP 301 response and redirect to a URL','site-mode');?></option>
                    </select>
                    <span class="arrow-down"></span>
                </div>
            </div>
        </div>

        <div class="redirect_options <?php echo ($this->mode_type === 'redirect') ? '' : 'sm_hide_field'; ?>">
            <div class="option__row">
                <div class="option__row--label">
                    <span><label for="redirect_url"><?php _e('Redirect URL','site-mode');?></label></span>
                </div>
                <div class="option__row--field">
                    <div class="sm_input_cover">
                        <input type="text" id="redirect_url" name="site-mode-redirect-url" value="<?php echo $this->redirect_url; ?>" <?php checked(1, $this->redirect_url, true); ?> />
                    </div>
                </div>
            </div>
            <div class="option__row">
                <div class="option__row--label">
                    <span><label for="delay_seconds"><?php _e('Delay (seconds)','site-mode');?></label></span>
                </div>
                <div class="option__row--field">
                    <div class="sm_input_cover">
                        <input type="number" min="0" max="9" id="delay_seconds" class="number" data-inc="1" name="site-mode-redirect-delay" value="<?php echo $this->redirect_delay; ?>" <?php checked(1, $this->redirect_delay, true); ?> />
                    </div>
                </div>
            </div>
        </div>

        <!-- Logo Setting -->
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="login_icon"><?php _e('Show Login Icon','site-mode');?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_checkbox_wrapper">
                    <input type="checkbox" id="login_icon" class="enable_login_icon" name="site-mode-show-login-icon" value="1" <?php checked(1, $this->show_login_icon, true); ?> />
                    <label for="login_icon"></label>
                </div>
            </div>
        </div>
        <div class="login_url_field <?php echo (!empty($this->show_login_icon)) ? '' : 'sm_hide_field'; ?>">
            <div class="option__row">
                <div class="option__row--label">
                    <span><label for="redirect_url_field"><?php _e('Custom Login URL','site-mode');?></label></span>
                </div>
                <div class="option__row--field">
                    <div class="sm_input_cover">
                        <input type="text" id="redirect_url_field" name="site-mode-custom-login-url" value="<?php echo esc_attr($this->custom_login_url); ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="whitelist_include"><?php _e('Whitelist Pages', 'site-mode')?></label></span>
            </div>
            <div class="option__row--field">
                <?php $all_pages = get_pages(); ?>
                <div class="sm_select">
                    <select class="js-example-basic-multiple" name="site-mode-whitelist-pages[]" multiple="multiple" id="whitelist_include_">
                        <?php foreach($all_pages as $value ) :
                            if(in_array($value->post_name, $this->whitelist_pages) ) {
                                $selected = 'selected';
                            } else {
                                $selected = '';
                            } ?>
                            <option value="<?php echo $value->post_name; ?>" <?php echo $selected ?>> <?php echo $value->post_name;?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="arrow-down"></span>
                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><?php _e('Show site to these roles', 'site-mode')?></span>
            </div>
            <div class="option__row--field">
                <?php  global  $wp_roles; ?>
	            <?php foreach ( $wp_roles->roles as $key => $value ): ?>
                <div class="sm_checkbox_wrapper role_checkbox">
		            <?php $checked = (in_array($key, $this->user_roles)) ? 'checked' : ''; ?>
                    <input type="checkbox" id="<?php echo $value['name'] . '-' .$key; ?>" name="site-mode-user-roles[]" value="<?php echo strtolower($value['name']); ?>" <?php echo $checked; ?> />
                    <label for="<?php echo $value['name'] . '-' .$key; ?>"><?php echo $value['name'] ?></label>
                </div>
	            <?php endforeach; ?>
            </div>
        </div>
        <?php wp_nonce_field('general_settings_action', 'general_section_field'); ?>

        <!-- Todo: Move Temporary CSS -->
        <style>
            .site-mode-save-btn {
                display: flex !important;
            }
            @-moz-keyframes spin {
                from { -moz-transform: rotate(0deg); }
                to { -moz-transform: rotate(360deg); }
            }
            @-webkit-keyframes spin {
                from { -webkit-transform: rotate(0deg); }
                to { -webkit-transform: rotate(360deg); }
            }
            @keyframes spin {
                from {transform:rotate(0deg);}
                to {transform:rotate(360deg);}
            }
            .save-btn-loader svg {
                animation: spin 2s linear infinite;
            }
        </style>

        <!-- Submit setting -->
        <div class="option__row">
            <div class="option__row--label submit_button">
                <?php // submit_button(); ?>
                <!-- Todo: Style below button like above one -->
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
