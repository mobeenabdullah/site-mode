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
            $data = array(
                "status"      =>$_POST['site-mode-status-settings'],
                "mode"        =>$_POST['site-mode-mode-settings'],
                "url"         =>$_POST['site-mode-redirect-url-settings'],
                'delay'       =>$_POST['site-mode-delay-settings'],
                'login_icon'  =>$_POST['site-mode-login-icon-setting'],
                'login_url'   =>$_POST['site-mode-login-url-setting'],
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


    public function redirect_status_code() {

        if($this->mode==='redirect') {
            if(!empty($this->status) && !empty($this->url)) {
//                wp_redirect( $this->url, 301 );
                exit;
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

    }

}
