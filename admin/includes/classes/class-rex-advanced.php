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
class Rex_Advanced
{

        protected $ga_id            = '';
        protected $custom_cs        = '';
        protected $enable_rest_api  = false;
        protected $enable_feed      = false;
        protected $include_pages    = '';
        protected $exclude_pages    = '';
        protected $header_code      = '';
        protected $footer_code      = '';
        protected $admin_role       = false;
        protected $editor_role      = false;
        protected $author_role      = false;
        protected $contributor_role = false;
        protected $subscriber_role  = false;
        protected $user_role        = false;

    public function __construct()
    {
        $rex_advanced = get_option('rex_advanced');
        //uniseralize data
        $uns_data = unserialize($rex_advanced);

//        $this->ga_id              = $uns_data['ga_id'];
//        $this->custom_css         = $uns_data['custom_css'];
//        $this->enable_rest_api    = $uns_data['enable_rest_api'];
//        $this->enable_feed        = $uns_data['enable_feed'];
//        $this->include_pages      = $uns_data['include_pages'];
//        $this->exclude_pages      = $uns_data['exclude_pages'];
//        $this->header_code        = $uns_data['header_code'];
//        $this->footer_code        = $uns_data['footer_code'];
//        $this->admin_role         = $uns_data['admin_role'];
//        $this->editor_role        = $uns_data['editor_role'];
//        $this->author_role        = $uns_data['author_role'];
//        $this->contributor_role   = $uns_data['contributor_role'];
//        $this->subscriber_role    = $uns_data['subscriber_role'];
//        $this->user_role          = $uns_data['user_role'];


    }

    public function rex_custom_css_include()
    {
        if (!empty($this->custom_css)) {
            echo '<style type="text/css">' . $this->custom_css . '</style>';
            echo 'custom css test';
        }
    }

    public function header_code_include()
    {
        if (!empty($this->header_code)) {
            echo $this->header_code;
        }
    }

    public function footer_code_include()
    {
        if (!empty($this->footer_code)) {
            echo $this->footer_code;
        }
    }

    public function  ajax_rex_advanced() {

        $nonce = $_POST['advance-custom-message'];
        if(!wp_verify_nonce( $nonce, 'advance-settings-save' )) {
            die(__('Security Check', 'rex-maintenance-mode'));
        }
        else {
            $data = array(
                'ga_id'                 => $_POST['advanced-ga-id-setting'],
                'custom_css'            => $_POST['advanced-custom-css-setting'],
                'enable_rest_api'       => $_POST['advanced-wp-rest-api-setting'],
                'enable_feed'           => $_POST['advanced-wp-feed-setting'],
                'include_pages'         => $_POST['advanced-include-pages-setting'],
                'exclude_pages'         => $_POST['advanced-exclude-pages-setting'],
                'header_code'           => $_POST['advanced-header-code-setting'],
                'footer_code'           => $_POST['advanced-footer-code-setting'],
                'admin_role'            => $_POST['advanced-user-administrator-role-setting'],
                'editor_role'           => $_POST['advanced-user-editor-role-setting'],
                'author_role'           => $_POST['advanced-user-author-role-setting'],
                'contributor_role'      => $_POST['advanced-user-contributor-role-setting'],
                'subscriber_role'       => $_POST['advanced-user-subscriber-role-setting'],
                'user_role'             => array(
                    'administrator' => $_POST['advanced-administrator-role-setting'],
                    'editor'        => $_POST['advanced-editor-role-setting'],
                    'author'        => $_POST['advanced-author-role-setting'],
                    'contributor'   => $_POST['advanced-contributor-role-setting'],
                    'subscriber'    => $_POST['advanced-subscriber-role-setting'],
                ),


            );
        }

        if(get_option( 'rex_advanced' )) {
            update_option('rex_advanced',serialize($data) );
            wp_send_json_success(get_option( 'rex_advanced' ));
        }
        else {
            add_option('rex_advanced',serialize($data));
            wp_send_json_success(get_option( 'rex_advanced' ));
        }
        die();
    }

}