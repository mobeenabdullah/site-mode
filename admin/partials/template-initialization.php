<?php

$templates = [
    'template-1' => [
        'name'          => 'Template 1',
        'description'   => 'This is template 1',
        'image'         => 'template-1.png',
        'category'      => 'coming-soon',
    ],
    'template-2' => [
        'name'          => 'Template 2',
        'description'   => 'This is template 2',
        'image'         => 'template-2.png',
        'category'      => 'maintenance',
    ],
    'template-3' => [
        'name'          => 'Template 3',
        'description'   => 'This is template 3',
        'image'         => 'template-3.png',
        'category'      => 'coming-soon',
    ],
    'template-4' => [
        'name'          => 'Template 4',
        'description'   => 'This is template 4',
        'image'         => 'template-4.png',
        'category'      => 'coming-soon',
    ],
    'template-5' => [
        'name'          => 'Template 5',
        'description'   => 'This is template 5',
        'image'         => 'template-5.png',
        'category'      => 'coming-soon',
    ],
    'template-6' => [
        'name'          => 'Template 6',
        'description'   => 'This is template 6',
        'image'         => 'template-6.png',
        'category'      => 'maintenance',
    ],
    'template-7' => [
        'name'          => 'Template 7',
        'description'   => 'This is template 7',
        'image'         => 'template-7.png',
        'category'      => 'coming-soon',
    ],
    'template-8' => [
        'name'          => 'Template 8',
        'description'   => 'This is template 8',
        'image'         => 'template-8.png',
        'category'      => 'coming-soon',
    ],
    'template-9' => [
        'name'          => 'Template 9',
        'description'   => 'This is template 9',
        'image'         => 'template-9.png',
        'category'      => 'maintenance',
    ],
];

$categories = [
    'all' => 'All',
    'coming-soon' => 'Coming Soon',
    'maintenance' => 'Maintenance'
];

?>

<div class="sm-step-wrapper">
    <div class="sm-step-1 sm-step active">1</div>
    <div class="sm-step-2 sm-step">2</div>
    <div class="sm-step-3 sm-step">3</div>
</div>


<div class="sm-category-card-wrapper">
    <div class="sm-category-card-header">
        <h1>Choose a category</h1>
        <p>Choose a category for your site mode page.</p>
    </div>
    <div class="sm-category-cards">
        <div class="sm-category-card" data-value="coming-soon">Coming Soon</div>
        <div class="sm-category-card" data-value="maintenance">Maintenance</div>
    </div>
    <div class="sm-category-card-error" style="display: none">Please Select category!</div>
    <div class="sm-category-card-button">
        <button class="sm-category-card-button__next">Next</button>
    </div>
</div>



<div class="sm-template-card-wrapper" style="display: none">
    <div class="template-category-wrapper">
        <?php foreach($categories as $key => $category ): ?>
            <span class="template-category-filter" data-template-category="<?php echo $key; ?>" >
                <?php echo $category; ?>
            </span>
        <?php endforeach; ?>
    </div>

    <form method="post" id="sm-template__initialization" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
        <div class="template__initialization--header">
            <h1>Choose a template</h1>
            <p>Choose a template for your site mode page.</p>
        </div>
        <div class="template__initialization--content">
            <div class="template__initialization--content__templates">
                <?php foreach($templates as $key => $template ): ?>
                    <div class="template-content-wrapper" data-category-name="<?php echo $template['category']; ?>" >
                        <input type="radio" name="template" required value="<?php echo $key; ?>" id="<?php echo $key; ?>" <?php echo $key == 'default_template' ? 'checked' : ''; ?> >
                        <label for="<?php echo $key; ?>"><?php echo $template['name']; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php wp_nonce_field( 'template_init_action', 'template_init_field' ); ?>
        <div class="template__initialization--button">
            <button type="button" class="template-init-back">Back</button>
            <button type="submit" name="submit" class="button button-primary site-mode-save-btn">
                <span class="save-btn-loader" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><circle cx="12" cy="20" r="2"></circle><circle cx="12" cy="4" r="2"></circle><circle cx="6.343" cy="17.657" r="2"></circle><circle cx="17.657" cy="6.343" r="2"></circle><circle cx="4" cy="12" r="2.001"></circle><circle cx="20" cy="12" r="2"></circle><circle cx="6.343" cy="6.344" r="2"></circle><circle cx="17.657" cy="17.658" r="2"></circle></svg>
                </span>
                <?php esc_html_e( 'Continue', 'site-mode' ); ?>
            </button>
        </div>
    </form>
</div>


<div class="sm-template-init-success" style="display: none">
    <h3>Thank You</h3>
    <a href="#" class="sm-edit-page-link">Customize Page</a>
    <a href="<?php echo home_url('?preview=true'); ?>" target="_blank">Preview Page</a>
</div>