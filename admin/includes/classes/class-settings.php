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
class Settings
{


    public function __construct() {

    }

    //empty function ajax_call to handle ajax call.
    public function ajax_call() {
        //check  if nonce is valid
        if ( ! isset( $_POST['general_section_field'] ) || ! wp_verify_nonce( $_POST['general_section_field'], 'general_settings_action' ) ) {
            wp_send_json_error( 'Invalid nonce' );
        }
        else {

        }
    }

    public function save_data($option_name, $data) {
        $data = serialize($data);
        update_option($option_name, $data);
        wp_send_json_success(get_option($option_name));

    }

    public function get_data($option_name) {
        $data = get_option($option_name);
        $data = unserialize($data);
        return $data;
    }

    public function display_settings_page($page_name) {

     echo require_once plugin_dir_path( dirname( __FILE__ ) ) . "partials/{$page_name}-setting-page.php";

    }








}





