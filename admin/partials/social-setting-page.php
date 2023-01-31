<div class="site_mode__wrap-form">

    <form id="site-mode-social" method="post">
        <?php
        // display error message
        settings_errors();

        ?>

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="show-social-icons-setting"><?php _e('Show Social Icons','site-mode');?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_checkbox_wrapper">
                    <input type="checkbox" id="show-social-icons-setting" name="show-social-icons-setting" value="<?php esc_attr_e($this->show_social,'site-mode'); ?>" <?php checked(1, !empty($this->show_social),true); ?> />
                    <label for="show-social-icons-setting"></label>
                </div>
            </div>
        </div>

        <div class="socialmedia__wrapper">
            <ul class="sm_sortable" id="sm_sortable">


                <?php foreach ($this->social_content as $key => $item) : ?>


                <li class="ui-state-default" id="<?php esc_attr_e($key + 1); ?>">
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="social_fb"><?php _e($item['label'],'site-mode');?></label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="social_media_field">
                                <div class="sortable_icon">
                                    <span>
                                        <svg fill="none" height="15" viewBox="0 0 15 15" width="15" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M4.49999 2.5C4.49999 1.94772 4.9477 1.5 5.49999 1.5C6.05227 1.5 6.49999 1.94772 6.49999 2.5C6.49999 3.05228 6.05227 3.5 5.49999 3.5C4.9477 3.5 4.49999 3.05228 4.49999 2.5ZM8.49999 2.5C8.49999 1.94772 8.9477 1.5 9.49999 1.5C10.0523 1.5 10.5 1.94772 10.5 2.5C10.5 3.05228 10.0523 3.5 9.49999 3.5C8.9477 3.5 8.49999 3.05229 8.49999 2.5ZM4.49998 7.5C4.49998 6.94772 4.9477 6.5 5.49998 6.5C6.05227 6.5 6.49998 6.94772 6.49998 7.5C6.49998 8.05228 6.05227 8.5 5.49998 8.5C4.9477 8.5 4.49998 8.05228 4.49998 7.5ZM8.49998 7.5C8.49998 6.94771 8.9477 6.5 9.49999 6.5C10.0523 6.5 10.5 6.94772 10.5 7.5C10.5 8.05228 10.0523 8.5 9.49998 8.5C8.9477 8.5 8.49998 8.05228 8.49998 7.5ZM4.49998 12.5C4.49998 11.9477 4.9477 11.5 5.49998 11.5C6.05227 11.5 6.49998 11.9477 6.49998 12.5C6.49998 13.0523 6.05227 13.5 5.49998 13.5C4.9477 13.5 4.49998 13.0523 4.49998 12.5ZM8.49998 12.5C8.49998 11.9477 8.9477 11.5 9.49998 11.5C10.0523 11.5 10.5 11.9477 10.5 12.5C10.5 13.0523 10.0523 13.5 9.49998 13.5C8.9477 13.5 8.49998 13.0523 8.49998 12.5Z" fill="black" fill-rule="evenodd"/></svg>
                                    </span>
                                </div>
                                <div class="social_icon">
                                    <span><?php echo $item['icon']; ?></span>
                                </div>
                                <div class="social_field">
                                    <input type="text" id="social_fb" name="<?php esc_attr_e($item['key']); ?>" value="<?php esc_attr_e($item['value']); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="<?php esc_attr_e($item['order_key']); ?>" value="<?php esc_attr_e($key + 1); ?>" class="social-order" />
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
