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
class Rex_Seo
{



    public function __construct()
    {
    }

    public function ajax_rex_seo() {


        $nonce = $_POST['seo-custom-message'];
        if(!wp_verify_nonce( $nonce, 'seo-settings-save' )) {
            die(__('Security Check', 'rex-maintenance-mode'));
        }
        else {
            $data = array(
                'meta_title'            => $_POST['soe-meta-title-setting'],
                'meta_description'       => $_POST['soe-meta-description-setting'],
                'meta_favicon'          => $_POST['soe-meta-favicon-setting'],
                'meta_image'            => $_POST['soe-meta-image-setting'],
            );
        }

        if(get_option( 'rex_seo' )) {
            update_option('rex_seo',$this->rex_seralize($data) );
            wp_send_json_success(get_option( 'rex_seo' ));
        }
        else {
            add_option('rex_seo',$this->rex_seralize($data));
            wp_send_json_success(get_option( 'rex_seo' ));
        }
        die();
    }
}