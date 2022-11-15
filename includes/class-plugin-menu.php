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


    public function  __construct()
    {
        add_action('admin_menu', [$this, 'rex_maintenance_mode_menu']);
        add_action('admin_menu', [$this, 'rex_maintenance_mode_submenu_settings_page']);
    }

    public function rex_maintenance_mode_menu()
    {
        add_menu_page(
            __('REX Maintenance Mode Settings', 'rex-maintenance-mode'),
            'REX Maintenance Mode',
            'manage_options',
            'rex-maintenance-mode-options',
            [$this, 'rex_maintenance_mode_settings_page_cb'],
            'dashicons-welcome-add-page',

        );
    }

    public function rex_maintenance_mode_submenu_settings_page()
    {
        add_submenu_page(
            'rex-maintenance-mode-options',
            'Settings',
            'Settings',
            'manage_options',
            'rex-maintenance-mode-options',
            [$this, 'rex_maintenance_mode_settings_page_cb']
        );
        add_submenu_page(
            'rex-maintenance-mode-options',
            'about',
            'About',
            'manage_options',
            'rex-maintenance-mode-about',
            [$this, 'rex_maintenance_mode_content_page_html']
        );
    }

    public function rex_maintenance_mode_settings_page_cb()
    {
        if (!current_user_can('manage_options')) {
            return;
        }
        $default_tab = null;
        $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
?>
        <div class="wrap">
            <!-- Print the page title -->
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <!-- Here are our tabs -->
            <nav class="nav-tab-wrapper">
                <a href="?page=rex-maintenance-mode-options" class="nav-tab <?php if ($tab === null) : ?>nav-tab-active<?php endif; ?>"><?php esc_html_e('General Settings', 'rex-maintenance-mode'); ?></a>
                <a href="?page=rex-maintenance-mode-options&tab=content" class="nav-tab <?php if ($tab === 'content') : ?>nav-tab-active<?php endif; ?>"><?php esc_html_e('Content', 'rex-maintenance-mode'); ?></a>
                <a href="?page=rex-maintenance-mode-options&tab=tools" class="nav-tab <?php if ($tab === 'tools') : ?>nav-tab-active<?php endif; ?>"><?php esc_html_e('Design', 'rex-maintenance-mode'); ?></a>
            </nav>
            <form action="options.php" method="post">
                <?php switch ($tab):
                    case 'content':
                        settings_fields('rex-maintenance-mode-setting-content-group');
                        do_settings_sections('rex-maintenance-mode-options-one');
                        submit_button(__('Save Changes', 'rex-maintenance-mode'));
                        break;
                    case 'tools':
                        settings_fields('rex-maintenance-mode-setting-design-group');
                        do_settings_sections('rex-maintenance-mode-design');
                        submit_button(__('Save Changes', 'rex-maintenance-mode'));
                        break;
                    default:
                        settings_fields('rex-maintenance-mode-setting-group');
                        do_settings_sections('rex-maintenance-mode-options');
                        submit_button(__('Save Changes', 'rex-maintenance-mode'));
                        break;

                endswitch; ?>
            </form>
        </div>
<?php
    }

    public function rex_maintenance_mode_content_page_html()
    {
        echo 'About page';
    }
}
