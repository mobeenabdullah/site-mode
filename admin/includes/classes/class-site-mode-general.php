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
class Site_Mode_General extends Settings
{
    protected $option_name = 'site_mode_general';
    protected $enable_site_mode     = array();
    protected $status = false;
    protected $url = '';
    protected $delay = 0;
    protected $login_icon = false;
    protected $login_url = '';
    protected $site_mode_design     = array();
    protected $enable_template      = false;

    public function __construct(){
        $this->site_mode_general = $this->get_data($this->option_name);


        //check if the values are set or not and then assign them to the variables
        $this->status         = isset($this->site_mode_general['status'] ) ? $this->site_mode_general['status']  : '';
        $this->mode           = isset($this->site_mode_general['mode'] ) ? $this->site_mode_general['mode']  : '';
        $this->url            = isset($this->site_mode_general['url'] ) ? $this->site_mode_general['url']  : '';

        $this->site_mode_design = unserialize(get_option('site_mode_design'));
        $this->enable_template = isset($this->site_mode_design['enable_template'] ) ? $this->site_mode_design['enable_template']  : '1';


    }

    public function ajax_site_mode_general() {

       //check  if nonce is valid

//        if ( ! isset( $_POST['general_section_field'] ) || ! wp_verify_nonce( $_POST['general_section_field'], 'general_settings_action' ) ) {
//            wp_send_json_error( 'Invalid nonce' );
//        }
//        else {

             global  $wp_roles;
                foreach ( $wp_roles->roles as $key=>$value ):
                    $user_roles["${key}-role-setting"] = $_POST["site-mode-${key}-role-setting"];
               endforeach;
            $data = array(
                "status"                =>$_POST['site-mode-status-settings'],
                'include_pages'         =>$_POST['site-mode-include-pages-setting'],
                "mode"                  =>$_POST['site-mode-mode-settings'],
                "url"                   =>$_POST['site-mode-redirect-url-settings'],
                'delay'                 =>$_POST['site-mode-delay-settings'],
                'login_icon'            =>$_POST['site-mode-login-icon-setting'],
                'login_url'             =>$_POST['site-mode-login-url-setting'],
                'user_role'             => $user_roles,
            );
//        }

        $this->save_data($this->option_name, $data);
        return $this->save_data($this->option_name, $data);
        die();

    }

    public function load_template_on_call()
    {
        $this->site_mode_general = unserialize(get_option('site_mode_general'));

        if(is_user_logged_in() && isset($_GET['site-mode-preview']) == 'true') {
            esc_html($this->load_templates());
            exit;
        }

        if ( is_user_logged_in()) {

            $current_user = wp_get_current_user();
            $user_roles = $current_user->roles;
            foreach ($this->site_mode_general['user_role'] as $key=>$value){
                if($current_user->roles[0] == $value ) {

                    return;
                }
                else {
                    esc_html($this->load_templates());
                    exit;
                }

            }
        }

        if (!is_user_logged_in()) {

            esc_html($this->load_templates());
            exit;
        }

    }

    public function load_templates()
    {

        if($this->mode==='redirect') {
            if(!empty($this->status) && !empty($this->url)) {
                wp_redirect( $this->url, 301 );
            }
        }
        else if($this->mode==='coming-soon') {
            status_header( 503);
            nocache_headers();
        }
        else if($this->mode === 'maintenance') {
            status_header( 200 );
            nocache_headers();
        }
        else {
            status_header( 200 );
            nocache_headers();
        }
            $this->redirect_to_previous_page();
    }

    public function redirect_to_previous_page()
    {

        $active_template = unserialize(get_option('site_mode_design'));
        $template_preview = isset($_GET['template']) ? $_GET['template'] : '';

        if (is_user_logged_in() && ((isset($_GET['site-mode-preview']) == 'true') && (isset($_GET['template']))) )
        {

            $this->design_active_template($template_preview);

        }
        if (is_user_logged_in() && isset($_GET['site-mode-preview']) == 'true')
        {
            $this->design_active_template($active_template);
        }
        if (!is_user_logged_in() && $this->status === '1')
        {
            $this->design_active_template($active_template);
        }
    }

    public function design_active_template($show_template)
    {

            $templates = array(
                'food_template',
                'construction_template',
                'fashion_template',
                'travel_template'
            );
            foreach ($templates as $template) {
                if ($show_template === $template) {
                    require_once plugin_dir_path(dirname(__DIR__)) . '../public/templates/' . $template . '.php';
                    exit;
                }
            }
    }

    // function to display the template
    public function display_settings_page_cb() {
        $this->display_settings_page('general');
    }

}
