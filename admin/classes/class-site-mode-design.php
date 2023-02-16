<?php

/**
 * Responsible for plugin menu
 *
 * @link       https://mobeenabdullah.com
 * @since      0.0.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      0.0.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Design extends  Settings {
        protected $option_name_1 = 'site_mode_design';
        protected $option_name_2 = 'site_mode_design_lb';
        protected $option_name_3 = 'site_mode_design_fonts';
        protected $option_name_4 = 'site_mode_design_social';
        protected $active_template;
        protected $logo_width;
        protected $logo_height;
        protected $background_overlay ;
        protected $overlay_color;
        protected $overlay_opacity;

        protected $site_mode_design_fonts;
        protected $heading_font_size;
        protected $heading_font_color;
        protected $heading_font_family;
        protected $heading_font_weight;
        protected $heading_letter_spacing;
        protected $heading_line_height;

        protected $description_font_family;
        protected $description_font_size;
        protected $description_font_color;
        protected $description_font_weight;
        protected $description_letter_spacing;
        protected $description_line_height;

        protected $site_mode_design_social;

        protected $icon_size;
        protected $icon_color;
        protected $icon_bg_color;
        protected $icon_border_color;
        protected $status;
        protected $mode;
        protected $site_mode_design = [];




    public function __construct(){
        //template settings
        $this->active_template = $this->get_data($this->option_name_1);

        //logo  and background settings
        $this->site_mode_design     = $this->get_data($this->option_name_2);
        $this->logo_width           = isset($this->site_mode_design['logo-width']) ? $this->site_mode_design['logo-width'] : '100';
        $this->logo_height          = isset($this->site_mode_design['logo-height']) ? $this->site_mode_design['logo-height'] : '100';
        $this->background_overlay   = isset($this->site_mode_design['background-overlay']) ? $this->site_mode_design['background-overlay'] : '#000000';
        $this->overlay_color        = isset($this->site_mode_design['overlay-color']) ? $this->site_mode_design['overlay-color'] : '#000000';
        $this->overlay_opacity      = isset($this->site_mode_design['overlay-opacity']) ? $this->site_mode_design['overlay-opacity'] : '8';
       // font and color settings


        //font settings
        $this->site_mode_design_fonts = $this->get_data($this->option_name_3);
        // use ternary operator for check data is empty or not.
        $this->heading_font_size                  = !empty($this->site_mode_design_fonts['heading_font_size']) ? $this->site_mode_design_fonts['heading_font_size'] : '90';
        $this->heading_font_family                = !empty($this->site_mode_design_fonts['heading_font_family']) ? $this->site_mode_design_fonts['heading_font_family'] : 'Raleway';
        $this->heading_font_weight                = !empty($this->site_mode_design_fonts['heading_font_weight']) ? $this->site_mode_design_fonts['heading_font_weight'] : '600';
        $this->heading_letter_spacing             = !empty($this->site_mode_design_fonts['heading_letter_spacing']) ? $this->site_mode_design_fonts['heading_letter_spacing'] : '0';
        $this->heading_line_height                = !empty($this->site_mode_design_fonts['heading_line_height']) ? $this->site_mode_design_fonts['heading_line_height'] : '110';
        $this->heading_font_color                 = !empty($this->site_mode_design_fonts['heading_font_color']) ? $this->site_mode_design_fonts['heading_font_color'] : '#ffffff';
        $this->description_font_family            = !empty($this->site_mode_design_fonts['description_font_family']) ? $this->site_mode_design_fonts['description_font_family'] : 'Raleway';
        $this->description_font_size              = !empty($this->site_mode_design_fonts['description_font_size']) ? $this->site_mode_design_fonts['description_font_size'] : '24';
        $this->description_font_weight            = !empty($this->site_mode_design_fonts['description_font_weight']) ? $this->site_mode_design_fonts['description_font_weight'] : '300';
        $this->description_letter_spacing         = !empty($this->site_mode_design_fonts['description_letter_spacing']) ? $this->site_mode_design_fonts['description_letter_spacing'] : '0';
        $this->description_line_height            = !empty($this->site_mode_design_fonts['description_line_height']) ? $this->site_mode_design_fonts['description_line_height'] : '42';
        $this->description_font_color             = !empty($this->site_mode_design_fonts['description_font_color']) ? $this->site_mode_design_fonts['description_font_color'] : '#ffffff';



        //color settings
        $this->site_mode_design_social = $this->get_data($this->option_name_4);
        //check if values are set or not and assign default values
        $this->icon_size              = isset($this->site_mode_design_social['icon_size']) ? $this->site_mode_design_social['icon_size'] : '24';
        $this->icon_color             = isset($this->site_mode_design_social['icon_color']) ? $this->site_mode_design_social['icon_color'] : '#ffffff';
        $this->icon_bg_color          = isset($this->site_mode_design_social['icon_bg_color']) ? $this->site_mode_design_social['icon_bg_color'] : '';
        $this->icon_border_color      = isset($this->site_mode_design_social['icon_border_color']) ? $this->site_mode_design_social['icon_border_color'] : '#ffffff';

    }
    public function ajax_site_mode_design_lb() {

	    $this->verify_nonce('design-logo-background', 'design-logo-background-settings-save');
		// validate data and sanitize
	    $data = [];
        $data['logo-width'] = $this->get_post_data('logo-width', 'design-logo-background-settings-save', 'design-logo-background', 'text');
        $data['logo-height'] = $this->get_post_data('logo-height', 'design-logo-background-settings-save', 'design-logo-background', 'text');
        $data['background-overlay'] = $this->get_post_data('background-overlay', 'design-logo-background-settings-save', 'design-logo-background', 'text');
        $data['overlay-color'] = $this->get_post_data('overlay-color', 'design-logo-background-settings-save', 'design-logo-background', 'text');
        $data['overlay-opacity'] = $this->get_post_data('overlay-opacity', 'design-logo-background-settings-save', 'design-logo-background', 'text');

		return $this->save_data($this->option_name_2, $data);
        die();
    }

    public function ajax_site_mode_design_font() {

	    $this->verify_nonce('design-fonts', 'design-fonts-settings-save');
	    $data = [];
		$data['heading_font_family'] = $this->get_post_data('heading-font-family', 'design-fonts-settings-save', 'design-fonts', 'text');
        $data['heading_font_size'] = $this->get_post_data('heading-font-size', 'design-fonts-settings-save', 'design-fonts', 'number');
        $data['heading_font_color'] = $this->get_post_data('heading-font-color', 'design-fonts-settings-save', 'design-fonts', 'color');
        $data['heading_font_weight'] = $this->get_post_data('heading-font-weight', 'design-fonts-settings-save', 'design-fonts', 'text');
        $data['heading_letter_spacing'] = $this->get_post_data('heading-letter-spacing', 'design-fonts-settings-save', 'design-fonts', 'number');
        $data['heading_line_height'] = $this->get_post_data('heading-line-height', 'design-fonts-settings-save', 'design-fonts', 'number');
        $data['description_font_family'] = $this->get_post_data('description-font-family', 'design-fonts-settings-save', 'design-fonts', 'text');
        $data['description_font_size'] = $this->get_post_data('description-font-size', 'design-fonts-settings-save', 'design-fonts', 'number');
        $data['description_font_color'] = $this->get_post_data('description-font-color', 'design-fonts-settings-save', 'design-fonts', 'color');
        $data['description_font_weight'] = $this->get_post_data('description-font-weight', 'design-fonts-settings-save', 'design-fonts', 'text');
        $data['description_letter_spacing'] = $this->get_post_data('description-letter-spacing', 'design-fonts-settings-save', 'design-fonts', 'number');
        $data['description_line_height'] = $this->get_post_data('description-line-height', 'design-fonts-settings-save', 'design-fonts', 'number');

        return $this->save_data($this->option_name_3, $data);
            die();
    }

    public function ajax_site_mode_design_social() {

	    $this->verify_nonce('design-icon-color', 'design-icon-color-settings-save');
	    $color_section_data = [];
        $data['icon_size'] = $this->get_post_data('icon-size', 'design-icon-color-settings-save', 'design-icon-color', 'number');
        $data['icon_color'] = $this->get_post_data('icon-color', 'design-icon-color-settings-save', 'design-icon-color', 'color');
        $data['icon_bg_color'] = $this->get_post_data('icon-bg', 'design-icon-color-settings-save', 'design-icon-color', 'color');
        $data['icon_border_color'] = $this->get_post_data('icon-border-color', 'design-icon-color-settings-save', 'design-icon-color', 'color');
        $data['design_icon_color'] = $this->get_post_data('design-icon-color', 'design-icon-color-settings-save', 'design-icon-color', 'color');

		return $this->save_data($this->option_name_4, $color_section_data);
		die();

    }

    public function render() {
        $this->display_settings_page('design');
    }

}
