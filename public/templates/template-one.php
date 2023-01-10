<?php

/**
 *  Name : Template-one
 */

require_once 'header.php';

?>
<main>
    <section id="under_constructon" class="wrapper" style=" echo esc_url(plugin_dir_url( __FILE__ ).'../assets/img/bg-placeholder.jpg');')">
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
                        <img src="" width="150" height="150" alt="">
                    </div>
                    <div class="construction_cover-heading">
                        <h1 class="main_title">
                            Heading goes here
                        </h1>
                    </div>
                    <div class="construction_cover-text">
                        <p>Descritpion goes here</p>
                    </div>

                    <div class="construction_cover-text">
                        <p></p>
                    </div>
                    <div class="construction_cover-icons">
                        <ul class="social_media">
                                <li>
                                    <a href="hhttps://www.facebook.com/" aria-label="Linkedin profile">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="9.979" height="19.236" viewBox="0 0 9.979 19.236"><path id="bxl-facebook"  d="M13.814,22.236v-8.76H16.77l.439-3.43H13.814V7.861c0-.99.276-1.667,1.7-1.667h1.8V3.136A23.873,23.873,0,0,0,14.674,3c-2.612,0-4.406,1.595-4.406,4.522v2.517H7.332v3.43h2.942v8.767Z" transform="translate(-7.332 -3)" /></svg>
                                    </a>
                                </li>
                        </ul>
                    </div>
            </div>
        </div>
    </section>
</main>



