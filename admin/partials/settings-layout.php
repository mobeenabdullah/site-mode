<?php
/**
 * Responsible for settings layout.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for settings layout.
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.1.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
?>

<?php
if ( ( isset( $_GET['design'] ) && true == $_GET['design'] ) || empty( get_option( 'sm-fresh-installation' ) ) ) :
	require_once SITE_MODE_ADMIN . 'partials/wizard/wizard.php';
	else :
		?>

	<div class="sm__dasboard-wrapper">
		<div class="smd__header">
			<div class="smd__header-logo">
				<a href="<?php echo esc_url( admin_url( '?page=site-mode' ) ); ?>"><img src="<?php echo esc_url( SITE_MODE_ADMIN_URL . '/assets/img/sitemode-logo.png' ); ?>" alt="Site Mode Logo" class="site_mode__wrap--logo"></a>
			</div>
			<div class="smd__header-nav">
				<div class="smd-navbar">
					<?php
						$site_mode_tabs = array(
							array(
								'title' => 'Dashboard',
								'icon'  => '<i class="fa-solid fa-gear"></i>',
								'slug'  => 'dashboard',
								'link'  => 'admin.php?page=site-mode&setting=dashboard',
							),
							array(
								'title' => 'Setup',
								'icon'  => '<i class="fa-solid fa-palette"></i>',
								'slug'  => 'setup',
								'link'  => 'admin.php?page=site-mode&design=true',
							),
							array(
								'title' => 'Subscribers',
								'icon'  => '<i class="fa-solid fa-sliders"></i>',
								'slug'  => 'subscribers',
								'link'  => 'admin.php?page=site-mode&setting=subscribers',
							),
							array(
								'title' => 'Settings',
								'icon'  => '<i class="fa-solid fa-chart-pie"></i>',
								'slug'  => 'settings',
								'link'  => 'admin.php?page=site-mode&setting=settings',
							),
						);

						$current_tab = isset( $_GET['setting'] ) ? sanitize_text_field( wp_unslash( $_GET['setting'] ) ) : 'dashboard';

						foreach ( $site_mode_tabs as $site_mode_tab ) :
							$tab_class = ( $current_tab === $site_mode_tab['slug'] ) ? 'active' : '';
							?>
								<a href="<?php echo esc_url( admin_url( $site_mode_tab['link'] ) ); ?>" class="<?php echo esc_attr( wp_unslash( $tab_class ) ); ?>"><?php echo esc_html( wp_unslash( $site_mode_tab['title'] ) ); ?></a>
							<?php
						endforeach;
						?>
				</div>
			</div>
		</div>
		<div class="sm__dashboard-content">
			<div class="smd-fluid-container">
				<div class="tab__contents">
					<div class="smd-tab-content" id="<?php echo esc_attr( $current_tab ); ?>">
						<?php

						if ( 'settings' === $current_tab ) {
							?>
								<div class="tabs_wrapper">
									<ul class="sm_tabs">
										<?php
										$site_mode_tabs = array(
											array(
												'title' => 'General',
												'icon'  => '<i class="fa-solid fa-gear"></i>',
											),
											array(
												'title' => 'SEO',
												'icon'  => '<i class="fa-solid fa-chart-line"></i>',
											),
											array(
												'title' => 'Integrations',
												'icon'  => '<i class="fa-solid fa-code-compare"></i>',
											),
											array(
												'title' => 'Advanced',
												'icon'  => '<i class="fa-solid fa-sliders"></i>',
											),
										);
										$active_tab     = isset( $_GET['tab'] ) ? strtolower( sanitize_text_field( wp_unslash( $_GET['tab'] ) ) ) : 'general';

										foreach ( $site_mode_tabs as $site_mode_tab ) :
											$tab_class = strtolower( $site_mode_tab['title'] ) === $active_tab ? 'sm_tabs-link current' : 'sm_tabs-link';
											$tab_data  = 'tab-' . strtolower( $site_mode_tab['title'] );
											$tab_link  = 'admin.php?page=site-mode&setting=settings&tab=' . strtolower( $site_mode_tab['title'] );
											?>
											<li class="<?php echo esc_attr( $tab_class ); ?>" data-tab="<?php echo esc_attr( $tab_data ); ?>">
												<a href="<?php echo esc_url( admin_url( $tab_link ) ); ?>" >
													<span class="menu_icon"><?php $this->wp_kses_svg( $site_mode_tab['icon'] ); ?> </span>
													<span class="menu_label"><?php echo esc_html( $site_mode_tab['title'] ); ?></span>
												</a>
											</li>
											<?php
										endforeach;
										?>
									</ul>

									<div class="tab-content current">
										<?php
										require_once SITE_MODE_ADMIN . "classes/class-site-mode-{$active_tab}.php";
										$class_name = 'Site_Mode_' . ucfirst( $active_tab );
										$class      = new $class_name();
										$class->render();
										?>
									</div>

								</div>
								<?php

						} elseif ( 'about-us' === $current_tab ) {
							require_once SITE_MODE_ADMIN . 'partials/about-page.php';
						} elseif ( 'subscribers' === $current_tab ) {
							require_once SITE_MODE_ADMIN . 'partials/subscribes.php';
						} else {
							require_once SITE_MODE_ADMIN . 'partials/dashboard-setting-page.php';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php endif; ?>


<div id="toast-success">
	<div class="toast-success-msg">
		<div id="img" class="toast-icon">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>
		</div>
		<div id="desc" class="toast-description">
			<span><?php esc_html_e( 'Settings Saved', 'site-mode' ); ?></span>
		</div>
	</div>
</div>
<div id="toast-error">
	<div class="toast-error-msg">
		<div id="img" class="toast-icon">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M11.001 10h2v5h-2zM11 16h2v2h-2z"></path><path d="M13.768 4.2C13.42 3.545 12.742 3.138 12 3.138s-1.42.407-1.768 1.063L2.894 18.064a1.986 1.986 0 0 0 .054 1.968A1.984 1.984 0 0 0 4.661 21h14.678c.708 0 1.349-.362 1.714-.968a1.989 1.989 0 0 0 .054-1.968L13.768 4.2zM4.661 19 12 5.137 19.344 19H4.661z"></path></svg>
		</div>
		<div id="desc" class="toast-description">
			<span><?php esc_html_e( 'Settings Not Saved', 'site-mode' ); ?></span>
		</div>
	</div>
</div>

