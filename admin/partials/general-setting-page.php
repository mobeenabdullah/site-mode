<div class="site_mode__wrap-form">
	<form method="post" class="site_mode_form general_form" id="site-mode-general" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<div class="option__row">
			<div class="option__row--label">
				<span><label for="status"><?php esc_html_e( 'Status', 'site-mode' ); ?></label></span>
				<span class="info_text"><?php esc_html_e( 'Enable to display the maintenance page on your website', 'site-mode' ); ?></span>
			</div>
			<div class="option__row--field">
				<div class="sm_checkbox_wrapper">
					<input type="checkbox" id="status" name="site-mode-mode-status" value="1" <?php checked( 1, $this->mode_status, true ); ?> />
					<label for="status"></label>
				</div>
			</div>
		</div>

		<div class="redirect_options <?php echo ( $this->mode_type === 'redirect' ) ? '' : 'sm_hide_field'; ?>">
			<div class="option__row">
				<div class="option__row--label">
					<span><label for="redirect_url"><?php esc_html_e( 'Redirect URL', 'site-mode' ); ?></label></span>
					<span class="info_text"><?php esc_html_e( 'Specify the URL to which the site should be redirected by entering it in the field', 'site-mode' ); ?></span>
				</div>
				<div class="option__row--field">
					<div class="sm_input_cover">
						<input type="text" id="redirect_url" name="site-mode-redirect-url" value="<?php echo esc_attr( $this->redirect_url ); ?>" <?php checked( 1, $this->redirect_url, true ); ?> />
					</div>
				</div>
			</div>
			<div class="option__row">
				<div class="option__row--label">
					<span><label for="delay_seconds"><?php esc_html_e( 'Delay (seconds)', 'site-mode' ); ?></label></span>
					<span class="info_text"><?php esc_html_e( 'Enter the number of seconds to delay the redirection in the range of 0-10 seconds', 'site-mode' ); ?></span>
				</div>
				<div class="option__row--field">
					<div class="sm_input_cover">
						<input type="number" min="0" max="10" id="delay_seconds" class="number" data-inc="1" name="site-mode-redirect-delay" value="<?php echo esc_attr( $this->redirect_delay ); ?>" <?php checked( 1, $this->redirect_delay, true ); ?> />
					</div>
				</div>
			</div>
		</div>

		<!-- Logo Setting -->
		<div class="option__row">
			<div class="option__row--label">
				<span><label for="login_icon"><?php esc_html_e( 'Show Login Icon', 'site-mode' ); ?></label></span>
				<span class="info_text"><?php esc_html_e( 'Enable this option to easily access the login page URL directly from the icon on the front page of your website', 'site-mode' ); ?></span>
			</div>
			<div class="option__row--field">
				<div class="sm_checkbox_wrapper">
					<input type="checkbox" id="login_icon" class="enable_login_icon" name="site-mode-show-login-icon" value="1" <?php checked( 1, $this->show_login_icon, true ); ?> />
					<label for="login_icon"></label>
				</div>
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
						<input type="text" id="redirect_url_field" name="site-mode-custom-login-url" value="<?php echo esc_attr( $this->custom_login_url ); ?>" placeholder="<?php echo esc_attr( site_url() ); ?>/login/" />
					</div>
				</div>
			</div>
		</div>


		<?php wp_nonce_field( 'general_settings_action', 'general_section_field' ); ?>

		<!-- Submit setting -->
		<div class="option__row">
			<div class="option__row--label submit_button">
				<?php // submit_button(); ?>
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
