<?php
/**
 * Responsible for plugin dashboard seo settings.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for plugin dashboard seo settings.
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.1.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Seo extends Settings {
	/**
	 * The Key of seo tab settings in the options table.
	 *
	 * @since    1.1.1
	 * @access   protected
	 * @var      string    $option_name    The Key of settings in the options table.
	 */
	protected $option_name = 'site_mode_seo';

	/**
	 * SEO Settings
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var array $seo_settings SEO Settings.
	 */
	protected $seo_settings = array();

	/**
	 * Meta Title.
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var string $meta_title Meta Title.
	 */
	protected $meta_title;

	/**
	 * Meta Description.
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var string $meta_description Meta Description.
	 */
	protected $meta_description;

	/**
	 * Meta Favicon.
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var string $meta_favicon Meta Favicon.
	 */
	protected $meta_favicon;

	/**
	 * Meta Image.
	 *
	 * @since 1.1.1
	 * @access protected
	 * @var string $meta_image Meta Image.
	 */
	protected $meta_image;

	/**
	 * Site_Mode_Seo constructor.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return void
	 */
	public function __construct() {

		$this->seo_settings = $this->get_data( $this->option_name );
		// check if values are set or not if not set then set default values.
		$this->meta_title       = isset( $this->seo_settings['meta_title'] ) ? $this->seo_settings['meta_title'] : 'SEO Meta Title';
		$this->meta_description = isset( $this->seo_settings['meta_description'] ) ? $this->seo_settings['meta_description'] : 'SEO Meta Description';
		$this->meta_favicon     = isset( $this->seo_settings['meta_favicon'] ) ? $this->seo_settings['meta_favicon'] : '';
		$this->meta_image       = isset( $this->seo_settings['meta_image'] ) ? $this->seo_settings['meta_image'] : '';
	}

	/**
	 * AJAX for site mode seo settings
	 *
	 * @since 1.1.1
	 * @access public
	 * @return mixed
	 */
	public function ajax_site_mode_seo() {

		$this->verify_nonce( 'seo-custom-message', 'seo-settings-save' );
		$data                     = array();
		$data['meta_title']       = $this->get_post_data( 'seo-meta-title', 'seo-settings-save', 'seo-custom-message', 'text' );
		$data['meta_description'] = $this->get_post_data( 'seo-meta-description', 'seo-settings-save', 'seo-custom-message', 'text' );
		$data['meta_favicon']     = $this->get_post_data( 'seo-meta-favicon', 'seo-settings-save', 'seo-custom-message', 'text' );
		$data['meta_image']       = $this->get_post_data( 'seo-meta-image', 'seo-settings-save', 'seo-custom-message', 'text' );

		return $this->save_data( $this->option_name, $data );
		die();
	}

	/**
	 * Render the seo settings page for this plugin.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return void
	 */
	public function render() {
		$this->display_settings_page( 'seo' );
	}
}
