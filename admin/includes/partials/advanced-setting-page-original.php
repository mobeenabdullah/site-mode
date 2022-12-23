<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <?php
        // error message
        settings_errors();
        // get data from database
        $rex_advanced = get_option('rex_advanced');
        //uniseralize data
        $uns_data = unserialize($rex_advanced);
        
    //check if value is set or not and set default value
        $ga_id              = isset($uns_data['ga_id']) ? $uns_data['ga_id'] : 'google analytics id';
        $custom_css         = isset($uns_data['custom_css']) ? $uns_data['custom_css'] : 'custom css';
        $enable_rest_api    = isset($uns_data['enable_rest_api']) ? $uns_data['enable_rest_api'] : 'enable';
        $enable_feed        = isset($uns_data['enable_feed']) ? $uns_data['enable_feed'] : 'enable';
        $include_pages      = isset($uns_data['include_pages']) ? $uns_data['include_pages'] : '';
        $exclude_pages      = isset($uns_data['exclude_pages']) ? $uns_data['exclude_pages'] : '';
        $header_code        = isset($uns_data['header_code']) ? $uns_data['header_code'] : 'header code';
        $footer_code        = isset($uns_data['footer_code']) ? $uns_data['footer_code'] : 'footer code';
        $admin_role         = isset($uns_data['admin_role']) ? $uns_data['admin_role'] : 'administrator';
        $editor_role        = isset($uns_data['editor_role']) ? $uns_data['editor_role'] : 'editor';
        $author_role        = isset($uns_data['author_role']) ? $uns_data['author_role'] : 'author';
        $contributor_role   = isset($uns_data['contributor_role']) ? $uns_data['contributor_role'] : 'contributor';
        $subscriber_role    = isset($uns_data['subscriber_role']) ? $uns_data['subscriber_role'] : 'subscriber';
        $user_role          = isset($uns_data['user_role']) ? $uns_data['user_role'] : 'user';

    ?>
    <form method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
        <div class="um_input_cover">
            <label class="screen-reading" for="ga"><?php _e('GA (ID/Code)', 'rex-maintenance-mode')?></label>
            <input type="text" id="ga" name="advanced-ga-id-setting" value="<?php echo esc_attr($ga_id); ?>" />
        </div>
        <div class="um_textarea_cover">
            <label class="screen-reading" for="custom-css"><?php _e('Custom CSS', 'rex-maintenance-mode')?></label>
            <textarea id="custom-css" name="advanced-custom-css-setting" rows="6" cols="80"><?php echo esc_attr($custom_css); ?></textarea>
        </div>
        <div class="um_checkbox_wrapper">
            <input type="checkbox" id="rest_api" name="advanced-wp-rest-api-setting" value="1" <?php checked(1,$enable_rest_api,true); ?> />
            <label for="rest_api"><?php _e('Rest API Enable/Disable', 'rex-maintenance-mode')?></label>
        </div>
        <div class="um_checkbox_wrapper">
            <input type="checkbox" id="feed_enable" name="advanced-wp-feed-setting" value="1" <?php checked(1,$enable_feed,true); ?>/>
            <label for="feed_enable"><?php _e('Feeds Enable/Disable', 'rex-maintenance-mode')?></label>
        </div>
            <?php $all_pages = get_pages(); ?>
        <div class="um_select">
            <select name="advanced-include-pages-setting" id="whitelist_include">
                <?php foreach($all_pages as $value ) : ?>
                    <option value="<?php echo $value->post_name; ?>" <?php selected($value->post_name, $include_pages);?>><?php echo $value->post_name;?></option>
                <?php endforeach; ?>
            </select>
            <span class="arrow-down"></span>
        </div>
            <?php $pages = get_pages(); ?>
        <div class="um_select label_top">
            <select name="advanced-exclude-pages-setting" id="page_exclude">
                <?php foreach($pages as $value ) : ?>
                    <option value="<?php echo $value->post_name; ?>" <?php selected($value->post_name, $exclude_pages);?>><?php echo $value->post_name; ?></option>
                <?php endforeach; ?>
            </select>
            <span class="arrow-down"></span>
        </div>
        <div class="um_textarea_cover">
            <label class="screen-reading" for="header-code"><?php _e('Header Code', 'rex-maintenance-mode')?></label>
            <textarea id="header-code" name="advanced-header-code-setting" rows="6" cols="80"><?php echo $header_code; ?></textarea>
        </div>
        <div class="um_textarea_cover">
            <label class="screen-reading" for="footer-code"><?php _e('Footer Code', 'rex-maintenance-mode')?></label>
            <textarea id="footer-code" name="advanced-footer-code-setting" rows="6" cols="80"><?php echo $footer_code; ?></textarea>
        </div>
       <?php  global  $wp_roles;
        foreach ( $wp_roles->roles as $key=>$value ):
        ?>
        <div class="um_checkbox_wrapper">
            <input type="checkbox" id="<?php echo $key; ?>" name="advanced-<?php echo $key; ?>-role-setting" value="<?php echo $key; ?>" <?php checked($key,isset($user_role[$key]) ? $user_role[$key] : 'administrator'); ?> />
            <label for="<?php echo $key; ?>"><?php echo $value['name']; ?></label>
            <?php echo "advanced-{$key}-role-setting"; ?>
        </div>
        <?php endforeach;
        wp_nonce_field('advance-settings-save', 'advance-custom-message');
        submit_button();
        ?>
    </form>

</div>