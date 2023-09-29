<?php

/**
 * Responsible for plugin menu
 *
 * @link       https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.0.0
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Menu {

    public function __construct() {}

	public function site_mode_menu() {
		add_menu_page(
			__( 'Site Mode Settings', 'site-mode' ),
			'Site Mode',
			'manage_options',
			'site-mode',
			[ $this, 'site_mode_settings_page_cb' ],
            SITE_MODE_ADMIN_URL . 'assets/img/admin-menu-icon.png',
		);
	}

    public function site_mode_submenu_settings_page() {

        $submenus = [
            [
                'page_title' => 'Templates',
                'menu_title' => 'Templates',
                'capability' => 'manage_options',
                'menu_slug'  => 'admin.php?page=site-mode&setting=templates',
            ],
            [
                'page_title' => 'Settings',
                'menu_title' => 'Settings',
                'capability' => 'manage_options',
                'menu_slug'  => 'admin.php?page=site-mode&setting=settings',
            ],
            [
                'page_title' => 'About Us',
                'menu_title' => 'About Us',
                'capability' => 'manage_options',
                'menu_slug'  => 'admin.php?page=site-mode&setting=about-us',
            ]

        ];

        foreach ($submenus as $submenu ) {
            add_submenu_page(
                'site-mode',
                $submenu['page_title'],
                $submenu['menu_title'],
                $submenu['capability'],
                $submenu['menu_slug'],
            );
        }

    }

	public function site_mode_settings_page_cb() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		require_once SITE_MODE_ADMIN . 'partials/settings-layout.php';
	}

	public function wp_kses_svg( $svg_content ) {
		$kses_defaults = wp_kses_allowed_html( 'post' );

		$svg_args = [
			'svg'   => [
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true, // <= Must be lower case!
			],
			'g'     => ['fill' => true ],
			'title' => [ 'title' => true ],
			'path'  => [
				'd'    => true,
				'fill' => true,
			],
		];

		$allowed_tags = array_merge( $kses_defaults, $svg_args );
		echo wp_kses( $svg_content, $allowed_tags );
	}
}
