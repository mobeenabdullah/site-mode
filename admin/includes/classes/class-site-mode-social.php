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
class Site_Mode_Social
{

        protected $show_social = false;
        protected $facebook = '';
        protected $twitter = '';
        protected $linkedin = '';
        protected $youtube = '';
        protected $instagram = '';
        protected $pinterest = '';
        protected $quora = '';
        protected $behance ='';
    public function __construct()
    {

    }

    public function ajax_site_mode_social() {


        $nonce = $_POST['social-custom-message'];
        if(!wp_verify_nonce( $nonce, 'social-settings-save' )) {
            die(__('Security Check', 'site-mode'));
        }
        else {
            $data = array(
                'show_social'       =>$_POST['show-social-icons-setting'],
                'social_fb'         =>$_POST['content-social-fb-setting'],
                'social_twitter'    =>$_POST['content-social-twitter-setting'],
                'social_linkedin'   => $_POST['content-social-linkedin-setting'],
                'social_youtube'    => $_POST['content-social-youtube-setting'],
                'social_instagram'  => $_POST['content-social-instagram-setting'],
                'social_pintrest'   => $_POST['content-social-pintrest-setting'],
                'social_quora'      => $_POST['content-social-quora-setting'],
                'social_behance'    => $_POST['content-social-behance-setting'],
            );
        }

        if(get_option( 'site_mode_social' )) {
            update_option('site_mode_social',serialize($data));
            wp_send_json_success(get_option( 'site_mode_social' ));
        }
        else {
            add_option('site_mode_social',serialize($data));
            wp_send_json_success(get_option( 'site_mode_social' ));
        }

        die();

    }
}

