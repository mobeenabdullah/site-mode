<?php
/**
 * Responsible for Advanced Settings page.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for Advanced Settings page.
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

	<form id="site-mode-advanced" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<div class="option__row">
			<div class="option__row--label">
				<span><label for="rest_api"><?php esc_html_e( 'Disable REST API', 'site-mode' ); ?></label></span>
				<span class="info_text"><?php esc_html_e( 'Activate to disable the REST API, which can enhance security and prevent unauthorized access', 'site-mode' ); ?></span>
			</div>
			<div class="option__row--field">
				<span class="btn-toggle btn-check-toggle smd_normal_toggle">
					<input type="checkbox" id="rest_api" name="disable-rest-api" value="1" <?php checked( 1, $this->disable_rest_api, true ); ?> />
					<label class="toggle" for="rest_api"></label>
				</span>
			</div>
		</div>
		<div class="option__row">
			<div class="option__row--label">
				<span><label for="feed_enable"><?php esc_html_e( 'Disable RSS Feed', 'site-mode' ); ?></label></span>
				<span class="info_text"><?php esc_html_e( 'Activate to disable the RSS feed, which can improve website security and prevent unauthorized access to content', 'site-mode' ); ?></span>
			</div>
			<div class="option__row--field">
				<span class="btn-toggle btn-check-toggle smd_normal_toggle">
					<input type="checkbox" id="feed_enable" name="disable-rss-feed" value="1" <?php checked( 1, $this->disable_rss_feed, true ); ?>/>
					<label class="toggle" for="feed_enable"></label>
				</span>
			</div>
		</div>

		<div class="option__row">
			<div class="option__row--label">
				<span><label for="feed_enable"><?php esc_html_e( 'Redirect', 'site-mode' ); ?></label></span>
				<span class="info_text"><?php esc_html_e( 'Enabe/Disable Redirect', 'site-mode' ); ?></span>
			</div>
			<div class="option__row--field">
				<span class="btn-toggle btn-check-toggle smd_normal_toggle">
					<input type="checkbox" id="sm-redirect" name="redirect" value="1" <?php checked( 1, $this->redirect, true ); ?>/>
					<label class="toggle" for="sm-redirect"></label>
				</span>
			</div>
		</div>

		<div class="redirect_options <?php echo ( $this->redirect ) ? '' : 'sm_hide_field'; ?>">
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

		<div class="option__row">
			<div class="option__row--label">
				<span><?php esc_html_e( 'Whitelist User Roles', 'site-mode' ); ?></span>
				<span class="info_text"><?php esc_html_e( 'Exclude these user roles from viewing the maintenance page', 'site-mode' ); ?></span>
			</div>
			<div class="option__row--field">
				<?php global $wp_roles; ?>
				<div class="sm_select">
					<select class="whitelist_user_role-multiselect" name="site-mode-user-roles[]" multiple="multiple" id="whitelist_user_role">
						<?php
						foreach ( $wp_roles->roles as $key => $value ) :
							if ( in_array( strtolower( $value['name'] ), $this->user_roles ) ) {
								$selected = 'selected';
							} else {
								$selected = 'not-selected';
							}
							?>
							<option value="<?php echo esc_attr( strtolower( $value['name'] ) ); ?>" <?php echo esc_attr( $selected ); ?>> <?php echo esc_html( $value['name'] ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>

		<div class="option__row">
			<div class="option__row--label">
				<span><label for="whitelist_include"><?php esc_html_e( 'Whitelist Pages', 'site-mode' ); ?></label></span>
				<span class="info_text"><?php esc_html_e( 'Exclude these pages from displaying the maintenance page', 'site-mode' ); ?></span>
			</div>
			<div class="option__row--field">
				<?php $all_pages = get_pages(); ?>
				<div class="sm_select">
					<select class="whitelist-pages-multiselect" name="site-mode-whitelist-pages[]" multiple="multiple" id="whitelist_include">
						<?php
						foreach ( $all_pages as $value ) :
							if ( in_array( $value->ID, $this->whitelist_pages ) ) {
								$selected = 'selected';
							} else {
								$selected = '';
							}
							?>
							<option value="<?php echo esc_attr( $value->ID ); ?>" <?php echo esc_attr( $selected ); ?>> <?php echo esc_html( $value->post_name ); ?></option>
						<?php endforeach; ?>
					</select>
					<span class="arrow-down"></span>
				</div>
			</div>
		</div>

		<?php wp_nonce_field( 'advance-settings-save', 'advance-custom-message' ); ?>
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
