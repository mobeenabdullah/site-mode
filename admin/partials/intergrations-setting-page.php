<?php
/**
 * Responsible for Integrations Settings page.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for Integrations Settings page.
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.1.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
?>

<div class="site_mode__wrap-form">
	<?php settings_errors(); ?>

	<form id="site-mode-integrations" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<div class="option__row">
			<div class="option__row--label">
				<span><label for="google_analytic_id"><?php esc_html_e( 'Google Analytics ID', 'site-mode' ); ?></label></span>
				<span class="info_text"><?php esc_html_e( 'Enter your Google Analytics tracking ID to integrate website analytics and monitor traffic', 'site-mode' ); ?></span>
			</div>
			<div class="option__row--field">
				<div class="sm_input_cover">
					<input type="text" id="google_analytic_id" name="ga-id" value="<?php echo esc_attr( $this->ga_id ); ?>" placeholder="e.g. G-XXXXXXXXXX" />
				</div>
			</div>
		</div>

		<div class="option__row">
			<div class="option__row--label">
				<span><label for="facebook_pixel_id"><?php esc_html_e( 'Facebook Pixel ID', 'site-mode' ); ?></label></span>
				<span class="info_text"><?php esc_html_e( 'Enter your Facebook Pixel ID to enable tracking and measurement of your website\'s performance on Facebook', 'site-mode' ); ?></span>
			</div>
			<div class="option__row--field">
				<div class="sm_input_cover">
					<input type="text" id="facebook_pixel_id" name="facebook-id" value="<?php echo esc_attr( $this->fb_id ); ?>" placeholder="e.g. xxxxxxxxxxxxxxx" />
				</div>
			</div>
		</div>
		<?php wp_nonce_field( 'intergrations_action', 'intergrations_field' ); ?>
		<div class="option__row">
			<div class="option__row--label submit_button">
				<button type="submit" name="submit" class="button button-primary site-mode-save-btn">
					<span class="save-btn-loader" style="display: none;">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><circle cx="12" cy="20" r="2"></circle><circle cx="12" cy="4" r="2"></circle><circle cx="6.343" cy="17.657" r="2"></circle><circle cx="17.657" cy="6.343" r="2"></circle><circle cx="4" cy="12" r="2.001"></circle><circle cx="20" cy="12" r="2"></circle><circle cx="6.343" cy="6.344" r="2"></circle><circle cx="17.657" cy="17.658" r="2"></circle></svg>
					</span>
					<?php esc_html_e( 'Save Changes', 'site-mode' ); ?>
				</button>
			</div>
		</div>

	</form>
</div>
