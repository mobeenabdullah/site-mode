<?php
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
function create_sm_login_form_block_init() {
	register_block_type_from_metadata( __DIR__, array(
		'render_callback' => 'create_sm_login_form_block_render_callback',
	) );
}
add_action( 'init', 'create_sm_login_form_block_init' );


function create_sm_login_form_block_render_callback($attributes) {

	wp_login_form();

}
