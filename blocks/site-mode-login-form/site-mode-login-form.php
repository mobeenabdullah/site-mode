<?php
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
function create_sm_login_form_block() {
	register_block_type_from_metadata( __DIR__, array(
		'render_callback' => 'sm_login_form_block_render_callback',
	) );
}
add_action( 'init', 'create_sm_login_form_block' );


function sm_login_form_block_render_callback($attributes) {

	$output = '';
	if ( is_user_logged_in() ) {

		$what_to_do = 'hide';
		if ( ! empty( $attributes['loggedInBehaviour'] ) ) {
			$what_to_do = $attributes['loggedInBehaviour'];
		}

		switch ( $what_to_do ) {
			case 'user':
				$output .= sprintf( __( 'Logged in as %s.', 'site-mode' ), wp_get_current_user()->display_name );

				$output .= ' ';
				// Add logout link.
			case 'logout':
				$redirect_to = false;
				if ( ! empty( $block->context['postId'] ) ) {
					$redirect_to = get_permalink( $block->context['postId'] );
				}

				$output .= wp_loginout( $redirect_to, false );
				$output .= '</div>';
				return $output;

			case 'hide':
			default:
				return '';

			case 'login':
				$attributes['defaultUsername'] = wp_get_current_user()->user_login;
				// Intentionally fall through.
		}
	}

	$attribute_to_form_arg = [
		'labelUsername'     => 'label_username',
		'defaultUsername'   => 'value_username',
		'labelPassword'     => 'label_password',
		'labelRememberMe'   => 'label_remember',
		'showRememberMe'    => 'remember',
		'defaultRememberMe' => 'value_remember',
		'labelLogIn'        => 'label_log_in',
	];

	$args = [
		'form_id' => 'sm-login-form-block',
		'echo'    => false,
	];

	if ( ! empty( $block->context['postId'] ) ) {
		$args['redirect'] = get_permalink( $block->context['postId'] );
	}

	foreach ( $attribute_to_form_arg as $attribute => $arg ) {
		if ( isset( $attributes[ $attribute ] ) && '' !== $attributes[ $attribute ] ) {
			$args[ $arg ] = $attributes[ $attribute ];
		}
	}

	$output .= wp_login_form($args);

	return $output;

}
