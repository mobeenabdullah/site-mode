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
class Site_Mode_Export
{
    protected $advance;
    protected $content;
    protected $design ;
    protected $site_mode_design_lb;
    protected $site_mode_design_colors;
    protected $seo;
    protected $social;
    protected $settings ;
    protected $general;
    protected $data = [];

    public function __construct()
    {
        $this->advance                       = get_option('site_mode_advanced');
        $this->content                       = get_option('site_mode_content');
        $this->design                        = get_option('site_mode_design');
        $this->site_mode_design_lb           = get_option('site_mode_design_lb');
        $this->site_mode_design_colors       = get_option('site_mode_design_colors');
        $this->seo                  = get_option('site_mode_seo');
        $this->social               = get_option('site_mode_social');
        $this->settings             = get_option('site_mode_settings');
        $this->general              = get_option('site_mode_general');

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

    public function ajax_site_mode_export() {
        $json = json_encode($this->data);
        if($json) {
            // get plugin name dynamically
            echo wp_json_encode($json);
            die();
        }
        else {
            echo 'error';
        }

        die();

    }
}
