<div class="site_mode__wrap-form">

    <form id="site-mode-social" method="post">
        <?php settings_errors(); ?>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="show-social-icons-setting"><?php _e('Show Social Icons','site-mode');?></label></span>
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
                <span>Social Icons</span>
            </div>
            <div class="option__row--field">
                <style>
                    .social_icons_selectors {
                        display: flex;
                        flex-wrap: wrap;
                        max-width: 60%;
                        gap: 20px;
                    }
                    .sm-social_icon_selector {
                        width: 50px;
                        height: 50px;
                        border: 2px solid #eee;
                        border-radius: 5px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        cursor: pointer;
                    }
                    .social_icon_selector:hover, .sm-social_icon_selector.sm-social_icon--checked {
                        border-color: #6f73d2;
                    }
                    .sm-social_icon_selector span {
                        pointer-events: none;
                    }
                </style>
                <div class="social_icons_selectors">
                    <?php foreach ($this->di_social_icons as $icon) : ?>
                        <div class="sm-social_icon_selector <?php $this->check_selected_social_icon($icon['title']); ?>" data-icon-id="sm-social_icon_<?php esc_attr_e(strtolower($icon['title'])); ?>" data-icon-title="<?php esc_attr_e($icon['title']); ?>" data-icon-class="<?php esc_attr_e(strtolower($icon['icon'])); ?>">
                            <span class="dashicons dashicons-<?php esc_attr_e($icon['icon']); ?>"></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="socialmedia__wrapper">
            <ul class="sm-social_icons sm_sortable" id="sm_sortable">

                <?php foreach ($this->social_icons as $icon) : ?>

                    <li class="sm-social_icon ui-state-default" id="sm-social_icon_<?php echo esc_attr(strtolower($icon['title'])); ?>">
                        <div class="option__row">
                            <div class="option__row--label">
                                <span><label for="icon_<?php echo esc_attr(strtolower($icon['title'])); ?>"><?php echo esc_attr($icon['title']);?></label></span>
                            </div>
                            <div class="option__row--field">
                                <div class="social_media_field">
                                    <div class="sortable_icon">
                                        <span class="dashicons dashicons-sort"></span>
                                    </div>
                                    <div class="social_icon">
                                        <span class="dashicons dashicons-<?php echo esc_attr($icon['icon']); ?>"></span>
                                    </div>
                                    <div class="social_field">
                                        <input type="text" id="icon_<?php echo esc_attr(strtolower($icon['title'])); ?>" name="social_icons[<?php esc_attr_e(strtolower($icon['title'])); ?>][link]" value="<?php esc_attr_e($icon['link']); ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="option__row--remove">
                                <span class="dashicons dashicons-no-alt remove-social-icon" data-icon-id="sm-social_icon_<?php echo esc_attr(strtolower($icon['title'])); ?>"></span>
                            </div>
                        </div>
                        <input type="hidden" name="social_icons[<?php esc_attr_e(strtolower($icon['title'])); ?>][title]" value="<?php esc_attr_e($icon['title']); ?>" />
                        <input type="hidden" name="social_icons[<?php esc_attr_e(strtolower($icon['title'])); ?>][icon]" value="<?php esc_attr_e($icon['icon']); ?>" />
                    </li>

                <?php endforeach; ?>

            </ul>
        </div>

        <?php
            wp_nonce_field('social-settings-save', 'social-custom-message');
        ?>
        <div class="option__row">
            <div class="option__row--label submit_button">
                <?php submit_button(); ?>
            </div>
        </div>
    </form>
</div>
