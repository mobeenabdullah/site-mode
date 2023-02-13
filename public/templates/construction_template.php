<?php

/**
 *  Name : Template-Two
 */
?>
<?php require_once 'header.php' ?>

<?php
    $content                    = unserialize(get_option('site_mode_content'));
    $design                     = unserialize(get_option('site_mode_design'));
    $design_logo_background     = unserialize(get_option('site_mode_design_lb'));
    $design_typo                = unserialize(get_option('site_mode_design_fonts'));
    $design_social              = unserialize(get_option('site_mode_design_social'));
    $social                     = unserialize(get_option('site_mode_social'));
    $seo                        = unserialize(get_option('site_mode_seo'));
    $logo_url                   = isset($content['logo_image']) ? wp_get_attachment_image_url($content['logo_image'], 'full') : '';
    $image_url                  = isset($content['bg_image']) ? wp_get_attachment_image_url($content['bg_image'], 'full') : '';
?>
<?php 
    echo '<pre>';
    print_r($design_social);
    echo '</pre>';
?>
<style>
    .construction_cover__right--heading .main_title {
        font-family: <?php echo $design_typo['heading_font_family'] ? esc_html($design_typo['heading_font_family']) : 'var(--base-open-sans)' ?>;
        font-size: calc(<?php echo esc_attr($design_typo['heading_font_size']). 'px' ?>);
        color: <?php echo esc_attr($design_typo['heading_font_color']) ?>;
        font-weight: <?php echo esc_attr($design_typo['heading_font_weight']) ?>;
        letter-spacing: <?php echo esc_attr($design_typo['heading_letter_spacing']) . 'px' ?>;
        line-height: <?php echo esc_attr($design_typo['heading_line_height']) . 'px' ?>;
    }
    .construction_cover__right--text p {
        font-family: <?php echo esc_attr($design_typo['description_font_family']) ?>;
        font-size: <?php echo esc_attr($design_typo['description_font_size']) . 'px' ?>;
        color: <?php echo esc_attr($design_typo['description_font_color']) ?>;
        font-weight: <?php echo esc_attr($design_typo['description_font_weight']) ?>;
        letter-spacing: <?php echo esc_attr($design_typo['description_letter_spacing']) . 'px' ?>;
        line-height: <?php echo esc_attr($design_typo['description_line_height']) . 'px' ?>;
    }
    .construction_cover__left--logo {
        width: <?php echo esc_attr($design_logo_background['logo-width']) . 'px' ?>;
        height: <?php echo esc_attr($design_logo_background['logo-height']) . 'px' ?>;
    }
    .social_media_icon a {
        font-size: <?php echo esc_attr($design_social['icon_size']) . 'px' ?>;        
        background-color: <?php echo esc_attr($design_social['icon_bg_color']) ?>;
        border: 1px solid <?php echo esc_attr($design_social['icon_border_color']) ?>;
    }
    .social_media_icon a i {
        color: <?php echo esc_attr($design_social['icon_color']) ?>;
    }
    .wrapper_overlay {
        background-color: <?php echo esc_attr($design_logo_background['overlay-color']); ?>;
        opacity: <?php echo esc_attr($design_logo_background['overlay-opacity']) / 10; ?>;
    }

</style>



<main>
    <section id="under_constructon" class="wrapper" style="background-image: url('<?php echo  esc_url($image_url) ?>')">
        <!--Section Overlay-->
        <div class="wrapper_overlay"></div>
        <!--Section Content-->
        <div class="container-fluid">
            <div class="content">
                <div class="construction_cover">
                    <div class="construction_cover__left">
                        <div class="construction_cover__left--logo">
                            <img src="<?php echo esc_url($logo_url)?>" width="<?php echo esc_attr($design_logo_background['logo-width']); ?>" height="<?php echo esc_attr($design_logo_background['logo-height']); ?>" alt="alt text">
                        </div>
                    </div>

                    <div class="construction_cover__right">
                        <div class="construction_cover__right--heading">
                            <h1 class="main_title"><?php echo esc_attr($content['content_heading']); ?></h1>
                        </div>


                        <div class="construction_cover__right--text">
                            <p><?php echo esc_attr($content['content_description']); ?></p>
                        </div>

                        <div class="construction_cover__right--icons">
                            <ul class="social_media">
                                <?php foreach ($social as $key => $value) : ?>                                    
                                    <?php if( is_array($value) || is_object($value)) : ?>
                                        <?php foreach ($value as $item) : ?>
                                            <li class="social_media_icon">
                                                <a href="<?php echo $item['link'];?>" aria-label="<?php echo $item['title'];?> profile" target="_blank">
                                                    <i class="fa-brands <?php echo $item['icon'];?>"></i>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>                                        
                                <?php endforeach; ?>                                   
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once 'footer.php' ?>
