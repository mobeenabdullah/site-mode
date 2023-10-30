<?php

/**
 * Responsible for plugin menu
 *
 * @link       https://mobeenabdullah.com
 * @since      1.0.5
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

require_once SITE_MODE_ADMIN . 'classes/class-settings.php';
/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.0.5
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Integrations extends Settings {
    protected $option_name = 'site_mode_integrations';
    protected $ga_id;
    protected $fb_id;

    protected $site_mode_intergrations = [];


    public function __construct() {
        $this->site_mode_intergrations = get_option( 'site_mode_integrations' );
        if ( $this->site_mode_intergrations ) {
            $this->ga_id            = isset( $this->site_mode_intergrations['ga_id'] ) ? $this->site_mode_intergrations['ga_id'] : '';
            $this->fb_id            = isset( $this->site_mode_intergrations['fb_id'] ) ? $this->site_mode_intergrations['fb_id'] : '';
        }
    }

    public function ajax_site_mode_intergrations() {

        $this->verify_nonce( 'intergrations_field', 'intergrations_action' );

        // validate using isset and sanitize inputs before storing in database.
        $data                     = [];
        $data['ga_id']            = $this->get_post_data( 'ga-id', 'intergrations_action', 'intergrations_field', 'text' );
        $data['fb_id']            = $this->get_post_data( 'facebook-id', 'intergrations_action', 'intergrations_field', 'text' );

        return $this->save_data( $this->option_name, $data );

        wp_die();
    }

    public function render() {
        $this->display_settings_page( 'intergrations' );
    }




}