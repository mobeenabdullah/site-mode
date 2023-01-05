<div class="site_mode__wrap-form">
    
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

        <div class="option__row">
            <div class="option__row--label">
                <span><label for="seo-meta-title"><?php esc_html_e('SEO Meta Title', 'site-mode'); ?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_input_cover">
                    <input type="text" id="seo-meta-title" name="soe-meta-title-setting" value="<?php echo $meta_title; ?>" />
                </div>
            </div>
        </div> 
        
        <div class="option__row">
            <div class="option__row--label">
                <span><label for="seo-meta-description"><?php esc_html_e('SEO Meta Title', 'site-mode'); ?></label></span>
            </div>
            <div class="option__row--field">
                <div class="sm_input_cover">
                <input type="text" id="seo-meta-description" name="soe-meta-description-setting" value="<?php echo $meta_description; ?>" />
                </div>
            </div>
        </div>       

        <?php $favicon_url = wp_get_attachment_image_url($meta_favicon, 'medium'); ?>
        <div class="option__row">
            <div class="option__row--label">
                <span><label class="logo-upload" for="logo_upload"><?php esc_html_e('Upload Favicon', 'site-mode'); ?></label></span>
            </div>
            <div class="option__row--field">
                <div>
                    <?php if ($favicon_url) : ?>
                        <a href="#" class="logo-upload">
                            <img src="<?php echo esc_url($favicon_url) ?>" width="150" height="150" />
                            <?php
                            ?>
                        </a>
                        <a href="#" class="logo-remove"><?php _e('Remove Favicon', 'site-mode'); ?></a>
                        <input type="hidden" id="logo_upload" name="soe-meta-favicon-setting" value="<?php esc_attr_e($meta_favicon,'site-mode'); ?>">
                    <?php else : ?>
                        <a href="#" class="favicon-upload button btn_outline"><?php esc_html_e('Upload Favicon', 'site-mode'); ?></a>
                        <a href="#" class="favicon-remove button btn_outline" style="display:none"><?php esc_html_e('Remove Favicon', 'site-mode'); ?></a>
                        <input type="hidden" id="logo_upload" name="soe-meta-favicon-setting" value=<?php esc_attr_e($meta_favicon,'site-mode'); ?>>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php $image_url = wp_get_attachment_image_url($meta_image, 'medium'); ?>
        <div class="option__row">
            <div class="option__row--label">
                <span><label class="image-upload" for="headline"><?php esc_html_e('SEO Image', 'site-mode'); ?></label></span>
            </div>
            <div class="option__row--field">
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
                        <a href="#" class="image-upload button btn_outline"><?php esc_html_e('Upload Image', 'site-mode'); ?></a>
                        <a href="#" class="remove-image button btn_outline" style="display:none"><?php esc_html_e('Remove Image', 'site-mode'); ?></a>
                        <input type="hidden" name="soe-meta-image-setting" value=<?php esc_attr_e($meta_image,'site-mode'); ?>>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        

        
        
       

        <?php wp_nonce_field('seo-settings-save', 'seo-custom-message'); ?>
        <div class="option__row">
            <div class="option__row--label submit_button">                
                <?php submit_button(); ?>
            </div>            
        </div>
    </form>
</div>
