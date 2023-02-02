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
class Settings {

    public function save_data($option_name, $data) {
        $data = serialize($data);
        update_option($option_name, $data);
        wp_send_json_success(unserialize(get_option($option_name)));
    }

    public function get_data($option_name) {
        $data = get_option($option_name);
        $data = unserialize($data);
        return $data;
    }

	public function verify_nonce($key, $action) {
		if ( ! isset( $_POST[$key] ) || ! wp_verify_nonce( $_POST[$key], $action ) ) {
			wp_send_json_error( 'Invalid nonce' );
		}
	}

    public function display_settings_page($page_name) {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . "partials/{$page_name}-setting-page.php";
    }

	public function wp_kses_svg($svg_content) {
		$kses_defaults = wp_kses_allowed_html( 'post' );

		$svg_args = array(
			'svg'   => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true // <= Must be lower case!
			),
			'g'     => array( 'fill' => true ),
			'title' => array( 'title' => true ),
			'path'  => array(
				'd'               => true,
				'fill'            => true
			)
		);

		$allowed_tags = array_merge( $kses_defaults, $svg_args );
		return wp_kses( $svg_content, $allowed_tags );
	}

}





