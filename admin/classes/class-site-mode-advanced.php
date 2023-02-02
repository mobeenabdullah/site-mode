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
class Site_Mode_Advanced extends Settings {
        protected $option_name          = 'site_mode_advanced';
        protected  $ga_type;
        protected $ga_id;
        protected $fb_id;
        protected $custom_css;
        protected $enable_rest_api;
        protected $enable_feed;
        protected $header_code;
        protected $footer_code;
        protected $site_mode_advanced   = [];

    public function __construct() {
        $this->site_mode_advanced = unserialize(get_option('site_mode_advanced'));
        if($this->site_mode_advanced) {
            $this->ga_type          = isset($this->site_mode_advanced['ga_type']) ? $this->site_mode_advanced['ga_type'] : '1';
            $this->ga_id            = isset($this->site_mode_advanced['ga_id']) ? $this->site_mode_advanced['ga_id'] : '';
            $this->fb_id            = isset($this->site_mode_advanced['fb_id']) ? $this->site_mode_advanced['fb_id'] : '';
            $this->custom_css       = isset($this->site_mode_advanced['custom_css']) ? $this->site_mode_advanced['custom_css'] : '';
            $this->enable_rest_api  = isset($this->site_mode_advanced['enable_rest_api']) ? $this->site_mode_advanced['enable_rest_api'] : '1';
            $this->enable_feed      = isset($this->site_mode_advanced['enable_feed']) ? $this->site_mode_advanced['enable_feed'] : '1';
            $this->header_code      = isset($this->site_mode_advanced['header_code']) ? $this->site_mode_advanced['header_code'] : '';
            $this->footer_code      = isset($this->site_mode_advanced['footer_code']) ? $this->site_mode_advanced['footer_code'] : '';

        }
    }

    public function site_mode_remove_rss_feed() {
        wp_die( 'RSS feed is disabled' );
    }



    public function site_mode_custom_css_include() {
        if (!empty($this->custom_css)) {
          echo  esc_html($this->custom_css);
        }
    }
    public function header_code_include() {
        if (!empty($this->header_code)) {
            echo esc_html($this->header_code);
        }
    }

    public function footer_code_include() {
        if (!empty($this->footer_code)) {
            echo esc_html($this->footer_code);
        }
    }
    public function  ajax_site_mode_advanced() {
        $nonce = isset($_POST['nonce']) ? $_POST['nonce'] : '';
        if(!wp_verify_nonce( $nonce, 'advance-settings-save' ) || empty($nonce)) {
            wp_die('Security Check');
        }
        else {
            // validate using isset and sanitize inputs before storing in database.
            $data = array();
            if(isset($_POST['advanced-ga-type-setting'])){
                $data['ga_type'] = sanitize_text_field($_POST['advanced-ga-type-setting']);
            }
            if(isset($_POST['advanced-ga-id-setting'])){
                $data['ga_id'] = sanitize_text_field($_POST['advanced-ga-id-setting']);
            }
            if(isset($_POST['advanced-facebook-id-setting'])){
                $data['fb_id'] = sanitize_text_field($_POST['advanced-facebook-id-setting']);
            }
            if(isset($_POST['advanced-custom-css-setting'])){
                $data['custom_css'] = sanitize_textarea_field($_POST['advanced-custom-css-setting']);
            }
            if(isset($_POST['advanced-wp-rest-api-setting'])){
                $data['enable_rest_api'] = sanitize_text_field($_POST['advanced-wp-rest-api-setting']);
            }
            if(isset($_POST['advanced-wp-feed-setting'])){
                $data['enable_feed'] = sanitize_text_field($_POST['advanced-wp-feed-setting']);
            }
            if(isset($_POST['advanced-header-code-setting'])){
                $data['header_code'] = sanitize_textarea_field($_POST['advanced-header-code-setting']);
            }
            if(isset($_POST['advanced-footer-code-setting'])){
                $data['footer_code'] = sanitize_textarea_field($_POST['advanced-footer-code-setting']);
            }

        }

        return $this->save_data($this->option_name, $data);

        wp_die();
    }

    public function site_mode_rest_api($access) {
        if (empty($this->enable_rest_api)) {
            return $access;
        } else {
            return new WP_Error('rest_cannot_access', __('The REST API on this site has been disabled.', 'site-mode'), array('status' => rest_authorization_required_code()));
        }
    }

    public function site_mode_google_analytics_id() {
        if (!empty($this->ga_id)) {?>

            <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($this->ga_id); ?>"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', '<?php echo esc_attr($this->ga_id); ?>');
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
              fbq('init', '{<?php echo esc_attr($this->fb_id); ?>}');
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
