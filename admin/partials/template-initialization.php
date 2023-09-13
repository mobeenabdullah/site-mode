<?php




$templates = [
    'template-1' => [
        'name'          => 'Template 1',
        'description'   => 'This is template 1',
        'image'         => 'screenshot.jpg',
        'category'      => 'coming-soon',
    ],
    'template-2' => [
        'name'          => 'Template 2',
        'description'   => 'This is template 2',
        'image'         => 'template-2.jpg',
        'category'      => 'maintenance',
    ],
    'template-3' => [
        'name'          => 'Template 3',
        'description'   => 'This is template 3',
        'image'         => 'template-3.jpg',
        'category'      => 'coming-soon',
    ],
    'template-4' => [
        'name'          => 'Template 4',
        'description'   => 'This is template 4',
        'image'         => 'template-4.jpg',
        'category'      => 'coming-soon',
    ],
    'template-5' => [
        'name'          => 'Template 5',
        'description'   => 'This is template 5',
        'image'         => 'template-5.jpg',
        'category'      => 'coming-soon',
    ],
    'template-6' => [
        'name'          => 'Template 6',
        'description'   => 'This is template 6',
        'image'         => 'template-6.jpg',
        'category'      => 'maintenance',
    ],
    'template-7' => [
        'name'          => 'Template 7',
        'description'   => 'This is template 7',
        'image'         => 'template-7.jpg',
        'category'      => 'coming-soon',
    ],
    'template-8' => [
        'name'          => 'Template 8',
        'description'   => 'This is template 8',
        'image'         => 'template-8.jpg',
        'category'      => 'coming-soon',
    ],
    'template-9' => [
        'name'          => 'Template 9',
        'description'   => 'This is template 9',
        'image'         => 'template-9.jpg',
        'category'      => 'maintenance',
    ],
];

$categories = [
    'all' => 'All',
    'coming-soon' => 'Coming Soon',
    'maintenance' => 'Maintenance'
];

$admin_url = plugin_dir_url(dirname(__FILE__));
?>
<div class="sm__wizard-header">
    <div class="sm__wizard--logo">
        <img src="<?php echo esc_url( plugins_url( '/assets/img/site-mode-logo.svg', dirname( __FILE__ ) ) ); ?>" alt="Site Mode Logo" class="site_mode__wrap--logo">
    </div>
    <div class="sm_close_wizard">
        <span class="close_wizard_btn">
            <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M24.288 9L17.9235 15.363L11.5605 9L9.43951 11.121L15.8025 17.484L9.43951 23.847L11.5605 25.968L17.9235 19.605L24.288 25.968L26.409 23.847L20.046 17.484L26.409 11.121L24.288 9Z" fill="#CCCCCC"/>
            </svg>
        </span>
    </div>
</div>
<div class="sm__wizard">
    <div class="sm-step-wrapper sm__wizard-steps">
        <div class="sm__wizard-steps--cover">
            <div class="sm-step-1 sm-step active">1</div>
            <div class="sm-step-2 sm-step">2</div>
            <div class="sm-step-3 sm-step">3</div>
            <div class="sm-step-4 sm-step">4</div>
        </div>
    </div>
    <div class="sm-category-card-wrapper sm__wizard-box">
        <div class="sm__wizard-category">
            <div class="sm-category-card-header">
                <h2>Choose a category</h2>
                <p>Choose a category for your site mode page.</p>
            </div>
            <div class="sm-category-cards">
                <div class="sm-category-card" data-value="coming-soon">Coming Soon</div>
                <div class="sm-category-card" data-value="maintenance">Maintenance</div>
            </div>
            <div class="sm-category-card-error" style="display: none">Please Select category!</div>
            <div class="sm-category-card-button sm_actions submit_button">
                <button class="sm-category-card-button__next">Next</button>
            </div>
        </div>
    </div>

    <div class="sm__wizard-box">
        <div class="sm__wizard-templates">
            <form method="post" id="sm-template__initialization" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <div class="sm-template-card-wrapper" style="display: none">
                     <div class="sm__wizard-templates--header">
                         <div class="sm__wizard-templates--heading">
                             <h2>Choose a template</h2>
                         </div>
                         <div class="sm_desktop_filters show_desktop">
                             <div class="template-category-wrapper">
                                 <?php foreach($categories as $key => $category ): ?>
                                     <span class="template-category-filter" data-template-category="<?php echo $key; ?>">
                                    <?php echo $category; ?>
                                </span>
                                 <?php endforeach; ?>
                             </div>
                         </div>
                         <div class="sm_mobile_filters show_mobile">
                             <select name="template_filter" class="select_template_category">
                                 <?php foreach($categories as $key => $category ): ?>
                                     <option class="template-category-dropdown" data-template-category="<?php echo $key; ?>" value="<?php echo $key; ?>"><?php echo $category; ?></option>
                                 <?php endforeach; ?>
                             </select>
                         </div>
                     </div>
                     <div class="template__initialization--content section_theme">
                         <div class="template__initialization--content__templates template__wrapper">
                             <div class="template_options sm__wizard-cards">
                                 <?php foreach($templates as $key => $template ): ?>
                                     <div class="template_card template-content-wrapper" data-category-name="<?php echo $template['category']; ?>">
                                         <label for="<?php echo $key; ?>">
                                             <div class="template_card-image" style="background-image: url(<?php echo esc_url($admin_url . 'assets/templates/' . $key . '/screenshot.jpg'); ?>);"></div>
                                         </label>
                                         <div class="template_card-content">
                                             <input type="radio" name="template" class="template_input" required value="<?php echo $key; ?>" id="<?php echo $key; ?>" <?php echo $key == 'default_template' ? 'checked' : ''; ?> >
                                             <h2 class="template_card-content--title"><?php echo $template['name']; ?></h2>
                                         </div>
                                     </div>
                                 <?php endforeach; ?>
                             </div>
                         </div>
                     </div>
                     <?php wp_nonce_field( 'template_init_action', 'template_init_field' ); ?>
                     <div class="template__initialization--button sm_actions submit_button">
                         <button type="button" class="template-init-back">Back</button>
                         <button type="button" class="template-init-next">Next</button>
                     </div>
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
            </form>
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