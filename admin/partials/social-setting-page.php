<div class="site_mode__wrap-form">

    <form id="site-mode-social" method="post">
        <?php settings_errors(); ?>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="show-social-icons-setting"><?php esc_html_e('Show Social Icons','site-mode');?></label></span>
                <span class="info_text"><?php esc_html_e('Activate to display social media icons on your webpage','site-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="sm_checkbox_wrapper">
                    <input type="checkbox" id="show-social-icons-setting" name="show-social-icons" <?php echo $this->show_social === 'on' ? 'checked' : ''; ?> />
                    <label for="show-social-icons-setting"></label>
                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span><?php esc_html_e('Available Icons', 'site-mode');?></span>
                <span class="info_text"><?php esc_html_e('Choose the icons you want to display on the maintenance page','site-mode');?></span>
            </div>
            <div class="option__row--field">
                <div class="social_icons_selectors">
                    <?php foreach ($this->di_social_icons as $icon) : ?>
                        <div class="sm-social_icon_selector <?php $this->check_selected_social_icon($icon['title']); ?>" data-icon-id="sm-social_icon_<?php esc_attr_e(strtolower($icon['title'])); ?>" data-icon-title="<?php esc_attr_e($icon['title']); ?>" data-icon-class="<?php esc_attr_e(strtolower($icon['icon'])); ?>">
                            <span class="fa-brands <?php esc_attr_e($icon['icon']); ?>"></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="option__row">
            <div class="option__row--label">
                <span aria-labelledby="social_profiles"><?php esc_html_e('Selected Icons', 'site-mode');?></span>
            </div>
            <div class="option__row--field" id='social_profiles'>
                <div class="socialmedia__wrapper">
                    <ul class="sm-social_icons sm_sortable" id="sm_sortable">
                        <?php foreach ($this->social_icons as $icon) : ?>
                            <li class="sm-social_icon ui-state-default" id="sm-social_icon_<?php echo esc_attr(strtolower($icon['title'])); ?>">
                                <div class="option__row">
                                    <div class="option__row--field">
                                        <div class="social_media_field">
                                            <div class="sortable_icon">
                                                <svg width="800px" height="800px" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        fill-rule="evenodd"
                                                        clip-rule="evenodd"
                                                        d="M5.5 4.625C6.12132 4.625 6.625 4.12132 6.625 3.5C6.625 2.87868 6.12132 2.375 5.5 2.375C4.87868 2.375 4.375 2.87868 4.375 3.5C4.375 4.12132 4.87868 4.625 5.5 4.625ZM9.5 4.625C10.1213 4.625 10.625 4.12132 10.625 3.5C10.625 2.87868 10.1213 2.375 9.5 2.375C8.87868 2.375 8.375 2.87868 8.375 3.5C8.375 4.12132 8.87868 4.625 9.5 4.625ZM10.625 7.5C10.625 8.12132 10.1213 8.625 9.5 8.625C8.87868 8.625 8.375 8.12132 8.375 7.5C8.375 6.87868 8.87868 6.375 9.5 6.375C10.1213 6.375 10.625 6.87868 10.625 7.5ZM5.5 8.625C6.12132 8.625 6.625 8.12132 6.625 7.5C6.625 6.87868 6.12132 6.375 5.5 6.375C4.87868 6.375 4.375 6.87868 4.375 7.5C4.375 8.12132 4.87868 8.625 5.5 8.625ZM10.625 11.5C10.625 12.1213 10.1213 12.625 9.5 12.625C8.87868 12.625 8.375 12.1213 8.375 11.5C8.375 10.8787 8.87868 10.375 9.5 10.375C10.1213 10.375 10.625 10.8787 10.625 11.5ZM5.5 12.625C6.12132 12.625 6.625 12.1213 6.625 11.5C6.625 10.8787 6.12132 10.375 5.5 10.375C4.87868 10.375 4.375 10.8787 4.375 11.5C4.375 12.1213 4.87868 12.625 5.5 12.625Z"
                                                        fill="#000000"
                                                    />
                                                </svg>
                                            </div>
                                            <label class="social_icon" for="icon_<?php echo esc_attr(strtolower($icon['title'])); ?>">
                                                <span class="fa-brands <?php echo esc_attr($icon['icon']); ?>"></span>
                                            </label>
                                            <div class="social_field">
                                                <label for="icon_<?php echo esc_attr(strtolower($icon['title'])); ?>"><?php esc_htm_e($icon['title']);?></label>
                                                <input type="text" id="icon_<?php echo esc_attr(strtolower($icon['title'])); ?>" name="social_icons[<?php esc_attr_e(strtolower($icon['title'])); ?>][link]" value="<?php esc_attr_e($icon['link']); ?>" required />
                                            </div>
                                            <div class="option__row--remove">
                                                <span class="remove-social-icon" data-icon-id="sm-social_icon_<?php echo esc_attr(strtolower($icon['title'])); ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <input type="hidden" name="social_icons[<?php esc_attr_e(strtolower($icon['title'])); ?>][title]" value="<?php esc_attr_e($icon['title']); ?>" />
                                <input type="hidden" name="social_icons[<?php esc_attr_e(strtolower($icon['title'])); ?>][icon]" value="<?php esc_attr_e($icon['icon']); ?>" />
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php
            wp_nonce_field('social-settings-save', 'social-custom-message');
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
