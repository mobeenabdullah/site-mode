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
class Rex_Social
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

//        // get data from database
//        $social = get_option('rex_social');
//        // unserialize data
//        $uns_data = unserialize($social);
//        $this->show_social = $uns_data['show_social'];
//        $this->facebook = $uns_data['social_fb'];
//        $this->twitter = $uns_data['social_twitter'];
//        $this->linkedin = $uns_data['social_linkedin'];
//        $this->youtube = $uns_data['social_youtube'];
//        $this->instagram = $uns_data['social_instagram'];
//        $this->pinterest = $uns_data['social_pintrest'];
//        $this->quora = $uns_data['social_quora'];
//        $this->behance = $uns_data['social_behance'];
    }

    public function ajax_rex_social() {


        $nonce = $_POST['social-custom-message'];
        if(!wp_verify_nonce( $nonce, 'social-settings-save' )) {
            die(__('Security Check', 'rex-maintenance-mode'));
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

        if(get_option( 'rex_social' )) {
            update_option('rex_social',serialize($data));
            wp_send_json_success(get_option( 'rex_social' ));
        }
        else {
            add_option('rex_social',serialize($data));
            wp_send_json_success(get_option( 'rex_social' ));
        }

        die();

    }
}


