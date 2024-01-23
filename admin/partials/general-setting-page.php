<?php
/**
 * Responsible for general Settings page.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for general Settings page.
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
	<form method="post" class="site_mode_form general_form" id="site-mode-general" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<div class="option__row">
			<div class="option__row--label">
				<span><label for="login_icon"><?php esc_html_e( 'Show Login Icon', 'site-mode' ); ?></label></span>
				<span class="info_text"><?php esc_html_e( 'Enable this option to easily access the login page URL directly from the icon on the front page of your website', 'site-mode' ); ?></span>
			</div>
			<div class="option__row--field">
				<span class="btn-toggle btn-check-toggle smd_normal_toggle">
					<input type="checkbox" id="login_icon" class="enable_login_icon" name="site-mode-show-login-icon" value="1" <?php checked( 1, $this->show_login_icon, true ); ?> />
					<label class="toggle" for="login_icon"></label>
				</span>
			</div>
		</div>
		<div class="login_url_field <?php echo ( ! empty( $this->show_login_icon ) ) ? '' : 'sm_hide_field'; ?>">
			<div class="option__row">
				<div class="option__row--label">
					<span><label for="redirect_url_field"><?php esc_html_e( 'Custom Login URL', 'site-mode' ); ?></label></span>
					<span class="info_text"><?php esc_html_e( 'Enter a custom URL for the login page that the login icon should link to', 'site-mode' ); ?></span>
				</div>
				<div class="option__row--field">
					<div class="sm_input_cover">
						<input type="text" id="redirect_url_field" name="site-mode-custom-login-url" value="<?php echo esc_attr( $this->custom_login_url ); ?>" placeholder="<?php echo esc_attr( site_url() ); ?>/wp-login.php" />
					</div>
				</div>
			</div>
		</div>

		<?php wp_nonce_field( 'general_settings_action', 'general_section_field' ); ?>

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
