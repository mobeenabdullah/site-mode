<?php

/**
 * Fired during plugin activation
 *
 * @link       https://mobeenabdullah.com
 * @since      0.0.2
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.0.2
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Activator {

	public static function activate() {
		// Add default options to database for general settings
		$general_settings = [
			'mode_status'      => 0,
			'mode_type'        => 'maintenance',
			'redirect_url'     => '',
			'redirect_delay'   => 0,
			'show_login_icon'  => 1,
			'custom_login_url' => '',
			'whitelist_pages'  => [],
			'user_roles'       => ['administrator'],
		];

		// add default options to database for SEO settings fields with placeholder text.
		$seo_settings = [
			'meta_title'       => '',
			'meta_description' => '',
			'meta_favicon'     => '',
			'meta_image'       => '',
		];

		// adding default options to database for advanced settings.
		$advance_settings = [
			'ga_id'            => '',
			'fb_id'            => '',
			'enable_rest_api'  => '0',
			'disable_rss_feed' => '0',
			'enable_feed'      => '1',
		];

        // Add default templates to database for design settings.

        $sm_design_templates = [
            'categories' => [
                'all' => 'All',
                'coming-soon' => 'Coming Soon',
                'maintenance' => 'Maintenance',
            ],
            'templates'  => [
                'template-1' => [
                    'name'          => 'Template 1',
                    'category'      => 'coming-soon',
                ],
                'template-2' => [
                    'name'          => 'Template 2',
                    'category'      => 'maintenance',
                ],
                'template-3' => [
                    'name'          => 'Template 3',
                    'category'      => 'coming-soon',
                ],
                'template-4' => [
                    'name'          => 'Template 4',
                    'category'      => 'coming-soon',
                ],
                'template-5' => [
                    'name'          => 'Template 5',
                    'category'      => 'coming-soon',
                ],
                'template-6' => [
                    'name'          => 'Template 6',
                    'category'      => 'maintenance',
                ],
                'template-7' => [
                    'name'          => 'Template 7',
                    'category'      => 'coming-soon',
                ],
                'template-8' => [
                    'name'          => 'Template 8',
                    'category'      => 'coming-soon',
                ],
                'template-9' => [
                    'name'          => 'Template 9',
                    'category'      => 'maintenance',
                ],
            ]
        ];

		// Add default options to database for general settings.
		$settings = [
			'site_mode_general'             => $general_settings,
			'site_mode_seo'                 => $seo_settings,
			'site_mode_advanced'            => $advance_settings,
            'site_mode_design_templates'    => $sm_design_templates,
            'sm_activation_redirect'        => true
		];

		foreach ( $settings as $key => $value ) :
			add_option( $key, $value );
		endforeach;

	}
}
