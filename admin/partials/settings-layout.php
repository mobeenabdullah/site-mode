<div class="wrap site_mode__wrap">
	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
	<div class="site_mode__wrap--cover">
		<div class="site_mode__wrap--cover-content">
			<?php require_once plugin_dir_path(dirname(__FILE__)) . 'partials/main-content.php'; ?>
		</div>
		<div class="site_mode__wrap--cover-sidebar">
			<?php require_once plugin_dir_path(dirname(__FILE__)) . 'partials/sidebar.php'; ?>
		</div>
	</div>
</div>
