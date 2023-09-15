<?php
/**
 * Responsible for plugin menu
 *
 * @link       https://mobeenabdullah.com
 * @since      0.0.2
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

class Site_Mode_Google_fonts {
    public function __construct() {
        add_action('init', array($this, 'init'));
    }

    public function init() {
        // Check if the user has enabled Google Fonts for the plugin.
        if (get_option('my_plugin_enable_google_fonts') === true) {
            // Get the Google Fonts CSS file URL.
            $fonts = array('font1', 'font2'); // Replace with your font array.
            $fonts_url = 'https://fonts.googleapis.com/css?family=' . implode('|', $fonts);

            // Enqueue the Google Fonts CSS file.
            wp_enqueue_style('my-plugin-google-fonts', $fonts_url);
        }
    }
}