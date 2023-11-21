<?php
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
function create_sm_login_form_block() {
	register_block_type_from_metadata(
		__DIR__,
		array(
			'render_callback' => 'sm_login_form_block_render_callback',
		)
	);
}
add_action( 'init', 'create_sm_login_form_block' );


function sm_login_form_block_render_callback( $attributes ) {
	$colors = $attributes['colors'] ?? array();

	$what_to_do = 'hide';
	if ( ! empty( $attributes['loggedInBehaviour'] ) ) {
		$what_to_do = $attributes['loggedInBehaviour'];
	}

	$output = '<style>
			.login__heading {
				color: ' . $colors['headingText'] . ' !important;
			}
			#sm-login-form-block p label {
				color: ' . $colors['inputLabel'] . ' !important;
			}
			#sm-login-form-block p input {
				background-color: ' . $colors['inputBackground'] . ';
				border-color: ' . $colors['inputBorder'] . ' !important;
			}
			#sm-login-form-block p input[type="submit"] {
				background-color: ' . $colors['buttonBackground'] . ';
				border-color: ' . $colors['buttonBorder'] . ' !important;
				color: ' . $colors['buttonText'] . ';
			}
			#sm-login-form-block p input[type="checkbox"] {
				accent-color: ' . $colors['buttonBackground'] . ' !important;
			}
			.logged_in_as_user {
				color: ' . $colors['inputLabel'] . ' !important;
			}
			.logout_link a {
				color: ' . $colors['buttonBackground'] . ' !important;
			}
	</style>';

	$output .= '<div class="sm-login-form-block">';
	$output .= '<div class="sm-login-form-cover">';
	if ( ! is_user_logged_in() || $what_to_do === 'login' ) {
		$output .= '<h2 class="login__heading">' . __( 'Login', 'site-mode' ) . '</h2>';
	} else {
		$output .= '<h2 class="login__heading">' . __( 'Welcome to', 'site-mode' ) . ' ' . get_bloginfo( 'name' ) . '</h2>';
	}
	if ( is_user_logged_in() ) {

		switch ( $what_to_do ) {
			case 'user':
				$output .= '<div class="logged_in_as_user">';
				$output .= sprintf( __( 'Logged in as %s.', 'site-mode' ), wp_get_current_user()->display_name );
				$output .= '</div>';
				$output .= '<div class="logout_link">';
				$output .= sprintf( '<a href="%s">%s</a>', wp_logout_url(), __( 'Log out', 'site-mode' ) );
				$output .= '</div>';
				return $output;

			case 'logout':
				$redirect_to = false;
				if ( ! empty( $block->context['postId'] ) ) {
					$redirect_to = get_permalink( $block->context['postId'] );
				}
				$output .= '<div class="logout_link">';
				$output .= wp_loginout( $redirect_to, false );
				$output .= '</div>';
				return $output;

			default:
				return '';

			case 'login':
				$attributes['defaultUsername'] = wp_get_current_user()->user_login;

		}
	}

	$attribute_to_form_arg = array(
		'labelUsername'     => 'label_username',
		'defaultUsername'   => 'value_username',
		'labelPassword'     => 'label_password',
		'labelRememberMe'   => 'label_remember',
		'showRememberMe'    => 'remember',
		'defaultRememberMe' => 'value_remember',
		'labelLogIn'        => 'label_log_in',
	);

	$args = array(
		'form_id' => 'sm-login-form-block',
		'echo'    => false,
	);

	if ( isset( $_GET['redirect_to'] ) ) {
		$args['redirect'] = esc_url_raw( $_GET['redirect_to'] );
	} elseif ( ! empty( $block->context['postId'] ) ) {
		$args['redirect'] = get_permalink( $block->context['postId'] );
	}

	foreach ( $attribute_to_form_arg as $attribute => $arg ) {
		if ( isset( $attributes[ $attribute ] ) && '' !== $attributes[ $attribute ] ) {
			$args[ $arg ] = $attributes[ $attribute ];
		}
	}

	$output .= wp_login_form( $args );
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}
