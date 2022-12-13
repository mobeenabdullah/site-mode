<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/admin
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Rex_Maintenance_Mode_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

        add_action('wp_ajax_nopriv_ajax_rex_seo',[$this,'ajax_rex_seo']);
        add_action('wp_ajax_ajax_rex_seo',[$this,'ajax_rex_seo']);

        // general
        add_action('wp_ajax_nopriv_ajax_rex_general', [$this,'ajax_rex_general']);
        add_action('wp_ajax_ajax_rex_general', [$this,'ajax_rex_general']);

        // content
        add_action('wp_ajax_nopriv_ajax_rex_content', [$this,'ajax_rex_content']);
        add_action('wp_ajax_ajax_rex_content', [$this,'ajax_rex_content']);

        //social

        // content
        add_action('wp_ajax_nopriv_ajax_rex_social', [$this,'ajax_rex_social']);
        add_action('wp_ajax_ajax_rex_social', [$this,'ajax_rex_social']);


        // Design
        add_action('wp_ajax_nopriv_ajax_rex_design', [$this,'ajax_rex_design']);
        add_action('wp_ajax_ajax_rex_design', [$this,'ajax_rex_design']);

        add_action('wp_ajax_nopriv_ajax_rex_design_lb', [$this,'ajax_rex_design_lb']);
        add_action('wp_ajax_nopriv_ajax_rex_design_color_section', [$this,'ajax_rex_design_color_section']);
        add_action('wp_ajax_ajax_rex_design_color_section', [$this,'ajax_rex_design_color_section']);
        add_action('wp_ajax_ajax_rex_design_color_section', [$this,'ajax_rex_design_color_section']);

        // advance
        add_action('wp_ajax_nopriv_ajax_rex_advanced', [$this,'ajax_rex_advanced']);
        add_action('wp_ajax_ajax_rex_advanced', [$this,'ajax_rex_advanced']);

    // export
        add_action('wp_ajax_nopriv_ajax_rex_export', [$this,'ajax_rex_export']);
        add_action('wp_ajax_ajax_rex_export', [$this,'ajax_rex_export']);

        // import
        add_action('wp_ajax_nopriv_ajax_rex_import', [$this,'ajax_rex_import']);
        add_action('wp_ajax_ajax_rex_import', [$this,'ajax_rex_import']);




        add_action('admin_enqueue_scripts', [$this,'enqueue_media']);

    }

    public function enqueue_media() {
        if( function_exists( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }
    }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rex_Maintenance_Mode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rex_Maintenance_Mode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'assets/css/rex-maintenance-mode-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rex_Maintenance_Mode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rex_Maintenance_Mode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        //enqueue jquery
        wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-draggable', array('jquery'), $this->version, false);
        if (!did_action('wp_enqueue_media')) {
            wp_enqueue_media();
        }
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'assets/js/rex-maintenance-mode-admin.js', array('jquery'), $this->version, false);
        wp_localize_script( $this->plugin_name,'ajaxObj',array(
            'ajax_url'      => admin_url( 'admin-ajax.php' ),
            'ajax_nonce'    =>wp_create_nonce('rex_nonce_field'),
        ));

    }

    public function rex_seralize($data) {
        $se_data = serialize($data);
        return $se_data;
    }

    public function ajax_rex_general() {

        $nonce = $_POST['general_section_field'];

      if(!wp_verify_nonce( $nonce, 'general_settings_action' )) {
        die(__('Security Check', 'rex-maintenance-mode'));
      }
      else {
          $data = array(
              "status"      =>$_POST['wprex-status-settings'],
              "mode"        =>$_POST['wprex-mode-settings'],
              "url"         =>$_POST['wprex-redirect-url-settings'],
              'delay'       =>$_POST['wprex-delay-settings'],
              'login_icon'  =>$_POST['wprex-login-icon-setting'],
              'login_url'   =>$_POST['wprex-login-url-setting'],
          );
      }

        if(get_option( 'rex_general' )) {
            update_option('rex_general',$this->rex_seralize($data) );
            wp_send_json_success(get_option( 'rex_general' ));
        }
        else {
            add_option('rex_general',$this->rex_seralize($data));
            wp_send_json_success(get_option( 'rex_general' ));
        }

        die();

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
            update_option('rex_content',$this->rex_seralize($data) );
            wp_send_json_success(get_option( 'rex_content' ));
        }
        else {
            add_option('rex_content',$this->rex_seralize($data));
            wp_send_json_success(get_option( 'rex_content' ));
        }

        die();

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
            update_option('rex_social',$this->rex_seralize($data) );
            wp_send_json_success(get_option( 'rex_social' ));
        }
        else {
            add_option('rex_social',$this->rex_seralize($data));
            wp_send_json_success(get_option( 'rex_social' ));
        }

        die();

    }

    public function ajax_rex_design() {

        $nonce = $_POST['design-custom-message'];
        if(!wp_verify_nonce( $nonce, 'design-settings-save' )) {
            die(__('Security Check', 'rex-maintenance-mode'));
        }
        else {
            $data = array(
                'enable_template'     => $_POST['design-template-enable'],
            );
        }

        if(get_option( 'rex_design' )) {
            update_option('rex_design',$this->rex_seralize($data) );
            wp_send_json_success(get_option( 'rex_design' ));
        }
        else {
            add_option('rex_design',$this->rex_seralize($data));
            wp_send_json_success(get_option( 'rex_design' ));
        }
        die();
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
                update_option('rex_advanced',$this->rex_seralize($data) );
                wp_send_json_success(get_option( 'rex_advanced' ));
            }
            else {
                add_option('rex_advanced',$this->rex_seralize($data));
                wp_send_json_success(get_option( 'rex_advanced' ));
            }
            die();
    }

    public function ajax_rex_export() {
        $advance = get_option('rex_advanced');
        $content = get_option('rex_content');
        $design = get_option('rex_design');
        $rex_design_lb = get_option('rex_design_lb');
        $rex_design_colors = get_option('rex_design_colors');
        $seo = get_option('rex_seo');
        $social = get_option('rex_social');
        $settings = get_option('rex_settings');
        $general = get_option('rex_general');

        $data = array(
            'advance'   => $advance,
            'content'   => $content,
            'design'    => $design,
            'seo'       => $seo,
            'social'    => $social,
            'settings'  => $settings,
            'general'   => $general,
        );

        $json = json_encode($data);
        if(file_put_contents(plugin_dir_path(__FILE__) . "export.json", $json)) {
            echo $json;
            $filename = plugin_dir_path(__FILE__) . "export.json";
            //Clear the cache
            wp_send_json_success($filename);
            clearstatcache();

            if (file_exists($filename)) {
            // delete the file


            }
            else {
                //generate error message
                wp_send_json_error("File not found");
            }
        }
        else {
            echo 'error';
        }

        $file = plugin_dir_path(__FILE__) . "export.json";
        die();

    }

    // import JSON file
    public function ajax_rex_import() {


//        $data = file_get_contents(plugin_dir_path(__FILE__) . "export.json");
//        $data = json_decode($data, true);

//        wp_send_json_success($_FILES);
        $file = $_FILES['json-file']['tmp_name'];
        $data = file_get_contents($file);
        $data = json_decode($data, true);
//        wp_send_json_success($data);
            $advance = $data['advance'];
            $content = $data['content'];
            $design = $data['design'];
            $rex_design_lb = $data['rex_design_lb'];
            $rex_design_colors = $data['rex_design_colors'];
            $seo = $data['seo'];
            $social = $data['social'];
            $settings = $data['settings'];
            $general = $data['general'];

            update_option('rex_advanced',$advance);
            update_option('rex_content',$content);
            update_option('rex_design',$design);
            update_option('rex_design_lb',$rex_design_lb);
            update_option('rex_design_colors',$rex_design_colors);
            update_option('rex_seo',$seo);
            update_option('rex_social',$social);
            update_option('rex_settings',$settings);
            update_option('rex_general',$general);


            wp_send_json_success($data);
//        }
        die();
    }


    //  design  logo and backgroun settings
    public function ajax_rex_design_lb() {

        $nonce = $_POST['design-logo-background'];
        if(!wp_verify_nonce( $nonce, 'design-logo-background-settings-save' )) {
            die(__('Security Check', 'rex-maintenance-mode'));
        }
        else {
            $data = array(
                'logo_width'            => $_POST['logo-width-setting'],
                'logo_height'           => $_POST['logo-height-setting'],
                'design_background'     => $_POST['design-background-setting'],
                'background_overlay'    => $_POST['design-background-overlay-setting'],
                'overlay_color'         => $_POST['overlay-color-setting'],
                'overlay_opacity'       => $_POST['overlay-opacity-setting'],
            );
        }

        if(get_option( 'rex_design_lb' )) {
            update_option('rex_design_lb',$this->rex_seralize($data) );
            wp_send_json_success(get_option( 'rex_design_lb' ));
        }
        else {
            add_option('rex_design_lb',$this->rex_seralize($data));
            wp_send_json_success(get_option( 'rex_design_lb' ));
        }
        die();
    }
    public function ajax_rex_design_color_section() {

        $nonce = $_POST['design-icon-color'];
        if(!wp_verify_nonce( $nonce, 'design-icon-color-settings-save' )) {
            die(__('Security Check', 'rex-maintenance-mode'));
        }
        else {
            $data = array(
                'icon_size'            => $_POST['icon-size-setting'],
                'icon_color'           => $_POST['icon-color-setting'],
                'icon_bg_color'              => $_POST['icon-bg-setting'],
                'icon_border_color'    => $_POST['icon-border-color-setting'],
            );
        }

        if(get_option( 'rex_design_colors' )) {
            update_option('rex_design_colors',$this->rex_seralize($data) );
            wp_send_json_success(get_option( 'rex_design_colors' ));
        }
        else {
            add_option('rex_design_colors',$this->rex_seralize($data));
            wp_send_json_success(get_option( 'rex_design_colors' ));
        }
        die();
    }

}
