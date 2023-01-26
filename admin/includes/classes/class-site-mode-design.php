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
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-settings.php';
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
    protected $option_name = 'site_mode_design';
        protected $enable_template      = false;
        protected $logo_width           = '';
        protected $logo_height          ='';
        protected $design_background    = '';
        protected $background_overlay   = '';
        protected $overlay_color        = '';
        protected $overlay_opacity      = '';
        protected $icon_size            = '';
        protected $icon_color           = '';
        protected $icon_bg_color        = '';
        protected $icon_border_color    = '';
        protected $status               = '';
        protected $mode                 = '';
        protected $site_mode_design     = array();




    public function __construct(){
        $this->site_mode_design = get_option('site_mode_design');
        $this->site_mode_design = unserialize($this->site_mode_design);
        $this->enable_template = isset($this->site_mode_design['enable_template'] ) ? $this->site_mode_design['enable_template']  : '1';
    }

    public function ajax_site_mode_design() {
		if(isset($_POST['template_name'])) {
			$template_name = $_POST['template_name'];
			update_option('site_mode_design', serialize($template_name));
			wp_send_json_success(unserialize(get_option( 'site_mode_design' )));
		}
    }
    public function ajax_site_mode_design_lb() {
        print_r($_POST);
        $nonce = $_POST['design-logo-background'];
        if(!wp_verify_nonce( $nonce, 'design-logo-background-settings-save' )) {
            die(__('Security Check', 'site-mode'));
        }
        else {
            $data = array(
                'logo_width'            => $_POST['logo-width-setting'],
                'logo_height'           => $_POST['logo-height-setting'],
                'design_background'     => $_POST['design-background-setting'],
                'background_overlay'    => $_POST['design-background-overlay-setting'],
                'overlay_color'         => $_POST['overlay-color-setting'],
                'overlay_opacity'       => $_POST['overlay-opacity-setting'],
            );
        }

          return $this->save_data($this->option_name, $data);
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

        return $this->save_data('site_mode_design_font', $data);
            die();
    }

    public function ajax_site_mode_design_color_section() {
        $nonce = $_POST['design-icon-color'];
        if(!wp_verify_nonce( $nonce, 'design-icon-color-settings-save' )) {
            die(__('Security Check', 'site-mode'));
        } else {
            $color_section_data = array(
                'icon_size'                 => $_POST['icon-size-setting'],
                'icon_color'                => $_POST['icon-color-setting'],
                'icon_bg_color'             => $_POST['icon-bg-setting'],
                'icon_border_color'         => $_POST['icon-border-color-setting'],
                'design_icon_color'         => $_POST['design-icon-color'],
            );
        }

        return $this->save_data('site_mode_design_color_section', $color_section_data);

        die();
    }

    public function display_settings_page_cb() {
        $this->display_settings_page('design');
    }

}
