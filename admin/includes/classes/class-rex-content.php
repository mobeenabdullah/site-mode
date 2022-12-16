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
//        $content            = get_option('rex_content');
//        //unserialize data
//        $uns_data           = unserialize($content);
//        $this->text_logo    = $uns_data['text_logo'];
//        $this->image_logo   = $uns_data['image_logo'];
//        $this->disable_logo = $uns_data['disable_logo'];
//        $this->heading      = $uns_data['heading'];
//        $this->description  = $uns_data['description'];
//        $this->bg_image     = $uns_data['bg_image'];
    }

    public function ajax_rex_content() {

        $nonce = $_POST['design-custom-message'];

        if(!wp_verify_nonce( $nonce, 'design-settings-save' )) {
            die(__('Security Check', 'rex-maintenance-mode'));
        }
        else {
            $data = array(
                "image_logo"    =>$_POST['content-image-logo-setting'],
                "text_logo"     =>$_POST['content-text-logo-setting'],
                "disable_logo"  =>$_POST['content-logo-settings'],
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