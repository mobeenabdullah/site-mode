<?php
/**
 * Responsible for subscribe table layout.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/admin
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @param array $attributes attributes.
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
function site_mode_countdown_block_render_callback( $attributes ) {

	$due_date   = strtotime( $attributes['dueDate'] );
	$time_units = $attributes['timeUnits'] || array();
	// $date            = strtotime( ( new DateTime( date( 'D, d M y H:i:s O' ), new DateTimeZone( 'UTC' ) ) )->format( 'D, d M y H:i:s O' ) );.
	$date            = strtotime( gmdate( 'D, d M Y H:i:s O' ) );
	$bg_color        = ! is_admin() && $attributes['background'] ? $attributes['bgColor'] : '';
	$border_color    = ! is_admin() && $attributes['border'] ? $attributes['borderColor'] : '';
	$label_color     = ! is_admin() ? $attributes['labelColor'] : '';
	$number_color    = ! is_admin() ? $attributes['numberColor'] : '';
	$separator_color = ! is_admin() ? $attributes['separatorColor'] : '';

	if ( $due_date >= $date ) {

		$markup  = '<div class="countdown_main-wrapper">';
		$markup .= '<div class="countdown-wrapper ' . esc_attr( $attributes['preset'] ) . ' ">';
		$markup .= '<input type="hidden" value="' . esc_attr( $attributes['dueDate'] ) . '" class="due-date">';
		if ( in_array( 'days', (array) $time_units ) ) :
			$markup .= '<div class="sm-countdown-box sm-countdown-days-wrapper" style="background-color: ' . $bg_color . '; border-color: ' . $border_color . '; ">';
			$markup .= '<div class="sm-countdown-days-label countdown_label" style="color: ' . $label_color . ';">Days</div>';
			$markup .= '<div class="sm-countdown-days countdown_number" style="color: ' . $number_color . ';">';
			$markup .= '<span>0</span>';
			$markup .= '</div>';
			$markup .= '</div>';
		endif;
		if ( $attributes['showSeperator'] && in_array( 'days', (array) $time_units ) ) :
			$markup .= '<span class="countdown-seperator" style="color: ' . $separator_color . '; ">:</span>';
		endif;
		if ( in_array( 'hours', (array) $time_units ) ) :
			$markup .= '<div class="sm-countdown-box sm-countdown-hours-wrapper" style="background-color: ' . $bg_color . '; border-color: ' . $border_color . '; ">';
			$markup .= '<div class="sm-countdown-hours-label countdown_label" style="color: ' . $label_color . ';">Hours</div>';
			$markup .= '<div class="sm-countdown-hours countdown_number" style="color: ' . $number_color . ';">';
			$markup .= '<span>0</span>';
			$markup .= '</div>';
			$markup .= '</div>';
		endif;
		if ( $attributes['showSeperator'] && in_array( 'hours', (array) $time_units ) ) :
			$markup .= '<span class="countdown-seperator" style="color: ' . $separator_color . '; ">:</span>';
		endif;
		if ( in_array( 'minutes', (array) $time_units ) ) :
			$markup .= '<div class="sm-countdown-box sm-countdown-minutes-wrapper" style="background-color: ' . $bg_color . '; border-color: ' . $border_color . '; ">';
			$markup .= '<div class="sm-countdown-minutes-label countdown_label" style="color: ' . $label_color . ';">Minutes</div>';
			$markup .= '<div class="sm-countdown-minutes countdown_number" style="color: ' . $number_color . ';">';
			$markup .= '<span>0</span>';
			$markup .= '</div>';
			$markup .= '</div>';
		endif;
		if ( $attributes['showSeperator'] && in_array( 'minutes', (array) $time_units ) && in_array( 'seconds', (array) $time_units ) ) :
			$markup .= '<span class="countdown-seperator" style="color: ' . $separator_color . '; ">:</span>';
		endif;
		if ( in_array( 'seconds', (array) $time_units ) ) :
			$markup .= '<div class="sm-countdown-box sm-countdown-seconds-wrapper" style="background-color: ' . $bg_color . '; border-color: ' . $border_color . '; ">';
			$markup .= '<div class="sm-countdown-seconds-label countdown_label" style="color: ' . $label_color . ';">Seconds</div>';
			$markup .= '<div class="sm-countdown-seconds countdown_number" style="color: ' . $number_color . ';">';
			$markup .= '<span>0</span>';
			$markup .= '</div>';
			$markup .= '</div>';
		endif;

		$markup .= '</div>';
		$markup .= '</div>';
		return $markup;
	}
}

/**
 * Register the block.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/register-block-type/
 */
function site_mode_countdown_block_init() {
	register_block_type_from_metadata(
		__DIR__,
		array(
			'render_callback' => 'site_mode_countdown_block_render_callback',
		)
	);
}

add_action( 'init', 'site_mode_countdown_block_init' );

/**
 * Enqueue the block's assets for the editor.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/loading-assets/
 */
function site_mode_countdown_block_script() {

	if ( is_admin() ) {
		return;
	}

	wp_enqueue_script(
		'sm-countdown-block',
		plugin_dir_url( __FILE__ ) . 'src/sm-countdown.js',
		array( 'wp-blocks' ),
		'1.1.1',
		true
	);
}

add_action( 'enqueue_block_assets', 'site_mode_countdown_block_script' );
