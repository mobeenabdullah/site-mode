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

/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      0.0.2
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Design extends  Settings {

    protected $option_name = 'site_mode_design';
    protected  $active_template = 'template-1';

    public function __construct() {
        $this->active_template = unserialize(get_option( $this->option_name )) ? unserialize(get_option( $this->option_name )) : 'template-1';
    }

    public function ajax_site_mode_template_init(){
        $this->verify_nonce( 'template_init_field', 'template_init_action' );
        $template = $this->get_post_data( 'template', 'template_init_action', 'template_init_field', 'text' );

        // check has maintaince page
        $page_id = $this->check_maintaince_page($template);

        if($page_id){
            update_option( $this->option_name, serialize($template) );
            update_option( 'sm-fresh-installation', serialize(true) );

            $template      = json_decode( file_get_contents( plugin_dir_path( dirname( __FILE__ ) ) . 'assets/templates/'.$template.'/blocks-export.json' ) );
            $blocks = str_replace( '\n', '', $template->content );

            $post = get_post( $page_id );
            $post->post_content = $blocks;
            $result = wp_update_post($post);

            if(is_wp_error($result)){
                wp_send_json_error( 'Something went wrong.' );
            }

            wp_send_json_success( 'Template has been initialized successfully.' );
        }

        wp_send_json_error( 'Something went wrong.' );
        die();
    }
	public function render() {
		$this->display_settings_page( 'design' );
	}

    public function check_maintaince_page($template_name = 'template-1'){
        $page = get_page_by_title( 'Maintenance Page' );

        if($page){
            return $page->ID;
        }

        return $this->create_maintaince_page($template_name);
    }

    public function create_maintaince_page ($template_name = 'template-1') {
        // Create a new page and insert blocks code
        $page_title = 'Maintenance Page';
        $template      = json_decode( file_get_contents( plugin_dir_path( dirname( __FILE__ ) ) . 'assets/templates/'.$template_name.'/blocks-export.json' ) );
        $blocks = str_replace( '\n', '', $template->content );

        // Create the page
        $page_id = wp_insert_post( array(
            'post_title'   => $page_title,
            'post_content' => $blocks,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ) );

        if(!is_wp_error($page_id)){
            return wp_send_json_success( 'Template has been initialized successfully.' );
        }
        return false;
    }

}
