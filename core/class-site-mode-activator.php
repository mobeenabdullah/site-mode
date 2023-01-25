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
class Site_Mode_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
        // Add default options to database for general settings
        $general_settings = array(
            "status"                => "1",
            'include_pages'         => array(),
            "mode"                  =>'maintenance',
            "url"                   => '',
            'delay'                 => '0',
            'login_icon'            => '1',
            'login_url'             => '',
            'user_role'             => 'administrator',
        );

        // Add default options to database for content settings.
        $content_settings= array(
            "logo_settings" =>'text-type',
            "image_logo"    =>'',
            "text_logo"     =>bloginfo('name'),
            "heading"       =>"We are currently under maintenance",
            'description'   =>"We are currently under maintenance. We will be back shortly. Thank you for your patience.",
            'bg_image'      =>'',
        );
        // Add default options to database for social settings.
        $social_settings = array(
            'show_social'       => '1',
            'social_fb'         => 'rexnixtechnologies',
            'social_twitter'    => 'rexnixtechnologies',
            'social_linkedin'   => 'rexnixtechnologies',
            'social_youtube'    => 'rexnixtechnologies',
            'social_instagram'  => 'rexnixtechnologies',
            'social_pintrest'   => 'rexnixtechnologies',
            'social_quora'      => 'rexnixtechnologies',
            'social_behance'    => 'rexnixtechnologies',
        );

        // Add default options to database for Design settings.
        $template_name = 'construction_template';

        // Add default options to database for Design logo and background settings.
        $design_lb_settings = array(
            'logo_width'            =>'120',
            'logo_height'           => '120',
            'design_background'     => '1',
            'background_overlay'    => '1',
            'overlay_color'         => '#000000',
            'overlay_opacity'       => '0.5',
        );

        // Add default options to database for Design fonts  settings.
        $design_fonts_settings = array(
            'heading_font_family'               => 'Open Sans',
            'heading_font_size'                 => '48',
            'description_font_family'           => 'Open Sans',
            'description_font_size'             => '18',
        );

        // Add default options to database for Design icons color settings.
        $design_icon_color = array(
            'icon_size'                 => '32',
            'icon_color'                => '#ffffff',
            'icon_bg_color'             => '#000000',
            'icon_border_color'         => '#000000',
            'design_icon_color'         => '#ffffff',
        );

        //add default options to database for SEO settings fields with placeholder text.
        $seo_settings = array(
            'meta_title'            => 'Site is under maintenance',
            'meta_description'      => 'Site is under maintenance',
            'meta_favicon'          => '',
            'meta_image'            => '',
        );

        // adding default options to database for advanced settings.
        $advance_settings = array(
            'ga_type'               => '',
            'ga_id'                 => 'Google Analytics ID',
            'fb_id'                 => 'Facebook Pixel ID',
            'custom_css'            => 'Custom CSS',
            'enable_rest_api'       => '1',
            'enable_feed'           => '1',
            'header_code'           => 'Header Code',
            'footer_code'           => 'Footer Code',

        );

    // Add default options to database for general settings.
        $settings = array(
            'site_mode_general'             => $general_settings,
            'site_mode_content'             => $content_settings,
            'site_mode_social'              => $social_settings,
            'site_mode_design'              => $template_name,
            'site_mode_design_lb'           => $design_lb_settings,
            'site_mode_design_fonts'        => $design_fonts_settings,
            'site_mode_design_icon_color'   => $design_icon_color,
            'site_mode_seo'                 => $seo_settings,
            'site_mode_advanced'            => $advance_settings,
        );

        foreach ($settings as $key => $value) {
            add_option($key, serialize($value));
        }



	}
}
