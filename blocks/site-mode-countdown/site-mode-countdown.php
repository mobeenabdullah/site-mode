<?php

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */


function site_mode_countdown_block_render_callback( $attributes  ) {

	$due_date  = strtotime($attributes['dueDate']);
	$time_Units = $attributes['timeUnits'] || [];
	$date = strtotime((new DateTime(date('D, d M y H:i:s O'), new DateTimeZone('UTC')))->format('D, d M y H:i:s O'));
	if($due_date >= $date) {
		if(!is_admin()) :
		?>
		<style>
			.sm-countdown-box {
				background-color: <?php echo $attributes['background']  ? esc_attr($attributes['bgColor'])  : ''; ?> ;
				border-color: <?php echo $attributes['border'] ? esc_attr($attributes['borderColor']) : ''; ?> !important;
			}
			.countdown_main-wrapper .countdown-wrapper .sm-countdown-box .countdown_label {
				color: <?php echo esc_attr($attributes['labelColor']); ?>;
			}
			.countdown_main-wrapper .countdown-wrapper .sm-countdown-box .countdown_number {
				color: <?php echo esc_attr($attributes['numberColor']); ?>;
			}
			.countdown_main-wrapper .countdown-wrapper .countdown-seperator {
				color: <?php echo esc_attr($attributes['separatorColor']); ?>;
			}
		</style>
		<?php endif;

		$markup = '<div class="countdown_main-wrapper">';
		$markup .= '<div class="countdown-wrapper '. esc_attr($attributes['preset']) .' ">';
		$markup .= '<input type="hidden" value="'.esc_attr($attributes['dueDate']).'" class="due-date">';
		if(in_array('days', (array)$time_Units)) :
			$markup .= '<div class="sm-countdown-box sm-countdown-days-wrapper">';
			$markup .= '<div class="sm-countdown-days-label countdown_label">Days</div>';
			$markup .= '<div class="sm-countdown-days countdown_number">';
			$markup .= '<span>0</span>';
			$markup .= '</div>';
			$markup .= '</div>';
		endif;
		if($attributes['showSeperator'] && in_array('days', (array)$time_Units)) :
			$markup .= '<span class="countdown-seperator">:</span>';
		endif;
		if(in_array('hours', (array)$time_Units)) :
			$markup .= '<div class="sm-countdown-box sm-countdown-hours-wrapper">';
			$markup .= '<div class="sm-countdown-hours-label countdown_label">Hours</div>';
			$markup .= '<div class="sm-countdown-hours countdown_number">';
			$markup .= '<span>0</span>';
			$markup .= '</div>';
			$markup .= '</div>';
		endif;
		if($attributes['showSeperator'] && in_array('hours', (array)$time_Units)) :
			$markup .= '<span class="countdown-seperator">:</span>';
		endif;
		if(in_array('minutes', (array)$time_Units)):
			$markup .= '<div class="sm-countdown-box sm-countdown-minutes-wrapper">';
			$markup .= '<div class="sm-countdown-minutes-label countdown_label">Minutes</div>';
			$markup .= '<div class="sm-countdown-minutes countdown_number">';
			$markup .= '<span>0</span>';
			$markup .= '</div>';
			$markup .= '</div>';
		endif;
		if($attributes['showSeperator'] && in_array('minutes', (array)$time_Units) && in_array('seconds', (array)$time_Units)) :
			$markup .= '<span class="countdown-seperator">:</span>';
		endif;
		if(in_array('seconds', (array)$time_Units)):
			$markup .= '<div class="sm-countdown-box sm-countdown-seconds-wrapper">';
			$markup .= '<div class="sm-countdown-seconds-label countdown_label">Seconds</div>';
			$markup .= '<div class="sm-countdown-seconds countdown_number">';
			$markup .= '<span>0</span>';
			$markup .= '</div>';
			$markup .= '</div>';
		endif;

		$markup .= '</div>';
		$markup .= '</div>';
		return $markup;
	}

}



function site_mode_countdown_block_init() {
	register_block_type_from_metadata( __DIR__, array(
		'render_callback' => 'site_mode_countdown_block_render_callback',
	));
}

add_action( 'init', 'site_mode_countdown_block_init' );


function enqueue_my_block_script() {

	if(is_admin()) {
		return;
	}

	// Enqueue the JavaScript file for your block
	wp_enqueue_script(
			'sm-countdown-block', // Handle
			plugin_dir_url(__FILE__) . 'src/sm-countdown-frontend.js', // Adjust the path as needed
			array('wp-blocks', 'wp-editor'), // Dependencies
			'1.0.0', // Version number
			true // Load in the footer
	);
}
add_action('enqueue_block_assets', 'enqueue_my_block_script');
