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
class Rex_General
{

    protected $status = false;
    protected $url = '';
    protected $delay = 0;
    protected $login_icon = false;
    protected $login_url = '';

    public function __construct()
    {
//        $general = get_option('rex_general');
//        if(!empty($general)){
//            $un_data = unserialize($general);
//            $this->status       = ($un_data['status']) ? true : false;
//            $this->url          = ($un_data['url']) ? $un_data['url'] : '';
//            $this->delay        = ($un_data['delay']) ? $un_data['delay'] : 0;
//            $this->login_icon   = ($un_data['login_icon']) ? true : false;
//            $this->login_url    = ($un_data['login_url']) ? $un_data['login_url'] : '';
//        }
    }

    public function ajax_rex_general() {

        $nonce = $_POST['general_section_field'];

        if(!wp_verify_nonce( $nonce, 'general_settings_action' )) {
            die(__('Security Check', 'rex-maintenance-mode'));
        }
        else {
            $data = array(
                "status"      =>$_POST['wprex-status-settings'],
                "mode"        =>$_POST['wprex-mode-settings'],
                "url"         =>$_POST['wprex-redirect-url-settings'],
                'delay'       =>$_POST['wprex-delay-settings'],
                'login_icon'  =>$_POST['wprex-login-icon-setting'],
                'login_url'   =>$_POST['wprex-login-url-setting'],
            );
        }

        if(get_option( 'rex_general' )) {
            update_option('rex_general',serialize($data));
            wp_send_json_success(get_option( 'rex_general' ));
        }
        else {
            add_option('rex_general',serialize($data));
            wp_send_json_success(get_option( 'rex_general' ));
        }

        die();

    }
}
