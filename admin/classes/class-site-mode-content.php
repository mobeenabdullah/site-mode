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
    protected $content_heading ;
    protected $content_description;
	protected $logo_type;
	protected $logo_text;
	protected $logo_image;
    protected $bg_image;

    public function __construct() {
        $this->site_mode_content        = $this->get_data($this->option_name);
        $this->content_heading          = (isset($this->site_mode_content['content_heading'])) ? $this->site_mode_content['content_heading'] : null;
        $this->content_description      = (isset($this->site_mode_content['content_description'])) ? $this->site_mode_content['content_description'] : null;
	    $this->logo_type        	    = (isset($this->site_mode_content['logo_type'])) ? $this->site_mode_content['logo_type'] : null;
	    $this->logo_text                = (isset($this->site_mode_content['logo_text'])) ? $this->site_mode_content['logo_text'] : null;
	    $this->logo_image               = isset($this->site_mode_content['logo_image']) ? $this->get_attachments_details($this->site_mode_content['logo_image']) : null;
        $this->bg_image                 = isset($this->site_mode_content['bg_image']) ? $this->get_attachments_details($this->site_mode_content['bg_image']) : null;

    }

    public function ajax_site_mode_content() {

	    $this->verify_nonce('design-custom-message', 'design-settings-save');

		// validate using isset and sanitize inputs before storing in database.
	    $data = array();
				if(isset($_POST['content-heading'])){
					$data['content_heading'] = sanitize_text_field($_POST['content-heading']);
				}
				if(isset($_POST['content-description'])){
					$data['content_description'] = sanitize_text_field($_POST['content-description']);
				}
			    if(isset($_POST['logo-type'])){
				    $data['logo_type'] = sanitize_text_field($_POST['logo-type']);
			    }
			    if(isset($_POST['logo-text'])){
				    $data['logo_text'] = sanitize_text_field($_POST['logo-text']);
			    }
			    if(isset($_POST['logo-image'])){
				    $data['logo_image'] = intval($_POST['logo-image']);
			    }
				if(isset($_POST['bg-image'])){
					$data['bg_image'] = intval($_POST['bg-image']);
				}

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
				'id' => $id,
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
