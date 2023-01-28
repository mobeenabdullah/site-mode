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
	    $this->whitelist_pages      = $this->site_mode_general['whitelist_pages'] || [];
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

        return $this->save_data($this->option_name, $data);

        wp_die();
    }

    // function to display the template
    public function render() {
        $this->display_settings_page('general');
    }
}
