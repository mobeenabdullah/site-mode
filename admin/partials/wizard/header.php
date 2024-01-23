<?php
/**
 * Responsible for wizard header.
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

<div class="sm__wizard-header">
	<div class="sm__wizard-header--logo">
		<img src="<?php echo esc_url( SITE_MODE_ADMIN_URL . '/assets/img/sitemode-logo.png' ); ?>" alt="Site Mode Logo" class="site_mode__wrap--logo">
	</div>
	<div class="sm__wizard-header--steps">
		<div class="sm__wizard-header--steps-cover">
			<div class="sm-wizard-start sm-step active">
				<div class="step_circle"></div>
				<div class="step_label">Select Type</div>
				<div class="step_line"></div>
			</div>
			<div class="sm-select-template sm-step">
				<div class="step_circle"></div>
				<div class="step_label">Select Template</div>
				<div class="step_line"></div>
			</div>
			<div class="sm-customize sm-step">
				<div class="step_circle"></div>
				<div class="step_label">Customize</div>
				<div class="step_line"></div>
			</div>
			<div class="sm-import sm-step">
				<div class="step_circle"></div>
				<div class="step_label">Activate</div>
			</div>
		</div>
	</div>
	<div class="sm__wizard-header--close">
		<div class="sm_close_wizard">
			<button class="close_wizard_btn">
				<span tooltip="Exit to dashboard" flow="down">
					<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M24.288 9L17.9235 15.363L11.5605 9L9.43951 11.121L15.8025 17.484L9.43951 23.847L11.5605 25.968L17.9235 19.605L24.288 25.968L26.409 23.847L20.046 17.484L26.409 11.121L24.288 9Z" fill="#CCCCCC"/>
					</svg>
				</span>
			</button>
		</div>
	</div>
</div>
