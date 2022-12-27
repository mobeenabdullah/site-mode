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
class Rex_Export
{
    protected $advance              = '';
    protected $content              = '';
    protected $design               = '';
    protected $rex_design_lb        = '';
    protected $rex_design_colors    = '';
    protected $seo                  = '';
    protected $social               = '';
    protected $settings             = '';
    protected $general              = '';
    protected $data                 = array();

    public function __construct()
    {
        $this->advance              = get_option('rex_advanced');
        $this->content              = get_option('rex_content');
        $this->design               = get_option('rex_design');
        $this->rex_design_lb        = get_option('rex_design_lb');
        $this->rex_design_colors    = get_option('rex_design_colors');
        $this->seo                  = get_option('rex_seo');
        $this->social               = get_option('rex_social');
        $this->settings             = get_option('rex_settings');
        $this->general              = get_option('rex_general');

        $this->data = array(
            'advance'   => $this->advance,
            'content'   => $this->content,
            'design'    => $this->design,
            'seo'       => $this->seo,
            'social'    => $this->social,
            'settings'  => $this->settings,
            'general'   => $this->general,
        );
    }

    public function ajax_rex_export() {
        $json = json_encode($this->data);
        if(file_put_contents(plugin_dir_path(__FILE__) . "export.json", $json)) {
            echo $json;
            $filename = plugin_dir_path(__FILE__) . "export.json";
            //Clear the cache
            wp_send_json_success($filename);
            clearstatcache();

            if (file_exists($filename)) {
                // delete the file

            }
            else {
                //generate error message
                wp_send_json_error("File not found");
            }
        }
        else {
            echo 'error';
        }

        $file = plugin_dir_path(__FILE__) . "export.json";
        die();

    }
}
