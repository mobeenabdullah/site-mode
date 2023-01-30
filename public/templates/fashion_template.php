<h1>Template 3<h1>
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
                        <div class="construction_cover__left--img">
                            <img src="" width="1920" height="1080" alt="Background image |"/>
                        </div>

                        <div class="construction_cover__left--img">
                            <img src="<?php echo esc_url(plugin_dir_url( __FILE__ ).'../img/bg-placeholder.jpg'); ?>" width="1920" height="1080" alt="Background image |"/>
                        </div>
                </div>

                <div class="construction_cover__right">
                    <div class="uc_content">
                            <div class="uc_content-logo">
                                <img src="" alt="Logo |">
                            </div>

                            <div class="uc_content-logo">
                                <img src="<?php echo esc_url(plugin_dir_url( __FILE__ ).'../img/logo-placeholder.png'); ?>" width="150" height="150" alt="">
                            </div>
                            <div class="uc_content-heading">
                                <h1 class="main_title"></h1>
                            </div>

                            <div class="uc_content-heading">
                                <h1 class="main_title"></h1>
                            </div>
                            <div class="uc_content-text">
                                <p><?php _e('Description goes here','site-mode')?></p>
                            </div>

                            <div class="uc_content-text">
                                <p></p>
                            </div>

                            <div class="uc_content-social">
                                <h3 class="sub_title"><?php _e('Follow us on:','site-mode')?></h3>
                                <ul class="social_media">
                                        <li>
                                            <a href="https://www.facebook.com/" aria-label="Facebook profile">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="9.979" height="19.236" viewBox="0 0 9.979 19.236"><path id="bxl-facebook"  d="M13.814,22.236v-8.76H16.77l.439-3.43H13.814V7.861c0-.99.276-1.667,1.7-1.667h1.8V3.136A23.873,23.873,0,0,0,14.674,3c-2.612,0-4.406,1.595-4.406,4.522v2.517H7.332v3.43h2.942v8.767Z" transform="translate(-7.332 -3)" /></svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.twitter.com/" aria-label="Twitter profile">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19.236" height="15.624" viewBox="0 0 19.236 15.624"><path id="bxl-twitter" d="M19.26,7.913c.013.171.013.342.013.512A11.141,11.141,0,0,1,8.055,19.643,11.14,11.14,0,0,1,2,17.872a8.239,8.239,0,0,0,.952.049,7.9,7.9,0,0,0,4.9-1.685A3.951,3.951,0,0,1,4.16,13.5a5.021,5.021,0,0,0,.745.061,4.2,4.2,0,0,0,1.039-.134A3.942,3.942,0,0,1,2.782,9.56V9.511a3.978,3.978,0,0,0,1.781.5A3.948,3.948,0,0,1,3.342,4.739a11.214,11.214,0,0,0,8.13,4.126,4.48,4.48,0,0,1-.1-.9,3.946,3.946,0,0,1,6.823-2.7,7.789,7.789,0,0,0,2.5-.952,3.935,3.935,0,0,1-1.734,2.173,7.9,7.9,0,0,0,2.27-.611A8.462,8.462,0,0,1,19.26,7.913Z" transform="translate(-2 -4.019)" /></svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="hhttps://www.linkedin.com/in/" aria-label="Linkedin profile">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><circle cx="4.983" cy="5.009" r="2.188"></circle><path d="M9.237 8.855v12.139h3.769v-6.003c0-1.584.298-3.118 2.262-3.118 1.937 0 1.961 1.811 1.961 3.218v5.904H21v-6.657c0-3.27-.704-5.783-4.526-5.783-1.835 0-3.065 1.007-3.568 1.96h-.051v-1.66H9.237zm-6.142 0H6.87v12.139H3.095z"></path></svg>
                                            </a>
                                        </li>
                                </ul>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once 'footer.php' ?>
