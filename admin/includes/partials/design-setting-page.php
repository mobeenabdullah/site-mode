<div class="site_mode__wrap-form">
    <div class="section__wrapper">
        <div class="section__wrapper-header">
            <div class="section_title">
                <h3 class="section_title-title"><?php _e('Themes','site-mode');?></h3>
            </div>
        </div>
        <div class="section__wrapper-content section_theme">
            <!-- Template Form -->
            <form class="active-btnss" method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
                <?php
                    $template = get_option('site_mode_design');
                    
                    // convert serialized string to array
                    $un_data = unserialize($template);

                    echo '<pre>';
                    print_r($un_data);
                    echo '</pre>';
                    
                    //check if value is set or not if not set then set default value.
                    $enable_template = isset($un_data['enable_template']) ? $un_data['enable_template'] : '1';
                ?>                
                <div class="template__wrapper">
                    <div class="template_options">  

                        <div class="template_card <?php echo ($enable_template== '1') ? 'active_template' : '' ?>">
                            <div class="template_card-image">
                                <img src="<?php echo plugin_dir_url( __DIR__ ).'../assets/img/template-1.jpg'; ?>" alt="" />
                                <div class="template_card-actions button_wrapper">
                                    <button type="button" class="btn btn_sm active-btn" id="template_food" name="design-template-enable" value="1">Activate</button>
                                    <a class="btn btn_sm btn_white" href="<?php echo esc_url(home_url( "?site-mode-preview=true&template=food_template")); ?>" target="_blank">
                                        <?php _e('Preview','site-mode');?>
                                    </a>
                                </div>
                            </div>
                            <div class="template_card-content">
                                <h2 class="template_card-content--title"><?php _e('Food Template','site-mode');?></h2>
                            </div>
                        </div>

                        <div class="template_card <?php echo ($enable_template== '2') ? 'active_template' : '' ?>">
                            <div class="template_card-image">
                                <img src="<?php echo plugin_dir_url( __DIR__ ).'../assets/img/template-2.jpg'; ?>" alt="" />
                                <div class="template_card-actions button_wrapper">
                                    <button class="btn btn_sm active-btn" id="template_construction" name="design-template-enable" value="2">
                                        <?php echo ($enable_template== '2') ? 'Activated' : _e('Activate','site-mode') ?>                                        
                                    </button>
                                    <a class="btn btn_sm btn_white" href="<?php echo esc_url(home_url( "?site-mode-preview=true&template=construction_template")); ?>" target="_blank"><?php _e('Preview','site-mode');?></a>
                                </div>
                            </div>
                            <div class="template_card-content">
                                <h2 class="template_card-content--title"><?php _e('Construction Template','site-mode');?></h2>
                            </div>                            
                        </div>

                        <div class="template_card <?php echo ($enable_template== '3') ? 'active_template' : '' ?>">
                            <div class="template_card-image">
                                <img src="<?php echo plugin_dir_url( __DIR__ ).'../assets/img/template-3.jpg'; ?>" alt="" />
                                <div class="template_card-actions button_wrapper">
                                    <button class="btn btn_sm active-btn" id="template_fashion" name="design-template-enable" value="3">
                                        <?php echo ($enable_template== '3') ? 'Activated' : _e('Activate','site-mode') ?>                                        
                                    </button>
                                    <a class="btn btn_sm btn_white" href="<?php echo esc_url(home_url( "?site-mode-preview=true&template=fashion_template")); ?>" target="_blank"><?php _e('Preview','site-mode');?></a>
                                </div>
                            </div>
                            <div class="template_card-content">
                                <h2 class="template_card-content--title"><?php _e('Fashion Template','site-mode');?></h2>
                            </div>                            
                        </div>

                        <div class="template_card <?php echo ($enable_template== '4') ? 'active_template' : '' ?>">
                            <div class="template_card-image">
                                <img src="<?php echo plugin_dir_url( __DIR__ ).'../assets/img/template-4.jpg'; ?>" alt="" />
                                <div class="template_card-actions button_wrapper">
                                    <button class="btn btn_sm" id="template_travel" name="design-template-enable" value="4">
                                        <?php echo ($enable_template== '4') ? 'Activated' : _e('Activate','site-mode') ?>                                        
                                    </button>
                                    <a class="btn btn_sm btn_white" href="<?php echo esc_url(home_url( "?site-mode-preview=true&template=travel_template")); ?>" target="_blank"><?php _e('Preview','site-mode');?></a>
                                </div>
                            </div>
                            <div class="template_card-content">
                                <h2 class="template_card-content--title"><?php _e('Travel Template','site-mode');?></h2>
                            </div>                            
                        </div>

                    </div>
                </div>
                <?php
                    wp_nonce_field('design-settings-save', 'design-custom-message');            
                ?>
                <div class="option__row submit_button">
                    <div class="option__row--label">                
                        <?php submit_button(); ?>
                    </div>            
                </div>
            </form>
        </div>
    </div>  

    <div class="section__wrapper">
        <div class="section__wrapper-header">
            <div class="section_title">
                <h3 class="section_title-title"><?php _e('Logo & Background','site-mode');?></h3>
            </div>
        </div>
        <div class="section__wrapper-content section_logo">
            <form id="site-mode-design-logo-background" method="post">
                <?php
                    $site_mode_design_lb = get_option('site_mode_design_lb');

                    // convert serialized string to array
                    $lb_data = unserialize($site_mode_design_lb);
                    //check if value is set or not if not set then set default value.
                    $logo_width         = isset($lb_data['logo_width']) ? $lb_data['logo_width'] : '200';
                    $logo_height        = isset($lb_data['logo_height']) ? $lb_data['logo_height'] : '200';
                    $design_background  = isset($lb_data['design_background']) ? $lb_data['design_background'] : '#ffffff';
                    $background_overlay = isset($lb_data['background_overlay']) ? $lb_data['background_overlay'] : '#000000';
                    $overlay_color      = isset($lb_data['overlay_color']) ? $lb_data['overlay_color'] : '#000000';
                    $overlay_opacity    = isset($lb_data['overlay_opacity']) ? $lb_data['overlay_opacity'] : '0.5';
                ?>
                <div class="background_logo_wrapper">
                    <h4 class="section_subheading"><?php _e('Logo Settings','site-mode');?></h4>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="logo_width"><?php _e('Logo Width','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">                        
                                <input type="number" id="logo_width" class="number" name="logo-width-setting" value="<?php echo $logo_width; ?>" <?php checked(1, $logo_width, true); ?>  />                            
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="logo_height"><?php _e('Logo Height','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">                                                    
                                <input type="number" id="logo_height" class="number" data-inc="1" name="logo-height-setting" value="<?php echo $logo_height; ?>" <?php checked(1, $logo_height, true); ?> />
                            </div>
                        </div>
                    </div>
                    <h4 class="section_subheading"><?php _e('Background Settings','site-mode');?></h4>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="check_background"><?php _e('Background','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_checkbox_wrapper">
                                <input type="checkbox" id="check_background" class="check_background" name="design-background-setting" value="" <?php checked(1, $design_background, true); ?> />                    
                                <label for="check_background"></label>
                            </div>                        
                        </div>
                    </div>
                    <div class="show_background sm_hide_field">
                        <div class="option__row">
                            <div class="option__row--label">
                                <span><label for="background"><?php _e('Upload Background','site-mode');?></label></span>
                            </div>
                            <div class="option__row--field">
                                <?php $image_url = wp_get_attachment_image_src($design_background, 'full'); ?>
                                <?php if ($image_url) : ?>
                                    <div class="bg_image_wrapper">
                                        <a href="#" class="logo-upload um_btn_outline image_btn"></a>
                                        <div class="display_logo_img">
                                            <img src="<?php echo esc_url($image_url[0]) ?>" width="150" height="150" />
                                        </div>
                                    </div>
                                    <a href="#" class="button btn_outline logo-remove"><?php _e('Remove Background Image', 'site-mode'); ?></a>
                                    <input type="hidden" name="design-background-setting" value="<?php esc_attr_e(get_option('content-image-logo-setting'),'site-mode'); ?>">
                                <?php else : ?>
                                    <a href="#" class="logo-upload button btn_outline"><?php _e('Background Image', 'site-mode'); ?></a>
                                    <a href="#" class="logo-remove button btn_outline" style="display: none;"><?php _e('Background Overlay', 'site-mode'); ?></a>
                                    <input type="hidden" name="design-background-setting" value=<?php esc_attr_e(get_option('content-image-logo-setting'),'site-mode'); ?>>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="background_overlay"><?php _e('Background Overlay','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_checkbox_wrapper">
                                <input type="checkbox" id="background_overlay" class="background_overlay" name="design-background-overlay-setting" value="1"/>                        
                                <label for="background_overlay"></label>
                            </div>                        
                        </div>
                    </div>
                   
                    <div class="background_overlay sm_hide_field">                    
                        <div class="option__row">
                            <div class="option__row--label">
                                <span><label for="overlay_color"><?php _e('Overlay Color','site-mode');?></label></span>
                            </div>
                            <div class="option__row--field">
                                <div class="sm_input_wrapper">
                                    <input type="color" id="overlay_color" name="overlay-color-setting" value="<?php echo $overlay_color; ?>">
                                    <label for="overlay_color"></label>
                                </div>                        
                            </div>
                        </div>

                        <div class="option__row">
                            <div class="option__row--label">
                                <span><label for="overlay_opacity"><?php _e('Overlay Opacity','site-mode');?></label></span>
                            </div>
                            <div class="option__row--field">                                
                                    <input type="range" id="overlay_opacity" name="overlay-opacity-setting" steps="0.1" min="0" max="9" value="<?php echo $overlay_opacity; ?>">
                                    <label for="overlay_opacity"></label>                                
                            </div>
                        </div>                    
                    </div>
                </div>
                    
                <?php wp_nonce_field('design-logo-background-settings-save', 'design-logo-background'); ?>
                <div class="option__row submit_button">
                    <div class="option__row--label">                
                        <?php submit_button(); ?>
                    </div>            
                </div>
            </form>
        </div>
    </div>
    

    <div class="section__wrapper">
        <div class="section__wrapper-header">
            <div class="section_title">
                <h3 class="section_title-title"><?php _e('Colors & Fonts','site-mode');?></h3>
            </div>
        </div>
        <div class="section__wrapper-content section_colors_fonts">            
            <form id="site-mode-design-fonts" method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
                <?php
                    // api call for font family
                    $response           = wp_remote_get('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyB0YDSD0wGZLd65KStCqyhZxCmYn7EM4x8');
                    $body               = wp_remote_retrieve_body($response);
                    $data               = json_decode($body);
                    
                    //story font family in array
                    $font_family        = array();
                    foreach ($data->items as $key => $value) {
                        $font_family[]  = $value->family;
                    }
                    
                    //serialize font family array then store in option
                    $font_family        = serialize($font_family);
                    update_option('site-mode-font-family', $font_family);
                    
                    //get font family from option
                    $font_family            = get_option('site-mode-font-family');
                    
                    //get data from option
                    $site_mode_design_font                    = get_option('site_mode_design_font');
                    $site_mode_design_font                    = unserialize($site_mode_design_font);
        // use ternary operator for check data is empty or not.
                    $heading_font_size                  = !empty($site_mode_design_font['heading_font_size']) ? $site_mode_design_font['heading_font_size'] : '36';
                    $heading_font_family                = !empty($site_mode_design_font['heading_font_family']) ? $site_mode_design_font['heading_font_family'] : 'Open Sans';
                    $description_font_size              = !empty($site_mode_design_font['description_font_size']) ? $site_mode_design_font['description_font_size'] : '16';
                    $description_font_family            = !empty($site_mode_design_font['description_font_family']) ? $site_mode_design_font['description_font_family'] : 'Open Sans';
                ?>
                <div class="heading-section">
                    <h4><?php _e('Heading','site-mode');?></h4>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="font_family"><?php _e('Font family','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_select">                                
                                <select name="heading-font-family-setting" id="font_family">
                                    <option value=""><?php _e('Select Font Family','site-mode');?></option>
                                    <?php
                                    $font_family = unserialize($font_family);
                                    foreach ($font_family as $key => $value) { ?>
                                        <option value="<?php echo $value ?>" <?php selected( $value===$heading_font_family, 1 ); ?>><?php echo $value ?></option>
                                    <?php }
                                    ?>
                                </select>
                                <span class="arrow-down"></span>
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="font_size"><?php _e('Font Size','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">
                                <input type="number" class="number" id="font_size" data-inc="1" name="heading-font-size-setting" value="<?php echo $heading_font_size; ?>" <?php checked(1, $heading_font_size, true); ?> />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="description_section">
                    <h4><?php _e('Description','site-mode');?></h4>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="description_font_family" class="screen-reading"><?php _e('Font family','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_select">                                
                                <select name="description-font-family-setting" id="description_font_family">
                                    <option value=""><?php _e('Select Font Family','site-mode');?></option>
                                    <?php
                                    foreach ($font_family as $key => $value) { ?>
                                        <option value="<?php echo $value ?>" <?php selected( $value===$description_font_family, 1 ); ?>><?php echo $value ?></option>
                                    <?php }
                                    ?>
                                </select>
                                <span class="arrow-down"></span>
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="description_font_size"><?php _e('Font Size','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">
                                <input type="number" class="number" id="font_size" data-inc="1" name="description-font-size-setting" value="<?php echo $description_font_size; ?>" <?php checked(1, $description_font_size, true); ?> />
                            </div>
                        </div>
                    </div>                    
                </div>      
                
                <?php wp_nonce_field('design-fonts-settings-save', 'design-fonts'); ?>
                <div class="option__row">
                    <div class="option__row--label submit_button">                
                        <?php submit_button(); ?>
                    </div>            
                </div>
        </form>

        </div>
    </div>

    <div class="section__wrapper social_wrapper">
        <div class="section__wrapper-header">
            <div class="section_title">
                <h3 class="section_title-title"><?php _e('Social Icons','site-mode');?></h3>
            </div>
        </div>
        <div class="section__wrapper-content section_social_icons">
        <form id="site-mode-design-color-section" method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
            <?php
                $site_mode_design_colors      = get_option('site_mode_design_colors');
                
                //unserialize data
                $color_data             = unserialize($site_mode_design_colors);
                
                //check if values are set or not and assign default values
                $icon_size              = isset($color_data['icon_size']) ? $color_data['icon_size'] : '32';
                $icon_color             = isset($color_data['icon_color']) ? $color_data['icon_color'] : '#ffffff';
                $icon_bg_color          = isset($color_data['icon_bg_color']) ? $color_data['icon_bg_color'] : '#000000';
                $icon_border_color      = isset($color_data['icon_border_color']) ? $color_data['icon_border_color'] : '#000000';
            ?>
            <div class="social_icon_section">
                <div class="option__row">
                    <div class="option__row--label">
                        <span><label for="site_mode"><?php _e('Icon Size','site-mode');?></label></span>
                    </div>
                    <div class="option__row--field">
                        <div class="sm_select">                        
                            <select name="icon-size-setting" id="site_mode">
                                <option value="32" <?php selected( $icon_size==='32', 1 ); ?> ><?php _e('32','site-mode');?></option>
                                <option value="64" <?php selected( $icon_size==='64', 1 ); ?> ><?php _e('64','site-mode');?></option>
                                <option value="128" <?php selected( $icon_size==='128', 1 ); ?> ><?php _e('128','site-mode');?></option>
                            </select>
                            <span class="arrow-down"></span>
                        </div>
                    </div>
                </div>

                <div class="option__row">
                    <div class="option__row--label">
                        <span><label for="icon_color"><?php _e('Icons Color','site-mode');?></label></span>
                    </div>
                    <div class="option__row--field">
                        <div class="sm_input_cover">                        
                            <input type="color" id="icon_color" name="icon-color-setting" value="<?php echo esc_attr($icon_color, 'site-mode');?>">
                        </div>
                    </div>
                </div>
                
                <div class="option__row">
                    <div class="option__row--label">
                        <span><label for="icon_bg_color"><?php _e('Icons Background Color','site-mode');?></label></span>
                    </div>
                    <div class="option__row--field">
                        <div class="sm_input_cover">                        
                            <input type="color" id="icon_bg_color" name="icon-bg-setting" value="<?php echo esc_attr($icon_bg_color, 'site-mode'); ?>">
                        </div>
                    </div>
                </div>
                
                <div class="option__row">
                    <div class="option__row--label">
                        <span><label for="icon_border_color"><?php _e('Icons Border Color','site-mode');?></label></span>
                    </div>
                    <div class="option__row--field">
                        <div class="sm_input_cover">                        
                            <input type="color" id="icon_border_color" name="icon-border-color-setting" value="<?php echo esc_attr($icon_border_color,'site-mode'); ?>">
                        </div>
                    </div>
                </div>
            </div>
            <?php wp_nonce_field('design-icon-color-settings-save', 'design-icon-color'); ?>
            <div class="option__row">
                <div class="option__row--label submit_button">                
                    <?php submit_button(); ?>
                </div>            
            </div>
        </form>

        </div>
    </div>
</div>
