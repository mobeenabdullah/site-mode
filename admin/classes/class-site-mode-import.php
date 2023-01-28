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
class Site_Mode_Import extends Settings {
    protected $file;
    protected $data;
    protected $advance;
    protected $content;
    protected $design;
    protected $seo;
    protected $social;
    protected $settings;
    protected $general;
	protected $site_mode_design_lb;
	protected $site_mode_design_colors;

    public function ajax_site_mode_import() {

        $this->file                 = $_FILES['json-file']['tmp_name'];
        $this->data                 = file_get_contents($this->file);
        $data                       = json_decode($this->data, true);
        $this->advance              = $data['advance'];
        $this->content              = $data['content'];
        $this->design               = $data['design'];
        $this->site_mode_design_lb        = $data['site_mode_design_lb'];
        $this->site_mode_design_colors    = $data['site_mode_design_colors'];
        $this->seo                  = $data['seo'];
        $this->social               = $data['social'];
        $this->settings             = $data['settings'];
        $this->general              = $data['general'];

        $this->save_data('site_mode_advanced',$this->advance);
        $this->save_data('site_mode_content',$this->content);
        $this->save_data('site_mode_design',$this->design);
        $this->save_data('site_mode_design_lb',$this->site_mode_design_lb);
        $this->save_data('site_mode_design_colors',$this->site_mode_design_colors);
        $this->save_data('site_mode_seo',$this->seo);
        $this->save_data('site_mode_social',$this->social);
        $this->save_data('site_mode_settings',$this->settings);
        $this->save_data('site_mode_general',$this->general);

        wp_send_json_success($this->data);
        die();
    }

    public function render() {
        $this->display_settings_page('export-import');
    }
}
