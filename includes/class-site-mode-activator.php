<?php

/**
 * Fired during plugin activation
 *
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

        // Add default options to database for general settings
        $general_settings = array(
            "mode_status"                => 1,
            "mode_type"                  => 'maintenance',
            "redirect_url"               => '',
            'redirect_delay'             => 0,
            'show_login_icon'            => 1,
            'custom_login_url'           => '',
            'whitelist_pages'            => [],
            'user_roles'                 => ['administrator']
        );

        // Add default options to database for content settings.
        $content_settings= array(
            "logo_type"                  => 'text-type',
            "image_logo"                 => 'https://sitemode.local/wp-content/uploads/2023/02/admin-sidebar-icon.svg',
            "logo_text"                  => get_bloginfo('name'),
            "content_heading"            => "Something great is in the works!",
            'content_description'        => "We're currently rebuilding our website to create a more seamless and immersive online experience for our valued customers. Follow us on social media for the latest updates and exclusive sneak peeks of what's to come. Be the first to know when our new site goes live and don't miss out on what we have in store!",
            'bg_image'                   => '',
        );
        // Add default options to database for social settings.
        $social_settings = array(
            'show_social_icons'          => '1',
            'social_icons'               => [],
        );

        // Add default options to database for Design settings.
        $template_name = 'default_template';

        // Add default options to database for Design logo and background settings.
        $design_lb_settings = array(
            'logo-width'                 => '100',
            'logo-height'                => '100',
            'background-overlay'         => '1',
            'overlay-color'              => '#000000',
            'overlay-opacity'            => '8',
        );

        // Add default options to database for Design fonts  settings.
        $design_fonts_settings = array(
            'heading_font_family'        => 'Raleway',
            'heading_font_size'          => '90',
			'heading_font_color'         => '#ffffff',
			'heading_font_weight'        => '600',
			'heading_letter_spacing'     => '0',
			'heading_line_height'        => '110',
            'description_font_family'    => 'Raleway',
            'description_font_size'      => '24',
	        'description_font_color'     => '#ffffff',
	        'description_font_weight'    => '300',
	        'description_letter_spacing' => '0',
	        'description_line_height'    => '42',

        );

        //add default options to database for SEO settings fields with placeholder text.
        $seo_settings = array(
            'meta_title'                    => '',
            'meta_description'              => '',
            'meta_favicon'                  => '',
            'meta_image'                    => '',
        );

        // adding default options to database for advanced settings.
        $advance_settings = array(
            'ga_id'                         => '',
            'fb_id'                         => '',
            'custom_css'                    => '',
            'enable_rest_api'               => '0',
			'disable_rss_feed'              => '0',
            'enable_feed'                   => '1',
            'header_code'                   => '',
            'footer_code'                   => '',

        );

        $site_mode_design_social = array(
            'icon_size'              => '24',
            'icon_color'             => '#ffffff',
            'icon_bg_color'          => '',
            'icon_border_color'      => '#ffffff',
        );

    // Add default options to database for general settings.
        $settings = array(
            'site_mode_general'             => $general_settings,
            'site_mode_content'             => $content_settings,
            'site_mode_social'              => $social_settings,
            'site_mode_design'              => $template_name,
            'site_mode_design_lb'           => $design_lb_settings,
            'site_mode_design_fonts'        => $design_fonts_settings,            
            'site_mode_seo'                 => $seo_settings,
            'site_mode_advanced'            => $advance_settings,
            'site_mode_design_social'      => $site_mode_design_social,
        );

        foreach ($settings as $key => $value) {
            add_option($key, serialize($value));
        }

	}
}
