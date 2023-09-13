

    <?php
    if(empty(get_option('sm-fresh-installation'))):
        require_once SITE_MODE_ADMIN . 'partials/template-initialization.php';
    else :
    ?>
    <div class="wrap site_mode__wrap">
        <div class="site_mode__wrap--header">
            <img src="<?php echo esc_url( SITE_MODE_ADMIN_URL. '/assets/img/site-mode-logo.svg' ); ?>" alt="Site Mode Logo" class="site_mode__wrap--logo">
        </div>
        <div class="site_mode__wrap--cover">
            <div class="site_mode__wrap--cover-content">
                <?php require_once SITE_MODE_ADMIN . 'partials/main-content.php'; ?>
            </div>
            <div class="site_mode__wrap--cover-sidebar">
                <?php require_once SITE_MODE_ADMIN . 'partials/sidebar.php'; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

