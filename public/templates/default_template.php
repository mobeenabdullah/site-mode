<?php

/**
 *  Name : Default-Template
 */

require_once 'header.php';

$content                    = unserialize(get_option('site_mode_content'));
$design                     = unserialize(get_option('site_mode_design'));
$design_logo_background     = unserialize(get_option('site_mode_design_lb'));
$design_typo                = unserialize(get_option('site_mode_design_fonts'));
$design_social              = unserialize(get_option('site_mode_design_social'));
$social                     = unserialize(get_option('site_mode_social'));
$seo                        = unserialize(get_option('site_mode_seo'));
$logo_url                   = isset($content['logo_image']) ? wp_get_attachment_image_url($content['logo_image'], 'full') : '';
$image_url                  = isset($content['bg_image']) ? wp_get_attachment_image_url($content['bg_image'], 'full') : '';

require_once 'footer.php';
?>

<style>
    .construction_cover-heading .main_title {
        font-family: <?php echo $design_typo['heading_font_family'] ? esc_html($design_typo['heading_font_family']) : 'var(--base-open-sans)' ?>;
        font-size: <?php echo esc_attr($design_typo['heading_font_size']) / 10 . 'rem' ?>;
        color: <?php echo esc_attr($design_typo['heading_font_color']) ?>;
        font-weight: <?php echo esc_attr($design_typo['heading_font_weight']) ?>;
        letter-spacing: <?php echo esc_attr($design_typo['heading_letter_spacing']) / 10 . 'rem' ?>;
        line-height: <?php echo esc_attr($design_typo['heading_line_height']) / 10 . 'rem' ?>;
    }
    .construction_cover-text p {
        font-family: <?php echo esc_attr($design_typo['description_font_family']) ?>;
        font-size: <?php echo esc_attr($design_typo['description_font_size']) / 10 . 'rem' ?>;
        color: <?php echo esc_attr($design_typo['description_font_color']) ?>;
        font-weight: <?php echo esc_attr($design_typo['description_font_weight']) ?>;
        letter-spacing: <?php echo esc_attr($design_typo['description_letter_spacing']) / 10 . 'rem' ?>;
        line-height: <?php echo esc_attr($design_typo['description_line_height']) / 10 . 'rem' ?>;
    }
    .construction_cover-logo {
        width: <?php echo esc_attr($design_logo_background['logo-width']) / 10 . 'rem' ?>;
        height: auto;
    }
    .construction_cover-icons .social_media_icon a {
        font-size: <?php echo esc_attr($design_social['icon_size']) / 10 . 'rem' ?>;

        background-color: <?php echo esc_attr($design_social['icon_bg_color']) ?>;
        border: 1px solid <?php echo esc_attr($design_social['icon_border_color']) ?>;
        

        <?php if($design_social['icon_size'] === 16) : ?>
            width: 3.8rem !important;
            height: 3.8rem !important;
        <?php endif; ?>

        <?php if($design_social['icon_size'] === 24) : ?>
            width: 5rem !important;
            height: 5rem !important;
        <?php endif; ?>

        <?php if($design_social['icon_size'] === 32) : ?>
            width: 6rem !important;
            height: 6rem !important;
        <?php endif; ?>
           
        padding: 1rem;
    }
    .construction_cover-icons .social_media_icon a i {
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
            <div class="login_icon">
                <a href="<?php echo get_home_url() . '/wp-login.php' ?>" style="display: block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40"  height="40" viewBox="0 0 24 24" style="fill:#ffffff"><path d="M12 2C9.243 2 7 4.243 7 7v3H6c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-8c0-1.103-.897-2-2-2h-1V7c0-2.757-2.243-5-5-5zm6 10 .002 8H6v-8h12zm-9-2V7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9z" fill="#ffffff"></path></svg>
                </a>
            </div>
        <!--Section Content-->
        <div class="container">
            <div class="construction_cover">
                    <div class="construction_cover-logo">
                        <img src="<?php echo esc_url($logo_url)?>" width="<?php echo esc_attr($design_logo_background['logo-width']); ?>" height="<?php echo esc_attr($design_logo_background['logo-height']); ?>" alt="alt text">
                    </div>
                    <div class="construction_cover-heading">
                        <h1 class="main_title">
                            <?php echo esc_attr($content['content_heading']); ?>
                        </h1>
                    </div>
                    <div class="construction_cover-text">
                        <p><?php echo esc_attr($content['content_description']); ?></p>
                    </div>                    
                    <div class="construction_cover-icons">
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
    </section>
</main>





