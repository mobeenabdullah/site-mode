<div class="site_mode__wrap-form">
    <div class="section__wrapper">
        <div class="section__wrapper-header">
            <div class="section_title">
                <h3 class="section_title-title"><?php _e('Themes','site-mode');?></h3>
            </div>
        </div>
        <div class="section__wrapper-content section_theme">
                <div class="template__wrapper">
                    <div class="template_options">

                        <?php
                            $templates = [
                                [
                                    'id' => 1,
                                    'name' => 'food_template',
                                    'title' => 'Food Template',
                                    'image' => plugin_dir_url( __DIR__ ).'assets/img/template-1.jpg'
                                ],
	                            [
		                            'id' => 2,
		                            'name' => 'construction_template',
		                            'title' => 'Construction Template',
		                            'image' => plugin_dir_url( __DIR__ ).'assets/img/template-2.jpg'
	                            ],
	                            [
		                            'id' => 3,
		                            'name' => 'fashion_template',
		                            'title' => 'Fashion Template',
		                            'image' => plugin_dir_url( __DIR__ ).'assets/img/template-3.jpg'
	                            ],
	                            [
		                            'id' => 4,
		                            'name' => 'travel_template',
		                            'title' => 'Travel Template',
		                            'image' => plugin_dir_url( __DIR__ ).'assets/img/template-4.jpg'
	                            ],
                            ];

                        ?>

                        <?php foreach ($templates as $template) : ?>
                        <div class="template_card template-<?php echo esc_attr($template['name']) ?> <?php echo $template['name'] === $this->active_template ? 'active_template' : '' ?>">
                            <div class="template_card-image">
                                <img src="<?php echo esc_attr($template['image'])  ?>" alt="<?php _e($template['title'],'site-mode'); ?>" />
                                <div class="template_card-actions button_wrapper">
                                    <button type="button" class="btn btn_sm activate-template-btn" value="<?php echo esc_attr($template['name']) ?>"><?php echo $template['name'] === $this->active_template ? 'Activated' : 'Active' ?></button>
                                    <a class="btn btn_sm btn_white" href="<?php echo esc_url(home_url( "?site-mode-preview=true&template={$template['name']}")); ?>" target="_blank">
                                        <?php _e('Preview','site-mode');?>
                                    </a>
                                </div>
                            </div>
                            <div class="template_card-content">
                                <h2 class="template_card-content--title"><?php _e($template['title'],'site-mode'); ?></h2>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
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
                <div class="background_logo_wrapper">
                    <h4 class="section_subheading"><?php _e('Logo Settings','site-mode');?></h4>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="logo_width"><?php _e('Logo Width','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">
                                <input type="number" id="logo_width" class="number" name="logo-width-setting" value="<?php echo $this->logo_width; ?>" <?php checked(1, $this->logo_width, true); ?>  />
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="logo_height"><?php _e('Logo Height','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">
                                <input type="number" id="logo_height" class="number" data-inc="1" name="logo-height-setting" value="<?php echo $this->logo_height; ?>" <?php checked(1, $this->logo_height, true); ?> />
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
                                <input type="checkbox" id="check_background" class="check_background" name="design-background-setting" value="" <?php checked(1, $this->design_background, true); ?> />
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
                                <?php $image_url = wp_get_attachment_image_src($this->design_background, 'full'); ?>
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
                   <!-- background_overlay sm_hide_field -->
                    <div class="background_overlay sm_hide_field">                    
                        <div class="option__row">
                            <div class="option__row--label">
                                <span><label for="overlay_color"><?php _e('Overlay Color','site-mode');?></label></span>
                            </div>
                            <div class="option__row--field">
                                <div class="sm_input_wrapper">
                                    <input type="color" id="overlay_color" name="overlay-color-setting" value="<?php echo $this->overlay_color; ?>">
                                    <label for="overlay_color"></label>
                                </div>
                            </div>
                        </div>

                        <div class="option__row">
                            <div class="option__row--label">
                                <span><label for="overlay_opacity"><?php _e('Overlay Opacity','site-mode');?></label></span>
                            </div>
                            <div class="option__row--field">                                
                                    <!-- <input type="range" id="overlay_opacity" name="overlay-opacity-setting" steps="0.1" min="0" max="9" value="<?php //echo $overlay_opacity; ?>">
                                    <label for="overlay_opacity"></label>                                 -->
                                    <div class="range__slider slider_bg-transparent">
                                        <input type="range" steps="0.5" min="0" max="10" name="overlay-opacity-setting" value="<?php echo $this->overlay_opacity; ?>" data-rangeSlider>
                                        <div class="display__value-wrapper">
                                            <span class="output-value"></span>
                                            <!-- <span>%</span> -->
                                        </div>
                                    </div>
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
                    $fonts = array();
                    foreach ($data->items as $key => $value) {
                        $fonts[$value->family] = array(
                            'font_variant' => $value->variants,
                        );
                    }

                    //serialize font family array then store in option
                    $fonts_data        = serialize($fonts);
                    update_option('site-mode-font-family', $fonts_data);



                    //get font family from option
                    $fonts_data        = get_option('site-mode-font-family');
                    $fonts             = unserialize($fonts_data);


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
                                    <?php  foreach ($fonts  as $key => $value) { ?>
                                    <option value="<?php echo $key; ?>" <?php selected($this->heading_font_family, $key); ?>><?php echo $key; ?></option>
                                    <?php }?>
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
                                <input type="number" class="number" id="font_size" data-inc="1" name="heading-font-size-setting" value="<?php echo $this->heading_font_size; ?>" <?php checked(1, $this->heading_font_size, true); ?> />
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="heading_font_weight"><?php _e('Font Weight','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_select">
                                <select name="heading-font-weight-setting" id="heading_font_weight">
                                    <option value=""><?php _e('Select Font Weight','site-mode');?></option>
                                       <?php
                                            // if select font family selected then show font weight.
                                            if (!empty($this->heading_font_family)) {
                                                foreach ($fonts[$this->heading_font_family]['font_variant'] as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value; ?>" <?php selected($this->heading_font_weight, $value); ?>><?php echo $value; ?></option>
                                                    <?php
                                                }
                                            }
                                       ?>
                                </select>
                                <span class="arrow-down"></span>
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row">
                            <div class="option__row--label">
                                <span><label for="heading_letter_spacing"><?php _e('Letter Spacing','site-mode');?></label></span>
                            </div>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">
                                <input type="number" class="number" id="heading_letter_spacing" data-inc="1" name="heading-letter-spacing-setting" value="<?php echo esc_attr($this->heading_letter_spacing); ?>" <?php checked(1, $this->heading_font_size, true); ?> />
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row">
                            <div class="option__row--label">
                                <span><label for="line_height"><?php _e('Light Height','site-mode');?></label></span>
                            </div>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">
                                <input type="number" class="number" id="font_size" data-inc="1" name="heading-line-hight-setting" value="<?php echo esc_attr($this->heading_font_size); ?>" <?php checked(1, $this->heading_font_size, true); ?> />
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="heading_font_color"><?php _e('Heading Font Color','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">
                                <input type="color" id="heading_font_color" name="heading-font-color-setting" value="<?php echo esc_attr($this->heading_font_color); ?>">
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
                                    <?php  foreach ($fonts as $key => $value) { ?>
                                        <option value="<?php echo $key; ?>" <?php selected($this->description_font_family, $key); ?>><?php echo $key; ?></option>
                                    <?php }?>
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
                                <input type="number" class="number" id="font_size" data-inc="1" name="description-font-size-setting" value="<?php echo $this->description_font_size; ?>" <?php checked(1, $this->description_font_size, true); ?> />
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="description_font_weight"><?php _e('Description Font Weight','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_select">
                                <select name="description-font-weight-setting" id="font_family">
                                    <option value=""><?php _e('Select Font Weight','site-mode');?></option>
                                    <?php
                                    // if select font family selected then show font weight.
                                    if (!empty($this->description_font_family)) {
                                        foreach ($fonts[$this->description_font_family]['font_variant'] as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value; ?>" <?php selected($this->description_font_family, $value); ?>><?php echo $value; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <span class="arrow-down"></span>
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row">
                            <div class="option__row--label">
                                <span><label for="description_line_height"><?php _e('Description Line Height','site-mode');?></label></span>
                            </div>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">
                                <input type="number" class="number" id="description_line_height" data-inc="1" name="description-line-height-setting" value="<?php echo esc_attr($this->description_font_size); ?>" <?php checked(1, $this->heading_font_size, true); ?> />
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row">
                            <div class="option__row--label">
                                <span><label for="description_letter_spacing"><?php _e('Description Letter Spacing','site-mode');?></label></span>
                            </div>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">
                                <input type="number" class="number" id="description_letter_spacing" data-inc="1" name="description-letter-spacing-setting" value="<?php echo $this->heading_font_size; ?>" <?php checked(1, $this->heading_font_size, true); ?> />
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="description_font_color"><?php _e('Description Font Color','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">
                                <input type="color" id="description_font_color" name="description-font-color-setting" value="<?php echo esc_attr($this->description_font_color); ?>">
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

            <div class="social_icon_section">
                <div class="option__row">
                    <div class="option__row--label">
                        <span><label for="site_mode"><?php _e('Icon Size','site-mode');?></label></span>
                    </div>
                    <div class="option__row--field">
                        <div class="sm_select">
                            <select name="icon-size-setting" id="site_mode">
                                <option value="32" <?php selected( $this->icon_size==='32', 1 ); ?> ><?php _e('32','site-mode');?></option>
                                <option value="64" <?php selected( $this->icon_size==='64', 1 ); ?> ><?php _e('64','site-mode');?></option>
                                <option value="128" <?php selected( $this->icon_size==='128', 1 ); ?> ><?php _e('128','site-mode');?></option>
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
                            <input type="color" id="icon_color" name="icon-color-setting" value="<?php echo esc_attr($this->icon_color, 'site-mode');?>">
                        </div>
                    </div>
                </div>

                <div class="option__row">
                    <div class="option__row--label">
                        <span><label for="icon_bg_color"><?php _e('Icons Background Color','site-mode');?></label></span>
                    </div>
                    <div class="option__row--field">
                        <div class="sm_input_cover">
                            <input type="color" id="icon_bg_color" name="icon-bg-setting" value="<?php echo esc_attr($this->icon_bg_color, 'site-mode'); ?>">
                        </div>
                    </div>
                </div>

                <div class="option__row">
                    <div class="option__row--label">
                        <span><label for="icon_border_color"><?php _e('Icons Border Color','site-mode');?></label></span>
                    </div>
                    <div class="option__row--field">
                        <div class="sm_input_cover">
                            <input type="color" id="icon_border_color" name="icon-border-color-setting" value="<?php echo esc_attr($this->icon_border_color,'site-mode'); ?>">
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
