<?php
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets, so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */

function site_mode_contact_form_block_render_callback( $attributes ) {

	$nameLabel 	 = isset($attributes['nameLabel']) ? $attributes['nameLabel'] : 'Name';
	$emailLabel  = isset($attributes['emailLabel']) ? $attributes['emailLabel'] : 'Email';
	$namePlaceholder = isset($attributes['namePlaceholder']) ? $attributes['namePlaceholder'] : 'Enter your name';
	$emailPlaceholder = isset($attributes['emailPlaceholder']) ? $attributes['emailPlaceholder'] : 'Enter your email';

	$markup  = '<div class="sm__contact">';
	$markup .= '<form class="sm__contact-form">';
	$markup .= '<div class="sm__contact-form--field">';
	$markup .= '<label for="sm-name">' . esc_attr( $nameLabel ) . '</label>';
	$markup .= '<input type="text" id="sm-contact-name" name="name" placeholder="' . esc_attr( $namePlaceholder ) . '">';
	$markup .= '</div>';
	$markup .= '<div class="sm__contact-form--field">';
	$markup .= '<label for="sm-email">' . esc_attr( $emailLabel ) . '</label>';
	$markup .= '<input type="email" id="sm-conatct-email" name="email" placeholder="' . esc_attr( $emailPlaceholder ) . '">';
	$markup .= '</div>';
	$markup .= '<div class="sm__contact-form--field">';
	$markup .= '<input type="submit" value="Submit">';
	$markup .= '</div>';
	$markup .= '</form>';
	$markup .= '</div>';

	return $markup;

}

function site_mode_contact_form_block_init() {
	register_block_type_from_metadata(
		__DIR__,
		array(
			'render_callback' => 'site_mode_contact_form_block_render_callback',
		)
	);
}


add_action( 'init', 'site_mode_contact_form_block_init' );

function site_mode_contact_form_block_script() {

	if ( is_admin() ) {
		return;
	}

	// Enqueue the JavaScript file for your block
	wp_enqueue_script(
		'sm-contact-form-block', // Handle
		plugin_dir_url( __FILE__ ) . 'src/sm-contact-form.js', // Adjust the path as needed
		array( 'wp-blocks', 'wp-editor' ), // Dependencies
		'1.0.7', // Version number
		true // Load in the footer
	);

	// localise the script with new data
	wp_localize_script( 'sm-contact-form-block', 'ajaxObj', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
	));

}
add_action( 'enqueue_block_assets', 'site_mode_contact_form_block_script' );

