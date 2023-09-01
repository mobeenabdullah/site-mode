<?php

/**
 *  Name : Default-Template
 */

require_once 'header.php';

$design                 = get_option( 'site_mode_design' );
$seo                    = get_option( 'site_mode_seo' );
$general                = get_option( 'site_mode_general' );
$show_login_icon        = isset( $general['show_login_icon'] ) ? $general['show_login_icon'] : '';
$custom_login_url       = isset( $general['custom_login_url'] ) ? $general['custom_login_url'] : '';

?>
<style>
	.wrapper_overlay {
		background-color: rgba(0,0,0, 0.5);
		opacity: 0.5;
	}
</style>

<main>    
	<section id="default_template" class="wrapper" style="">
		<!--Section Overlay-->                
			<div class="template_wrapper">
				<div class="wrapper_overlay"></div>
				<?php if ( $show_login_icon ) : ?>
					<div class="login_icon">
						<?php if ( empty( $custom_login_url ) ) : ?>
						<a href="<?php echo esc_url( get_home_url() ) . '/wp-login.php'; ?>" style="display: block">
							<svg xmlns="http://www.w3.org/2000/svg" width="40"  height="40" viewBox="0 0 24 24" style="fill:#ffffff"><path d="M12 2C9.243 2 7 4.243 7 7v3H6c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-8c0-1.103-.897-2-2-2h-1V7c0-2.757-2.243-5-5-5zm6 10 .002 8H6v-8h12zm-9-2V7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9z" fill="#ffffff"></path></svg>
						</a>
						<?php else : ?>
							<a href="<?php echo esc_url( get_home_url()  . '/' . $custom_login_url); ?>" style="display: block">
								<svg xmlns="http://www.w3.org/2000/svg" width="40"  height="40" viewBox="0 0 24 24" style="fill:#ffffff"><path d="M12 2C9.243 2 7 4.243 7 7v3H6c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-8c0-1.103-.897-2-2-2h-1V7c0-2.757-2.243-5-5-5zm6 10 .002 8H6v-8h12zm-9-2V7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9z" fill="#ffffff"></path></svg>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div class="default_template">
						<div class="default_template-heading">
							<h2 class="main_title">
								Maintenance Mode
							</h2>
						</div>
						<div class="default_template-text">
							<p>Maintenance Mode is Active</p>
						</div>
				</div>
			</div>
	</section>
</main>

<?php

require_once 'footer.php';


