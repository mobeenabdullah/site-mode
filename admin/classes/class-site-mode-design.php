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
        protected $option_name_4 = 'site_mode_design_color_section';
        protected $active_template;
        protected $logo_width;
        protected $logo_height;
        protected $design_background;
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

        protected $site_mode_design_color_section;

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
        $this->site_mode_design = $this->get_data($this->option_name_2);
        $this->logo_width = isset($this->site_mode_design['logo_width']) ? $this->site_mode_design['logo_width'] : '200';
        $this->logo_height = isset($this->site_mode_design['logo_height']) ? $this->site_mode_design['logo_height'] : '200';
        $this->design_background = isset($this->site_mode_design['design_background']) ? $this->site_mode_design['design_background'] : '#ffffff';
        $this->background_overlay = isset($this->site_mode_design['background_overlay']) ? $this->site_mode_design['background_overlay'] : '#000000';
        $this->overlay_color = isset($this->site_mode_design['overlay_color']) ? $this->site_mode_design['overlay_color'] : '#000000';
        $this->overlay_opacity = isset($this->site_mode_design['overlay_opacity']) ? $this->site_mode_design['overlay_opacity'] : '0.5';

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
        $this->site_mode_design_color_section = $this->get_data($this->option_name_4);
        //check if values are set or not and assign default values
        $this->icon_size              = isset($this->site_mode_design_color_section['icon_size']) ? $this->site_mode_design_color_section['icon_size'] : '32';
        $this->icon_color             = isset($this->site_mode_design_color_section['icon_color']) ? $this->site_mode_design_color_section['icon_color'] : '#ffffff';
        $this->icon_bg_color          = isset($this->site_mode_design_color_section['icon_bg_color']) ? $this->site_mode_design_color_section['icon_bg_color'] : '#000000';
        $this->icon_border_color      = isset($this->site_mode_design_color_section['icon_border_color']) ? $this->site_mode_design_color_section['icon_border_color'] : '#000000';

    }

    public function ajax_site_mode_design() {
		if(isset($_POST['template_name'])) {
			$template_name = $_POST['template_name'];
            return $this->save_data($this->option_name_1, $template_name);
            die();
		}
    }
    public function ajax_site_mode_design_lb() {
	    $this->verify_nonce('design-logo-background', 'design-logo-background-settings-save');
        $data = array(
            'logo_width'            => $_POST['logo-width-setting'],
            'logo_height'           => $_POST['logo-height-setting'],
            'design_background'     => $_POST['design-background-setting'],
            'background_overlay'    => $_POST['design-background-overlay-setting'],
            'overlay_color'         => $_POST['overlay-color-setting'],
            'overlay_opacity'       => $_POST['overlay-opacity-setting'],
        );

		return $this->save_data($this->option_name_2, $data);
        die();
    }

    public function ajax_site_mode_design_font() {

                $data = array(
                    'heading_font_family'               => $_POST['heading-font-family-setting'],
                    'heading_font_size'                 => $_POST['heading-font-size-setting'],
                    'heading_font_color'                => $_POST['heading-font-color-setting'],
                    'heading_font_weight'               => $_POST['heading-font-weight-setting'],
                    'heading_letter_spacing'            => $_POST['heading-letter-spacing-setting'],
                    'heading_line_height'               => $_POST['heading-line-hight-setting'],
                    'description_font_family'           => $_POST['description-font-family-setting'],
                    'description_font_size'             => $_POST['description-font-size-setting'],
                    'description_font_color'            => $_POST['description-font-color-setting'],
                    'description_font_weight'           => $_POST['description-font-weight-setting'],
                    'description_letter_spacing'        => $_POST['description-letter-spacing-setting'],
                    'description_line_height'           => $_POST['description-line-height-setting'],

                );

        return $this->save_data($this->option_name_3, $data);
            die();
    }

    public function ajax_site_mode_design_color_section() {

	    $this->verify_nonce('design-icon-color', 'design-icon-color-settings-save');
        $color_section_data = array(
            'icon_size'                 => $_POST['icon-size-setting'],
            'icon_color'                => $_POST['icon-color-setting'],
            'icon_bg_color'             => $_POST['icon-bg-setting'],
            'icon_border_color'         => $_POST['icon-border-color-setting'],
            'design_icon_color'         => $_POST['design-icon-color'],
        );

        return $this->save_data($this->option_name_4, $color_section_data);

        wp_die();
    }

    public function render() {
        $this->display_settings_page('design');
    }

}
