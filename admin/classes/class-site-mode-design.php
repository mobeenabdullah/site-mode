<?php

/**
 * Responsible for plugin menu
 *
 * @link       https://mobeenabdullah.com
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
class Site_Mode_Design extends  Settings {

    protected $option_name = 'site_mode_design';
    protected $active_template = '';
    protected  $show_social = true;
    protected  $show_countdown = true;
    protected $color_scheme = '';

    protected $page_setup = [
        'active_page'   => '',
        'coming_soon_page_id'  => '',
        'maintenance_page_id'   => '',
        'maintenance_template' => '',
        'coming_soon_template' => '',
    ];
    protected array $default_images = [
        'template-1' => 'https://demo.site-mode.com/wp-content/uploads/2023/10/landscape-tree-nature-wilderness-creative-mountain-367379-pxhere.com_-scaled.jpg',
        'template-2' => 'https://demo.site-mode.com/wp-content/uploads/2023/10/hand-person-black-and-white-girl-woman-sport-615778-pxhere.com_-scaled.jpg',
        'template-3' => 'https://demo.site-mode.com/wp-content/uploads/2023/10/girl-woman-hair-white-photography-cute-596921-pxhere.com_-scaled.jpg',
        'template-4' => 'https://demo.site-mode.com/wp-content/uploads/2023/10/mac-atmosphere-space-galaxy-nebula-outer-space-741617-pxhere.com_-1.jpg',
        'template-5' => 'https://demo.site-mode.com/wp-content/uploads/2023/10/girl-woman-hair-white-photography-cute-596921-pxhere.com_-scaled.jpg',
        'template-6' => 'https://demo.site-mode.com/wp-content/uploads/2023/10/tree-nature-branch-snow-winter-black-and-white-1153705-pxhere.com_-scaled.jpg',

    ];

    public function __construct() {
        $this->get_template_props_init();
    }

    public function ajax_site_mode_skip_wizard() {
        $this->verify_nonce( 'template_init_field', 'template_init_action' );
        update_option('sm-fresh-installation', true);
        wp_send_json_success([
            'success' => true
        ]);
        die();
    }

    protected function add_subscriber_to_mailchimp_list ($email) {

        try {
            $api_key = 'fe524550eae6ded493741f2dc83ce973-us21';
            $status = 'subscribed'; // we are going to talk about it in just a little bit
            $list_id = '4a1d333259'; // List / Audience ID

            // start our Mailchimp connection
            $connection = curl_init();
            curl_setopt(
                $connection,
                CURLOPT_URL,
                'https://' . substr( $api_key, strpos( $api_key, '-' ) + 1 ) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5( strtolower( $email ) )
            );
            curl_setopt( $connection, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', 'Authorization: Basic '. base64_encode( 'user:'.$api_key ) ) );
            curl_setopt( $connection, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $connection, CURLOPT_CUSTOMREQUEST, 'PUT' );
            curl_setopt( $connection, CURLOPT_POST, true );
            curl_setopt( $connection, CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt(
                $connection,
                CURLOPT_POSTFIELDS,
                json_encode( array(
                    'apikey'        => $api_key,
                    'email_address' => $email,
                    'status'        => $status,
                ) )
            );

            $result = curl_exec( $connection );
            update_option('mailchimp-subscriber-status', $result);
        } catch (Exception $e) {
            update_option('mailchimp-subscriber-status', $e->getMessage());
        }
    }

    public function ajax_site_mode_page_setup() {
        $this->verify_nonce( 'setup_action_field', 'setup_action' );
        $active_page_id = $this->get_post_data( 'activePage', 'setup_action', 'setup_action_field', 'text' );

        $design_data = [
            'template'      => $this->active_template,
            'page_setup'    => $this->page_setup,
            'preset'        => $this->color_scheme
        ];

        $design_data['page_setup']['active_page'] = $active_page_id;
        $this->save_data( $this->option_name, $design_data );
        die();

    }

    public function ajax_site_mode_template_init() : void{
        $this->verify_nonce( 'template_init_field', 'template_init_action' );
        $template_name = $this->get_post_data( 'template', 'template_init_action', 'template_init_field', 'text' );
        $subscriber_email = $this->get_post_data( 'subscriber_email', 'template_init_action', 'template_init_field', 'text' );
        $category  = $this->get_post_data( 'category', 'template_init_action', 'template_init_field', 'text' );
        $this->sm_design_properties_init();

        if(!empty($subscriber_email)) {
            $this->add_subscriber_to_mailchimp_list($subscriber_email);
        }

        if(!isset($template_name)) {
            $template_name = $this->active_template;
        }

        $design_data = [
            'template'      => $template_name,
            'page_setup'    => $this->page_setup,
            'preset'        => $this->color_scheme
        ];

        // check has maintaince page
        $page_id = $this->check_maintaince_page($this->page_setup, $template_name, $category );
        $design_data['page_setup']['active_page'] = $page_id;

        if($category === 'maintenance') {
            $design_data['page_setup']['maintenance_page_id'] = $page_id;
            $design_data['page_setup']['maintenance_template'] = $template_name;
        } else {
            $design_data['page_setup']['coming_soon_page_id'] = $page_id;
            $design_data['page_setup']['coming_soon_template'] = $template_name;
        }

        $this->page_id    = $page_id;

        // replace placeholder strings
        $template         = json_decode($this->replace_template_default_image($template_name));
        $template_content = $this->replace_template_placeholder($this->active_template, $template->content, 'countdown', $this->show_countdown);
        $template_content = $this->replace_template_placeholder($this->active_template, $template_content, 'social-media', $this->show_social);
        $blocks = str_replace( '\n', '', $template_content );

        $post = get_post( $page_id );
        $post->post_content = $blocks;
        $post->page_template = 'templates/sm-page-template.php';
        $post->post_status = 'publish';
        $result = wp_update_post($post);

        if(is_wp_error($result)){
            wp_send_json_error( 'Something went wrong.' );
        }
        $this->save_data( $this->option_name, $design_data );
    }
	public function render() {
		$this->display_settings_page( 'design' );
	}

    public function check_maintaince_page($page_setup = '', $template_name = '', $category = ''){

        if( $category === 'maintenance') {
            $id = $page_setup['maintenance_page_id'];
        } else {
            $id = $page_setup['coming_soon_page_id'];
        }

        if($id){
            $page = get_post($id);
            if($page){
                return $page->ID;
            } else {
                return $this->create_maintenance_page($template_name, $category);
            }
        } else {
            return $this->create_maintenance_page($template_name, $category);
        }
    }

    public function create_maintenance_page ($template_name = '', $category = '') {

        // Replace placeholder strings for content
        $template         = json_decode($this->replace_template_default_image($template_name));
        $template_content = $this->replace_template_placeholder($this->active_template, $template->content, 'countdown', $this->show_countdown);
        $template_content = $this->replace_template_placeholder($this->active_template, $template_content, 'social-media', $this->show_social);
        $blocks           = str_replace( '\n', '', $template_content );

        // Create the page
        $page_id = wp_insert_post( array(
            'post_title'    => $category === 'maintenance' ? 'Maintenance Page' : 'Coming Soon Page',
            'post_content'  => $blocks,
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'page_template' => 'templates/sm-page-template.php'
        ) );

        if(!is_wp_error($page_id)){
            $this->page_setup['active_page'] = $page_id;
            if($category === 'maintenance') {
                $this->page_setup['maintenance_page_id'] = $page_id;
                $this->page_setup['maintenance_template'] = $template_name;
            } else {
                $this->page_setup['coming_soon_page_id'] = $page_id;
                $this->page_setup['coming_soon_template'] = $template_name;
            }

            $design_data = [
                'template'      => $template_name,
                'page_setup'    => $this->page_setup,
                'preset'        => $this->color_scheme
            ];

            $this->save_data( $this->option_name, $design_data );
//            return $page_id;
        } else {
            wp_send_json_error( 'Something went wrong.');
        }
    }

    public function get_template_props_init() : void {
        $design_settings = $this->get_data( $this->option_name );

        if(!empty($design_settings)){
            $this->color_scheme    = $design_settings['preset'] ?? '';
            $this->active_template = $design_settings['template'] ?? '';
            $this->page_setup = [
                'active_page'   => $design_settings['page_setup']['active_page'] ?? '',
                'coming_soon_page_id'  => $design_settings['page_setup']['coming_soon_page_id'] ?? '',
                'maintenance_page_id'   => $design_settings['page_setup']['maintenance_page_id'] ?? '',
                'maintenance_template' => $design_settings['page_setup']['maintenance_template'] ?? '',
                'coming_soon_template' => $design_settings['page_setup']['coming_soon_template'] ?? '',
            ];
        }
    }

    protected function replace_template_placeholder($template_name, $template_content, $placeholder, $emptyPlaceholder ) {
        $placeholder_str = '---sm-' . $placeholder . '---';

        if($emptyPlaceholder == 'false'){
            $placeholder_content = '';
        } else {
            $placeholder_content_url = SITE_MODE_ADMIN . 'assets/templates/'. $template_name .'/'. $placeholder .'.json';
            $placeholder_content         = json_decode(file_get_contents($placeholder_content_url))->content;
        }

        if(!str_contains($template_content, $placeholder_str)){
            return $template_content;
        } else {
            return str_replace($placeholder_str, $placeholder_content, $template_content);
        }
    }

    public function replace_template_default_image($template_name = '') {
        $template_url     = SITE_MODE_ADMIN . 'assets/templates/'. $template_name .'/blocks-export.json';
        $template_content = file_get_contents($template_url);
        $image_url        = $this->default_images[$template_name];

        try {

            if(!str_contains($template_content, $template_name)){
                return $template_content;
            } else {

                // Fetch the image and save it to the uploads directory
                $upload_dir = wp_upload_dir();
                $image_data = file_get_contents($image_url);
                $filename   = basename($image_url);
                $file_path  = $upload_dir['path'] . '/' . $template_name . '-' . $filename;
                $media_id   = '';

                // Check if the file already exists
                if (!file_exists($file_path)) {
                    file_put_contents($file_path, $image_data);

                    // Add the image to the media library
                    $attachment = array(
                        'post_title'   => sanitize_file_name($template_name),
                        'post_content' => '',
                        'post_status'  => 'inherit'
                    );

                    $media_id = wp_insert_attachment($attachment, $file_path);

                    // Update image metadata
                    require_once ABSPATH . 'wp-admin/includes/image.php';
                    $attach_data = wp_generate_attachment_metadata($media_id, $file_path);
                    wp_update_attachment_metadata($media_id, $attach_data);
                } else {

                    $attachment_posts = get_posts(array(
                        'post_type'   => 'attachment',
                        'post_status' => 'inherit',
                        'meta_query'  => array(
                            array(
                                'key'     => '_wp_attached_file',
                                'value'   => $template_name . '-' . $filename,
                                'compare' => 'LIKE'
                            )
                        )
                    ));

                    if(!empty($attachment_posts)){
                        $media_id = $attachment_posts[0]->ID;
                    } else {

                        $attachment = array(
                            'post_title'   => sanitize_file_name($template_name),
                            'post_content' => '',
                            'post_status'  => 'inherit'
                        );

                        $media_id = wp_insert_attachment($attachment, $file_path);

                        // Update image metadata
                        require_once ABSPATH . 'wp-admin/includes/image.php';
                        $attach_data = wp_generate_attachment_metadata($media_id, $file_path);
                        wp_update_attachment_metadata($media_id, $attach_data);

                    }
                }

                // Check if the image was successfully uploaded
                if ($media_id) {
                    $media_url = wp_get_attachment_url($media_id);
                    if ($media_url) {
                        // Replace "template1.png" with the site-mode media URL
                        $new_content = str_replace($template_name, $media_url, $template_content);
                        // Save the updated content back to template-content.php
                        return $new_content;
                    } else {
                        return $template_content;
                    }

                } else {
                    return $template_content;
                }
            }
        } catch (Exception $e) {
            return $template_content;
        }
    }

    /**
     * @return void
     */
    protected function sm_design_properties_init(): void {
        $this->get_template_props_init();
        $this->show_countdown = $this->get_post_data('showCountdown', 'template_init_action', 'template_init_field', 'text');
        $this->show_social = $this->get_post_data('showSocial', 'template_init_action', 'template_init_field', 'text');
        $this->color_scheme = $this->get_post_data('colorScheme', 'template_init_action', 'template_init_field', 'text');

    }


}
