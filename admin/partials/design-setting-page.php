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

						<?php
							$templates = [
								[
									'id'    => 1,
									'name'  => 'default_template',
									'title' => 'Default Template',
									'image' => plugin_dir_url( __DIR__ ) . 'assets/img/screenshot.png',
								],
							];
							?>

						<?php foreach ( $templates as $template ) : ?>
						<div class="template_card template-<?php echo esc_attr( $template['name'] ); ?> <?php echo $template['name'] === $this->active_template ? 'active_template' : ''; ?>">
							<div class="template_card-image" style="background-image: url(<?php echo esc_url( $template['image'] ); ?>);">
							</div>
							<div class="template_card-content">
								<h2 class="template_card-content--title"><?php echo esc_html_e( $template['title'] ); ?></h2>
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
