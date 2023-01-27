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
    ?>

        <div class="wrap site_mode__wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <div class="site_mode__wrap--cover">
                <div class="site_mode__wrap--cover-content">
                    <?php
                        require_once plugin_dir_path(dirname(__FILE__)) . 'partials/main-content.php';
                    ?>
                </div>
                <div class="site_mode__wrap--cover-sidebar">
                    <?php require_once plugin_dir_path(dirname(__FILE__)) . 'partials/sidebar.php'; ?>
                </div>
            </div>
        </div>
<?php
    }

    public function site_mode_content_page_html()
    {
        echo 'About page';
    }
}
