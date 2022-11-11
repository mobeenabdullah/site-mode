<?php

/**
 * Responsible for plugin menu
 *
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Oh_My_Page
 * @subpackage Oh_My_Page/includes
 */

/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.0.0
 * @package    Oh_My_Page
 * @subpackage Oh_My_Page/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Oh_My_Page_Menu
{


    public function  __construct()
    {
        add_action('admin_menu', [$this, 'oh_my_page_menu']);
        add_action('admin_menu', [$this, 'oh_my_page_submenu_settings_page']);
    }

    public function oh_my_page_menu()
    {
        add_menu_page(
            __('Oh My Page Settings', 'oh-my-page'),
            'Oh My Page',
            'manage_options',
            'oh-my-page-options',
            [$this, 'oh_my_page_settings_page_cb'],
            'dashicons-welcome-add-page',
            10,
        );
    }

    public function oh_my_page_submenu_settings_page()
    {
        add_submenu_page(
            'oh-my-page-options',
            'Settings',
            'Settings',
            'manage_options',
            'oh-my-page-options',
            [$this, 'oh_my_page_settings_page_cb']
        );
        add_submenu_page(
            'oh-my-page-options',
            'about',
            'About',
            'manage_options',
            'oh-my-page-about',
            [$this, 'oh_my_page_content_page_html']
        );
    }

    public function oh_my_page_settings_page_cb()
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
                <a href="?page=oh-my-page-options" class="nav-tab <?php if ($tab === null) : ?>nav-tab-active<?php endif; ?>"><?php esc_html_e('General Settings', 'oh-my-page'); ?></a>
                <a href="?page=oh-my-page-options&tab=content" class="nav-tab <?php if ($tab === 'content') : ?>nav-tab-active<?php endif; ?>"><?php esc_html_e('Content', 'oh-my-page'); ?></a>
                <a href="?page=oh-my-page-options&tab=tools" class="nav-tab <?php if ($tab === 'tools') : ?>nav-tab-active<?php endif; ?>"><?php esc_html_e('Design', 'oh-my-page'); ?></a>
            </nav>
            <form action="options.php" method="post">
                <?php switch ($tab):
                    case 'content':
                        settings_fields('oh-my-page-setting-content-group');
                        do_settings_sections('oh-my-page-options-one');
                        submit_button(__('Save Changes', 'oh-my-page'));
                        break;
                    case 'tools':
                        settings_fields('oh-my-page-setting-design-group');
                        do_settings_sections('oh-my-page-design');
                        submit_button(__('Save Changes', 'oh-my-page'));
                        break;
                    default:
                        settings_fields('oh-my-page-setting-group');
                        do_settings_sections('oh-my-page-options');
                        submit_button(__('Save Changes', 'oh-my-page'));
                        break;

                endswitch; ?>
            </form>
        </div>
<?php
    }

    public function oh_my_page_content_page_html()
    {
        echo 'About page';
    }
}
