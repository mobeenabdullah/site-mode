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
class Site_Mode_Content
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

    public function ajax_site_mode_content() {
        wp_nonce_field('design-settings-save', 'design-custom-message');
        if(!wp_verify_nonce( $_POST['design-custom-message'], 'design-settings-save' ) ) {
            die(__('Security Check', 'site-mode'));
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

        if(get_option( 'site_mode_content' )) {
            update_option('site_mode_content',serialize($data));
            wp_send_json_success(get_option( 'site_mode_content' ));
        }
        else {
            add_option('site_mode_content',serialize($data));
            wp_send_json_success(get_option( 'site_mode_content' ));
        }

        die();

    }



}