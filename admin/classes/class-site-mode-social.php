<?php

/**
 * Responsible for plugin menu
 *
 * @link       https://mobeenabdullah.com
 * @since      0.0.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      0.0.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Social extends Settings {

		protected $show_social;
		protected $social_icons;
		protected $di_social_icons = array(
			array(
				'title' => 'Facebook',
				'icon'  => 'fa-facebook-f',
			),
			array(
				'title' => 'Twitter',
				'icon'  => 'fa-twitter',
			),
			array(
				'title' => 'Linkedin',
				'icon'  => 'fa-linkedin-in',
			),
			array(
				'title' => 'Instagram',
				'icon'  => 'fa-instagram',
			),
			array(
				'title' => 'Pinterest',
				'icon'  => 'fa-pinterest',
			),
			array(
				'title' => 'Whatsapp',
				'icon'  => 'fa-whatsapp',
			),
			array(
				'title' => 'Google',
				'icon'  => 'fa-google',
			),
			array(
				'title' => 'Tiktok',
				'icon'  => 'fa-tiktok',
			),
			array(
				'title' => 'Discord',
				'icon'  => 'fa-discord',
			),
			array(
				'title' => 'Youtube',
				'icon'  => 'fa-youtube',
			),
			array(
				'title' => 'Slack',
				'icon'  => 'fa-slack',
			),
			array(
				'title' => 'Dribbble',
				'icon'  => 'fa-dribbble',
			),
			array(
				'title' => 'Vimeo',
				'icon'  => 'fa-vimeo',
			),
			array(
				'title' => 'Behance',
				'icon'  => 'fa-behance',
			),
			array(
				'title' => 'Skype',
				'icon'  => 'fa-skype',
			),
			array(
				'title' => 'Twitch',
				'icon'  => 'fa-twitch',
			),
			array(
				'title' => 'Tumblr',
				'icon'  => 'fa-tumblr',
			),
			array(
				'title' => 'Reddit',
				'icon'  => 'fa-reddit-alien',
			),
		);

		public function __construct() {
			$this->option_name = 'site_mode_social';

			$social_content     = $this->get_data( 'site_mode_social' );
			$this->show_social  = isset( $social_content['show_social_icons'] ) ? $social_content['show_social_icons'] : 'off';
			$this->social_icons = isset( $social_content['social_icons'] ) ? $social_content['social_icons'] : array();

		}

		public function ajax_site_mode_social() {

			$this->verify_nonce( 'social-custom-message', 'social-settings-save' );

			if ( isset( $_POST['social_icons'] ) && isset( $_POST['social-custom-message'] ) && wp_verify_nonce( $_POST['social-custom-message'], 'social-settings-save' ) ) {
				$data['social_icons'] = $_POST['social_icons'];
			} else {
				$data['social_icons'] = array();
			}

			if ( isset( $_POST['show-social-icons'] ) && isset( $_POST['social-custom-message'] ) && wp_verify_nonce( $_POST['social-custom-message'], 'social-settings-save' ) ) {
				$data['show_social_icons'] = sanitize_text_field( $_POST['show-social-icons'] );
			} else {
				$data['show_social_icons'] = 'off';
			}

			return $this->save_data( $this->option_name, $data );

			wp_die();
		}

		public function check_selected_social_icon( $icon_title ) {

			$searchIcon = array_search( $icon_title, array_column( $this->social_icons, 'title' ) );

			if ( $searchIcon !== false ) {
				echo 'sm-social_icon--checked';
			}

		}

		public function render() {
			$this->display_settings_page( 'social' );
		}
}


