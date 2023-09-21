<?php
$templates = get_option('site_mode_design_templates')['templates'];
$categories = get_option('site_mode_design_templates')['categories'];
?>
<!-- Please don't remove sm__wizard-wrapper class -->
<div class="sm__wizard-wrapper">
    <!-- Select Template -->
    <div class="wizard__content">
        <?php include(SITE_MODE_ADMIN . 'partials/wizard/header.php'); ?>
        <div class="wizard__start" style="display: block">
            <div class="wizard_container">
                <div class="wizard__start-content">
                    <div class="wizard__start-content--title">
                        <h1>Select a Mode, Create the Magic</h1>
                    </div>
                    <div class="wizard__start-content--cover">
                        display

                    </div>
                </div>
            </div>
            <div class="wizard__content-wrapper--actions">
                <button type="button" class="choose_page_type sm__btn primary_btn_outline">
                    <span>Select Template</span>
                    <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.1567 7.68786L4 8.59375L8 4.29688L4 0L3.1567 0.905886L5.71701 3.65622H0V4.93753H5.71701L3.1567 7.68786Z" fill="white"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="wizard__content-wrapper" style="display: none">
            <div class="wizard_container">
                <div class="wizard__templates">
                    <div class="wizard__templates-filters">
                        <div class="result__showing">
                            Showing <span class="display_template_name"></span>templates only. <span class="sm_clearfilter">Clear Filters</span>
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
                                        <button type="button" class="select_tempalte">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.00008 1.16663C3.78358 1.16663 1.16675 3.78346 1.16675 6.99996C1.16675 10.2165 3.78358 12.8333 7.00008 12.8333C10.2166 12.8333 12.8334 10.2165 12.8334 6.99996C12.8334 3.78346 10.2166 1.16663 7.00008 1.16663ZM7.00008 11.6666C4.427 11.6666 2.33341 9.57304 2.33341 6.99996C2.33341 4.42688 4.427 2.33329 7.00008 2.33329C9.57316 2.33329 11.6667 4.42688 11.6667 6.99996C11.6667 9.57304 9.57316 11.6666 7.00008 11.6666Z" fill="white"/>
                                                <path d="M5.83272 7.92569L4.49164 6.58694L3.66797 7.41294L5.83389 9.57419L9.74572 5.66236L8.92089 4.83752L5.83272 7.92569Z" fill="white"/>
                                            </svg>
                                            <span>Select</span>
                                        </button>
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
            <div class="wizard__content-wrapper--actions">
                <button class="back_wizard_start sm__btn secondary_btn_outline" type="button">
                    <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.8433 0.94495L4 0.0390625L0 4.33594L4 8.63281L4.8433 7.72693L2.28299 4.97659L8 4.97659V3.69528L2.28299 3.69528L4.8433 0.94495Z" fill="black"/>
                    </svg>
                    <span>Back</span>
                </button>
                <button class="select_template_btn sm__btn sm_disabled_btn" disabled="disabled" type="button" data-template-name="<?php echo $key; ?>" data-template-label="<?php echo $template['name']; ?>">
                    <span>Customize</span>
                    <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.1567 7.68786L4 8.59375L8 4.29688L4 0L3.1567 0.905886L5.71701 3.65622H0V4.93753H5.71701L3.1567 7.68786Z" fill="white"/>
                    </svg>
                </button>
            </div>
        </div>
        <?php include(SITE_MODE_ADMIN . 'partials/wizard/customize-template.php'); ?>
    </div>
</div>

<div id="importing__popup" class="sm-modal">
    <div class="modal_overlay"></div>
    <div class="sm-modal-content">
        <div class="import__content" style="display: block;">
            <div class="sm-modal-content-text">
                <img src="<?php echo esc_url( SITE_MODE_ADMIN_URL. '/assets/img/loading.png' ); ?>" alt="Site Mode Logo" class="site_mode__wrap--logo">
                <h3>Importing ...</h3>
                <p>Please be patient and don't refresh this page. The import can take some time.</p>
            </div>
        </div>

        <div class="error__content" style="display: none;">
            <div class="error_icon">
                <div class="icon error_box">
                      <span class="x-mark">
                        <span class="errorLine left"></span>
                        <span class="errorLine right"></span>
                      </span>
                </div>
                <h3>Unfortunately, an unexpected hiccup disrupted the smooth import process.</h3>
            </div>
        </div>

        <div class="thank__you-content" style="display: none;">
                <a href="/wp-admin/" class="close-popup">
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.288 9.51599L17.9235 15.879L11.5605 9.51599L9.43945 11.637L15.8025 18L9.43945 24.363L11.5605 26.484L17.9235 20.121L24.288 26.484L26.409 24.363L20.046 18L26.409 11.637L24.288 9.51599Z" fill="#CCCCCC"/>
                    </svg>
                </a>
            <div class="sm-modal-content-text remove_animation">
                <div class="icon-success icon success animate">
                    <span class="tip successLine animateSuccessTip"></span>
                    <span class="long successLine animateSuccessLong"></span>
                    <div class="placeholder"></div>
                    <div class="fix"></div>
                </div>
                <h3>Congratulations</h3>
                <p class="sm-modal-success-message">Your {comingsoon} page is ready. Now you can view the page or start customizing it.</p>
                <div class="buttons__wrapper">
                    <a href="#" class="outline_btn">Customize</a>
                    <a href="<?php echo home_url() . '?site-mode-preview=true'; ?>" class="primary_btn" target="_blank">View Page</a>
                </div>
            </div>
        </div>
    </div>
</div>
