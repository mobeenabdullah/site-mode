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

    protected $status = false;
    protected $url = '';
    protected $delay = 0;
    protected $login_icon = false;
    protected $login_url = '';

    public function __construct(){

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

}
