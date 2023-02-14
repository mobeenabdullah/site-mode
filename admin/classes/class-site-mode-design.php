<?php

/**
 * Responsible for plugin menu
 *
 * @link       https://https://mobeenabdullah.com
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
class Site_Mode_Design extends  Settings
{
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
        $this->logo_width           = isset($this->site_mode_design['logo-width']) ? $this->site_mode_design['logo-width'] : '200';
        $this->logo_height          = isset($this->site_mode_design['logo-height']) ? $this->site_mode_design['logo-height'] : '200';
        $this->background_overlay   = isset($this->site_mode_design['background-overlay']) ? $this->site_mode_design['background-overlay'] : '#000000';
        $this->overlay_color        = isset($this->site_mode_design['overlay-color']) ? $this->site_mode_design['overlay-color'] : '#000000';
        $this->overlay_opacity      = isset($this->site_mode_design['overlay-opacity']) ? $this->site_mode_design['overlay-opacity'] : '0.5';

       // font and color settings


        //font settings
        $this->site_mode_design_fonts = $this->get_data($this->option_name_3);
        // use ternary operator for check data is empty or not.
        $this->heading_font_size                  = !empty($this->site_mode_design_fonts['heading_font_size']) ? $this->site_mode_design_fonts['heading_font_size'] : '36';
        $this->heading_font_family                = !empty($this->site_mode_design_fonts['heading_font_family']) ? $this->site_mode_design_fonts['heading_font_family'] : 'Open Sans';
        $this->heading_font_weight                = !empty($this->site_mode_design_fonts['heading_font_weight']) ? $this->site_mode_design_fonts['heading_font_weight'] : '400';
        $this->heading_letter_spacing             = !empty($this->site_mode_design_fonts['heading_letter_spacing']) ? $this->site_mode_design_fonts['heading_letter_spacing'] : '0';
        $this->heading_line_height                = !empty($this->site_mode_design_fonts['heading_line_height']) ? $this->site_mode_design_fonts['heading_line_height'] : '1.5';
        $this->heading_font_color                 = !empty($this->site_mode_design_fonts['heading_font_color']) ? $this->site_mode_design_fonts['heading_font_color'] : '#000000';
        $this->description_font_family            = !empty($this->site_mode_design_fonts['description_font_family']) ? $this->site_mode_design_fonts['description_font_family'] : 'Open Sans';
        $this->description_font_size              = !empty($this->site_mode_design_fonts['description_font_size']) ? $this->site_mode_design_fonts['description_font_size'] : '16';
        $this->description_font_weight            = !empty($this->site_mode_design_fonts['description_font_weight']) ? $this->site_mode_design_fonts['description_font_weight'] : '400';
        $this->description_letter_spacing         = !empty($this->site_mode_design_fonts['description_letter_spacing']) ? $this->site_mode_design_fonts['description_letter_spacing'] : '0';
        $this->description_line_height            = !empty($this->site_mode_design_fonts['description_line_height']) ? $this->site_mode_design_fonts['description_line_height'] : '1.5';
        $this->description_font_color             = !empty($this->site_mode_design_fonts['description_font_color']) ? $this->site_mode_design_fonts['description_font_color'] : '#000000';



        //color settings
        $this->site_mode_design_social = $this->get_data($this->option_name_4);
        //check if values are set or not and assign default values
        $this->icon_size              = isset($this->site_mode_design_social['icon_size']) ? $this->site_mode_design_social['icon_size'] : '32';
        $this->icon_color             = isset($this->site_mode_design_social['icon_color']) ? $this->site_mode_design_social['icon_color'] : '#ffffff';
        $this->icon_bg_color          = isset($this->site_mode_design_social['icon_bg_color']) ? $this->site_mode_design_social['icon_bg_color'] : '#000000';
        $this->icon_border_color      = isset($this->site_mode_design_social['icon_border_color']) ? $this->site_mode_design_social['icon_border_color'] : '#000000';

    }

    public function ajax_site_mode_design() {

//	    $this->verify_nonce('design-logo-background', 'design-logo-background-settings-save');

		if(isset($_POST['template_name'])) {
			$template_name = sanitize_text_field($_POST['template_name']);
            return $this->save_data($this->option_name_1, $template_name);
            die();
		}
    }
    public function ajax_site_mode_design_lb() {

	    $this->verify_nonce('design-logo-background', 'design-logo-background-settings-save');
		// validate data and sanitize
	    $data = [];
		    if(isset($_POST['logo-width'])) {
				$data['logo-width'] = intval($_POST['logo-width']);
		    }
			if(isset($_POST['logo-height'])) {
				$data['logo-height'] = intval($_POST['logo-height']);
			}
			if(isset($_POST['background-overlay'])) {
				$data['background-overlay'] = intval($_POST['background-overlay']);
			}
			if(isset($_POST['overlay-color'])) {
				$data['overlay-color'] = sanitize_hex_color($_POST['overlay-color']);
			}
			if(isset($_POST['overlay-opacity'])) {
				$data['overlay-opacity'] = intval($_POST['overlay-opacity']);
			}

		return $this->save_data($this->option_name_2, $data);
        die();
    }

    public function ajax_site_mode_design_font() {

	    $this->verify_nonce('design-fonts', 'design-fonts-settings-save');
	    $data = array();
		$data['heading_font_family'] = $this->get_post_data('heading-font-family', 'design-fonts-settings-save', 'design-fonts', 'text');
			if(isset($_POST['heading-font-size'])) {
				$data['heading_font_size'] = intval($_POST['heading-font-size']);
			}
			if(isset($_POST['heading-font-color']) ) {
				$data['heading_font_color'] = sanitize_hex_color($_POST['heading-font-color']);
			}
			if(isset($_POST['heading-font-weight']) ) {
				$data['heading_font_weight'] = sanitize_text_field($_POST['heading-font-weight']);
			}
			if(isset($_POST['heading-letter-spacing'])) {
				$data['heading_letter_spacing'] = intval($_POST['heading-letter-spacing']);
			}
			if(isset($_POST['heading-line-height'])) {
				$data['heading_line_height'] = intval($_POST['heading-line-height']);
			}
			if(isset($_POST['description-font-family']) ) {
				$data['description_font_family'] = sanitize_text_field($_POST['description-font-family']);
			}
			if(isset($_POST['description-font-size'])) {
				$data['description_font_size'] = intval($_POST['description-font-size']);
			}
			if(isset($_POST['description-font-color']) ) {
				$data['description_font_color'] = sanitize_hex_color($_POST['description-font-color']);
			}
			if(isset($_POST['description-font-weight'])) {
				$data['description_font_weight'] = sanitize_text_field($_POST['description-font-weight']);
			}
			if(isset($_POST['description-letter-spacing'])) {
				$data['description_letter_spacing'] = intval($_POST['description-letter-spacing']);
			}
			if(isset($_POST['description-line-height'])) {
				$data['description_line_height'] = intval($_POST['description-line-height']);
			}

        return $this->save_data($this->option_name_3, $data);
            die();
    }

    public function ajax_site_mode_design_social() {

	    $this->verify_nonce('design-icon-color', 'design-icon-color-settings-save');
	    $color_section_data = array();
	    if(isset($_POST['icon-size'])) {
		    $color_section_data['icon_size'] = intval($_POST['icon-size']);
	    }
		if(isset($_POST['icon-color'])) {
		    $color_section_data['icon_color'] = sanitize_hex_color($_POST['icon-color']);
	    }
		if(isset($_POST['icon-bg'])) {
		    $color_section_data['icon_bg_color'] = sanitize_hex_color($_POST['icon-bg']);
	    }
		if(isset($_POST['icon-border-color'])) {
		    $color_section_data['icon_border_color'] = sanitize_hex_color($_POST['icon-border-color']);
	    }
		if(isset($_POST['design-icon-color'])) {
		    $color_section_data['design_icon_color'] = sanitize_hex_color($_POST['design-icon-color']);
	    }

		return $this->save_data($this->option_name_4, $color_section_data);
		die();

    }

    public function render() {
        $this->display_settings_page('design');
    }

}
