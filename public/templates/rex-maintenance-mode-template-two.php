<?php

/**
 *  Name : Template-Two
 */
?>
<?php require_once 'header.php' ?>
<div class="container">
    <div class="company__logo">
        <?php
        $logo_url = wp_get_attachment_image_url(get_option('content-logo-settings'), 'full');
        ?>
        <img src="<?php echo  esc_attr($logo_url) ?>" width="150" height="150" alt="logo">
    </div>
    <div class="content">
        <h1>
            <?php esc_html_e(get_option('content-headline-settings', 'rex-maintenance-mode')); ?>
        </h1>
        <h3>
            <?php esc_html_e(get_option('content-content-settings', 'rex-maintenance-mode')); ?>
        </h3>
        <p>
            <?php esc_html_e(get_option('content-subheading-settings', 'rex-maintenance-mode')); ?>
        </p>
    </div>
    <div class="social-icons">
        <?php require_once 'social-media.php' ?>
    </div>
    <?php require_once 'social-media.php' ?>

</div>
<?php require_once 'footer.php' ?>