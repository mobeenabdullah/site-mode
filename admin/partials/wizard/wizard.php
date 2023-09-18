<?php
$templates = get_option('site_mode_design_templates')['templates'];
$categories = get_option('site_mode_design_templates')['categories'];
?>
<!-- Please don't remove sm__wizard-wrapper class -->
<div class="sm__wizard-wrapper">
    <!-- Select Template -->
    <div class="wizard__content" style="display: block">
        <?php include(SITE_MODE_ADMIN . 'partials/wizard/header.php'); ?>
        <div class="wizard__content-wrapper">
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
                                <div class="template_card-img" style="background-image: url(<?php echo esc_url(SITE_MODE_ADMIN_URL . 'assets/templates/' . $key . '/screenshot.jpg'); ?>);"></div>
                                <div class="template_card-heading">
                                    <h2 class="template_card-content--title"><?php echo $template['name']; ?></h2>
                                </div>
                                <div class="template_card-actions">
                                    <a href="#">Live Demo</a>
                                    <button type="button" class="select_tempalte" data-template-name="<?php echo $key; ?>">Select</button>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include(SITE_MODE_ADMIN . 'partials/wizard/customize-template.php'); ?>

    <?php include(SITE_MODE_ADMIN . 'partials/wizard/import-template.php'); ?>

</div>
