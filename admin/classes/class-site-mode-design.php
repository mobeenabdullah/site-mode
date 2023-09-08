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
    protected  $active_template = '';
    protected $page_id = '';


    public function __construct() {
        $this->get_template_props_init();
    }

    public function ajax_site_mode_design_page_init() {
        $this->verify_nonce( 'template_init_field', 'template_init_action' );
        $page_id = $this->get_post_data( 'page_id', 'template_init_action', 'template_init_field', 'number' );
        $this->get_template_props_init();
        $this->page_id = $page_id;
        $design_data = [
            'template' => $this->active_template,
            'page_id' => $page_id
        ];

        if($page_id){
            $template      = json_decode( file_get_contents( plugin_dir_path( dirname( __FILE__ ) ) . 'assets/templates/'.$this->active_template.'/blocks-export.json' ) );
            $blocks = str_replace( '\n', '', $template->content );
            $post = get_post( $page_id );
            $post->post_content = $blocks;
            $post->page_template = 'blank';
            $result = wp_update_post($post);
            $this->save_data( $this->option_name, $design_data );

            if(is_wp_error($result)) {
                wp_send_json_error('Something went wrong.');
            } else {
                wp_send_json_success('Template has been initialized successfully.');
            }
        }

    }
    public function ajax_site_mode_template_skip() {
        $this->verify_nonce( 'skip_template_field', 'skip_template_action' );
        update_option('sm-fresh-installation', true);
        wp_send_json_success([
            'redirect' => admin_url( 'admin.php?page=site-mode&tab=design' ),
            'fresh_installation' => true,
            'success' => true
        ]);
    }
    public function ajax_site_mode_template_init(){
        $this->verify_nonce( 'template_init_field', 'template_init_action' );
        $template = $this->get_post_data( 'template', 'template_init_action', 'template_init_field', 'text' );
        $this->get_template_props_init();
        if(!isset($template)) {
            $template = $this->active_template;
        }

        $design_data = [
            'template' => $template,
            'page_id' => $this->page_id
        ];

        // check has maintaince page
        $page_id = $this->check_maintaince_page($this->page_id, $template);
        $design_data['page_id'] = $page_id;
        $this->page_id = $page_id;
        $template      = json_decode( file_get_contents( plugin_dir_path( dirname( __FILE__ ) ) . 'assets/templates/'.$template.'/blocks-export.json' ) );
        $blocks = str_replace( '\n', '', $template->content );
        $post = get_post( $page_id );
        $post->post_content = $blocks;
        $post->page_template = 'blank';
        $result = wp_update_post($post);

        if(is_wp_error($result)){
            wp_send_json_error( 'Something went wrong.' );
        }
        $this->save_data( $this->option_name, $design_data );
    }
	public function render() {
		$this->display_settings_page( 'design' );
	}

    public function check_maintaince_page($id = '', $template_name = ''){
        if($id){
            $page = get_post($id);
            if($page){
                return $page->ID;
            } else {
                return $this->create_maintaince_page($template_name);
            }
        } else {
            return $this->create_maintaince_page($template_name);
        }
    }

    public function create_maintaince_page ($template_name = '') {
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
            $design_data = [
                'template' => $template_name,
                'page_id' => $page_id
            ];
            $this->save_data( $this->option_name, $design_data );
            return $page_id;
        } else {
            wp_send_json_error( 'Something went wrong.');
        }
    }

    public function get_template_props_init() {
        $design_settings = $this->get_data( $this->option_name );

        if(!empty($design_settings)){
            $this->active_template = isset($design_settings['template']) ? $design_settings['template'] : '';
            $this->page_id = isset($design_settings['page_id']) ? $design_settings['page_id'] : '';
        }
    }

}
