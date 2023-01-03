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
class Site_Mode_Advanced
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
        protected $site_mode_advanced     = array();

    public function __construct()
    {
        $this->site_mode_advanced = get_option('site_mode_advanced');
        $this->site_mode_advanced = unserialize($this->site_mode_advanced);
        if($this->site_mode_advanced) {
            $this->ga_id            = $this->site_mode_advanced['ga_id'];
            $this->custom_cs        = $this->site_mode_advanced['custom_css'];
            $this->enable_rest_api  = $this->site_mode_advanced['enable_rest_api'];
            $this->enable_feed      = $this->site_mode_advanced['enable_feed'];
            $this->include_pages    = $this->site_mode_advanced['include_pages'];
            $this->exclude_pages    = $this->site_mode_advanced['exclude_pages'];
            $this->header_code      = $this->site_mode_advanced['header_code'];
            $this->footer_code      = $this->site_mode_advanced['footer_code'];
            $this->admin_role       = $this->site_mode_advanced['admin_role'];
            $this->editor_role      = $this->site_mode_advanced['editor_role'];
            $this->author_role      = $this->site_mode_advanced['author_role'];
            $this->contributor_role = $this->site_mode_advanced['contributor_role'];
            $this->subscriber_role  = $this->site_mode_advanced['subscriber_role'];
            $this->user_role        = $this->site_mode_advanced['user_role'];
        }


    }

    public function site_mode_remove_rss_feed()
    {
        wp_die( __('No RSS FEEDS <a href="'. get_bloginfo('url') .'">homepage</a>!') );
    }



    public function site_mode_custom_css_include()
    {
        if (!empty($this->custom_css)) {
          echo  $this->custom_css;

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
    public function  ajax_site_mode_advanced() {
        
        $nonce = $_POST['advance-custom-message'];
        if(!wp_verify_nonce( $nonce, 'advance-settings-save' )) {
            die(__('Security Check', 'site-mode'));
        }
        else {
            $data = array(
                'ga_type'               => $_POST['advanced-analytics-type-setting'],
                'ga_id'                 => $_POST['advanced-ga-id-setting'],
                'ga_code'               => $_POST['advanced-ga-code-setting'],
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

        if(get_option( 'site_mode_advanced' )) {
            update_option('site_mode_advanced',serialize($data) );
            wp_send_json_success(get_option( 'site_mode_advanced' ));
        }
        else {
            add_option('site_mode_advanced',serialize($data));
            wp_send_json_success(get_option( 'site_mode_advanced' ));
        }
        die();
    }

    public function site_mode_rest_api($access)
    {
        if (empty($this->enable_rest_api)) {
            return $access;
        } else {
            return new WP_Error('rest_cannot_access', __('The REST API on this site has been disabled.', 'site-mode'), array('status' => rest_authorization_required_code()));
        }
    }



    public function site_mode_google_analytics_code()
    {
        if (!empty($this->ga_code)) {
            echo $this->ga_code;
        }
    }

    public function site_mode_google_analytics_id()
    {
        if (!empty($this->ga_id)) {?>

            <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $this->ga_id; ?>"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', '<?php echo $this->ga_id; ?>');
            </script>

        <?php
        }
    }


}