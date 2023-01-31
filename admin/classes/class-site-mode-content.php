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
class Site_Mode_Content extends Settings {
    protected $option_name = 'site_mode_content';
    protected $site_mode_content;
    protected $logo_settings;
    protected $text_logo;
    protected $image_logo;
    protected $disable_logo;
    protected $heading ;
	protected $sub_heading;
    protected $description;
    protected $bg_image;

    public function __construct() {
        $this->site_mode_content    = $this->get_data($this->option_name);
        $this->logo_setting        = $this->site_mode_content['logo_settings'];
        $this->text_logo            = $this->site_mode_content['text_logo'];
        $this->heading              = $this->site_mode_content['heading'];
        $this->sub_heading          = $this->site_mode_content['heading'];
        $this->description          = $this->site_mode_content['description'];
	    $this->image_logo           = $this->get_attachments_details($this->site_mode_content['image_logo']);
        $this->bg_image             = $this->get_attachments_details($this->site_mode_content['bg_image']);

    }

    public function ajax_site_mode_content() {

	    $this->verify_nonce('design-custom-message', 'design-settings-save');

        $data = array(
            "logo_settings" =>sanitize_text_field($_POST['content-logo-settings']),
            "image_logo"    =>intval($_POST['content-image-logo-setting']),
            "text_logo"     =>sanitize_text_field($_POST['content-text-logo-setting']),
            "heading"       =>sanitize_text_field($_POST['content-heading-setting']),
            'description'   =>sanitize_text_field($_POST['content-description-setting']),
            'bg_image'      =>intval($_POST['content-bg-image-setting']),
        );

        return $this->save_data($this->option_name, $data);

        die();

    }

	public function get_attachments_details($id) {
		if($id) {
			$image_url = wp_get_attachment_image_url($id, 'medium');
			$image_alt_text = get_post_meta($id, '_wp_attachment_image_alt', true);
			if(!$image_alt_text){
				$image_alt_text = get_the_title( $id );
			}

			if(!$image_url){
				return false;
			}

			return [
				'url' => $image_url,
				'alt' => $image_alt_text
			];
		} else {
			return false;
		}
	}

    public function render() {
        $this->display_settings_page('content');
    }

}
