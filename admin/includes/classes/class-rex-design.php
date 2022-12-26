<?php

/**
 * Responsible for plugin menu
 *
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/includes
 */

/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.0.0
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Rex_Design
{
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


    public function __construct()
    {
//        $template               = get_option('rex_design');
//        $rex_design_lb          = get_option('rex_design_lb');
//        $rex_design_colors      = get_option('rex_design_colors');
//
//        // convert serialized string to array
//        $un_data                = unserialize($template);
//        $lb_data                = unserialize($rex_design_lb);
//        $color_data             = unserialize($rex_design_colors);
//
//        $this->enable_template        = $un_data['enable_template'];
//        $this->logo_width             = $lb_data['logo_width'];
//
//        $this->logo_height            = $lb_data['logo_height'];
//        $this->design_background      = $lb_data['design_background'];
//        $this->background_overlay     = $lb_data['background_overlay'];
//        $this->overlay_color          = $lb_data['overlay_color'];
//        $this->overlay_opacity        = $lb_data['overlay_opacity'];
//
//        $this->icon_size              = $color_data['icon_size'];
//        $this->icon_color             = $color_data['icon_color'];
//        $this->icon_bg_color          = $color_data['icon_bg_color'];
//        $this->icon_border_color      = $color_data['icon_border_color'];


        // convert serialized string to array

        //unserialize data


    }

    public function ajax_rex_design() {

        $nonce = $_POST['design-custom-message'];
        if(!wp_verify_nonce( $nonce, 'design-settings-save' )) {
            die(__('Security Check', 'rex-maintenance-mode'));
        }
        else {
            $data = array(
                'enable_template'     => $_POST['design-template-enable'],
            );
        }

        if(get_option( 'rex_design' )) {
            update_option('rex_design',serialize($data));
            wp_send_json_success(get_option( 'rex_design' ));
        }
        else {
            add_option('rex_design',serialize($data));
            wp_send_json_success(get_option( 'rex_design' ));
        }
        die();
    }
    public function ajax_rex_design_lb() {

        $nonce = $_POST['design-logo-background'];
        if(!wp_verify_nonce( $nonce, 'design-logo-background-settings-save' )) {
            die(__('Security Check', 'rex-maintenance-mode'));
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

        if(get_option( 'rex_design_lb' )) {
            update_option('rex_design_lb',serialize($data));
            wp_send_json_success(get_option( 'rex_design_lb' ));
        }
        else {
            add_option('rex_design_lb',serialize($data));
            wp_send_json_success(get_option( 'rex_design_lb' ));
        }
        die();
    }
    public function ajax_rex_design_color_section() {

        $nonce = $_POST['design-icon-color'];
        if(!wp_verify_nonce( $nonce, 'design-icon-color-settings-save' )) {
            die(__('Security Check', 'rex-maintenance-mode'));
        }
        else {
            $data = array(
                'icon_size'                 => $_POST['icon-size-setting'],
                'icon_color'                => $_POST['icon-color-setting'],
                'icon_bg_color'             => $_POST['icon-bg-setting'],
                'icon_border_color'         => $_POST['icon-border-color-setting'],
            );
        }

        if(get_option( 'rex_design_colors' )) {
            update_option('rex_design_colors',serialize($data));
            wp_send_json_success(get_option( 'rex_design_colors' ));
        }
        else {
            add_option('rex_design_colors',serialize($data));
            wp_send_json_success(get_option( 'rex_design_colors' ));
        }
        die();
    }
}