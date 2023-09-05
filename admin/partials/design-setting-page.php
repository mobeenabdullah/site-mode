<?php

$templates = [
    'template-1' => [
        'name'          => 'Template 1',
        'description'   => 'This is template 1',
        'image'         => 'template-1.png',
        'category'      => 'maintenance',
    ],
    'template-2' => [
        'name'          => 'Template 2',
        'description'   => 'This is template 2',
        'image'         => 'template-2.png',
        'category'      => 'comming-soon',
    ],

];

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
            <span class="template-category-filter" data-template-category="all">
                All
            </span>
            <?php foreach($templates as $key => $template ): ?>
                <span class="template-category-filter" data-template-category="<?php echo $template['category']; ?>" >
                    <?php echo $template['category']; ?>
                </span>
            <?php endforeach; ?>
        </div>

        <div class="page-select-wrapper">
            <form method="post" id="site-mode-page-init" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <label for="sm_page_select">Select Page:</label>
                <select name="page_id" id="sm_page_select">
                    <option value="">Select Page</option>
                    <?php foreach ($page_ids as $page_id) : ?>
                        <option value="<?php echo $page_id->ID; ?>" <?php echo $page_id->ID == $this->page_id ? 'selected' : ''; ?>><?php echo $page_id->post_title; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php wp_nonce_field( 'template_init_action', 'template_init_field' ); ?>
                <input type="submit" id="sm_page_init" class="button button-primary" value="Save">
            </form>
        </div>


		<div class="section__wrapper-content section_theme">
            <div class="template__wrapper">
                <div class="template_options">
                    <?php foreach ( $templates as $key => $template ) : ?>
                    <div class="template_card template-content-wrapper template-<?php echo esc_attr( $key ); ?> <?php echo $key === $this->active_template ? 'active_template' : ''; ?>" data-category-name="<?php echo $template['category']; ?>">
                        <button class="template_init_button" data-value="<?php echo $key; ?>">Import</button>
                        <div class="template_card-image" style="background-image: url(<?php echo esc_url( $template['image'] ); ?>);">
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
