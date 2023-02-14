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
class Site_Mode_Social extends Settings {

        protected $show_social;
		protected $social_icons;
		protected $di_social_icons = [
			['title' => 'Facebook', 'icon' => 'fa-facebook-f'],
			['title' => 'Twitter', 'icon' => 'fa-twitter'],
			['title' => 'Linkedin', 'icon' => 'fa-linkedin-in'],
			['title' => 'Instagram', 'icon' => 'fa-instagram'],
			['title' => 'Pinterest', 'icon' => 'fa-pinterest'],
			['title' => 'Whatsapp', 'icon' => 'fa-whatsapp'],
			['title' => 'Google', 'icon' => 'fa-google'],
			['title' => 'Tiktok', 'icon' => 'fa-tiktok'],
			['title' => 'Discord', 'icon' => 'fa-discord'],
			['title' => 'Youtube', 'icon' => 'fa-youtube'],
			['title' => 'Slack', 'icon' => 'fa-slack'],
			['title' => 'Dribbble', 'icon' => 'fa-dribbble'],
			['title' => 'Vimeo', 'icon' => 'fa-vimeo'],
			['title' => 'Behance', 'icon' => 'fa-behance'],
			['title' => 'Skype', 'icon' => 'fa-skype'],
			['title' => 'Twitch', 'icon' => 'fa-twitch'],
			['title' => 'Tumblr', 'icon' => 'fa-tumblr'],
			['title' => 'Reddit', 'icon' => 'fa-reddit-alien'],
		];

		public function __construct() {
			$this->option_name = 'site_mode_social';

			$social_content     =   $this->get_data('site_mode_social');
			$this->show_social  =   isset($social_content['show_social_icons']) ? $social_content['show_social_icons'] : 'off';
			$this->social_icons =   isset($social_content['social_icons']) ? $social_content['social_icons'] : [];

		}

    public function ajax_site_mode_social() {

	    $this->verify_nonce('social-custom-message', 'social-settings-save');

	    $data = [
		    'show_social_icons'   => sanitize_text_field($_POST['show-social-icons']),
		    'social_icons'        => $_POST['social_icons']
	    ];

        return $this->save_data($this->option_name, $data);

        wp_die();
    }

	public function check_selected_social_icon($icon_title) {

		$searchIcon = array_search($icon_title, array_column($this->social_icons, 'title'));

		if($searchIcon !== false) {
			echo 'sm-social_icon--checked';
		}

	}

	public function render() {
	  $this->display_settings_page('social');
	}
}


