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
    protected $default_images = [
        'template-1' => 'https://s.w.org/wp-content/blogs.dir/1/files/2022/12/showcase_thumbs_a-75.webp',
        'template-2' => 'https://s.w.org/wp-content/blogs.dir/1/files/2022/12/showcase_thumbs_a-75.webp',
        'template-3' => 'https://s.w.org/wp-content/blogs.dir/1/files/2022/12/showcase_thumbs_a-75.webp',
        'template-4' => 'https://s.w.org/wp-content/blogs.dir/1/files/2022/12/showcase_thumbs_a-75.webp',
        'template-5' => 'https://s.w.org/wp-content/blogs.dir/1/files/2022/12/showcase_thumbs_a-75.webp',
        'template-6' => 'https://s.w.org/wp-content/blogs.dir/1/files/2022/12/showcase_thumbs_a-75.webp',
        'template-7' => 'https://s.w.org/wp-content/blogs.dir/1/files/2022/12/showcase_thumbs_a-75.webp',
        'template-8' => 'https://s.w.org/wp-content/blogs.dir/1/files/2022/12/showcase_thumbs_a-75.webp',
    ];

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
            $template      = json_decode( $this->replace_template_default_image($this->active_template) );
            $blocks = str_replace( '\n', '', $template->content );
            $post = get_post( $page_id );
            $post->post_content = $blocks;
            $result = wp_update_post($post);
            $post->page_template = 'templates/sm-page-template.php';
            $this->save_data( $this->option_name, $design_data );

            if(is_wp_error($result)) {
                wp_send_json_error('Something went wrong.');
            } else {
                wp_send_json_success('Template has been initialized successfully.');
            }
        }

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

        $template      = json_decode( $this->replace_template_default_image($template) );
        $blocks = str_replace( '\n', '', $template->content );
        $post = get_post( $page_id );
        $post->post_content = $blocks;
        $post->page_template = 'templates/sm-page-template.php';
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
        $template      = json_decode( $this->replace_template_default_image($template_name) );
        $blocks = str_replace( '\n', '', $template->content );

        // Create the page
        $page_id = wp_insert_post( array(
            'post_title'   => $page_title,
            'post_content' => $blocks,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'page_template' => 'templates/sm-page-template.php'
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

    public function replace_template_default_image($template_name = '') {
        $template_url = SITE_MODE_ADMIN . 'assets/templates/'. $template_name .'/blocks-export.json';
        $template_content = file_get_contents($template_url);
        $image_url = $this->default_images[$template_name];

        if(!str_contains($template_content, $template_name)){
            return $template_content;
        } else {

            // Fetch the image and save it to the uploads directory
            $upload_dir = wp_upload_dir();
            $image_data = file_get_contents($image_url);
            $filename = basename($image_url);
            $file_path = $upload_dir['path'] . '/' . $template_name . '-' . $filename;
            $media_id  = '';

            // Check if the file already exists
            if (!file_exists($file_path)) {
                file_put_contents($file_path, $image_data);

                // Add the image to the media library
                $attachment = array(
                    'post_title' => sanitize_file_name($template_name),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

                $attach_id = wp_insert_attachment($attachment, $file_path);
                $media_id = $attach_id;

                // Update image metadata
                require_once ABSPATH . 'wp-admin/includes/image.php';
                $attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
                wp_update_attachment_metadata($attach_id, $attach_data);
            } else {
                $attachment_posts = get_posts(array(
                    'post_type' => 'attachment',
                    'post_status' => 'inherit',
                    'meta_query' => array(
                        array(
                            'key' => '_wp_attached_file',
                            'value' => $template_name . '-' . $filename,
                            'compare' => 'LIKE'
                        )
                    )
                ));

                if(!empty($attachment_posts)){
                    $media_id = $attachment_posts[0]->ID;
                } else {
                    $media_id = '';
                    return $template_content;
                }


            }

            // Check if the image was successfully uploaded
            if ($media_id) {
                $media_url = wp_get_attachment_url($media_id);
                if ($media_url) {
                    // Replace "image1.png" with the WordPress media URL
                    $new_content = str_replace($template_name, $media_url, $template_content);
                    // Save the updated content back to template-content.php
                    return $new_content;
                }

            } else {
                return $template_content;
            }
        }
    }


}
