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
                                    'name' => 'default_template',
                                    'title' => 'Default Template',
                                    'image' => plugin_dir_url( __DIR__ ).'assets/img/default_template.jpg'
                                ]	                           
                            ];
                        ?>

                        <?php foreach ($templates as $template) : ?>
                        <div class="template_card template-<?php echo esc_attr($template['name']) ?> <?php echo $template['name'] === $this->active_template ? 'active_template' : '' ?>">
                            <div class="template_card-image" style="background-image: url(<?php echo esc_url($template['image'])  ?>);">                                                              
                            </div>
                            <div class="template_card-content">
                                <h2 class="template_card-content--title"><?php echo esc_attr($template['title']); ?></h2>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <div class="template_card coming_soon">
                            <h3 class="coming_soon_text">More Templates <br>Coming Soon</h3>
                        </div>  
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
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="logo_width"><?php _e('Logo Width','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">
                                <input type="number" id="logo_width" class="number" name="logo-width" value="<?php echo esc_attr($this->logo_width); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="logo_height"><?php _e('Logo Height','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">
                                <input type="number" id="logo_height" class="number" data-inc="1" name="logo-height" value="<?php echo esc_attr($this->logo_height); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="background_overlay"><?php _e('Background Overlay','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_checkbox_wrapper">
                                <input type="checkbox" id="background_overlay" class="background_overlay" name="background-overlay" value="1" <?php checked( $this->background_overlay, 1, true ); ?> />
                                <label for="background_overlay"></label>
                            </div>
                        </div>
                    </div>
                   <!-- background_overlay sm_hide_field -->
                    <div class="background_overlay <?php echo $this->background_overlay !== 1 ? 'sm_hide_field' : ''; ?>">
                        <div class="option__row">
                            <div class="option__row--label">
                                <span><label for="overlay_color"><?php _e('Overlay Color','site-mode');?></label></span>
                            </div>
                            <div class="option__row--field">
                                <div class="sm_input_wrapper color_field-wrapper color_overlay">
                                    <!-- <input type="color" id="overlay_color" name="overlay-color" value="<?php //echo esc_attr($this->overlay_color); ?>"> -->
                                    <label for="overlay_color"></label>
                                    <div class="color-picker-overlay"></div>
                                    <div class="color-box" style="background-color: <?php echo esc_attr($this->overlay_color); ?>"></div>
                                    <input type="hidden" name="overlay-color" id="overlay_color" value="<?php echo esc_attr($this->overlay_color); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="option__row">
                            <div class="option__row--label">
                                <span><label for="overlay_opacity"><?php _e('Overlay Opacity','site-mode');?></label></span>
                            </div>
                            <div class="option__row--field">
                                    <div class="range__slider slider_bg-transparent">
                                        <input type="range" steps="0.5" min="0" max="10" name="overlay-opacity" value="<?php echo esc_attr($this->overlay_opacity); ?>" data-rangeSlider>
                                        <div class="display__value-wrapper">
                                            <span class="output-value"></span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php wp_nonce_field('design-logo-background-settings-save', 'design-logo-background'); ?>

                <div class="option__row submit_button">
                    <div class="option__row--label">
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
    </div>


    <div class="section__wrapper">
        <div class="section__wrapper-header">
            <div class="section_title">
                <h3 class="section_title-title"><?php _e('Colors & Fonts','site-mode');?></h3>
            </div>
        </div>
        <div class="section__wrapper-content section_colors_fonts">

            <form id="site-mode-design-fonts" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <div class="heading-section">
                    <h4><?php _e('Heading','site-mode');?></h4>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="font_family"><?php _e('Font family','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_select">
                                <select name="heading-font-family" class="font-selector" data-saved-font="<?php echo esc_attr( $this->heading_font_family ); ?>"></select>
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
                                <input type="number" class="number" id="font_size" data-inc="1" name="heading-font-size" value="<?php echo esc_attr($this->heading_font_size); ?>" <?php checked(1, $this->heading_font_size, true); ?> />
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="heading_font_weight"><?php _e('Font Weight','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_select">
                                <select name="heading-font-weight" class="weight-selector" data-saved-weight="<?php echo esc_attr( $this->heading_font_weight ); ?>"></select>
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
                                <input type="number" class="number" id="heading_letter_spacing" data-inc="1" name="heading-letter-spacing" value="<?php echo esc_attr($this->heading_letter_spacing); ?>" <?php checked(1, $this->heading_font_size, true); ?> />
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row">
                            <div class="option__row--label">
                                <span><label for="heading_line_height"><?php _e('Light Height','site-mode');?></label></span>
                            </div>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">
                                <input type="number" class="number" id="heading_line_height" data-inc="1" name="heading-line-height" value="<?php echo esc_attr($this->heading_font_size); ?>" <?php checked(1, $this->heading_font_size, true); ?> />
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="heading_font_color"><?php _e('Heading Font Color','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_wrapper color_field-wrapper heading_color">
                                <label for="heading_font_color"></label>
                                <div class="color-picker-heading"></div>
                                <div class="color-box" style="background-color: <?php echo esc_attr($this->heading_font_color); ?>"></div>
                                <input type="hidden" id="heading_font_color" name="heading-font-color" value="<?php echo esc_attr($this->heading_font_color); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="description_section">
                    <h4><?php _e('Description','site-mode');?></h4>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="description_font_family"><?php _e('Font family','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_select">
                                <select name="description-font-family" class="font-selector" data-saved-font="<?php echo esc_attr( $this->description_font_family ); ?>"></select>
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
                                <input type="number" class="number" id="description_font_size" data-inc="1" name="description-font-size" value="<?php echo esc_attr($this->description_font_size); ?>" <?php checked(1, $this->description_font_size, true); ?> />
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="description_font_weight"><?php _e('Font Weight','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_select">
                                <select name="description-font-weight" class="weight-selector" data-saved-weight="<?php echo esc_attr( $this->description_font_weight ); ?>"></select>
                                <span class="arrow-down"></span>
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row">
                            <div class="option__row--label">
                                <span><label for="description_line_height"><?php _e('Line Height','site-mode');?></label></span>
                            </div>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">
                                <input type="number" class="number" id="description_line_height" data-inc="1" name="description-line-height" value="<?php echo esc_attr($this->description_line_height); ?>" <?php checked(1, $this->description_line_height, true); ?> />
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row">
                            <div class="option__row--label">
                                <span><label for="description_letter_spacing"><?php _e('Letter Spacing','site-mode');?></label></span>
                            </div>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_cover">
                                <input type="number" class="number" id="description_letter_spacing" data-inc="1" name="description-letter-spacing" value="<?php echo esc_attr($this->description_letter_spacing); ?>" <?php checked(1, $this->description_letter_spacing, true); ?> />
                            </div>
                        </div>
                    </div>
                    <div class="option__row">
                        <div class="option__row--label">
                        <span><label for="description_font_color"><?php _e('Font Color','site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="sm_input_wrapper color_field-wrapper description_font_color">
                                <label for="description_font_color"></label>
                                <div class="color-picker-description"></div>
                                <div class="color-box" style="background-color: <?php echo esc_attr($this->description_font_color); ?>"></div>
                                <input type="hidden" id="description_font_color" name="description-font-color" value="<?php echo esc_attr($this->description_font_color); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <?php wp_nonce_field('design-fonts-settings-save', 'design-fonts'); ?>
                <div class="option__row">
                    <div class="option__row--label submit_button">
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
    </div>

    <div class="section__wrapper social_wrapper">
        <div class="section__wrapper-header">
            <div class="section_title">
                <h3 class="section_title-title"><?php _e('Social Icons','site-mode');?></h3>
            </div>
        </div>
        <div class="section__wrapper-content section_social_icons">
        <form id="site-mode-design-social" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">

            <div class="social_icon_section">
                <div class="option__row">
                    <div class="option__row--label">
                        <span><label for="site_mode"><?php _e('Icon Size','site-mode');?></label></span>
                    </div>
                    <div class="option__row--field">
                        <div class="sm_select">
                            <select name="icon-size" id="site_mode">
                                <option value="16" <?php selected( strval($this->icon_size) === '16', 1 ); ?> ><?php _e('16','site-mode');?></option>
                                <option value="24" <?php selected( strval($this->icon_size) === '24', 1 ); ?> ><?php _e('24','site-mode');?></option>
                                <option value="32" <?php selected( strval($this->icon_size) === '32', 1 ); ?> ><?php _e('32','site-mode');?></option>                                
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
                        <div class="sm_input_wrapper color_field-wrapper icon_font_color">
                            <label for="icon_color"></label>
                            <div class="color-picker-icon"></div>
                            <div class="color-box" style="background-color: <?php echo esc_attr($this->icon_color, 'site-mode');?>;"></div>
                            <input type="hidden" id="icon_color" name="icon-color" value="<?php echo esc_attr($this->icon_color, 'site-mode');?>">
                        </div>
                    </div>

                </div>

                <div class="option__row">
                    <div class="option__row--label">
                        <span><label for="icon_bg_color"><?php _e('Icons Background Color','site-mode');?></label></span>
                    </div>
                    <div class="option__row--field">
                        <div class="sm_input_wrapper color_field-wrapper icon_bg_font_color">
                            <label for="icon_bg_color"></label>
                            <div class="color-picker-icon-bg"></div>
                            <div class="color-box" style="background-color: <?php echo esc_attr($this->icon_bg_color, 'site-mode'); ?>;"></div>
                            <input type="hidden" id="icon_bg_color" name="icon-bg" value="<?php echo esc_attr($this->icon_bg_color, 'site-mode'); ?>">
                        </div>
                    </div>
                </div>

                <div class="option__row">
                    <div class="option__row--label">
                        <span><label for="icon_border_color"><?php _e('Icons Border Color','site-mode');?></label></span>
                    </div>
                    <div class="option__row--field">
                        <div class="sm_input_wrapper color_field-wrapper icon_border_font_color">
                            <label for="icon_border_color"></label>
                            <div class="color-picker-icon-border"></div>
                            <div class="color-box" style="background-color: <?php echo esc_attr($this->icon_border_color,'site-mode'); ?>;"></div>
                            <input type="hidden" id="icon_border_color" name="icon-border-color" value="<?php echo esc_attr($this->icon_border_color,'site-mode'); ?>">
                        </div>
                    </div>
                </div>
            </div>
            <?php wp_nonce_field('design-icon-color-settings-save', 'design-icon-color'); ?>
            <div class="option__row">
                <div class="option__row--label submit_button">
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
    </div>
</div>
