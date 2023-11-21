<?php


/**
 * Responsible for Site Mode Advanced Settings
 *
 * @link       https://mobeenabdullah.com
 * @since      1.0.5
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

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
class Settings {

    /**
     * Constructor
     *
     * @since 1.0.5
     * @access public
     */
	public function save_data( $option_name, $data ) {
		update_option( $option_name, $data );

		if ( empty( get_option( 'sm-fresh-installation' ) ) && 'site_mode_design' === $option_name ) {
			update_option( 'sm-fresh-installation', true );

			wp_send_json_success(
				array(
					'page_link'          => urldecode( get_edit_post_link( intval( $data['page_setup']['active_page'] ) ) ),
					'message'            => 'Template has been initialized successfully.',
					'fresh_installation' => true,
					'template_name'      => str_replace( '-', ' ', $data['template'] ),
				)
			);
		} elseif ( $option_name === 'site_mode_design' ) {
			wp_send_json_success(
				array(
					'tab'       => 'design',
					'status'    => ! empty( $data['page_setup']['active_page'] ),
					'message'   => 'Settings has been saved successfully.',
					'page_link' => urldecode( get_edit_post_link( intval( $data['page_setup']['active_page'] ) ) ),
				)
			);
		} else {
			wp_send_json_success( get_option( $option_name ) );
		}
	}

    /**
     * Get Data.
     *
     * @since 1.0.5
     * @access public
     */
	public function get_data( $option_name ) {
		$data = get_option( $option_name );
		return $data;
	}

    /**
     * Get Post Data.
     *
     * @since 1.0.5
     * @access public
     */
	public function get_post_data( $key, $action, $nonce, $sanitize = 'text' ) {

		if ( isset( $_POST[ $key ] ) && isset( $_POST[ $nonce ] ) && wp_verify_nonce( sanitize_text_field( $_POST[ $nonce ] ), $action ) ) {
			if ( 'number' === $sanitize ) {
				return intval( $_POST[ $key ] );
			} elseif ( 'color' === $sanitize ) {
				return sanitize_hex_color( $_POST[ $key ] );
			} elseif ( 'code' === $sanitize ) {
				return $_POST[ $key ];
			} else {
				return sanitize_text_field( $_POST[ $key ] );
			}
		}
		return null;
	}

    /**
     * Verify Nonce.
     *
     * @since 1.0.5
     * @access public
     */
	public function verify_nonce( $key, $action ) {
		if ( ! isset( $_POST[ $key ] ) || ! wp_verify_nonce( $_POST[ $key ], $action ) ) {
			wp_send_json_error( 'Invalid nonce' );
		}
	}

    /**
     * Display Settings Page.
     *
     * @since 1.0.5
     * @access public
     */
	public function display_settings_page( $page_name ) {
		require_once SITE_MODE_ADMIN . "partials/{$page_name}-setting-page.php";
	}

    /**
     * SVG Sanitization.
     *
     * @since 1.0.5
     * @access public
     */
	public function wp_kses_svg( $svg_content ) {
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
				'viewbox'         => true, // <= Must be lower case!
			),
			'g'     => array( 'fill' => true ),
			'title' => array( 'title' => true ),
			'path'  => array(
				'd'    => true,
				'fill' => true,
			),
		);

		$allowed_tags = array_merge( $kses_defaults, $svg_args );
		echo wp_kses( $svg_content, $allowed_tags );
	}
}
