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
class Site_Mode_Menu {

    public function __constructor() {

    }

    public function site_mode_menu() {
        add_menu_page(
            __('Site Mode Settings', 'site-mode'),
            'Site Mode',
            'manage_options',
            'site-mode',
            [$this, 'site_mode_settings_page_cb'],
            'dashicons-welcome-add-page',
        );
    }

    public function site_mode_submenu_settings_page() {
        add_submenu_page(
            'site-mode',
            'Site Mode',
            'Settings',
            'manage_options',
            'site-mode',
            [$this, 'site_mode_settings_page_cb']
        );
        add_submenu_page(
            'site-mode',
            'about',
            'About',
            'manage_options',
            'site-mode-about',
            [$this, 'site_mode_content_page_html']
        );
    }

    public function site_mode_settings_page_cb() {
        if (!current_user_can('manage_options')) {
            return;
        }
	    require_once plugin_dir_path(dirname(__FILE__)) . 'partials/settings-layout.php';
    }

    public function site_mode_content_page_html() {
        echo 'About page';
    }
}
