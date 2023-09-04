<?php

$templates = [
    'template-1' => [
        'name' => 'Template 1',
        'description' => 'This is template 1',
        'image' => 'template-1.png',
    ],
    'template-2' => [
        'name' => 'Template 2',
        'description' => 'This is template 2',
        'image' => 'template-2.png',
    ],

];

?>

<form method="post" id="sm-template__initialization" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">

    <div class="template__initialization--header">
        <h1>Choose a template</h1>
        <p>Choose a template for your site mode page.</p>
    </div>

    <div class="template__initialization--content">
        <div class="template__initialization--content__templates">
            <?php foreach($templates as $key => $template ): ?>
                <input type="radio" name="template" required value="<?php echo $key; ?>" id="<?php echo $key; ?>" <?php echo $key == 'default_template' ? 'checked' : ''; ?> >
                <label for="<?php echo $key; ?>"><?php echo $template['name']; ?></label>
            <?php endforeach; ?>
        </div>
    </div>

    <?php wp_nonce_field( 'template_init_action', 'template_init_field' ); ?>

    <div class="template__initialization--content__templates--template__button">
        <button type="submit" name="submit" class="button button-primary site-mode-save-btn">
            <span class="save-btn-loader" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><circle cx="12" cy="20" r="2"></circle><circle cx="12" cy="4" r="2"></circle><circle cx="6.343" cy="17.657" r="2"></circle><circle cx="17.657" cy="6.343" r="2"></circle><circle cx="4" cy="12" r="2.001"></circle><circle cx="20" cy="12" r="2"></circle><circle cx="6.343" cy="6.344" r="2"></circle><circle cx="17.657" cy="17.658" r="2"></circle></svg>
            </span>
            <?php esc_html_e( 'Save Changes', 'site-mode' ); ?>
        </button>
    </div>

</form>
