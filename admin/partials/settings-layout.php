<div class="wrap site_mode__wrap">
	<div class="site_mode__wrap--header">		
		<img src="<?php echo esc_url( plugins_url( '/assets/img/site-mode-logo.svg', dirname( __FILE__ ) ) ); ?>" alt="Site Mode Logo" class="site_mode__wrap--logo">
	</div>

    <?php
    if(empty(get_option('sm-fresh-installation'))):
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/template-initialization.php';
    else :
    ?>

	<div class="site_mode__wrap--cover">
		<div class="site_mode__wrap--cover-content">
			<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/main-content.php'; ?>
		</div>
		<div class="site_mode__wrap--cover-sidebar">
			<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/sidebar.php'; ?>
		</div>
	</div>

    <?php endif; ?>
</div>
