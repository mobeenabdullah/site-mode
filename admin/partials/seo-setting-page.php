<?php
/**
 * Responsible for SEO Settings page.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for SEO Settings page.
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
	<form id="site-mode-seo" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" >
		<div class="option__row">
			<div class="option__row--label">
				<span><label for="seo-meta-title"><?php esc_html_e( 'SEO Meta Title', 'site-mode' ); ?></label></span>
				<span class="info_text"><?php esc_html_e( 'Enter the title of your webpage for better search engine optimization (SEO)', 'site-mode' ); ?></span>
			</div>
			<div class="option__row--field">
				<div class="sm_input_cover">
					<input type="text" id="seo-meta-title" name="seo-meta-title" value="<?php echo esc_attr( $this->meta_title, 'site-mode' ); ?>" />
				</div>
			</div>
		</div>

		<div class="option__row">
			<div class="option__row--label">
				<span><label for="seo-meta-description"><?php esc_html_e( 'SEO Meta Description', 'site-mode' ); ?></label></span>
				<span class="info_text"><?php esc_html_e( 'Write a concise description of your webpage to improve SEO and attract more clicks from search engines', 'site-mode' ); ?></span>
			</div>
			<div class="option__row--field">
				<div class="sm_input_cover">
				<input type="text" id="seo-meta-description" name="seo-meta-description" value="<?php echo esc_attr( $this->meta_description, 'site-mode' ); ?>" />
				</div>
			</div>
		</div>

		<div class="option__row">
			<div class="option__row--label">
				<span><label for="favicon-image"><?php esc_html_e( 'Favicon', 'site-mode' ); ?></label></span>
				<span class="info_text"><?php esc_html_e( 'Upload a small image to represent your website in the browser\'s address bar and bookmarks', 'site-mode' ); ?></span>
			</div>
			<?php
				$favicon_url      = wp_get_attachment_image_url( $this->meta_favicon, 'medium' );
				$favicon_alt_text = get_post_meta( $this->meta_favicon, '_wp_attachment_image_alt', true );
			if ( ! $favicon_alt_text ) {
				$favicon_alt_text = get_the_title( $this->meta_favicon );
			}
			?>
			<div class="option__row--field">
				<div class="upload_image_cover favicon_display">
					<?php if ( $favicon_url ) : ?>
						<div class="sm_image_wrapper">
							<img src="<?php echo esc_url( $favicon_url ); ?>" alt="<?php echo esc_attr( $favicon_alt_text ); ?>" />
						</div>

						<div class="sm-image-fields" style="display: flex; gap: 10px;">
							<button type="button" id="favicon-image" class="btn btn_outline btn_sm sm-upload-image" data-image-type="Favicon">
								<?php esc_html_e( 'Change Favicon', 'site-mode' ); ?>
							</button>
							<button type="button" class="btn btn_outline btn_sm sm-remove-image" data-image-type="Favicon">
								<?php esc_html_e( 'Remove Favicon', 'site-mode' ); ?>
							</button>
							<input type="hidden" name="seo-meta-favicon" value="<?php echo esc_attr( $this->meta_favicon ); ?>">
						</div>

					<?php else : ?>

						<div class="sm_image_wrapper"></div>

						<div class="sm-image-fields" style="display: flex; gap: 10px;">
							<button type="button" id="favicon-image" class="btn btn_outline btn_sm sm-upload-image" data-image-type="Favicon">
								<?php esc_html_e( 'Upload Favicon', 'site-mode' ); ?>
							</button>
							<button type="button" class="btn btn_outline btn_sm sm-remove-image" data-image-type="Favicon" style="display: none;">
								<?php esc_html_e( 'Remove Favicon', 'site-mode' ); ?>
							</button>
							<input type="hidden" name="seo-meta-favicon" value="<?php echo esc_attr( $this->meta_favicon ); ?>">
						</div>

					<?php endif; ?>

				</div>
			</div>
		</div>

		<div class="option__row">
			<div class="option__row--label">
				<span><label for="seo-image" ><?php esc_html_e( 'SEO Meta Image', 'site-mode' ); ?></label></span>
				<span class="info_text"><?php esc_html_e( 'Upload an image to represent your webpage when shared on social media or messaging apps to improve click-through rates and engagement', 'site-mode' ); ?></span>
			</div>
			<?php
			$seo_image_url      = wp_get_attachment_image_url( $this->meta_image, 'medium' );
			$seo_image_alt_text = get_post_meta( $this->meta_image, '_wp_attachment_image_alt', true );
			if ( ! $seo_image_alt_text ) {
				$seo_image_alt_text = get_the_title( $this->meta_image );
			}
			?>
			<div class="option__row--field">
				<div class="upload_image_cover seo_image_display">
					<?php if ( $seo_image_url ) : ?>
						<div class="sm_image_wrapper">
							<img src="<?php echo esc_url( $seo_image_url ); ?>" alt="<?php echo esc_attr( $seo_image_url ); ?>" />
						</div>

						<div class="sm-image-fields" style="display: flex; gap: 10px;">
							<button type="button" id="seo-image" class="btn btn btn_outline btn_sm sm-upload-image" data-image-type="SEO Image">
								<?php esc_html_e( 'Change SEO Image', 'site-mode' ); ?>
							</button>
							<button type="button" class="btn btn_outline btn_sm sm-remove-image" data-image-type="SEO Image">
								<?php esc_html_e( 'Remove SEO Image', 'site-mode' ); ?>
							</button>
							<input type="hidden" name="seo-meta-image" value="<?php echo esc_attr( $this->meta_image ); ?>">
						</div>

					<?php else : ?>

						<div class="sm_image_wrapper"></div>

						<div class="sm-image-fields" style="display: flex; gap: 10px;">
							<button type="button" id="seo-image" class="btn btn_outline btn_sm sm-upload-image" data-image-type="SEO Image">
								<?php esc_html_e( 'Upload SEO Image', 'site-mode' ); ?>
							</button>
							<button type="button" class="btn btn_outline btn_sm sm-remove-image" data-image-type="SEO Image" style="display: none;">
								<?php esc_html_e( 'Remove SEO Image', 'site-mode' ); ?>
							</button>
							<input type="hidden" name="seo-meta-image" value="<?php echo esc_attr( $this->meta_image ); ?>">
						</div>

					<?php endif; ?>

				</div>
			</div>
		</div>

		<?php wp_nonce_field( 'seo-settings-save', 'seo-custom-message' ); ?>
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
