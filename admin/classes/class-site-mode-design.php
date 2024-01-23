<?php
/**
 * Responsible for design settings.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for design settings.
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.1.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Design extends Settings {
	/**
	 * Variable for option name.
	 *
	 * @var string $option_name
	 */
	protected $option_name = 'site_mode_design';

	/**
	 * Variable for active template.
	 *
	 * @var string $active_template
	 */
	protected $active_template = '';

	/**
	 * Variable for show social.
	 *
	 * @var bool $show_social
	 */
	protected $show_social = true;

	/**
	 * Variable for show countdown.
	 *
	 * @var bool $show_countdown
	 */
	protected $show_countdown = true;

	/**
	 * Variable for color scheme.
	 *
	 * @var string $color_scheme
	 */
	protected $color_scheme = '';

	/**
	 * Variable for placeholder colors.
	 *
	 * @var string[] $placeholder_colors
	 */
	protected $placeholder_colors = array(
		'base'     => '#AC3C3C',
		'primary'  => '#8B1D86',
		'contrast' => '#B7E972',
	);

	/**
	 * Page Setup Array
	 *
	 * @var array
	 */
	protected $page_setup = array(
		'active_page'          => '',
		'coming_soon_page_id'  => '',
		'maintenance_page_id'  => '',
		'maintenance_template' => '',
		'coming_soon_template' => '',
		'404_template'         => false,
		'404_template_active'  => '',
		'404_template_content' => '',
	);

	/**
	 * Default Images
	 *
	 * @var string[]
	 */
	protected $default_images = array(
		'template-1' => 'https://site-mode.com/wp-content/uploads/2023/11/landscape-tree-nature-wilderness-creative-mountain-367379-pxhere.com_-scaled-1.webp',
		'template-2' => 'https://site-mode.com/wp-content/uploads/2023/11/hand-person-black-and-white-girl-woman-sport-615778-pxhere.com_-scaled-1.webp',
		'template-3' => 'https://site-mode.com/wp-content/uploads/2023/11/girl-woman-hair-white-photography-cute-596921-pxhere.com_-scaled-1.webp',
		'template-4' => 'https://site-mode.com/wp-content/uploads/2023/11/mac-atmosphere-space-galaxy-nebula-outer-space-741617-pxhere.com_-1.webp',
		'template-5' => 'https://site-mode.com/wp-content/uploads/2023/11/girl-woman-hair-white-photography-cute-596921-pxhere.com_-scaled-2.webp',
		'template-6' => 'https://site-mode.com/wp-content/uploads/2023/11/forest-outdoor-rope-sport-boy-kid-773699-pxhere.com_-scaled-1.webp',
		'template-7' => 'https://site-mode.com/wp-content/uploads/2023/11/girl-woman-hair-sunset-photography-wind-541159-pxhere.com_-1-scaled-1.webp',
		'template-8' => 'https://site-mode.com/wp-content/uploads/2023/11/hand-girl-hair-camera-photographer-pine-14200-pxhere.com_-scaled-1.webp',
	);

	/**
	 * Site_Mode_Design constructor.
	 *
	 * @since 1.1.1
	 * @return void
	 */
	public function __construct() {
		$this->get_template_props_init();
	}

	/**
	 * AJAX Site Mode Page Setup Wizard.
	 *
	 * @return void
	 */
	public function ajax_site_mode_skip_wizard() {
		$this->verify_nonce( 'template_init_field', 'template_init_action' );
		update_option( 'sm-fresh-installation', true );
		wp_send_json_success(
			array(
				'success' => true,
			)
		);
		die();
	}

	/**
	 * Add subscriber to mailchimp list.
	 *
	 * @param string $email Email.
	 * @return void
	 */
	protected function add_subscriber_to_mailchimp_list( $email ) {
		try {
			$api_key = 'fe524550eae6ded493741f2dc83ce973-us21';
			$status  = 'subscribed'; // we are going to talk about it in just a little.
			$list_id = '4a1d333259'; // List / Audience ID.

			// Mailchimp API endpoint.
			$url = 'https://' . substr( $api_key, strpos( $api_key, '-' ) + 1 ) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5( strtolower( $email ) );

			// Mailchimp connection options.
			$options = array(
				'headers'   => array(
					'Content-Type'  => 'application/json',
					'Authorization' => 'Basic ' . base64_encode( 'user:' . $api_key ),
				),
				'body'      => wp_json_encode(
					array(
						'email_address' => $email,
						'status'        => $status,
					)
				),
				'method'    => 'PUT',
				'sslverify' => false, // Only use this in development. For production, ensure SSL verification is enabled.
			);

			// Make the request.
			$result = wp_remote_request( $url, $options );

			// Handle the response.
			update_option( 'mailchimp-subscriber-status', $result );
		} catch ( Exception $e ) {
			update_option( 'mailchimp-subscriber-status', $e->getMessage() );
		}
	}

	/**
	 * AJAX Site Mode Page Setup Wizard.
	 *
	 * @return void
	 */
	public function ajax_site_mode_page_setup() {
		$this->verify_nonce( 'setup_action_field', 'setup_action' );
		$active_page_id = $this->get_post_data( 'activePage', 'setup_action', 'setup_action_field', 'text' );
		$page_category  = $this->get_post_data( 'category', 'setup_action', 'setup_action_field', 'text' );
		$design_data    = array(
			'template'   => $this->active_template,
			'page_setup' => $this->page_setup,
		);

		if ( '404' === $page_category ) {
			$design_data['page_setup']['404_template_active'] = $active_page_id;
		} else {
			$design_data['page_setup']['active_page'] = $active_page_id;
		}

		$this->save_data( $this->option_name, $design_data, $page_category );
		die();
	}

	/**
	 * AJAX Site Mode Template Init.
	 *
	 * @return void
	 */
	public function ajax_site_mode_template_init(): void {
		$this->verify_nonce( 'template_init_field', 'template_init_action' );
		$template_name    = $this->get_post_data( 'template', 'template_init_action', 'template_init_field', 'text' );
		$subscriber_email = $this->get_post_data( 'subscriber_email', 'template_init_action', 'template_init_field', 'text' );
		$category         = $this->get_post_data( 'category', 'template_init_action', 'template_init_field', 'text' );
		$this->sm_design_properties_init();

		if ( ! empty( $subscriber_email ) ) {
			$this->add_subscriber_to_mailchimp_list( $subscriber_email );
		}

		if ( ! isset( $template_name ) ) {
			$template_name = $this->active_template;
		}

		$design_data = array(
			'template'   => $template_name,
			'page_setup' => $this->page_setup,
		);

		if ( '404' !== $category ) {
			$page_id = $this->check_page_exist( $this->page_setup, $template_name, $category );
		} else {
			$this->create_page_or_template( $template_name, $category );
			return;
		}

		if ( 'maintenance' === $category ) {
			$design_data['page_setup']['maintenance_page_id']  = $page_id;
			$design_data['page_setup']['maintenance_template'] = $template_name;
			$design_data['page_setup']['active_page']          = $page_id;
		} else {
			$design_data['page_setup']['coming_soon_page_id']  = $page_id;
			$design_data['page_setup']['coming_soon_template'] = $template_name;
			$design_data['page_setup']['active_page']          = $page_id;
		}

		// Change the components placeholder to group the template components.
		$template         = json_decode( $this->replace_template_default_image( $template_name ) );
		$template_content = $template->content;
		if ( 'maintenance' === $category || 'coming-soon' === $category ) :
			$template_content = $this->replace_template_placeholder( $template_name, $template_content, '---sm-countdown---', $this->show_countdown );
			$template_content = $this->replace_template_placeholder( $template_name, $template_content, '---sm-social-media---', $this->show_social );
		endif;

		// Change the color placeholder to set the color scheme.
		$blocks = $this->changeTheColorPlaceholderToSetTheColorScheme( $template_name, $template_content, $this->color_scheme );

		$post                = get_post( $page_id );
		$post->post_content  = $blocks;
		$post->page_template = 'templates/sm-page-template.php';
		$post->post_status   = 'publish';
		$result              = wp_update_post( $post );

		if ( is_wp_error( $result ) ) {
			wp_send_json_error( 'Something went wrong.' );
		}
		$this->save_data( $this->option_name, $design_data, $category );
	}

	/**
	 * Render.
	 *
	 * @return void
	 */
	public function render() {
		$this->display_settings_page( 'design' );
	}

	/**
	 * Check page exist.
	 *
	 * @param mixed  $page_setup Page setup.
	 * @param string $template_name Template name.
	 * @param string $category Category.
	 * @return mixed
	 */
	public function check_page_exist( $page_setup = '', $template_name = '', $category = '' ) {

		if ( '404' !== $category ) {
			if ( 'maintenance' === $category ) {
				$id = $page_setup['maintenance_page_id'];
			} else {
				$id = $page_setup['coming_soon_page_id'];
			}
		} else {
			$this->create_page_or_template( $template_name, $category );
			return;
		}

		if ( $id ) {
			$page = get_post( $id );
			if ( $page ) {
				return $page->ID;
			} else {
				return $this->create_page_or_template( $template_name, $category );
			}
		} else {
			return $this->create_page_or_template( $template_name, $category );
		}
	}

	/**
	 * Create page or template.
	 *
	 * @param string $template_name Template name.
	 * @param string $category Category.
	 * @return void
	 */
	public function create_page_or_template( $template_name = '', $category = '' ) {

		// Change the components placeholder to group the template components.
		$template         = json_decode( $this->replace_template_default_image( $template_name ) );
		$template_content = $template->content;

		if ( 'maintenance' === $category || 'coming-soon' === $category ) :
			$template_content = $this->replace_template_placeholder( $template_name, $template_content, '---sm-countdown---', $this->show_countdown );
			$template_content = $this->replace_template_placeholder( $template_name, $template_content, '---sm-social-media---', $this->show_social );
		else :
			$template_content = $this->replace_template_placeholder( $template_name, $template_content, '---sm-countdown---', false );
			$template_content = $this->replace_template_placeholder( $template_name, $template_content, '---sm-social-media---', false );
		endif;

		// Change the color placeholder to set the color scheme.
		$blocks = $this->changeTheColorPlaceholderToSetTheColorScheme( $template_name, $template_content, $this->color_scheme );

		if ( 'maintenance' === $category ) {
			$title = 'Maintenance Page';
		} elseif ( 'coming-soon' === $category ) {
			$title = 'Coming Soon Page';
		} else {
			$this->page_setup['404_template']         = $template_name;
			$this->page_setup['404_template_active']  = true;
			$this->page_setup['404_template_content'] = $blocks;

			$design_data = array(
				'template'   => $template_name,
				'page_setup' => $this->page_setup,
			);
			$this->save_data( $this->option_name, $design_data, $category );
			return;
		}

		// Create the page.
		$page_id = wp_insert_post(
			array(
				'post_title'    => $title,
				'post_content'  => $blocks,
				'post_status'   => 'publish',
				'post_type'     => 'page',
				'page_template' => 'templates/sm-page-template.php',
			)
		);

		if ( ! is_wp_error( $page_id ) ) {
			if ( 'maintenance' === $category ) {
				$this->page_setup['maintenance_page_id']  = $page_id;
				$this->page_setup['maintenance_template'] = $template_name;
				$this->page_setup['active_page']          = $page_id;
			} else {
				$this->page_setup['coming_soon_page_id']  = $page_id;
				$this->page_setup['coming_soon_template'] = $template_name;
				$this->page_setup['active_page']          = $page_id;
			}

			$design_data = array(
				'template'   => $template_name,
				'page_setup' => $this->page_setup,
			);

			$this->save_data( $this->option_name, $design_data, $category );
		} else {
			wp_send_json_error( 'Something went wrong.' );
		}
	}

	/**
	 * Get template props init.
	 *
	 * @return void
	 */
	public function get_template_props_init(): void {
		$design_settings = $this->get_data( $this->option_name );

		if ( ! empty( $design_settings ) ) {
			$this->active_template = $design_settings['template'] ?? '';
			$this->page_setup      = array(
				'active_page'          => $design_settings['page_setup']['active_page'] ?? '',
				'coming_soon_page_id'  => $design_settings['page_setup']['coming_soon_page_id'] ?? '',
				'maintenance_page_id'  => $design_settings['page_setup']['maintenance_page_id'] ?? '',
				'maintenance_template' => $design_settings['page_setup']['maintenance_template'] ?? '',
				'coming_soon_template' => $design_settings['page_setup']['coming_soon_template'] ?? '',
				'404_template'         => $design_settings['page_setup']['404_template'] ?? '',
				'404_template_active'  => $design_settings['page_setup']['404_template_active'] ?? '',
				'404_template_content' => $design_settings['page_setup']['404_template_content'] ?? '',
			);
		}
	}

	/**
	 * Replace template placeholder.
	 *
	 * @param mixed        $template_name Template name.
	 * @param array|string $template_content Template content.
	 * @param mixed        $placeholder Placeholder.
	 * @param mixed        $empty_placeholder Empty placeholder.
	 * @param mixed        $new_color New color.
	 * @return array|string|string[]
	 */
	protected function replace_template_placeholder( $template_name, $template_content, $placeholder, $empty_placeholder, $new_color = '' ) {
		$placeholder_content = '';
		if ( 'false' !== $empty_placeholder && empty( $new_color ) ) {
			$filtered_placeholder    = str_replace( '---', '', $placeholder );
			$filtered_placeholder    = str_replace( 'sm-', '', $filtered_placeholder );
			$placeholder_content_url = SITE_MODE_ADMIN . 'assets/templates/' . $template_name . '/' . $filtered_placeholder . '.json';
			$placeholder_content     = json_decode( file_get_contents( $placeholder_content_url ) )->content;
		} elseif ( ! empty( $new_color ) ) {
			$placeholder_content = $new_color;
		}

		if ( str_contains( $template_content, strtolower( $placeholder ) ) ) {
			return str_replace( strtolower( $placeholder ), $placeholder_content, $template_content );
		} elseif ( ! str_contains( $template_content, $placeholder ) ) {
			return $template_content;
		} else {
			return str_replace( $placeholder, $placeholder_content, $template_content );
		}
	}

	/**
	 * Replace template default image.
	 *
	 * @param mixed $template_name Template name.
	 * @return array|string|string[]
	 */
	public function replace_template_default_image( $template_name = '' ) {
		$template_url     = SITE_MODE_ADMIN . 'assets/templates/' . $template_name . '/blocks-export.json';
		$template_content = file_get_contents( $template_url );
		$image_url        = $this->default_images[ $template_name ];

		try {

			if ( ! str_contains( $template_content, $template_name ) ) {
				return $template_content;
			} else {

				// Fetch the image and save it to the uploads directory.
				$upload_dir = wp_upload_dir();

				$image_data = file_get_contents( $image_url );

                if ($image_data === false) {
                    // Handle error; the image data could not be retrieved.
                    return $template_content;
                }

				$filename   = basename( $image_url );
				$file_path  = $upload_dir['path'] . '/' . $template_name . '-' . $filename;
				$media_id   = '';

				// Check if the file already exists.
				if ( ! file_exists( $file_path ) ) {
					file_put_contents( $file_path, $image_data );

					// Add the image to the media library.
                    $filetype = wp_check_filetype($filename, null);

                    $attachment = array(
                        'post_mime_type' => $filetype['type'],
                        'post_title'     => sanitize_file_name( $template_name ),
                        'post_content'   => '',
                        'post_status'    => 'inherit'
                    );

					$media_id = wp_insert_attachment( $attachment, $file_path );

					// Update image metadata.
					require_once ABSPATH . 'wp-admin/includes/image.php';
					$attach_data = wp_generate_attachment_metadata( $media_id, $file_path );
					wp_update_attachment_metadata( $media_id, $attach_data );
				} else {

					$attachment_posts = get_posts(
						array(
							'post_type'   => 'attachment',
							'post_status' => 'inherit',
							'meta_query'  => array(
								array(
									'key'     => '_wp_attached_file',
									'value'   => $template_name . '-' . $filename,
									'compare' => 'LIKE',
								),
							),
						)
					);

					if ( ! empty( $attachment_posts ) ) {
						$media_id = $attachment_posts[0]->ID;
					} else {

						$attachment = array(
							'post_title'   => sanitize_file_name( $template_name ),
							'post_content' => '',
							'post_status'  => 'inherit',
						);

						$media_id = wp_insert_attachment( $attachment, $file_path );

						// Update image metadata.
						require_once ABSPATH . 'wp-admin/includes/image.php';
						$attach_data = wp_generate_attachment_metadata( $media_id, $file_path );
						wp_update_attachment_metadata( $media_id, $attach_data );

					}
				}

				// Check if the image was successfully uploaded.
				if ( $media_id ) {
					$media_url = wp_get_attachment_url( $media_id );
					if ( $media_url ) {
						// Replace "template1.png" with the site-mode media URL.
//						$new_content = str_replace( $template_name, $media_url, $template_content );
                        $new_content = str_replace($template_name, $media_url, $template_content);
						// Save the updated content back to template-content.php.
						return $new_content;
					} else {
						return $template_content;
					}
				} else {
					return $template_content;
				}
			}
        } catch (Exception $e) {
            error_log('Image Replacement Error: ' . $e->getMessage());
            return $template_content;
        }
	}

	/**
	 * Sm design properties init.
	 *
	 * @return void
	 */
	protected function sm_design_properties_init(): void {
		$this->get_template_props_init();
		$this->show_countdown = $this->get_post_data( 'showCountdown', 'template_init_action', 'template_init_field', 'text' );
		$this->show_social    = $this->get_post_data( 'showSocial', 'template_init_action', 'template_init_field', 'text' );
		$current_color_scheme = $this->get_post_data( 'colorScheme', 'template_init_action', 'template_init_field', 'text' );
		$this->color_scheme   = $current_color_scheme;
	}


	/**
	 * Change the color placeholder to set the color scheme.
	 *
	 * @param mixed  $template_name Template name.
	 * @param mixed  $template_content Template content.
	 * @param string $scheme Scheme.
	 * @return string
	 */
	public function changeTheColorPlaceholderToSetTheColorScheme( $template_name, $template_content, $scheme ) {

		$color_scheme_file    = SITE_MODE_ADMIN . 'assets/color-scheme.json';
		$color_scheme_content = json_decode( file_get_contents( $color_scheme_file ) )->content;
		$template_content     = $this->replace_template_placeholder( $template_name, $template_content, $this->placeholder_colors['base'], false, $color_scheme_content->$scheme->base );
		$template_content     = $this->replace_template_placeholder( $template_name, $template_content, $this->placeholder_colors['contrast'], false, $color_scheme_content->$scheme->contrast );
		$template_content     = $this->replace_template_placeholder( $template_name, $template_content, $this->placeholder_colors['primary'], false, $color_scheme_content->$scheme->primary );

		$blocks = str_replace( '\n', '', $template_content );
		return $blocks;
	}
}
