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
class Rex_Content
{
    protected $text_logo    = '';
    protected $image_logo   = '';
    protected $disable_logo = false;
    protected $heading      = '';
    protected $sub_heading  = '';
    protected $description  = '';
    protected $bg_image     = '';


    public function __construct()
    {

    }

    public function ajax_rex_content() {

        if(!wp_verify_nonce( $_POST['design-custom-message'], 'design-settings-save' ) || !isset($_POST['design-custom-message'])  || !empty($_POST['design-custom-message']) ) {
            die(__('Security Check', 'rex-maintenance-mode'));
        }
        else {
            $data = array(
                "logo_settings" =>$_POST['content-logo-settings'],
                "image_logo"    =>$_POST['content-image-logo-setting'],
                "text_logo"     =>$_POST['content-text-logo-setting'],
                "heading"       =>$_POST['content-heading-setting'],
                'description'   =>$_POST['content-description-setting'],
                'bg_image'      =>$_POST['content-bg-image-setting'],
            );
        }

        if(get_option( 'rex_content' )) {
            update_option('rex_content',serialize($data));
            wp_send_json_success(get_option( 'rex_content' ));
        }
        else {
            add_option('rex_content',serialize($data));
            wp_send_json_success(get_option( 'rex_content' ));
        }

        die();

    }



}