<div class="wrap">
    <div class="rex__wrap--cover-content-form">
        <form id="rex-design" method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
            <div id="universal-message-container">
                <h2><?php _e('Themes','rex-maintenance-mode');?></h2>
                <div class="template__wrapper">
                    <?php
                        $template = get_option('rex_design');
                    // convert serialized string to array
                        $un_data = unserialize($template);
                        //check if value is set or not if not set then set default value.
                        $enable_template = isset($un_data['enable_template']) ? $un_data['enable_template'] : '1';


                    ?>
                    <div class="template_options">
                        <div class="template_thumb <?php echo ($enable_template== '1') ? 'activated_template' : '' ?>">
                            <div class="radio-img">
                                <div class="image" style="background-image: url(<?php echo plugin_dir_url( __DIR__ ).'/img/template-1.jpg'; ?>)"></div>
                            </div>
                            <div class="template_actions">
                                <div class="template_title">
                                    <h2 class="template_title-title"><?php _e('Food Template','rex-maintenance-mode');?></h2>
                                </div>
                                <label class="um_toggle">
                                    <input type="radio" class="toggle_input" id="one" name="design-template-enable" value="1" <?php echo ($enable_template == '1') ? 'checked' : ''?> />
                                    <div class="toggle-control"></div>
                                </label>
                            </div>
                        </div>
                        <div class="template_thumb <?php echo ($enable_template == '2') ? 'activated_template' : '' ?>">
                            <div class="radio-img">
                                <div class="image" style="background-image: url(<?php echo plugin_dir_url( __DIR__ ).'/img/template-2.jpg'; ?>)"></div>
                            </div>
                            <div class="template_actions">
                                <div class="template_title">
                                    <h2 class="template_title-title"><?php _e('Construction Template','rex-maintenance-mode');?></h2>
                                </div>
                                <label class="um_toggle">
                                    <input type="radio" class="toggle_input" id="two" name="design-template-enable" value="2" <?php echo ($enable_template == '2') ? 'checked' : ''?> />
                                    <div class="toggle-control"></div>
                                </label>
                            </div>

                        </div>
                        <div class="template_thumb <?php echo ($enable_template == '3') ? 'activated_template' : '' ?>">
                            <div class="radio-img">
                                <div class="image" style="background-image: url(<?php echo plugin_dir_url( __DIR__ ).'/img/template-3.jpg'; ?>)"></div>
                            </div>
                            <div class="template_actions">
                                <div class="template_title">
                                    <h2 class="template_title-title"><?php _e('Fashion Template','rex-maintenance-mode');?></h2>
                                </div>

                                <label class="um_toggle">
                                    <input type="radio" class="toggle_input" id="three" name="design-template-enable" value="3" <?php echo ($enable_template == '3') ? 'checked' : ''?> />
                                    <div class="toggle-control"></div>
                                </label>
                            </div>
                        </div>
                        <div class="template_thumb <?php echo ($enable_template == '4') ? 'activated_template' : '' ?>">
                            <div class="radio-img">
                                <div class="image" style="background-image: url(<?php echo plugin_dir_url( __DIR__ ).'/img/template-4.jpg'; ?>)"></div>
                            </div>
                            <div class="template_actions">
                                <div class="template_title">
                                    <h2 class="template_title-title"><?php _e('Travel Template','rex-maintenance-mode');?></h2>
                                </div>
                                <label class="um_toggle">
                                    <input type="radio" class="toggle_input" id="four" name="design-template-enable" value="4" <?php echo ($enable_template == '4') ? 'checked' : ''?> />
                                    <div class="toggle-control"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                wp_nonce_field('design-settings-save', 'design-custom-message');
                submit_button();
                ?>
        </form>
        <form id="rex-design-logo-background" method="post">
            <?php
            $rex_design_lb = get_option('rex_design_lb');
            // convert serialized string to array
            $lb_data = unserialize($rex_design_lb);
            //check if value is set or not if not set then set default value.
            $logo_width         = isset($lb_data['logo_width']) ? $lb_data['logo_width'] : '200';
            $logo_height        = isset($lb_data['logo_height']) ? $lb_data['logo_height'] : '200';
            $design_background  = isset($lb_data['design_background']) ? $lb_data['design_background'] : '#ffffff';
            $background_overlay = isset($lb_data['background_overlay']) ? $lb_data['background_overlay'] : '#000000';
            $overlay_color      = isset($lb_data['overlay_color']) ? $lb_data['overlay_color'] : '#000000';
            $overlay_opacity    = isset($lb_data['overlay_opacity']) ? $lb_data['overlay_opacity'] : '0.5';
        
            ?>
            <div class="logo_section">
                <h3>Logo & Background</h3>
                <div class="logo">
                    <h3>Logo</h3>
                    <div class="logo_width_cover">
                        <label for="logo_width"><?php _e('Logo Width','rex-maintenance-mode');?></label>
                        <div class="logo_width">
                            <input type="number" id="logo_width" data-inc="1" name="logo-width-setting" value="<?php echo $logo_width; ?>" <?php checked(1, $logo_width, true); ?> />
                        </div>
                    </div>
                    <div class="logo_height_cover">
                        <label for="logo_height"><?php _e('Logo Height','rex-maintenance-mode');?></label>
                        <div class="logo_height">
                            <input type="number"  id="logo_height" data-inc="1" name="logo-height-setting" value="<?php echo $logo_height; ?>" <?php checked(1, $logo_height, true); ?> />
                        </div>
                    </div>
                </div>
            </div>
            <div class="background_section">
                <h3><?php _e('Background','rex-maintenance-mode');?></h3>
                <div class="um_checkbox_wrapper">
                    <?php
                        //get image url from id
                        $image_url = wp_get_attachment_image_src($design_background, 'full');

                    ?>
                    <input type="checkbox" id="login_icon" class="enable_login_icon" name="design-background-setting" value="1"/>
                    <label for="login_icon"><?php _e('Background','rex-maintenance-mode');?></label>
                </div>
                <?php if ($image_url) : ?>
                    <div class="bg_image_wrapper">
                        <a href="#" class="logo-upload um_btn_outline image_btn"></a>
                        <div class="display_logo_img">
                            <img src="<?php echo esc_url($image_url[0]) ?>" width="150" height="150" />
                        </div>
                    </div>
                    <a href="#" class="button um_btn_outline logo-remove"><?php _e('Remove Background Image', 'rex-maintenance-mode'); ?></a>
                    <input type="hidden" name="design-background-setting" value="<?php esc_attr_e(get_option('content-image-logo-setting'),'rex-maintenance-mode'); ?>">
                <?php else : ?>
                    <a href="#" class="logo-upload button um_btn_outline"><?php _e('Background Image', 'rex-maintenance-mode'); ?></a>
                    <a href="#" class="logo-remove button um_btn_outline" style="display: none;"><?php _e('Background Overlay', 'rex-maintenance-mode'); ?></a>
                    <input type="hidden" name="design-background-setting" value=<?php esc_attr_e(get_option('content-image-logo-setting'),'rex-maintenance-mode'); ?>>
                <?php endif; ?>
                <div class="background_overlay">
                    <div class="um_checkbox_wrapper">
                        <input type="checkbox" id="background_overlay" class="background_overlay" name="design-background-overlay-setting" value="1"/>
                        <label for="background_overlay"><?php _e('Background Overlay','rex-maintenance-mode');?></label>
                    </div>
                    <div class="overlay_color">
                        <input type="color" id="overlay_color" name="overlay-color-setting" value="<?php echo $overlay_color; ?>">
                        <label for="overlay_color"><?php _e('Overlay Color','rex-maintenance-mode');?></label>
                    </div>
                    <div class="overlay_opacity">
                        <input type="range" id="overlay_opacity" name="overlay-opacity-setting" min="0" max="10" value="<?php echo $overlay_opacity; ?>">
                        <label for="overlay_opacity"><?php _e('Overlay Opacity','rex-maintenance-mode');?></label>
                    </div>
                </div>
            </div>
            <?php
            wp_nonce_field('design-logo-background-settings-save', 'design-logo-background');
            submit_button();
            ?>
        </form>
        <form id="rex-design-fonts" method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
            <?php
//             api call for font family
            $response = wp_remote_get('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyB0YDSD0wGZLd65KStCqyhZxCmYn7EM4x8');
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body);
            //story font family in array
            $font_family = array();
            foreach ($data->items as $key => $value) {
                $font_family[] = $value->family;
            }
            //serialize font family array then store in option
            $font_family = serialize($font_family);
            update_option('rex-font-family', $font_family);
            //get font family from option
            $font_family = get_option('rex-font-family');
            ?>
        <div class="color_font_section">
            <div class="font_family">
                <div class="um_select">
                    <label for="site_mode" class="screen-reading"><?php _e('Font family','rex-maintenance-mode');?></label>
                    <select name="font-family-setting" id="site_mode">
                        <option value=""><?php _e('Select Font Family','rex-maintenance-mode');?></option>
                        <?php
                        $font_family = unserialize($font_family);
                        foreach ($font_family as $key => $value) {
                            echo '<option value="' . $value . '">' . $value . '</option>';
                        }
                        ?>
                    </select>
                    <span class="arrow-down"></span>
                </div>
            </div>
        </div>
            <?php
            wp_nonce_field('design-fonts-settings-save', 'design-fonts');
            submit_button();
            ?>
        </form>
        <form id="rex-design-color-section" method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
            <?php

            $rex_design_colors = get_option('rex_design_colors');
            //unserialize data
            $color_data = unserialize($rex_design_colors);
            //check if values are set or not and assign default values
            $icon_size              = isset($color_data['icon_size']) ? $color_data['icon_size'] : '32';
            $icon_color             = isset($color_data['icon_color']) ? $color_data['icon_color'] : '#ffffff';
            $icon_bg_color          = isset($color_data['icon_bg_color']) ? $color_data['icon_bg_color'] : '#000000';
            $icon_border_color      = isset($color_data['icon_border_color']) ? $color_data['icon_border_color'] : '#000000';


            ?>
            <div class="social_icon_section">
                <div class="icon_size">
                    <div class="um_select">
                        <label for="site_mode" class="screen-reading"><?php _e('Icon Size','rex-maintenance-mode');?></label>
                        <select name="icon-size-setting" id="site_mode">
                            <option value="32" <?php selected( $icon_size==='32', 1 ); ?> ><?php _e('32','rex-maintenance-mode');?></option>
                            <option value="64" <?php selected( $icon_size==='64', 1 ); ?> ><?php _e('64','rex-maintenance-mode');?></option>
                            <option value="128" <?php selected( $icon_size==='128', 1 ); ?> ><?php _e('128','rex-maintenance-mode');?></option>
                        </select>
                </div>
                <div class="icon_color">
                    <input type="color" id="icon_color" name="icon-color-setting" value="<?php echo esc_attr($icon_color, 'rex-maintenance-mode');?>">
                    <label for="icon_color"><?php _e('Icons Color','rex-maintenance-mode');?></label>
                </div>
                <div class="icon_bg_color">
                    <input type="color" id="icon_bg_color" name="icon-bg-setting" value="<?php echo esc_attr($icon_bg_color, 'rex-maintenance-mode'); ?>">
                    <label for="icon_bg_color"><?php _e('Icons Background Color','rex-maintenance-mode');?></label>
                </div>
                <div class="icon_border_color">
                    <input type="color" id="icon_border_color" name="icon-border-color-setting" value="<?php echo esc_attr($icon_border_color,'rex-maintenance-mode'); ?>">
                    <label for="icon_border_color"><?php _e('Icons Border Color','rex-maintenance-mode');?></label>
                </div>
            </div>
            <?php
            wp_nonce_field('design-icon-color-settings-save', 'design-icon-color');
            submit_button();
            ?>
        </form>
    </div>
</div><!-- .wrap -->