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
class Site_Mode_General extends Settings {
    protected $option_name = 'site_mode_general';

	protected $mode_status;

    protected $mode_type;
    protected $redirect_url;
    protected $redirect_delay;
    protected $show_login_icon;
    protected $custom_login_url;
	protected $whitelist_pages;
	protected $user_roles;


    public function __construct() {
        $this->site_mode_general    = $this->get_data($this->option_name);



        $this->mode_status          = $this->site_mode_general['mode_status'];
        $this->mode_type            = $this->site_mode_general['mode_type'];
        $this->redirect_url         = $this->site_mode_general['redirect_url'];
	    $this->redirect_delay       = $this->site_mode_general['redirect_delay'];
	    $this->show_login_icon      = $this->site_mode_general['show_login_icon'];
	    $this->custom_login_url     = $this->site_mode_general['custom_login_url'];
	    $this->whitelist_pages      = $this->site_mode_general['whitelist_pages'];
	    $this->user_roles           = $this->site_mode_general['user_roles'];
    }

    public function ajax_site_mode_general() {
	    $this->verify_nonce('general_section_field', 'general_settings_action');

        $data = [
            "mode_status"           => $_POST['site-mode-mode-status'],
            "mode_type"             => $_POST['site-mode-mode-type'],
            "redirect_url"          => $_POST['site-mode-redirect-url'],
            'redirect_delay'        => $_POST['site-mode-redirect-delay'],
            'show_login_icon'       => $_POST['site-mode-show-login-icon'],
            'custom_login_url'      => $_POST['site-mode-custom-login-url'],
	        'whitelist_pages'       => $_POST['site-mode-whitelist-pages'],
            'user_roles'            => $_POST['site-mode-user-roles']
        ];

        $this->save_data($this->option_name, $data);
        return $this->save_data($this->option_name, $data);
        wp_die();

    }

    public function load_template_on_call() {
        $this->site_mode_general = unserialize(get_option('site_mode_general'));

        if(is_user_logged_in() && isset($_GET['site-mode-preview']) == 'true') {
            esc_html($this->load_templates());
            exit;
        }

        if ( is_user_logged_in()) {

            $current_user = wp_get_current_user();
            $user_roles = $current_user->roles;
            foreach ($this->site_mode_general['user_roles'] as $key=>$value){
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

    public function load_templates() {

        if($this->mode_type === 'redirect') {
            if(!empty($this->mode_status) && !empty($this->redirect_url)) {
                wp_redirect( $this->url, 301 );
            }
        }
        else if($this->mode_type === 'coming-soon') {
            status_header( 503);
            nocache_headers();
        }
        else if($this->mode_type === 'maintenance') {
            status_header( 200 );
            nocache_headers();
        }
        else {
            status_header( 200 );
            nocache_headers();
        }
            $this->redirect_to_previous_page();
    }

    public function redirect_to_previous_page() {

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

    public function design_active_template($show_template) {

        $templates = array(
            'food_template',
            'construction_template',
            'fashion_template',
            'travel_template'
        );
        foreach ($templates as $template) {
            if ($show_template === $template) {
                require_once plugin_dir_path(dirname(__DIR__)) . 'public/templates/' . $template . '.php';
                exit;
            }
        }
    }

    // function to display the template
    public function render() {
        $this->display_settings_page('general');
    }
}
