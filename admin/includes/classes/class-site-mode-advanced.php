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
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-settings.php';
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
class Site_Mode_Advanced extends Settings
{
    protected $option_name = 'site_mode_advanced';
        protected  $ga_type = '';
        protected $ga_id            = '';
        protected $fb_id            = '';
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
            $this->ga_type = isset($this->site_mode_advanced['ga_type'] ) ? $this->site_mode_advanced['ga_type']  : '';
            $this->ga_id            = isset($this->site_mode_advanced['ga_id'] ) ? $this->site_mode_advanced['ga_id']  : '';
            $this->fb_id            = isset($this->site_mode_advanced['fb_id'] ) ? $this->site_mode_advanced['fb_id']  : '';
            $this->custom_cs        = isset($this->site_mode_advanced['custom_cs'] ) ? $this->site_mode_advanced['custom_cs']  : '';
            $this->enable_rest_api  = isset($this->site_mode_advanced['enable_rest_api'] ) ? $this->site_mode_advanced['enable_rest_api']  : '';
            $this->enable_feed      = isset($this->site_mode_advanced['enable_feed'] ) ? $this->site_mode_advanced['enable_feed']  : '';
            $this->include_pages    = isset($this->site_mode_advanced['include_pages'] ) ? $this->site_mode_advanced['include_pages']  : '';
            $this->exclude_pages    = isset($this->site_mode_advanced['exclude_pages'] ) ? $this->site_mode_advanced['exclude_pages']  : '';
            $this->header_code      = isset($this->site_mode_advanced['header_code'] ) ? $this->site_mode_advanced['header_code']  : '';
            $this->footer_code      = isset($this->site_mode_advanced['footer_code'] ) ? $this->site_mode_advanced['footer_code']  : '';
            $this->admin_role       = isset($this->site_mode_advanced['admin_role'] ) ? $this->site_mode_advanced['admin_role']  : '';
            $this->editor_role      = isset($this->site_mode_advanced['editor_role'] ) ? $this->site_mode_advanced['editor_role']  : '';
            $this->author_role      = isset($this->site_mode_advanced['author_role'] ) ? $this->site_mode_advanced['author_role']  : '';
            $this->contributor_role = isset($this->site_mode_advanced['contributor_role'] ) ? $this->site_mode_advanced['contributor_role']  : '';
            $this->subscriber_role  = isset($this->site_mode_advanced['subscriber_role'] ) ? $this->site_mode_advanced['subscriber_role']  : '';
            $this->user_role        = isset($this->site_mode_advanced['user_role'] ) ? $this->site_mode_advanced['user_role']  : '';
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
                'fb_id'                 => $_POST['advanced-facebook-id-setting'],
                'custom_css'            => $_POST['advanced-custom-css-setting'],
                'enable_rest_api'       => $_POST['advanced-wp-rest-api-setting'],
                'enable_feed'           => $_POST['advanced-wp-feed-setting'],
                'header_code'           => $_POST['advanced-header-code-setting'],
                'footer_code'           => $_POST['advanced-footer-code-setting'],

            );
        }

        return $this->save_data($this->option_name, $data);

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



//    public function site_mode_google_analytics_code()
//    {
//        if (!empty($this->ga_code)) {
//            echo $this->ga_code;
//        }
//    }

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
        if(!empty($this->fb_id)) { ?>

            <script>
                        !function(f,b,e,v,n,t,s)
              {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                  n.queue=[];t=b.createElement(e);t.async=!0;
                  t.src=v;s=b.getElementsByTagName(e)[0];
                  s.parentNode.insertBefore(t,s)}(window, document,'script',
              'https://connect.facebook.net/en_US/fbevents.js');
              fbq('init', '{<?php echo $this->fb_id; ?>}');
              fbq('track', 'PageView');
            </script>
            <noscript>
              <img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id={your-pixel-id-goes-here}&ev=PageView&noscript=1"/>
            </noscript>
<?php
        }
    }

    public function render() {
        $this->display_settings_page('advanced');
    }


}
