<?php

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
class General_Field
{


    public function __construct()
    {
        $this->add_fields();
    }
    public function add_fields() {
        add_settings_field('rex_maintenance_status_disable', 'Status', [$this, 'rex_maintenance_status_cb'], 'wprex-maintenance-general-page', 'wprex-maintenance-general-section');
        add_settings_field('rex_maintenance_mode', 'Mode', [$this, 'rex_maintenance_mode_cb'], 'wprex-maintenance-general-page', 'wprex-maintenance-general-section');
        add_settings_field('rex_maintenance_login_log','Login Icon', [$this, 'rex_maintenance_login_cb'],'wprex-maintenance-general-page','wprex-maintenance-general-section');
    }
    public function rex_maintenance_status_cb()
    {
        //print_r(get_option('wprex-status-settings'));
        ?>
        <div class="um_checkbox_wrapper">
            <input type="checkbox" id="status" name="wprex-status-settings" value="1" <?php checked(1, get_option('wprex-status-settings'), true); ?> />
            <label for="status">Enable/Disable</label>
        </div>
        <?php
    }

    public function rex_maintenance_mode_cb()
    {
//        print_r(get_option('wprex-mode-settings'));
        ?>
        <div class="um_select">
            <label for="site_mode" class="screen-reading">Mode</label>
            <select name="wprex-mode-settings" id="site_mode">
                <option value="maintenance" >Maintenance - Returns HTTP 200 OK response</option>
                <option value="coming-soon">Coming Soon - Returns 503 HTTP Service response</option>
                <option value="redirect"  id="direct-item">Redirect - Returns HTTP 301 response and redirect to a URL</option>
            </select>
            <span class="arrow-down"></span>
        </div>
        <div class="redirect_options">
            <div class="um_input_cover label_top">
                <label for="redirect_url">Redirect Url</label>
                <input type="text" id="redirect_url" name="wprex-redirect-url-settings" value="1" <?php checked(1, get_option('wprex-redirect-url-settings'), true); ?> />
            </div>
            <div class="um_input_cover label_top">
                <label for="delay_seconds">Delay (Seconds)</label>
                <div class="um_number-cover">
                    <input type="number" min="0" max="9" id="delay_seconds" data-inc="1" name="wprex-delay-settings" value="1" <?php checked(1, get_option('wprex-delay-settings'), true); ?> />
                </div>
            </div>

        </div>
        <?php
    }

    public function rex_maintenance_login_cb() {
        ?>
        <div class="um_checkbox_wrapper">
            <input type="checkbox" id="login_icon" name="wprex-login-icon-setting" value="1" <?php checked(1, get_option('wprex-login-icon-setting'), true); ?> />
            <label for="login_icon">Login Icon</label>
        </div>
        <div class="um_input_cover label_top">
            <label for="redirect_url">Login URL</label>
            <input type="text" id="redirect_url" name="wprex-login-url-setting" value="login url" <?php checked(1, get_option('wprex-login-url-setting'), true); ?> />
        </div>
        <?php
    }
}
