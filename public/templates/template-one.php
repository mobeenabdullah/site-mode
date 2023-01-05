<?php

/**
 *  Name : Template-one
 */

$content                       = get_option('site_mode_content');
$design                        = get_option('site_mode_design');
$site_mode_design_lb           = get_option('site_mode_design_lb');
$site_mode_design_colors       = get_option('site_mode_design_colors');
$seo                  = get_option('site_mode_seo');
$social               = get_option('site_mode_social');
$general              = get_option('site_mode_general');

//unserialize data
$content_un = unserialize($content);

echo '<pre>';
print_r($content_un);
echo '</pre>';


if(!empty($content_un)) {
    $logo_settings   = isset($content_un['logo_settings'] ) ? $content_un['logo_settings']  : '';
    $image_logo      = isset($content_un['image_logo'] ) ? $content_un['image_logo']  : '';
    $text_logo       = isset($content_un['text_logo'] ) ? $content_un['text_logo']  : '';
    $heading         = isset($content_un['heading'] ) ? $content_un['heading']  : '';
    $description     = isset($content_un['description'] ) ? $content_un['description']  : '';
    $bg_image        = isset($content_un['bg_image'] ) ? $content_un['bg_image']  : '';
}

$logo_url = wp_get_attachment_image_url($image_logo , 'full');
$bg_url = wp_get_attachment_image_url($bg_image , 'full');
//unserialize data for social
$social_un = unserialize($social);
if(!empty($social_un)) {

}

require_once 'header.php';

?>
<main>

    <section id="under_constructon" class="wrapper" style="background-image: url('<?php if($bg_url) : echo esc_url($bg_url); else : echo esc_url(plugin_dir_url( __FILE__ ).'../assets/img/bg-placeholder.jpg'); endif; ?>')">
        <!--Section Overlay-->
        <div class="wrapper_overlay"></div>

            <div class="login_icon">
                <a href="<?php echo get_home_url() . '/wp-login.php' ?>" style="display: block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40"  height="40" viewBox="0 0 24 24" style="fill:"#ffffff"><path d="M12 2C9.243 2 7 4.243 7 7v3H6c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-8c0-1.103-.897-2-2-2h-1V7c0-2.757-2.243-5-5-5zm6 10 .002 8H6v-8h12zm-9-2V7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9z" fill="#ffffff"></path></svg>
                </a>
            </div>
        <!--Section Content-->
        <div class="container">

            <div class="construction_cover">

                    <div class="construction_cover-logo">
                        <img src="<?php echo esc_attr($logo_url);?>" width="150" height="150" alt="">
                    </div>
                    <div class="construction_cover-heading">
                        <h1 class="main_title">
                            <?php echo $heading; ?>
                        </h1>
                    </div>
                    <div class="construction_cover-text">
                        <p><?php echo $description; ?></p>
                    </div>

                    <div class="construction_cover-text">
                        <p></p>
                    </div>
                    <div class="construction_cover-icons">
                        <ul class="social_media">
                            <?php if($social_un['social_fb']) : ?>
                                <li>
                                    <a href="hhttps://www.facebook.com/<?php echo (social_un['social_fb']) ? esc_attr($social_un['social_fb']) : ''?>" aria-label="Linkedin profile">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="9.979" height="19.236" viewBox="0 0 9.979 19.236"><path id="bxl-facebook"  d="M13.814,22.236v-8.76H16.77l.439-3.43H13.814V7.861c0-.99.276-1.667,1.7-1.667h1.8V3.136A23.873,23.873,0,0,0,14.674,3c-2.612,0-4.406,1.595-4.406,4.522v2.517H7.332v3.43h2.942v8.767Z" transform="translate(-7.332 -3)" /></svg>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
            </div>
        </div>
    </section>
</main>



