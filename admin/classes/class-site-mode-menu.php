<?php
/**
 * Responsible for plugin menu
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.1.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Menu {
	/**
	 * Constructor
	 *
	 * @since 1.1.1
	 * @access public
	 */
	public function __construct() {}

	/**
	 * Add menu page
	 *
	 * @since 1.1.1
	 * @access public
	 */
	public function site_mode_menu() {
		add_menu_page(
			__( 'Site Mode Settings', 'site-mode' ),
			'Site Mode',
			'manage_options',
			'site-mode',
			array( $this, 'site_mode_settings_page_cb' ),
			SITE_MODE_ADMIN_URL . 'assets/img/admin-menu-icon.png',
		);
	}

	/**
	 * Add submenu page
	 *
	 * @since 1.1.1
	 * @access public
	 */
	public function site_mode_submenu_settings_page() {

		$submenus = array(
			array(
				'page_title' => 'Dashboard',
				'menu_title' => 'Dashboard',
				'capability' => 'manage_options',
				'menu_slug'  => 'admin.php?page=site-mode&setting=dashboard',
			),
			array(
				'page_title' => 'Setup',
				'menu_title' => 'Setup',
				'capability' => 'manage_options',
				'menu_slug'  => 'admin.php?page=site-mode&design=true',
			),
			array(
				'page_title' => 'Subscribers',
				'menu_title' => 'Subscribers',
				'capability' => 'manage_options',
				'menu_slug'  => 'admin.php?page=site-mode&setting=subscribers',
			),
			array(
				'page_title' => 'About Us',
				'menu_title' => 'About Us',
				'capability' => 'manage_options',
				'menu_slug'  => 'admin.php?page=site-mode&setting=about-us',
			),
			array(
				'page_title' => 'Settings',
				'menu_title' => 'Settings',
				'capability' => 'manage_options',
				'menu_slug'  => 'admin.php?page=site-mode&setting=settings',
			),

		);

		foreach ( $submenus as $submenu ) {
			add_submenu_page(
				'site-mode',
				$submenu['page_title'],
				$submenu['menu_title'],
				$submenu['capability'],
				$submenu['menu_slug'],
			);
		}
	}

	/**
	 * Callback function for menu page
	 *
	 * @since 1.1.1
	 * @access public
	 */
	public function site_mode_settings_page_cb() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		require_once SITE_MODE_ADMIN . 'partials/settings-layout.php';
	}

	/**
	 * Callback function for submenu page
	 *
	 * @param string $svg_content The SVG content to be processed.
	 * @return void
	 * @since 1.1.1
	 * @access public
	 */
	public function wp_kses_svg( $svg_content ) {
		$kses_defaults = wp_kses_allowed_html( 'post' );

		$svg_args = array(
			'svg'   => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true, // <= Must be lower case!
			),
			'g'     => array( 'fill' => true ),
			'title' => array( 'title' => true ),
			'path'  => array(
				'd'    => true,
				'fill' => true,
			),
		);

		$allowed_tags = array_merge( $kses_defaults, $svg_args );
		echo wp_kses( $svg_content, $allowed_tags );
	}
}
