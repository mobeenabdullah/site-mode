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
class Rex_Maintenance_Mode_Menu
{
    public function  __construct() {

    }
    
    public function rex_maintenance_mode_menu() {
        add_menu_page(
            __('REX Maintenance Mode Settings', 'rex-maintenance-mode'),
            'Maintenance Mode by WPRex',
            'manage_options',
            'wprex-maintenance-mode',
            [$this, 'rex_maintenance_mode_settings_page_cb'],
            'dashicons-welcome-add-page',
        );
    }

    public function add_page() {

    }

    public function rex_maintenance_mode_submenu_settings_page() {
        add_submenu_page(
            'wprex-maintenance-mode',
            'Maintenance Mode by WPRex',
            'Settings',
            'manage_options',
            'wprex-maintenance-mode',
            [$this, 'rex_maintenance_mode_settings_page_cb']
        );

        add_submenu_page(
            'wprex-maintenance-mode',
            'about',
            'About',
            'manage_options',
            'rex-maintenance-mode-about',
            [$this, 'rex_maintenance_mode_content_page_html']
        );
    }

    public function rex_maintenance_mode_settings_page_cb() {
        if (!current_user_can('manage_options')) {
            return;
        }
        $default_tab = null;
        $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
    ?>      
        
        <div class="wrap rex__wrap">            
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>            
            <div class="rex__wrap--cover">
                <div class="rex__wrap--cover-content">
                    <?php
                        require_once plugin_dir_path(dirname(__FILE__)) . 'partials/menu_nav.php';
                        require_once plugin_dir_path(dirname(__FILE__)) . 'partials/admin-page-form.php';
                    ?>
                </div>                
                <div class="rex__wrap--cover-sidebar">
                    <?php require_once plugin_dir_path(dirname(__FILE__)) . 'partials/sidebar.php'; ?>
                </div>
            </div>            
        </div>        
<?php
    }

    public function rex_maintenance_mode_content_page_html()
    {
        echo 'About page';
    }
}
