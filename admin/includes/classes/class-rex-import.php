<?php

/**
 * Responsible for plugin menu
 *
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/includes
 */

/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.0.0
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Rex_Import
{
        protected $file = '';
        protected $data = '';
        protected $advance = '';
        protected $content = '';
        protected $design = '';
        protected $rex_design_lb = '';
        protected $rex_design_colors = '';
        protected $seo = '';
        protected $social = '';
        protected $settings = '';
        protected $general = '';
    public function __construct()
    {

    }

    public function ajax_rex_import() {

        $this->file                 = $_FILES['json-file']['tmp_name'];
        $this->data                 = file_get_contents($this->file);
        $data                       = json_decode($this->data, true);
        $this->advance              = $data['advance'];
        $this->content              = $data['content'];
        $this->design               = $data['design'];
        $this->rex_design_lb        = $data['rex_design_lb'];
        $this->rex_design_colors    = $data['rex_design_colors'];
        $this->seo                  = $data['seo'];
        $this->social               = $data['social'];
        $this->settings             = $data['settings'];
        $this->general              = $data['general'];

        update_option('rex_advanced',$this->advance);
        update_option('rex_content',$this->content);
        update_option('rex_design',$this->design);
        update_option('rex_design_lb',$this->rex_design_lb);
        update_option('rex_design_colors',$this->rex_design_colors);
        update_option('rex_seo',$this->seo);
        update_option('rex_social',$this->social);
        update_option('rex_settings',$this->settings);
        update_option('rex_general',$this->general);
        wp_send_json_success($this->data);
//        }
        die();
    }
}