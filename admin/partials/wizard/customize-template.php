<?php
/**
 * Responsible for customize template.
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
$active_template    = '';

if ( isset( $_GET['template'] ) && isset( $_GET['template'] ) ) {
	$active_template = sanitize_text_field( wp_unslash( $_GET['template'] ) );
}
?>

<div class="customize__template sm_customize_settings" style="display: none">
	<div class="customize__template-wrapper">
		<div class="customize__template-cover">
			<div class="customize__template-layout">
				<div class="customize__template-sidebar" aria-label="Navigation" role="region" tabindex="-1">
					<div class="sidebar_content customize__sidebar-content"  style="display: block;">
						<div class="sidebar_content-header">
							<span>Template: <span class="template__name"></span></span>
							<button class="sm__edit-template template-init-back" type="button">
								<span tooltip="Edit Template" flow="left">
									<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M4.3535 9.85344L9 5.20694L6.793 2.99994L2.1465 7.64644C2.08253 7.71049 2.03709 7.79066 2.015 7.87844L1.5 10.4999L4.121 9.98494C4.209 9.96294 4.2895 9.91744 4.3535 9.85344ZM10.5 3.70694C10.6875 3.51941 10.7928 3.2651 10.7928 2.99994C10.7928 2.73478 10.6875 2.48047 10.5 2.29294L9.707 1.49994C9.51947 1.31247 9.26516 1.20715 9 1.20715C8.73484 1.20715 8.48053 1.31247 8.293 1.49994L7.5 2.29294L9.707 4.49994L10.5 3.70694Z" fill="black"/>
									</svg>
								</span>
							</button>
						</div>
						<div class="sidebar_content-settings">
							<div class="component__settings" style="display: block;">
								<div class="component__settings-cover">
									<div class="settings__card template-components">
										<div class="settings__card-title sm_open_panel">
											<h2 class="settings_card_heading">Components</h2>
											<div class="sm-setting-reset-components sm-setting-reset">
												<span tooltip="Reset" flow="left">
													<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M6 8C6.8355 8 7.5 7.3345 7.5 6.5C7.5 5.6655 6.8355 5 6 5C5.1645 5 4.5 5.6655 4.5 6.5C4.5 7.3345 5.1645 8 6 8Z" fill="#CCCCCC"/>
														<path d="M10.4085 5.593C10.2907 5.01718 10.0605 4.47024 9.731 3.9835C9.40729 3.50464 8.99486 3.09221 8.516 2.7685C8.0292 2.43916 7.48229 2.20895 6.9065 2.091C6.60405 2.02966 6.2961 1.99951 5.9875 2.001V1L4 2.5L5.9875 4V3.001C6.2295 3 6.4715 3.023 6.705 3.071C7.15251 3.1627 7.57759 3.3416 7.956 3.5975C8.32919 3.84912 8.65038 4.17031 8.902 4.5435C9.29267 5.12111 9.50098 5.80268 9.5 6.5C9.49991 6.96794 9.40642 7.43116 9.225 7.8625C9.13677 8.07027 9.02895 8.26917 8.903 8.4565C8.77655 8.6427 8.63293 8.81662 8.474 8.976C7.99 9.45909 7.37556 9.79047 6.706 9.9295C6.24036 10.0235 5.76064 10.0235 5.295 9.9295C4.84728 9.83771 4.42202 9.65863 4.0435 9.4025C3.67074 9.1511 3.3499 8.83026 3.0985 8.4575C2.70828 7.87927 2.49985 7.19758 2.5 6.5H1.5C1.50053 7.39685 1.76844 8.27317 2.2695 9.017C2.59342 9.49507 3.00543 9.90708 3.4835 10.231C4.22631 10.7337 5.10306 11.0017 6 11C6.30464 11 6.6085 10.9693 6.907 10.9085C7.48236 10.7897 8.02895 10.5595 8.516 10.231C8.75514 10.0699 8.97802 9.88583 9.1815 9.6815C9.38526 9.47719 9.56939 9.25421 9.7315 9.0155C10.2338 8.27289 10.5015 7.39654 10.5 6.5C10.5 6.19536 10.4693 5.8915 10.4085 5.593Z" fill="#CCCCCC"/>
													</svg>
												</span>
											</div>
										</div>
										<div class="settings__card-options">
											<div class="settings__card-options-box">
												<div class="settings__card-options--label setting__label">
													<h3>Countdown</h3>
													<p class="sm__helper-text">Set timer to show on the website</p>
												</div>
												<div class="settings__card-options--field">
											<span class="btn-toggle settings__toggle">
												<input type="checkbox" name="show-countdown" id="show-countdown" value="1" checked>
												<label class="toggle" for="show-countdown"></label>
											</span>
												</div>
											</div>
											<div class="settings__card-options-box">
												<div class="settings__card-options--label setting__label">
													<h3>Social Icons</h3>
													<p class="sm__helper-text">Show social media icons for better reach</p>
												</div>
												<div class="settings__card-options--field">
											<span class="btn-toggle settings__toggle">
												<input type="checkbox" name="show-social" id="show-social" value="1" checked>
												<label class="toggle" for="show-social"></label>
											</span>
												</div>
											</div>
										</div>
									</div>
									<div class="settings__card">
										<div class="settings__card-title">
											<h2 class="settings_card_heading">Colors</h2>
										</div>
										<div class="settings__card-options">
											<div class="settings__card-options-box">
												<div class="settings__card-options--label setting__label">
													<h3>Choose Colors</h3>
													<p class="sm__helper-text">Choose pre-defined color schemes </p>
												</div>
												<div class="settings__card-options--field">
													<div class="color__scheme">
														<div class="wizard-select">
															<select name="color_scheme" id="color_scheme" >
																<option value="default">Blue</option>
																<option value="preset1">Yellow</option>
																<option value="preset2">Green</option>
																<option value="preset4">Pink</option>
																<option value="preset5">Orange</option>
																<option value="preset6">Violet</option>
															</select>
															<div class="wizard-select-arrow">
																<span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path></svg></span>
															</div>
														</div>
														<div class="color__scheme-preset-box" data-preset="default">
															<span class="color_circles">
																<span class="color-circle default-primary"></span>
																<span class="color-circle default-base"></span>
																<span class="color-circle default-contrast"></span>
															</span>
														</div>
														<div class="color__scheme-preset-box" data-preset="preset1">
														   <span class="color_circles">
																<span class="color-circle p1-primary"></span>
																<span class="color-circle p1-base"></span>
																<span class="color-circle p1-contrast"></span>
															</span>
														</div>
														<div class="color__scheme-preset-box" data-preset="preset2">
														   <span class="color_circles">
																<span class="color-circle p2-primary"></span>
																<span class="color-circle p2-base"></span>
																<span class="color-circle p2-contrast"></span>
															</span>
														</div>
														<div class="color__scheme-preset-box" data-preset="preset3">
														   <span class="color_circles">
																<span class="color-circle p3-primary"></span>
																<span class="color-circle p3-base"></span>
																<span class="color-circle p3-contrast"></span>
															</span>
														</div>
														<div class="color__scheme-preset-box" data-preset="preset4">
															<span class="color_circles">
																<span class="color-circle p4-primary"></span>
																<span class="color-circle p4-base"></span>
																<span class="color-circle p4-contrast"></span>
															</span>
														</div>
														<div class="color__scheme-preset-box" data-preset="preset5">
															<span class="color_circles">
																<span class="color-circle p5-primary"></span>
																<span class="color-circle p5-base"></span>
																<span class="color-circle p5-contrast"></span>
															</span>
														</div>
														<div class="color__scheme-preset-box" data-preset="preset6">
														   <span class="color_circles">
																<span class="color-circle p6-primary"></span>
																<span class="color-circle p6-base"></span>
																<span class="color-circle p6-contrast"></span>
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="customize__template-content">
					<div class="fullscreen_actions">
						<button class="sm_full_screen" type="button" style="display: flex">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>
						</button>
						<button class="sm_exit_full_screen" type="button" style="display: none">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12 16c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.084 0 2 .916 2 2s-.916 2-2 2-2-.916-2-2 .916-2 2-2z"></path><path d="m2.845 16.136 1 1.73c.531.917 1.809 1.261 2.73.73l.529-.306A8.1 8.1 0 0 0 9 19.402V20c0 1.103.897 2 2 2h2c1.103 0 2-.897 2-2v-.598a8.132 8.132 0 0 0 1.896-1.111l.529.306c.923.53 2.198.188 2.731-.731l.999-1.729a2.001 2.001 0 0 0-.731-2.732l-.505-.292a7.718 7.718 0 0 0 0-2.224l.505-.292a2.002 2.002 0 0 0 .731-2.732l-.999-1.729c-.531-.92-1.808-1.265-2.731-.732l-.529.306A8.1 8.1 0 0 0 15 4.598V4c0-1.103-.897-2-2-2h-2c-1.103 0-2 .897-2 2v.598a8.132 8.132 0 0 0-1.896 1.111l-.529-.306c-.924-.531-2.2-.187-2.731.732l-.999 1.729a2.001 2.001 0 0 0 .731 2.732l.505.292a7.683 7.683 0 0 0 0 2.223l-.505.292a2.003 2.003 0 0 0-.731 2.733zm3.326-2.758A5.703 5.703 0 0 1 6 12c0-.462.058-.926.17-1.378a.999.999 0 0 0-.47-1.108l-1.123-.65.998-1.729 1.145.662a.997.997 0 0 0 1.188-.142 6.071 6.071 0 0 1 2.384-1.399A1 1 0 0 0 11 5.3V4h2v1.3a1 1 0 0 0 .708.956 6.083 6.083 0 0 1 2.384 1.399.999.999 0 0 0 1.188.142l1.144-.661 1 1.729-1.124.649a1 1 0 0 0-.47 1.108c.112.452.17.916.17 1.378 0 .461-.058.925-.171 1.378a1 1 0 0 0 .471 1.108l1.123.649-.998 1.729-1.145-.661a.996.996 0 0 0-1.188.142 6.071 6.071 0 0 1-2.384 1.399A1 1 0 0 0 13 18.7l.002 1.3H11v-1.3a1 1 0 0 0-.708-.956 6.083 6.083 0 0 1-2.384-1.399.992.992 0 0 0-1.188-.141l-1.144.662-1-1.729 1.124-.651a1 1 0 0 0 .471-1.108z"></path></svg>
						</button>
					</div>
					<div class="customize__template-content--canvas sm-scroll">
						<iframe src="<?php echo esc_url( 'https://site-mode.com/' . $active_template ); ?>?site-mode-preview=true" id="sm-preview-iframe" name="page" height="700" width="100%" style="display: none;"></iframe>
						<div class="loading__template"  style="display: flex;">
							<div class="template-loader">
								<div class="loader">
									<svg class="circular-loader"viewBox="25 25 50 50" >
										<circle class="loader-path" cx="50" cy="50" r="20" fill="none" stroke-width="2" />
									</svg>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="wizard__content-wrapper--actions">
				<?php wp_nonce_field( 'template_init_action', 'template_init_field' ); ?>
				<div class="customize__actions" style="display: flex;">
					<button class="template-init-back secondary_btn_outline sm__btn" type="button">
						<svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M4.8433 0.94495L4 0.0390625L0 4.33594L4 8.63281L4.8433 7.72693L2.28299 4.97659L8 4.97659V3.69528L2.28299 3.69528L4.8433 0.94495Z" fill="black"/>
						</svg>
						<span>Back</span>
					</button>
					<button class="start_importing primary_btn_outline sm__btn" type="button">
						<span>Activate</span>
						<svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M3.1567 7.68786L4 8.59375L8 4.29688L4 0L3.1567 0.905886L5.71701 3.65622H0V4.93753H5.71701L3.1567 7.68786Z" fill="white"/>
						</svg>
					</button>
				</div>
				<div class="import__actions" style="display: none;">
					<button class="template-back-customize secondary_btn_outline sm__btn" type="button">
						<svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M4.8433 0.94495L4 0.0390625L0 4.33594L4 8.63281L4.8433 7.72693L2.28299 4.97659L8 4.97659V3.69528L2.28299 3.69528L4.8433 0.94495Z" fill="black"/>
						</svg>
						<span>Back</span>
					</button>
					<button class="primary_btn_outline sm__btn import-template" type="button">
						<span>Start Importing</span>
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
