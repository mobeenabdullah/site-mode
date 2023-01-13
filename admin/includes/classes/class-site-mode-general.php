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
class Site_Mode_General
{
    protected $enable_site_mode     = array();
    protected $status = false;
    protected $url = '';
    protected $delay = 0;
    protected $login_icon = false;
    protected $login_url = '';

    public function __construct(){
        $this->site_mode_general = get_option('site_mode_general');
        $un_data                 = unserialize($this->site_mode_general);

        //check if the values are set or not and then assign them to the variables
        $this->status         = isset($un_data['status'] ) ? $un_data['status']  : '';
        $this->mode           = isset($un_data['mode'] ) ? $un_data['mode']  : '';
        $this->url            = isset($un_data['url'] ) ? $un_data['url']  : '';

    }

    public function ajax_site_mode_general() {

       //check  if nonce is valid

        if ( ! isset( $_POST['general_section_field'] ) || ! wp_verify_nonce( $_POST['general_section_field'], 'general_settings_action' ) ) {
            wp_send_json_error( 'Invalid nonce' );
        }
        else {

             global  $wp_roles;
                foreach ( $wp_roles->roles as $key=>$value ):
                    $user_roles["${key}-role-setting"] = $_POST["site-mode-${key}-role-setting"];
               endforeach;
            $data = array(
                "status"                =>$_POST['site-mode-status-settings'],
                'include_pages'         =>$_POST['site-mode-include-pages-setting'],
                "mode"                  =>$_POST['site-mode-mode-settings'],
                "url"                   =>$_POST['site-mode-redirect-url-settings'],
                'delay'                 =>$_POST['site-mode-delay-settings'],
                'login_icon'            =>$_POST['site-mode-login-icon-setting'],
                'login_url'             =>$_POST['site-mode-login-url-setting'],
                'user_role'             => $user_roles,
            );
        }

        if(get_option( 'site_mode_general' )) {
            update_option('site_mode_general',serialize($data));
            wp_send_json_success(get_option( 'site_mode_general' ));
        }
        else {
            add_option('site_mode_general',serialize($data));
            wp_send_json_success(get_option( 'site_mode_general' ));
        }
        die();

    }

    public function load_template_on_call()
    {
        $this->site_mode_general = get_option('site_mode_general');
        $un_data                 = unserialize($this->site_mode_general);
        if ( $this->status == '1' ) {

            $current_user = wp_get_current_user();
            $user_roles = $current_user->roles;
            if ($user_roles[0] != $un_data['user_role']["administrator-role-setting"]) {
//                $this->loader->add_action('template_redirect', $this->classes_loader->get_general(), 'load_template_on_call');


            } else {
                echo 'no';
            }
        }

        if (!is_user_logged_in()) {

            esc_html($this->load_templates());
            exit;
        }
        if(is_user_logged_in() && isset($_GET['site-mode-preview']) == 'true') {
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

        if ($this->enable_template == '1' || $_GET['template'] == 'food_template') {
            require_once plugin_dir_path(dirname(__DIR__)) . '../public/templates/template-one.php';
            exit;
        } elseif ($this->enable_template == '2' || $_GET['template'] == 'construction_template') {
            require_once plugin_dir_path(dirname(__DIR__)) . '../public/templates/template-two.php';
            exit;
        } elseif ($this->enable_template == '3' || $_GET['template'] == 'fashionTemplate') {
            require_once plugin_dir_path(dirname(__DIR__)) . '../public/templates/template-three.php';
            exit;
        } elseif ($this->enable_template == '4' || $_GET['template'] == 'travel_template') {
            require_once plugin_dir_path(dirname(__DIR__)) . '../public/templates/template-four.php';
            exit;
        } else {
            require_once plugin_dir_path(dirname(__DIR__)) . '../public/templates/template-one.php';
            exit;
        }
    }

}
