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
class Site_Mode_Seo extends Settings {

    protected $option_name = 'site_mode_seo';
    protected $seo_settings = [];
    protected $meta_title;
    protected $meta_description;
    protected $meta_favicon;
    protected $meta_image;

    public function __construct(){

        $this->seo_settings  = $this->get_data($this->option_name);
        //check if values are set or not if not set then set default values
        $this->meta_title          = isset($this->seo_settings['meta_title']) ? $this->seo_settings['meta_title'] : 'SEO Meta Title';
        $this->meta_description    = isset($this->seo_settings['meta_description']) ? $this->seo_settings['meta_description'] : 'SEO Meta Description';
        $this->meta_favicon        = isset($this->seo_settings['meta_favicon']) ? $this->seo_settings['meta_favicon'] : '';
        $this->meta_image          = isset($this->seo_settings['meta_image']) ? $this->seo_settings['meta_image'] : '';
    }

    public function ajax_site_mode_seo() {

	    $this->verify_nonce('seo-custom-message', 'seo-settings-save');
        $data = array(
            'meta_title'            => $_POST['soe-meta-title-setting'],
            'meta_description'      => $_POST['soe-meta-description-setting'],
            'meta_favicon'          => $_POST['soe-meta-favicon-setting'],
            'meta_image'            => $_POST['soe-meta-image-setting'],
        );

        return $this->save_data($this->option_name, $data);
        die();
    }

    public function render() {
        $this->display_settings_page('seo');
    }

}
