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

		public function __construct() {
			$this->option_name = 'site_mode_social';

			$social_content     =   $this->get_data('site_mode_social');
			$this->show_social  =   isset($social_content['show-social-icons']) ? $social_content['show-social-icons'] : '';
			$this->social_icons =   isset($social_content['social_icons']) ? $social_content['social_icons'] : [];

		}

    public function ajax_site_mode_social() {

	    $this->verify_nonce('social-custom-message', 'social-settings-save');

	    $data = [
		    'show_social_icons'   => sanitize_text_field($_POST['show-social-icons']),
		    'social_icons'        => $_POST['social_icons']
	    ];

		print_r($data);

        return $this->save_data($this->option_name, $data);

        wp_die();
    }

	public function render() {
	  $this->display_settings_page('social');
	}
}


