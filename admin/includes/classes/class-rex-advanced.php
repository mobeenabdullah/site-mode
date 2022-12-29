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
        protected $rex_advanced     = array();

    public function __construct()
    {
        $this->rex_advanced = get_option('rex_advanced');
        $this->rex_advanced = unserialize($this->rex_advanced);
        if($this->rex_advanced) {
            $this->ga_id            = $this->rex_advanced['ga_id'];
            $this->custom_cs        = $this->rex_advanced['custom_css'];
            $this->enable_rest_api  = $this->rex_advanced['enable_rest_api'];
            $this->enable_feed      = $this->rex_advanced['enable_feed'];
            $this->include_pages    = $this->rex_advanced['include_pages'];
            $this->exclude_pages    = $this->rex_advanced['exclude_pages'];
            $this->header_code      = $this->rex_advanced['header_code'];
            $this->footer_code      = $this->rex_advanced['footer_code'];
            $this->admin_role       = $this->rex_advanced['admin_role'];
            $this->editor_role      = $this->rex_advanced['editor_role'];
            $this->author_role      = $this->rex_advanced['author_role'];
            $this->contributor_role = $this->rex_advanced['contributor_role'];
            $this->subscriber_role  = $this->rex_advanced['subscriber_role'];
            $this->user_role        = $this->rex_advanced['user_role'];
        }

        add_action('do_feed',array($this,'rex_feed'), 1);
        add_action('do_feed_rdf',array($this,'rex_feed'), 1);
        add_action('do_feed_rss',array($this,'rex_feed'), 1);
        add_action('do_feed_rss2',array($this,'rex_feed'), 1);
        add_action('do_feed_atom',array($this,'rex_feed'), 1);
        add_action('do_feed_rss2_comments',array($this,'rex_feed'), 1);
        add_action('do_feed_atom_comments',array($this,'rex_feed'), 1);

    }

    public function rex_custom_css_include()
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
    public function  ajax_rex_advanced() {
        
        $nonce = $_POST['advance-custom-message'];
        if(!wp_verify_nonce( $nonce, 'advance-settings-save' )) {
            die(__('Security Check', 'rex-maintenance-mode'));
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

    public function rex_rest_api($access)
    {
        if (empty($this->enable_rest_api)) {
            return $access;
        } else {
            return new WP_Error('rest_cannot_access', __('The REST API on this site has been disabled.', 'rex-maintenance-mode'), array('status' => rest_authorization_required_code()));
        }
    }

    public function rex_feed()
    {
        return new WP_Error('feed_cannot_access', __('The Feed on this site has been disabled.', 'rex-maintenance-mode'), array('status' => rest_authorization_required_code()));

//        if (empty($this->enable_feed)) {
//            return;
//        } else {
//            return new WP_Error('feed_cannot_access', __('The Feed on this site has been disabled.', 'rex-maintenance-mode'), array('status' => rest_authorization_required_code()));
//        }
    }

    public function rex_google_analytics_code()
    {
        if (!empty($this->ga_code)) {
            echo $this->ga_code;
        }
    }

    public function rex_google_analytics_id()
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