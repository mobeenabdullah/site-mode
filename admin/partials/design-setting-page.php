<?php
$templates = array(
	'template-1' => array(
		'name'     => 'Template 1',
		'category' => 'maintenance',
	),
	'template-2' => array(
		'name'     => 'Template 2',
		'category' => 'coming-soon',
	),
	'template-3' => array(
		'name'     => 'Template 3',
		'category' => 'maintenance',
	),
	'template-4' => array(
		'name'     => 'Template 4',
		'category' => 'coming-soon',
	),
	'template-5' => array(
		'name'     => 'Template 5',
		'category' => 'coming-soon',
	),
	'template-6' => array(
		'name'     => 'Template 6',
		'category' => 'maintenance',
	),
	'template-7' => array(
		'name'     => 'Template 7',
		'category' => '404',
	),
	'template-8' => array(
		'name'     => 'Template 8',
		'category' => '404',
	),
);
$categories = array(
	'all'         => 'All',
	'coming-soon' => 'Coming Soon',
	'maintenance' => 'Maintenance',
	'404'         => '404',
// 'login'       => 'Login',
);

$args     = array(
	'post_type'      => 'page', // Only retrieve pages
	'post_status'    => 'publish', // Only retrieve published pages
	'posts_per_page' => -1, // Retrieve all pages
);
$page_ids = get_posts( $args );

?>

<div class="wizard__content-wrapper">
	<div class="smd-container">
		<div class="wizard__templates">
			<div class="wizard__templates-filters">
				<div class="result__showing">
					Showing <span class="display_template_name">All</span> templates. <span class="sm_clearfilter" style="display: none">Clear Filters</span>
				</div>
				<div class="wizard__templates-filter">
					<div class="wizard__templates-filter-cover">
						<?php foreach ( $categories as $key => $category ) : ?>
							<button type="button" class="template-category-filter filter_btn <?php echo $key === 'all' ? 'active' : ''; ?> " data-template-category="<?php echo $key; ?>">
								<?php echo $category; ?>
							</button>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="template_options wizard__templates-cards">
				<?php foreach ( $templates as $key => $template ) : ?>
					<div class="template_card template-content-wrapper wizard__templates-cards--single" data-category-name="<?php echo $template['category']; ?>">
						<div class="template_card-img" style="background-image: url(<?php echo esc_url( SITE_MODE_ADMIN_URL . 'assets/templates/' . $key . '/screenshot.jpg' ); ?>);">
							<div class="template_card-actions">
								<?php
								if ( $this->active_template !== $key ) :
									?>
								<a href="<?php echo admin_url( '/admin.php?page=site-mode&design=true&template=' ) . $key . '&cat=' . $template['category']; ?>" class="select_template">
									<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M7.00008 1.16663C3.78358 1.16663 1.16675 3.78346 1.16675 6.99996C1.16675 10.2165 3.78358 12.8333 7.00008 12.8333C10.2166 12.8333 12.8334 10.2165 12.8334 6.99996C12.8334 3.78346 10.2166 1.16663 7.00008 1.16663ZM7.00008 11.6666C4.427 11.6666 2.33341 9.57304 2.33341 6.99996C2.33341 4.42688 4.427 2.33329 7.00008 2.33329C9.57316 2.33329 11.6667 4.42688 11.6667 6.99996C11.6667 9.57304 9.57316 11.6666 7.00008 11.6666Z" fill="white"/>
										<path d="M5.83272 7.92569L4.49164 6.58694L3.66797 7.41294L5.83389 9.57419L9.74572 5.66236L8.92089 4.83752L5.83272 7.92569Z" fill="white"/>
									</svg>
									<span>Select</span>
								</a>
								<?php else : ?>
								<span>
									<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M7.00008 1.16663C3.78358 1.16663 1.16675 3.78346 1.16675 6.99996C1.16675 10.2165 3.78358 12.8333 7.00008 12.8333C10.2166 12.8333 12.8334 10.2165 12.8334 6.99996C12.8334 3.78346 10.2166 1.16663 7.00008 1.16663ZM7.00008 11.6666C4.427 11.6666 2.33341 9.57304 2.33341 6.99996C2.33341 4.42688 4.427 2.33329 7.00008 2.33329C9.57316 2.33329 11.6667 4.42688 11.6667 6.99996C11.6667 9.57304 9.57316 11.6666 7.00008 11.6666Z" fill="white"/>
										<path d="M5.83272 7.92569L4.49164 6.58694L3.66797 7.41294L5.83389 9.57419L9.74572 5.66236L8.92089 4.83752L5.83272 7.92569Z" fill="white"/>
									</svg>
									<span>Selected</span>
								</span>
								<?php endif; ?>
							</div>
						</div>
						<div class="template_card-heading">
							<h2 class="template_card-content--title"><?php echo $template['name']; ?></h2>
							<a href="<?php echo 'https://demo.site-mode.com/' . $key; ?>" class="template_card-content--demo" target="_blank">Live Demo</a>
						</div>
					</div>
				<?php endforeach; ?>
				<div class="wizard__templates-cards--single template_empty_card">
					More Templates <br>
					Coming Soon
				</div>
			</div>
		</div>
	</div>
</div>

