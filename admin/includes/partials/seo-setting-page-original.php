<div class="wrap">

    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <form id="site-mode-seo" method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>" >
       <?php
        // get data from database
       $seo = get_option('site_mode_seo');
       //unserialize data
         $seo = unserialize($seo);
         //check if values are set or not if not set then set default values
           $meta_title          = isset($seo['meta_title']) ? $seo['meta_title'] : 'SEO Meta Title';
           $meta_description    = isset($seo['meta_description']) ? $seo['meta_description'] : 'SEO Meta Description';
           $meta_favicon        = isset($seo['meta_favicon']) ? $seo['meta_favicon'] : '';
           $meta_image          = isset($seo['meta_image']) ? $seo['meta_image'] : '';

       ?>
        <div class="um_input_cover">
            <label class="screen-reading" for="headline"><?php esc_html_e('SEO Meta Title', 'site-mode'); ?></label>
            <input type="text" id="seo-meta-title" name="soe-meta-title-setting" value="<?php echo $meta_title; ?>" />
        </div>

        <div class="um_input_cover">
            <label class="screen-reading" for="headline"><?php esc_html_e('SEO Meta Title', 'site-mode'); ?></label>
            <input type="text" id="seo-meta-description" name="soe-meta-description-setting" value="<?php echo $meta_description; ?>" />
        </div>

        <?php
        $favicon_url = wp_get_attachment_image_url($meta_favicon, 'medium'); ?>
        <div>
            <?php if ($favicon_url) : ?>
                <a href="#" class="logo-upload">
                    <img src="<?php echo esc_url($favicon_url) ?>" width="150" height="150" />
                    <?php
                    ?>
                </a>
                <a href="#" class="logo-remove"><?php _e('Remove Favicon', 'site-mode'); ?></a>
                <input type="hidden" name="soe-meta-favicon-setting" value="<?php esc_attr_e($meta_favicon,'site-mode'); ?>">
            <?php else : ?>
                <a href="#" class="favicon-upload button um_btn"><?php esc_html_e('Upload Favicon', 'site-mode'); ?></a>
                <a href="#" class="favicon-remove button um_btn" style="display:none"><?php esc_html_e('Remove Favicon', 'site-mode'); ?></a>
                <input type="hidden" name="soe-meta-favicon-setting" value=<?php esc_attr_e($meta_favicon,'site-mode'); ?>>
            <?php endif; ?>
        </div>
        <?php
        $image_url = wp_get_attachment_image_url($meta_image, 'medium'); ?>
        <div>
            <?php if ($image_url) : ?>
                <a href="#" class="image-upload">
                    <img src="<?php echo esc_url($image_url) ?>" width="150" height="150" />
                    <?php
                    ?>
                </a>
                <a href="#" class="image-remove"><?php esc_html_e('Remove Image', 'soe-meta-image-setting'); ?></a>
                <input type="hidden" name="soe-meta-image-setting" value="<?php esc_attr_e($meta_image,'site-mode'); ?>">
            <?php else : ?>
                <a href="#" class="image-upload button um_btn"><?php esc_html_e('Upload Image', 'site-mode'); ?></a>
                <a href="#" class="remove-image button um_btn" style="display:none"><?php esc_html_e('Remove Image', 'site-mode'); ?></a>
                <input type="hidden" name="soe-meta-image-setting" value=<?php esc_attr_e($meta_image,'site-mode'); ?>>
            <?php endif; ?>
        </div>
    <?php
    wp_nonce_field('seo-settings-save', 'seo-custom-message');
    submit_button();
    ?>
    </form>
</div>
