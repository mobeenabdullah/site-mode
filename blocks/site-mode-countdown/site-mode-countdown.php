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
	$date = strtotime((new DateTime(date('D, d M y H:i:s O'), new DateTimeZone('UTC')))->format('D, d M y H:i:s O'));
	if($due_date >= $date) {
		?>
			<script>
				function countdownHandler(countInterval) {
					const now = new Date();
					const nowUTC = new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(), now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds());
					const timeleft = end - nowUTC;
					const days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
					const hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					const minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
					const seconds = Math.floor((timeleft % (1000 * 60)) / 1000);

					if(seconds > 0 || days > 0 || hours > 0 || minutes > 0 ){
						document.querySelector('.countdown_main-wrapper').style.display = 'block';
						setCount(days, hours, minutes, seconds);

					} else {
						clearInterval(countInterval);
						document.querySelector('.countdown_main-wrapper').innerHTML = '';
					}
				}

				function setCount(days, hours, minutes, seconds) {
					const daysArr = days.toString().split('');
					const hoursArr = hours.toString().split('');
					const minutesArr = minutes.toString().split('');
					const secondsArr = seconds.toString().split('');
					const daysWrapper = document.querySelector('.sm-countdown-days');
					const hoursWrapper = document.querySelector('.sm-countdown-hours');
					const minutesWrapper = document.querySelector('.sm-countdown-minutes');
					const secondsWrapper = document.querySelector('.sm-countdown-seconds');
					if(daysWrapper !== null) {
						daysWrapper.innerHTML = setCountContent(daysArr);
					}
					if(hoursWrapper !== null) {
						hoursWrapper.innerHTML = setCountContent(hoursArr);
					}
					if(minutesWrapper !== null) {
						minutesWrapper.innerHTML = setCountContent(minutesArr);
					}
					if(secondsWrapper !== null) {
						secondsWrapper.innerHTML = setCountContent(secondsArr);
					}
				}

				function setCountContent(intervalArr) {
					let content = '';
					if(intervalArr.length === 1) {
						content += `<span>0</span>`;
					}
					intervalArr.forEach((item) => {
						content += `<span>${item}</span>`;
					});
					return content;
				}

				var end = '';
				window.addEventListener('DOMContentLoaded', (event) => {
					const dueDate = document.querySelector('.due-date').value;
					if(dueDate !== ''){
						end = new Date(dueDate);
						var countInterval = setInterval(countdownHandler, 1000);
						countdownHandler(countInterval);
					}
				});
			</script>

		<div class="countdown_main-wrapper">
			<div class="countdown-wrapper default-countdown">
				<input type="hidden" value="<?php echo esc_attr($attributes['dueDate']); ?>" class="due-date">
				<?php if($attributes['showDays']): ?>
					<div class="sm-countdown-box sm-countdown-days-wrapper">
						<div class="sm-countdown-days-label countdown_label">Days</div>
						<div class="sm-countdown-days countdown_number">
							<span>0</span>
						</div>
					</div>
				<?php endif; ?>
				<?php if($attributes['showHours']): ?>
					<div class="sm-countdown-box sm-countdown-hours-wrapper">
						<div class="sm-countdown-hours-label countdown_label">Hours</div>
						<div class="sm-countdown-hours countdown_number">
							<span>0</span>
						</div>
					</div>
				<?php endif; ?>
				<?php if($attributes['showMinutes']): ?>
					<div class="sm-countdown-box sm-countdown-minutes-wrapper">
						<div class="sm-countdown-minutes-label countdown_label">Minutes</div>
						<div class="sm-countdown-minutes countdown_number">
							<span>0</span>
						</div>
					</div>
				<?php endif; ?>
				<?php if($attributes['showSeconds']): ?>
					<div class="sm-countdown-box sm-countdown-seconds-wrapper">
						<div class="sm-countdown-seconds-label countdown_label">Seconds</div>
						<div class="sm-countdown-seconds countdown_number">
							<span>0</span>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

}



function site_mode_countdown_block_init() {
	register_block_type_from_metadata( __DIR__, array(
		'render_callback' => 'site_mode_countdown_block_render_callback',
	));
}

add_action( 'init', 'site_mode_countdown_block_init' );

