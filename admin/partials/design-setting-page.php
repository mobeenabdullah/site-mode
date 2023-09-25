<?php
$templates = get_option('site_mode_design_templates')['templates'];
$categories = get_option('site_mode_design_templates')['categories'];

$args = array(
    'post_type' => 'page', // Only retrieve pages
    'post_status' => 'publish', // Only retrieve published pages
    'posts_per_page' => -1, // Retrieve all pages
);
$page_ids = get_posts($args);

?>

<div class="site_mode__wrap-form">
	<div class="section__wrapper">
		<div class="section__wrapper-header">
			<div class="section_title">
				<h3 class="section_title-title"><?php esc_html_e( 'Templates', 'site-mode' ); ?></h3>
			</div>
		</div>

        <div class="template-category-wrapper">
            <?php foreach($categories as $key => $cat ): ?>
                <span class="template-category-filter" data-template-category="<?php echo $key; ?>" >
                    <?php echo $cat; ?>
                </span>
            <?php endforeach; ?>
        </div>

		<div class="section__wrapper-content section_theme">
            <div class="template__wrapper">
                <div class="template_options">
                    <?php foreach ( $templates as $key => $template ) : ?>
                    <div class="template_card template-content-wrapper template-<?php echo esc_attr( $key ); ?> <?php echo $key === $this->active_template ? 'active_template' : ''; ?>" data-category-name="<?php echo $template['category']; ?>">
                        <button class="template_init_button" data-value="<?php echo $key; ?>">Import</button>

                        <a href="<?php echo admin_url('/admin.php?page=site-mode&design=true&template=') . $key . '&cat=' . $template['category']; ?>">Import</a>

                        <div class="template_card-image" style="background-image: url(<?php echo esc_url( SITE_MODE_ADMIN_URL . 'assets/templates/' . $key .'/screenshot.jpg' ); ?>);">
                        </div>
                        <div class="template_loading" style="display: none">Loading...</div>
                        <div class="template_card-content">
                            <h2 class="template_card-content--title"><?php echo esc_html_e( $template['name'] ); ?></h2>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="template_card coming_soon">
                        <h3 class="coming_soon_text">More Templates <br>Coming Soon</h3>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
