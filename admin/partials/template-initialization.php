<?php
$templates = get_option('site_mode_design_templates')['templates'];
$categories = get_option('site_mode_design_templates')['categories'];
?>
<!-- Please don't remove sm__wizard-wrapper class -->
<div class="sm__wizard-wrapper">
    <div class="sm__wizard-header">
        <div class="sm__wizard-header--logo">
            <img src="<?php echo esc_url( SITE_MODE_ADMIN_URL . '/assets/img/site-mode-logo.svg' ); ?>" alt="Site Mode Logo" class="site_mode__wrap--logo">
        </div>
        <div class="sm__wizard-header--steps">
            <div class="sm__wizard-header--steps-cover">
                <div class="sm-step-2 sm-step active">
                    <div class="step_circle"></div>
                    <div class="step_label">Select Template</div>
                    <div class="step_line"></div>
                </div>
                <div class="sm-step-3 sm-step">
                    <div class="step_circle"></div>
                    <div class="step_label">Customize</div>
                    <div class="step_line"></div>
                </div>
                <div class="sm-step-4 sm-step">
                    <div class="step_circle"></div>
                    <div class="step_label">Import</div>
                </div>
            </div>
        </div>
        <div class="sm__wizard-header--close">
            <div class="sm_close_wizard">
                <span class="close_wizard_btn">
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.288 9L17.9235 15.363L11.5605 9L9.43951 11.121L15.8025 17.484L9.43951 23.847L11.5605 25.968L17.9235 19.605L24.288 25.968L26.409 23.847L20.046 17.484L26.409 11.121L24.288 9Z" fill="#CCCCCC"/>
                    </svg>
                </span>
            </div>
        </div>
    </div>

    <div class="wizard__content">
        <div class="wizard_container">
            <div class="wizard__templates">
                <div class="wizard__templates-filters">
                    <div class="wizard__templates-search">
                        <form action="#" class="wizard__templates-form">
                            <div class="sm_search-field">
                                <input type="search" placeholder="Search templates" />
                                <button type="submit">
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.70412 9.40774C5.74783 9.40753 6.76147 9.05814 7.58363 8.41522L10.1685 11L11 10.1686L8.41508 7.58381C9.05837 6.76162 9.40799 5.7478 9.40824 4.70387C9.40824 2.11027 7.29786 0 4.70412 0C2.11039 0 0 2.11027 0 4.70387C0 7.29747 2.11039 9.40774 4.70412 9.40774ZM4.70412 1.17597C6.64986 1.17597 8.23221 2.75823 8.23221 4.70387C8.23221 6.64951 6.64986 8.23177 4.70412 8.23177C2.75838 8.23177 1.17603 6.64951 1.17603 4.70387C1.17603 2.75823 2.75838 1.17597 4.70412 1.17597Z" fill="#999999"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="wizard__templates-filter">
                        <div class="wizard__templates-filter-cover">
                            <?php foreach($categories as $key => $category ): ?>
                                <button type="button" class="template-category-filter filter_btn" data-template-category="<?php echo $key; ?>">
                                    <?php echo $category; ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="template_options wizard__templates-cards">
                    <?php foreach($templates as $key => $template ): ?>
                        <div class="template_card template-content-wrapper wizard__templates-cards--single" data-category-name="<?php echo $template['category']; ?>">
                            <div class="template_card-img" style="background-image: url(<?php echo esc_url(SITE_MODE_ADMIN_URL . 'assets/templates/' . $key . '/screenshot.jpg'); ?>);"></div>
                            <div class="template_card-heading">
                                <h2 class="template_card-content--title"><?php echo $template['name']; ?></h2>
                            </div>
                            <div class="template_card-actions">
                                <a href="#">Live Demo</a>
                                <button type="button">Select</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php wp_nonce_field( 'template_init_action', 'template_init_field' ); ?>
                </div>
                <div class="sm-template-next sm-wizard-box" style="display: none">
                    <h1>Screen 3</h1>
                    <div class="sm_actions submit_button">
                        <button type="submit" name="submit" class="button button-primary site-mode-save-btn">
                    <span class="save-btn-loader" style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><circle cx="12" cy="20" r="2"></circle><circle cx="12" cy="4" r="2"></circle><circle cx="6.343" cy="17.657" r="2"></circle><circle cx="17.657" cy="6.343" r="2"></circle><circle cx="4" cy="12" r="2.001"></circle><circle cx="20" cy="12" r="2"></circle><circle cx="6.343" cy="6.344" r="2"></circle><circle cx="17.657" cy="17.658" r="2"></circle></svg>
                    </span>
                            <?php esc_html_e( 'Continue', 'site-mode' ); ?>
                        </button>
                    </div>
                </div>
                <div class="sm-template-init-success sm__wizard-box" style="display: none">
                    <div class="sm__wizard-thanks">
                        <h3>Thank You</h3>
                        <div class="sm_actions submit_button">
                            <a href="#" class="sm-edit-page-link">Customize Page</a>
                            <a href="<?php echo home_url('?site-mode-preview=true'); ?>" target="_blank">Preview Page</a>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
