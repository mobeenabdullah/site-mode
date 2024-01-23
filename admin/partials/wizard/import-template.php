<?php
/**
 * Responsible for import template.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.1.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */

$get_current_user   = wp_get_current_user();
$current_user_email = $get_current_user->user_email;

?>

<div class="sm_final_import" style="display: none">
	<div class="customize__template-wrapper">
		<div class="sm_final_cover">
			<div class="wizard_container">
				<div class="wizard__start-content">
					<div class="wizard__start-content--cover">
						<div class="settings__card import__settings" style="display: block;">
							<div class="settings__card-cover">
								<div class="settings__card-options">
									<div class="settings__card-options-box">
										<div class="settings__card-options--label subscribe_label">
											<h3>Subscribe</h3>
											<p class="sm__helper-text">Subscribe to learn about new templates & features for Site Mode.</p>
										</div>
										<div class="settings__card-options--field">
											<span class="btn-toggle settings__toggle">
												<input type="checkbox" name="show-subscribe-field" id="show-subscribe-field" class="show-subscribe-field" value="1" checked>
												<label class="toggle" for="show-subscribe-field"></label>
											</span>
										</div>
									</div>
									<div class="subscribe_box" style="display: none;">
										<div class="settings__card-options-box">
											<div class="settings__card-options--label subscribe__label">
												<h4>Email:</h4>
												<p class="sm__helper-text">We do not spam, unsubscribe antime.</p>
											</div>
											<div class="settings__card-options--field">
												<input type="text" name="sm-subscribe-email" id="sm-subscribe-email" class="show-subscribe-field"   value="<?php echo esc_html( $current_user_email ); ?>">
												<label for="sm-subscribe-email"></label>
											</div>
										</div>
									</div>
								</div>
								<div class="settings__card-btn">
									<button class="sm__btn primary_button import-template" type="button">
										<span>Start Activation</span>
										<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M10.4602 1.19C9.89883 1.06428 9.3254 1.00057 8.75016 0.999999C8.20691 0.965506 7.66219 1.03875 7.14734 1.21551C6.63249 1.39228 6.15766 1.66908 5.75016 2.03C5.2135 2.56667 4.68183 3.10167 4.15516 3.635C3.55016 3.57 2.11516 3.535 1.15516 4.505C1.06204 4.59868 1.00977 4.72541 1.00977 4.8575C1.00977 4.98959 1.06204 5.11632 1.15516 5.21L6.80516 10.87C6.89884 10.9631 7.02557 11.0154 7.15766 11.0154C7.28975 11.0154 7.41648 10.9631 7.51016 10.87C8.48516 9.87 8.45516 8.46 8.39516 7.87L10.0002 6.27C11.5952 4.675 10.8702 1.68 10.8402 1.555C10.8171 1.46482 10.7693 1.38287 10.7021 1.31838C10.635 1.2539 10.5512 1.20943 10.4602 1.19ZM9.28016 5.565L7.50016 7.335C7.44252 7.39321 7.40006 7.46469 7.37652 7.54316C7.35298 7.62162 7.34908 7.70467 7.36516 7.785C7.47317 8.4539 7.37916 9.13982 7.09516 9.755L2.26016 4.91C2.88509 4.62238 3.58367 4.53506 4.26016 4.66C4.3402 4.67042 4.42157 4.66131 4.49732 4.63345C4.57307 4.60559 4.64095 4.5598 4.69516 4.5C4.69516 4.5 5.39516 3.775 6.45016 2.72C7.09887 2.19906 7.9202 1.94195 8.75016 2C9.14055 2.00193 9.53015 2.03538 9.91516 2.1C10.0352 2.815 10.2252 4.62 9.28016 5.565Z" fill="white"/>
											<path d="M7.86523 5.14999C8.41752 5.14999 8.86523 4.70228 8.86523 4.14999C8.86523 3.59771 8.41752 3.14999 7.86523 3.14999C7.31295 3.14999 6.86523 3.59771 6.86523 4.14999C6.86523 4.70228 7.31295 5.14999 7.86523 5.14999Z" fill="white"/>
											<path d="M2.5 8C1.5 8.5 1.5 10.5 1.5 10.5C2.42553 10.4736 3.31157 10.1192 4 9.5L2.5 8Z" fill="white"/>
										</svg>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="wizard__content-wrapper--actions import__actions">
				<?php wp_nonce_field( 'template_init_action', 'template_init_field' ); ?>
				<div class="import__actions" style="display: none;">
					<button class="template-back-customize secondary_btn_outline sm__btn" type="button">
						<svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M4.8433 0.94495L4 0.0390625L0 4.33594L4 8.63281L4.8433 7.72693L2.28299 4.97659L8 4.97659V3.69528L2.28299 3.69528L4.8433 0.94495Z" fill="black"/>
						</svg>
						<span>Back</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>







