<div class="site_mode__wrap-form">

    <form id="site-mode-social" method="post">
        <?php settings_errors(); ?>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="show-social-icons-setting"><?php _e('Show Social Icons','site-mode');?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_checkbox_wrapper">
                    <input type="checkbox" id="show-social-icons-setting" name="show-social-icons"  <?php checked('on', !empty($this->show_social),true); ?> />
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
                    .sm-social_icon:hover, .sm-social_icon.sm-social_icon--checked {
                        border-color: #000;
                    }
                    .sm-social_icon_selector span {
                        pointer-events: none;
                    }
                </style>
                <?php
                    $di_social_icons = [
                        [
                            'title' => 'Facebook',
                            'icon' => 'facebook-alt'
                        ],
                        [
                            'title' => 'Twitter',
                            'icon' => 'twitter'
                        ],
                        [
                            'title' => 'Linkedin',
                            'icon' => 'linkedin'
                        ],
                        [
                            'title' => 'Instagram',
                            'icon' => 'instagram'
                        ],
                        [
                            'title' => 'Pinterest',
                            'icon' => 'pinterest'
                        ],
                        [
                            'title' => 'Whatsapp',
                            'icon' => 'whatsapp'
                        ],
                        [
                            'title' => 'Google',
                            'icon' => 'google'
                        ]
                    ];

                ?>
                <div class="social_icons_selectors">
                    <?php foreach ($di_social_icons as $icon) : ?>
                        <div class="sm-social_icon_selector" data-icon-title="<?php esc_attr_e($icon['title']); ?>" data-icon-class="<?php esc_attr_e(strtolower($icon['icon'])); ?>">
                            <span class="dashicons dashicons-<?php esc_attr_e($icon['icon']); ?>"></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="socialmedia__wrapper">
            <ul class="sm-social_icons sm_sortable" id="sm_sortable">

                <?php foreach ($this->social_icons as $key => $icon) : ?>

                    <li class="sm-social_icon ui-state-default" id="<?php esc_attr_e($key); ?>">
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
                                        <input type="text" id="icon_<?php echo esc_attr(strtolower($icon['title'])); ?>" name="social-icons[<?php esc_attr_e($key); ?>][link]" value="<?php esc_attr_e($icon['link']); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="option__row--remove">
                                <span class="dashicons dashicons-no-alt"></span>
                            </div>
                        </div>
                        <input type="hidden" name="social-icons[<?php esc_attr_e($key); ?>][title]" value="<?php esc_attr_e($icon['title']); ?>" />
                        <input type="hidden" name="social-icons[<?php esc_attr_e($key); ?>][icon]" value="<?php esc_attr_e($icon['icon']); ?>" />
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
