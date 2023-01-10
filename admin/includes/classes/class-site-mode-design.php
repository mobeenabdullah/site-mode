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
class Site_Mode_Design
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
        protected $status               = '';
        protected $mode                 = '';
        protected $site_mode_general    = array();
        protected $site_mode_design     = array();




    public function __construct(){

        $this->site_mode_design = get_option('site_mode_design');
        $this->site_mode_design = unserialize($this->site_mode_design);
        $this->enable_template = isset($this->site_mode_design['enable_template'] ) ? $this->site_mode_design['enable_template']  : '1';

        $this->site_mode_general =  get_option('site_mode_general');
        $un_data = unserialize($this->site_mode_general);
        //check if the values are set or not and then assign them to the variables
        $this->status         = isset($un_data['status'] ) ? $un_data['status']  : '';
        $this->mode           = isset($un_data['mode'] ) ? $un_data['mode']  : '';
    }

    public function ajax_site_mode_design() {

        $nonce = $_POST['design-custom-message'];
        if(!wp_verify_nonce( $nonce, 'design-settings-save' )) {
            die(__('Security Check', 'site-mode'));
        }
        else {
            $data = array(
                'enable_template'     => $_POST['design-template-enable'],
            );
        }

        if(get_option( 'site_mode_design' )) {
            update_option('site_mode_design',serialize($data));
            wp_send_json_success(get_option( 'site_mode_design' ));
        }
        else {
            add_option('site_mode_design',serialize($data));
            wp_send_json_success(get_option( 'site_mode_design' ));
        }
        die();
    }
    public function ajax_site_mode_design_lb() {

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

        if(get_option( 'site_mode_design_lb' )) {
            update_option('site_mode_design_lb',serialize($data));
            wp_send_json_success(get_option( 'site_mode_design_lb' ));
        }
        else {
            add_option('site_mode_design_lb',serialize($data));
            wp_send_json_success(get_option( 'site_mode_design_lb' ));
        }
        die();
    }

    public function ajax_site_mode_design_font() {

                $data = array(
                    'heading_font_family'               => $_POST['heading-font-family-setting'],
                    'heading_font_size'                 => $_POST['heading-font-size-setting'],
                    'description_font_family'           => $_POST['description-font-family-setting'],
                    'description_font_size'             => $_POST['description-font-size-setting'],


                );

            if(get_option( 'site_mode_design_font' )) {
                update_option('site_mode_design_font',serialize($data));
                wp_send_json_success(get_option( 'site_mode_design_font' ));
            }
            else {
                add_option('site_mode_design_font',serialize($data));
                wp_send_json_success(get_option( 'site_mode_design_font' ));
            }
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

        if(get_option( 'site_mode_design_colors' )) {
            update_option('site_mode_design_colors',serialize($color_section_data));
            wp_send_json_success(get_option( 'site_mode_design_colors' ));
        }
        else {
            add_option('site_mode_design_colors',serialize($color_section_data));
            wp_send_json_success(get_option( 'site_mode_design_colors' ));
        }
        die();
    }

    public function load_template_on_call()
    {
        if (!is_user_logged_in() &&  $this->status == '1' ) {

            esc_html($this->load_templates());
            exit;
        }
        if(is_user_logged_in() && $_GET['site-mode-preview'] == 'true') {
            esc_html($this->load_templates());
            exit;
        }

        if(is_user_logged_in()) {
            esc_html($this->load_templates());
            exit;
        }

    }

    public function load_templates()
    {

        if($this->mode==='redirect') {
            if(!empty($this->status) && !empty($this->url)) {
                wp_redirect( $this->url, 301 );
            }
        }
        else if($this->mode==='coming-soon') {
            status_header( 503);
            nocache_headers();
        }
        else if($this->mode === 'maintenance') {
            status_header( 200 );
            nocache_headers();
        }
        else {
            status_header( 200 );
            nocache_headers();
        }

        if ($this->enable_template == '1' || $_GET['template'] == 'foodTemplate') {
            require_once plugin_dir_path(dirname(__DIR__)) . '../public/templates/template-one.php';
            exit;
        } elseif ($this->enable_template == '2' || $_GET['template'] == 'constructionTemplate') {
            require_once plugin_dir_path(dirname(__DIR__)) . '../public/templates/template-two.php';
            exit;
        } elseif ($this->enable_template == '3' || $_GET['template'] == 'fashionTemplate') {
            require_once plugin_dir_path(dirname(__DIR__)) . '../public/templates/template-three.php';
            exit;
        } elseif ($this->enable_template == '4' || $_GET['template'] == 'travelTemplate') {
            require_once plugin_dir_path(dirname(__DIR__)) . '../public/templates/template-four.php';
            exit;
        } else {
            require_once plugin_dir_path(dirname(__DIR__)) . '../public/templates/template-one.php';
            exit;
        }
    }

}
