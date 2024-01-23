<?php
/**
 * Responsible for customize options.
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

?>

<div class="customize__template-sidebar" aria-label="Navigation" role="region" tabindex="-1">
	<div class="sidebar_content">
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
			<div class="settings__card">
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
						<div class="settings__card-options--label">
							<h3>Countdown</h3>
							<span class="sm__helper-text">Set timer to show on the website</span>
						</div>
						<div class="settings__card-options--field">
											<span class="btn-toggle">
												<input type="checkbox" name="show-countdown" id="show-countdown" value="1" checked>
												<label class="toggle" for="show-countdown"></label>
											</span>
						</div>
					</div>
					<div class="settings__card-options-box">
						<div class="settings__card-options--label">
							<h3>Subscribe</h3>
							<span class="sm__helper-text">Set timer to show on the website</span>
						</div>
						<div class="settings__card-options--field">
											<span class="btn-toggle">
												<input type="checkbox" name="show-subscribe" id="show-subscribe" value="1" checked>
												<label class="toggle" for="show-subscribe"></label>
											</span>
						</div>
					</div>
					<div class="settings__card-options-box">
						<div class="settings__card-options--label">
							<h3>Social</h3>
							<span class="sm__helper-text">Set timer to show on the website</span>
						</div>
						<div class="settings__card-options--field">
											<span class="btn-toggle">
												<input type="checkbox" name="show-social" id="show-social" value="1" checked>
												<label class="toggle" for="show-social"></label>
											</span>
						</div>
					</div>
				</div>
			</div>
			<div class="settings__card">
				<div class="settings__card-title">
					<h2 class="settings_card_heading">Color</h2>
					<div class="sm-setting-reset-colors sm-setting-reset">
						<span tooltip="Reset" flow="left">
							<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6 8C6.8355 8 7.5 7.3345 7.5 6.5C7.5 5.6655 6.8355 5 6 5C5.1645 5 4.5 5.6655 4.5 6.5C4.5 7.3345 5.1645 8 6 8Z" fill="#CCCCCC"/>
								<path d="M10.4085 5.593C10.2907 5.01718 10.0605 4.47024 9.731 3.9835C9.40729 3.50464 8.99486 3.09221 8.516 2.7685C8.0292 2.43916 7.48229 2.20895 6.9065 2.091C6.60405 2.02966 6.2961 1.99951 5.9875 2.001V1L4 2.5L5.9875 4V3.001C6.2295 3 6.4715 3.023 6.705 3.071C7.15251 3.1627 7.57759 3.3416 7.956 3.5975C8.32919 3.84912 8.65038 4.17031 8.902 4.5435C9.29267 5.12111 9.50098 5.80268 9.5 6.5C9.49991 6.96794 9.40642 7.43116 9.225 7.8625C9.13677 8.07027 9.02895 8.26917 8.903 8.4565C8.77655 8.6427 8.63293 8.81662 8.474 8.976C7.99 9.45909 7.37556 9.79047 6.706 9.9295C6.24036 10.0235 5.76064 10.0235 5.295 9.9295C4.84728 9.83771 4.42202 9.65863 4.0435 9.4025C3.67074 9.1511 3.3499 8.83026 3.0985 8.4575C2.70828 7.87927 2.49985 7.19758 2.5 6.5H1.5C1.50053 7.39685 1.76844 8.27317 2.2695 9.017C2.59342 9.49507 3.00543 9.90708 3.4835 10.231C4.22631 10.7337 5.10306 11.0017 6 11C6.30464 11 6.6085 10.9693 6.907 10.9085C7.48236 10.7897 8.02895 10.5595 8.516 10.231C8.75514 10.0699 8.97802 9.88583 9.1815 9.6815C9.38526 9.47719 9.56939 9.25421 9.7315 9.0155C10.2338 8.27289 10.5015 7.39654 10.5 6.5C10.5 6.19536 10.4693 5.8915 10.4085 5.593Z" fill="#CCCCCC"/>
							</svg>
						</span>
					</div>
				</div>
				<div class="settings__card-options">
					<div class="color__scheme">
						<div class="wizard-select">
							<select name="color_scheme" id="color_scheme">
								<option value="default">Default</option>
								<option value="preset1">Preset 1</option>
								<option value="preset2">Preset 2</option>
								<option value="preset3">Preset 3</option>
								<option value="preset4">Preset 4</option>
								<option value="preset5">Preset 5</option>
								<option value="preset6">Preset 6</option>
							</select>
							<div class="wizard-select-arrow">
								<span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path></svg></span>
							</div>
						</div>
						<div class="color__scheme-preset-box" data-preset="default">
											<span class="color_circles">
												<span class="color-circle default-primary"></span>
												<span class="color-circle default-secondary"></span>
												<span class="color-circle default-tertiary"></span>
												<span class="color-circle default-base"></span>
												<span class="color-circle default-contrast"></span>
											</span>
						</div>
						<div class="color__scheme-preset-box" data-preset="preset1">
											<span class="color_circles">
												<span class="color-circle p1-primary"></span>
												<span class="color-circle p1-secondary"></span>
												<span class="color-circle p1-tertiary"></span>
												<span class="color-circle p1-base"></span>
												<span class="color-circle p1-contrast"></span>
											</span>
						</div>

						<div class="color__scheme-preset-box" data-preset="preset2">
											<span class="color_circles">
												<span class="color-circle p2-primary"></span>
												<span class="color-circle p2-secondary"></span>
												<span class="color-circle p2-tertiary"></span>
												<span class="color-circle p2-base"></span>
												<span class="color-circle p2-contrast"></span>
											</span>
						</div>
						<div class="color__scheme-preset-box" data-preset="preset3">
											<span class="color_circles">
												<span class="color-circle p3-primary"></span>
												<span class="color-circle p3-secondary"></span>
												<span class="color-circle p3-tertiary"></span>
												<span class="color-circle p3-base"></span>
												<span class="color-circle p3-contrast"></span>
											</span>
						</div>
						<div class="color__scheme-preset-box" data-preset="preset4">
											<span class="color_circles">
												<span class="color-circle p4-primary"></span>
												<span class="color-circle p4-secondary"></span>
												<span class="color-circle p4-tertiary"></span>
												<span class="color-circle p4-base"></span>
												<span class="color-circle p4-contrast"></span>
											</span>
						</div>
						<div class="color__scheme-preset-box" data-preset="preset5">
											<span class="color_circles">
												<span class="color-circle p5-primary"></span>
												<span class="color-circle p5-secondary"></span>
												<span class="color-circle p5-tertiary"></span>
												<span class="color-circle p5-base"></span>
												<span class="color-circle p5-contrast"></span>
											</span>
						</div>
						<div class="color__scheme-preset-box" data-preset="preset6">
											<span class="color_circles">
												<span class="color-circle p6-primary"></span>
												<span class="color-circle p6-secondary"></span>
												<span class="color-circle p6-tertiary"></span>
												<span class="color-circle p6-base"></span>
												<span class="color-circle p6-contrast"></span>
											</span>
						</div>
					</div>
				</div>
			</div>
			<div class="settings__card">
				<div class="settings__card-title">
					<h2 class="settings_card_heading">Fonts</h2>
					<div class="sm-setting-reset-fonts sm-setting-reset">
										<span tooltip="Reset" flow="left">
											<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M6 8C6.8355 8 7.5 7.3345 7.5 6.5C7.5 5.6655 6.8355 5 6 5C5.1645 5 4.5 5.6655 4.5 6.5C4.5 7.3345 5.1645 8 6 8Z" fill="#CCCCCC"/>
												<path d="M10.4085 5.593C10.2907 5.01718 10.0605 4.47024 9.731 3.9835C9.40729 3.50464 8.99486 3.09221 8.516 2.7685C8.0292 2.43916 7.48229 2.20895 6.9065 2.091C6.60405 2.02966 6.2961 1.99951 5.9875 2.001V1L4 2.5L5.9875 4V3.001C6.2295 3 6.4715 3.023 6.705 3.071C7.15251 3.1627 7.57759 3.3416 7.956 3.5975C8.32919 3.84912 8.65038 4.17031 8.902 4.5435C9.29267 5.12111 9.50098 5.80268 9.5 6.5C9.49991 6.96794 9.40642 7.43116 9.225 7.8625C9.13677 8.07027 9.02895 8.26917 8.903 8.4565C8.77655 8.6427 8.63293 8.81662 8.474 8.976C7.99 9.45909 7.37556 9.79047 6.706 9.9295C6.24036 10.0235 5.76064 10.0235 5.295 9.9295C4.84728 9.83771 4.42202 9.65863 4.0435 9.4025C3.67074 9.1511 3.3499 8.83026 3.0985 8.4575C2.70828 7.87927 2.49985 7.19758 2.5 6.5H1.5C1.50053 7.39685 1.76844 8.27317 2.2695 9.017C2.59342 9.49507 3.00543 9.90708 3.4835 10.231C4.22631 10.7337 5.10306 11.0017 6 11C6.30464 11 6.6085 10.9693 6.907 10.9085C7.48236 10.7897 8.02895 10.5595 8.516 10.231C8.75514 10.0699 8.97802 9.88583 9.1815 9.6815C9.38526 9.47719 9.56939 9.25421 9.7315 9.0155C10.2338 8.27289 10.5015 7.39654 10.5 6.5C10.5 6.19536 10.4693 5.8915 10.4085 5.593Z" fill="#CCCCCC"/>
											</svg>
										</span>
					</div>
				</div>
				<div class="settings__card-options">
					<div class="fonts__warpper">
						<div class="wizard-select">
							<select name="fonts" id="fonts">
								<option value="default">Default</option>
								<option value="roboto">Roboto</option>
								<option value="lato">Lato</option>
								<option value="releway">Releway</option>
							</select>
							<div class="wizard-select-arrow">
								<span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path></svg></span>
							</div>
						</div>
						<div class="fonts-preset-box" data-preset="default">
							<span>Default</span>
						</div>
						<div class="fonts-preset-box" data-preset="roboto">
							<span>Roboto</span>
						</div>
						<div class="fonts-preset-box" data-preset="lato">
							<span>Lato</span>
						</div>
						<div class="fonts-preset-box" data-preset="releway">
							<span>Releway</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="sidebar_content-actions">
			<?php wp_nonce_field( 'template_init_action', 'template_init_field' ); ?>
			<button class="template-init-back" type="button">
				<svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M4.8433 0.94495L4 0.0390625L0 4.33594L4 8.63281L4.8433 7.72693L2.28299 4.97659L8 4.97659V3.69528L2.28299 3.69528L4.8433 0.94495Z" fill="black"/>
				</svg>
				<span>Back</span>
			</button>
			<button class="start_importing next_button" type="button">
				<span>Next</span>
				<svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M3.1567 7.68786L4 8.59375L8 4.29688L4 0L3.1567 0.905886L5.71701 3.65622H0V4.93753H5.71701L3.1567 7.68786Z" fill="white"/>
				</svg>
			</button>
		</div>
	</div>
</div>
