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
class Site_Mode_Seo
{



    public function __construct(){}

    public function ajax_site_mode_seo() {

        $nonce = $_POST['seo-custom-message'];
        if(!wp_verify_nonce( $nonce, 'seo-settings-save' )) {
            die(__('Security Check', 'site-mode'));
        }
        else {
            $data = array(
                'meta_title'            => $_POST['soe-meta-title-setting'],
                'meta_description'       => $_POST['soe-meta-description-setting'],
                'meta_favicon'          => $_POST['soe-meta-favicon-setting'],
                'meta_image'            => $_POST['soe-meta-image-setting'],
            );
        }

        if(get_option( 'site_mode_seo' )) {
            update_option('site_mode_seo',serialize($data) );
            wp_send_json_success(get_option( 'site_mode_seo' ));
        }
        else {
            add_option('site_mode_seo',serialize($data));
            wp_send_json_success(get_option( 'site_mode_seo' ));
        }
        die();
    }
}
