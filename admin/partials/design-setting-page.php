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

<div class="wizard__content-wrapper">
    <div class="smd-container">
        <div class="wizard__templates">
            <div class="wizard__templates-filters">
                <div class="result__showing">
                    Showing <span class="display_template_name">All</span> templates. <span class="sm_clearfilter">Clear Filters</span>
                </div>
                <div class="wizard__templates-filter">
                    <div class="wizard__templates-filter-cover">
                        <?php foreach($categories as $key => $category ): ?>
                            <button type="button" class="template-category-filter filter_btn <?php echo $key === 'all' ? 'active' : ''; ?> " data-template-category="<?php echo $key; ?>">
                                <?php echo $category; ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="template_options wizard__templates-cards">
                <input type="hidden" name="template-name" id="selected-template-name">
                <?php foreach($templates as $key => $template ): ?>
                    <div class="template_card template-content-wrapper wizard__templates-cards--single" data-category-name="<?php echo $template['category']; ?>">
                        <div class="template_card-img" style="background-image: url(<?php echo esc_url(SITE_MODE_ADMIN_URL . 'assets/templates/' . $key . '/screenshot.jpg'); ?>);">
                            <div class="template_card-actions">
                                <a href="<?php echo admin_url('/admin.php?page=site-mode&design=true&template=') . $key . '&cat=' . $template['category']; ?>" class="select_template">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.00008 1.16663C3.78358 1.16663 1.16675 3.78346 1.16675 6.99996C1.16675 10.2165 3.78358 12.8333 7.00008 12.8333C10.2166 12.8333 12.8334 10.2165 12.8334 6.99996C12.8334 3.78346 10.2166 1.16663 7.00008 1.16663ZM7.00008 11.6666C4.427 11.6666 2.33341 9.57304 2.33341 6.99996C2.33341 4.42688 4.427 2.33329 7.00008 2.33329C9.57316 2.33329 11.6667 4.42688 11.6667 6.99996C11.6667 9.57304 9.57316 11.6666 7.00008 11.6666Z" fill="white"/>
                                        <path d="M5.83272 7.92569L4.49164 6.58694L3.66797 7.41294L5.83389 9.57419L9.74572 5.66236L8.92089 4.83752L5.83272 7.92569Z" fill="white"/>
                                    </svg>
                                    <span>Select</span>
                                </a>
                            </div>
                        </div>
                        <div class="template_card-heading">
                            <h2 class="template_card-content--title"><?php echo $template['name']; ?></h2>
                            <a href="<?php echo home_url() . '?site-mode-preview=true'; ?>" class="template_card-content--demo">Live Demo</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>











<?php /*
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
*/ ?>