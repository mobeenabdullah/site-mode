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
			['title' => 'Facebook', 'icon' => 'facebook-alt'],
			['title' => 'Twitter', 'icon' => 'twitter'],
			['title' => 'Linkedin', 'icon' => 'linkedin'],
			['title' => 'Instagram', 'icon' => 'instagram'],
			['title' => 'Pinterest', 'icon' => 'pinterest'],
			['title' => 'Whatsapp', 'icon' => 'whatsapp'],
			['title' => 'Google', 'icon' => 'google']
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


