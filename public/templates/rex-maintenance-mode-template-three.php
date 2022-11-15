<?php

/**
 *  Name : Template-Three
 */
?>
<?php require_once 'header.php' ?>
<main>
    <section id="under_constructon" class="wrapper">
        <div class="container-fluid">
            <div class="construction_cover">
                    <div class="construction_cover__left">
                        <?php
                        $bg_url = wp_get_attachment_image_url(get_option('content-bg-image-settings'), 'full');
                        ?>
                        <?php if($bg_url) : ?>
                            <div class="construction_cover__left--img">
                                <img src="<?php echo esc_url($bg_url);?>" width="1920" height="1080" alt="Background image | <?php esc_html_e(get_option('content-headline-settings', 'rex-maintenance-mode')); ?>"/>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="construction_cover__right">
                        <div class="uc_header">
                            <?php
                            $logo_url = wp_get_attachment_image_url(get_option('content-logo-settings'), 'full');
                            ?>
                            <?php if($logo_url) : ?>
                                <div class="uc_header-logo">
                                    <img src="<?php echo  esc_attr($logo_url) ?>" alt="Logo |<?php esc_html_e(get_option('content-headline-settings', 'rex-maintenance-mode')); ?>">
                                </div>
                            <?php else : ?>
                                <div class="construction_cover__right--logo">
                                    <img src="<?php echo plugin_dir_url( __FILE__ ).'../img/logo-placeholder.png'; ?>" width="150" height="150" alt="<?php esc_html_e(get_option('content-headline-settings', 'rex-maintenance-mode')); ?>">
                                </div>
                            <?php endif; ?>

                            <?php if(!empty(get_option('content-social-fb-settings')) || !empty(get_option('content-social-twitter-settings')) || !empty(get_option('content-social-linkedin-settings'))) : ?>
                                <div class="uc_header-social">
                                    <ul class="social_media">
                                        <?php if(!empty(get_option('content-social-fb-settings'))) { ?>
                                            <li>
                                                <a href="https://www.facebook.com/<?php echo esc_attr(get_option('content-social-fb-settings')); ?>" aria-label="Facebook profile">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="9.979" height="19.236"
                                                         viewBox="0 0 9.979 19.236">
                                                        <path id="bxl-facebook"
                                                              d="M13.814,22.236v-8.76H16.77l.439-3.43H13.814V7.861c0-.99.276-1.667,1.7-1.667h1.8V3.136A23.873,23.873,0,0,0,14.674,3c-2.612,0-4.406,1.595-4.406,4.522v2.517H7.332v3.43h2.942v8.767Z"
                                                              transform="translate(-7.332 -3)" />
                                                    </svg>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if(!empty(get_option('content-social-twitter-settings'))) { ?>
                                            <li>
                                                <a href="https://www.twitter.com/<?php echo esc_attr(get_option('content-social-twitter-settings')); ?>" aria-label="Twitter profile">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19.236" height="15.624"
                                                         viewBox="0 0 19.236 15.624">
                                                        <path id="bxl-twitter"
                                                              d="M19.26,7.913c.013.171.013.342.013.512A11.141,11.141,0,0,1,8.055,19.643,11.14,11.14,0,0,1,2,17.872a8.239,8.239,0,0,0,.952.049,7.9,7.9,0,0,0,4.9-1.685A3.951,3.951,0,0,1,4.16,13.5a5.021,5.021,0,0,0,.745.061,4.2,4.2,0,0,0,1.039-.134A3.942,3.942,0,0,1,2.782,9.56V9.511a3.978,3.978,0,0,0,1.781.5A3.948,3.948,0,0,1,3.342,4.739a11.214,11.214,0,0,0,8.13,4.126,4.48,4.48,0,0,1-.1-.9,3.946,3.946,0,0,1,6.823-2.7,7.789,7.789,0,0,0,2.5-.952,3.935,3.935,0,0,1-1.734,2.173,7.9,7.9,0,0,0,2.27-.611A8.462,8.462,0,0,1,19.26,7.913Z"
                                                              transform="translate(-2 -4.019)" />
                                                    </svg>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if(!empty(get_option('content-social-linkedin-settings'))) { ?>
                                            <li>
                                                <a href="hhttps://www.linkedin.com/in/<?php echo esc_attr(get_option('content-social-linkedin-settings')); ?>" aria-label="Linkedin profile">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19.236" height="13.467"
                                                         viewBox="0 0 19.236 13.467">
                                                        <path id="bxl-youtube"
                                                              d="M20.831,7.117a2.409,2.409,0,0,0-1.693-1.7C17.632,5.007,11.611,5,11.611,5a58.432,58.432,0,0,0-7.527.388A2.46,2.46,0,0,0,2.387,7.1a25.467,25.467,0,0,0-.4,4.627,25.311,25.311,0,0,0,.39,4.627,2.408,2.408,0,0,0,1.694,1.7c1.52.413,7.526.42,7.526.42a58.565,58.565,0,0,0,7.527-.387,2.417,2.417,0,0,0,1.7-1.694,25.353,25.353,0,0,0,.4-4.625A24.108,24.108,0,0,0,20.831,7.117Zm-11.146,7.5,0-5.767,5,2.888Z"
                                                              transform="translate(-1.986 -5)" />
                                                    </svg>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="uc_content">
                            <?php if(!empty(get_option('content-subheading-settings', 'rex-maintenance-mode')) || !empty(get_option('content-headline-settings', 'rex-maintenance-mode'))) : ?>
                                <div class="uc_content-heading">
                                    <?php if(!empty(get_option('content-content-settings', 'rex-maintenance-mode'))) { ?>
                                        <h2><?php esc_html_e(get_option('content-subheading-settings', 'rex-maintenance-mode')); ?></h2>
                                    <?php } ?>
                                    <h1><?php esc_html_e(get_option('content-headline-settings', 'rex-maintenance-mode')); ?></h1>
                                </div>
                            <?php endif; ?>

                            <?php if(!empty(get_option('content-content-settings', 'rex-maintenance-mode'))) : ?>
                                <div class="uc_content-text">
                                    <p><?php esc_html_e(get_option('content-content-settings', 'rex-maintenance-mode')); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</main>

<?php require_once 'footer.php' ?>