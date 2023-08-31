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

<div class="site_mode__wrap-form">
	<div class="section__wrapper">
		<div class="section__wrapper-header">
			<div class="section_title">
				<h3 class="section_title-title"><?php esc_html_e( 'Templates', 'site-mode' ); ?></h3>
			</div>
		</div>
		<div class="section__wrapper-content section_theme">
				<div class="template__wrapper">
					<div class="template_options">

						<?php foreach ( $templates as $key => $template ) : ?>
						<div class="template_card template-<?php echo esc_attr( $template['name'] ); ?> <?php echo $key === $this->active_template ? 'active_template' : ''; ?>" data-value="<?php echo $key; ?>">
							<div class="template_card-image" style="background-image: url(<?php echo esc_url( $template['image'] ); ?>);">
							</div>
                            <div class="template_loading" style="display: none">Loading...</div>
							<div class="template_card-content">
								<h2 class="template_card-content--title"><?php echo esc_html_e( $template['name'] ); ?></h2>
							</div>
						</div>
						<?php endforeach; ?>
                        <?php wp_nonce_field( 'template_init_action', 'template_init_field' ); ?>
						<div class="template_card coming_soon">
							<h3 class="coming_soon_text">More Templates <br>Coming Soon</h3>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>
