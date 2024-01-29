<?php
/**
 * Responsible for contact table layout.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/admin
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets, so they can be enqueued
 * through the block editor in the corresponding context. *
 *
 * @param array $attributes attributes.
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
function site_mode_contact_form_block_render_callback( $attributes ) {
	$name_label          = isset( $attributes['nameLabel'] ) ? $attributes['nameLabel'] : 'Name';
	$email_label         = isset( $attributes['emailLabel'] ) ? $attributes['emailLabel'] : 'Email';
	$subject_label       = isset( $attributes['subjectLabel'] ) ? $attributes['subjectLabel'] : 'Subject';
	$message_label       = isset( $attributes['messageLabel'] ) ? $attributes['messageLabel'] : 'Email';
	$submit_label        = isset( $attributes['submitLabel'] ) ? $attributes['submitLabel'] : 'Submit';
	$name_placeholder    = isset( $attributes['nameValue'] ) ? $attributes['nameValue'] : 'Enter your name';
	$email_placeholder   = isset( $attributes['emailValue'] ) ? $attributes['emailValue'] : 'Enter your email';
	$subject_placeholder = isset( $attributes['subjectValue'] ) ? $attributes['subjectValue'] : 'Enter subject';
	$message_placeholder = isset( $attributes['messageValue'] ) ? $attributes['messageValue'] : 'Message...';
	$nonce               = wp_create_nonce( 'sm_contact_form_nonce' );

	$label_color         = ! is_admin() && $attributes['labelColor'] ? $attributes['labelColor'] : '';
	$input_bg_color      = ! is_admin() && $attributes['inputBgColor'] ? $attributes['inputBgColor'] : '';
	$input_border_color  = ! is_admin() && $attributes['inputBorderColor'] ? $attributes['inputBorderColor'] : '';
	$input_text_color    = ! is_admin() && $attributes['inputTextColor'] ? $attributes['inputTextColor'] : '';
	$input_border_radius = ! is_admin() && $attributes['inputBorderRadius'] ? $attributes['inputBorderRadius'] : '';
	$input_border_width  = ! is_admin() && $attributes['inputBorderWidth'] ? $attributes['inputBorderWidth'] : '';
	$padding_top         = ! is_admin() && isset( $attributes['inputPadding']['top'] ) ? $attributes['inputPadding']['top'] : '';
	$padding_bottom      = ! is_admin() && isset( $attributes['inputPadding']['bottom'] ) ? $attributes['inputPadding']['bottom'] : '';
	$padding_left        = ! is_admin() && isset( $attributes['inputPadding']['left'] ) ? $attributes['inputPadding']['left'] : '';
	$padding_right       = ! is_admin() && isset( $attributes['inputPadding']['right'] ) ? $attributes['inputPadding']['right'] : '';
	$padding             = $padding_top . ' ' . $padding_right . ' ' . $padding_bottom . ' ' . $padding_left;
	$btn_bg_color        = ! is_admin() && $attributes['btnBgColor'] ? $attributes['btnBgColor'] : '';
	$btn_text_color      = ! is_admin() && $attributes['btnTextColor'] ? $attributes['btnTextColor'] : '';
	$btn_border_color    = ! is_admin() && $attributes['btnBorderColor'] ? $attributes['btnBorderColor'] : '';
	$btn_border_width    = ! is_admin() && $attributes['btnBorderWidth'] ? $attributes['btnBorderWidth'] : '';
	$btn_border_radius   = ! is_admin() && $attributes['btnBorderRadius'] ? $attributes['btnBorderRadius'] : '';
	$btn_padding_top     = ! is_admin() && isset( $attributes['btnPadding']['top'] ) ? $attributes['btnPadding']['top'] : '';
	$btn_padding_bottom  = ! is_admin() && isset( $attributes['btnPadding']['bottom'] ) ? $attributes['btnPadding']['bottom'] : '';
	$btn_padding_left    = ! is_admin() && isset( $attributes['btnPadding']['left'] ) ? $attributes['btnPadding']['left'] : '';
	$btn_padding_right   = ! is_admin() && isset( $attributes['btnPadding']['right'] ) ? $attributes['btnPadding']['right'] : '';
	$btn_padding         = $btn_padding_top . ' ' . $btn_padding_right . ' ' . $btn_padding_bottom . ' ' . $btn_padding_left;

	$markup  = '<div class="sm__contact">';
	$markup .= '<form class="sm__contact-form">';
	$markup .= '<input type="hidden" name="sm_contact_form_nonce" id="sm-contact-nonce" value="' . esc_attr( $nonce ) . '">';

	$markup .= '<div class="sm__contact-two-cols">';
	// Name field.
	$markup .= '<div class="sm__contact-form--field">';
	$markup .= '<label for="sm-contact-name" style="color: ' . $label_color . '">' . esc_attr( $name_label ) . '</label>';
	$markup .= '<input type="text" id="sm-contact-name" name="name" placeholder="' . esc_attr( $name_placeholder ) . '"style="background-color: ' . $input_bg_color . '; color:' . $input_text_color . '; border-color: ' . $input_border_color . '; border-radius: ' . $input_border_radius . 'px; border-width: ' . $input_border_width . 'px; padding: ' . $padding . '">';
	$markup .= '</div>';

	// Email field.
	$markup .= '<div class="sm__contact-form--field">';
	$markup .= '<label for="sm-contact-email" style="color: ' . $label_color . '">' . esc_attr( $email_label ) . '</label>';
	$markup .= '<input type="email" id="sm-contact-email" name="email" placeholder="' . esc_attr( $email_placeholder ) . '"style="background-color: ' . $input_bg_color . '; color:' . $input_text_color . '; border-color: ' . $input_border_color . '; border-radius: ' . $input_border_radius . 'px; border-width: ' . $input_border_width . 'px; padding: ' . $padding . '">';
	$markup .= '</div>';
	$markup .= '</div>';

	$markup .= '<div class="sm__contact-form--field">';
	$markup .= '<label for="sm-contact-subject" style="color: ' . $label_color . '">' . esc_attr( $subject_label ) . '</label>';
	$markup .= '<input type="text" id="sm-contact-subject" name="subject" placeholder="' . esc_attr( $subject_placeholder ) . '"style="background-color: ' . $input_bg_color . '; color:' . $input_text_color . '; border-color: ' . $input_border_color . '; border-radius: ' . $input_border_radius . 'px; border-width: ' . $input_border_width . 'px; padding: ' . $padding . '">';
	$markup .= '</div>';

	// Message field.
	$markup .= '<div class="sm__contact-form--field">';
	$markup .= '<label for="sm-contact-message" style="color: ' . $label_color . '">' . esc_attr( $message_label ) . '</label>';
	$markup .= '<textarea id="sm-contact-message" name="email" placeholder="' . esc_attr( $message_placeholder ) . '"style="background-color: ' . $input_bg_color . '; color:' . $input_text_color . '; border-color: ' . $input_border_color . '; border-radius: ' . $input_border_radius . 'px; border-width: ' . $input_border_width . 'px; padding: ' . $padding . '"></textarea>';
	$markup .= '</div>';

	// Submit Button.
	$markup .= '<div class="sm__contact-form--field">';
	$markup .= '<input type="submit" value="' . $submit_label . '" class="submit_contact" style="background-color: ' . $btn_bg_color . '; color:' . $btn_text_color . '; border-color: ' . $btn_border_color . '; padding: ' . $btn_padding . '; border-width: ' . $btn_border_width . 'px; border-radius: ' . $btn_border_radius . 'px;">';
	$markup .= '</div>';

	$markup .= '</form>';
	$markup .= '</div>';
	return $markup;

}

/**
 * Register the block.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/register-block-type/
 */
function site_mode_contact_form_block_init() {
	register_block_type_from_metadata(
		__DIR__,
		array(
			'render_callback' => 'site_mode_contact_form_block_render_callback',
		)
	);
}

add_action( 'init', 'site_mode_contact_form_block_init' );

/**
 * Enqueue the block's assets for the editor.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/loading-assets/
 */
function site_mode_contact_form_block_script() {

	if ( is_admin() ) {
		return;
	}

	wp_enqueue_script(
		'sm-contact-form-block',
		plugin_dir_url( __FILE__ ) . 'src/sm-contact-form.js',
		array( 'wp-blocks' ),
		'1.1.1',
		true
	);

	wp_localize_script(
		'sm-contact-form-block',
		'smContactForm',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		)
	);

}
add_action( 'enqueue_block_assets', 'site_mode_contact_form_block_script' );
