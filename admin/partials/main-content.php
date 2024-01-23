<?php
/**
 * Responsible for Design Settings page.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for Design Settings page.
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.1.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
?>

<div class="container">
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
	<span class="mobile_menu">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path></svg>
		<span class="menu_label">Main Menu</span>
	</span>
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
						'icon'  => '<i class="fa-solid fa-chart-pie"></i>',
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
				$active_tab     = isset( $_GET['setting'] ) ? strtolower( sanitize_text_field( wp_unslash( $_GET['setting'] ) ) ) : 'general';

				foreach ( $site_mode_tabs as $site_mode_tab ) :
					$tab_class = strtolower( $site_mode_tab['title'] ) === $active_tab ? 'sm_tabs-link current' : 'sm_tabs-link';
					$tab_data  = 'tab-' . strtolower( $site_mode_tab['title'] );
					?>
					<li class="<?php echo esc_attr( $tab_class ); ?>" data-tab="<?php echo esc_attr( $tab_data ); ?>">
						<span class="menu_icon"><?php $this->wp_kses_svg( $site_mode_tab['icon'] ); ?> </span>
						<span class="menu_label"><?php echo esc_html( $site_mode_tab['title'] ); ?></span>
					</li>
					<?php
				endforeach;
				?>
		</ul>

		<?php
		foreach ( $site_mode_tabs as $tab_content ) :
			$tab_class = strtolower( $tab_content['title'] ) === $active_tab ? 'tab-content current' : 'tab-content';
			$tab_id    = 'tab-' . strtolower( $tab_content['title'] );
			$tab_data  = 'tab-' . strtolower( $tab_content['title'] );
			$tab_name  = strtolower( esc_html( $tab_content['title'] ) );
			?>
				<div id="<?php esc_attr( $tab_id ); ?>" class="<?php esc_attr( $tab_class ); ?>">
					<?php
					require_once SITE_MODE_ADMIN . "classes/class-site-mode-{$tab_name}.php";
					$class_name = 'Site_Mode_' . ucfirst( $tab_name );
					$class      = new $class_name();
					$class->render();
					?>
				</div>
		<?php endforeach; ?>
	</div>
</div>
