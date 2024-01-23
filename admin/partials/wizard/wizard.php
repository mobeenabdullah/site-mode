<?php
/**
 * Responsible for Site Mode Wizard Settings Page
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

$templates       = array(
	'template-1' => array(
		'name'     => 'Template 1',
		'category' => 'maintenance',
	),
	'template-2' => array(
		'name'     => 'Template 2',
		'category' => 'coming-soon',
	),
	'template-3' => array(
		'name'     => 'Template 3',
		'category' => 'maintenance',
	),
	'template-4' => array(
		'name'     => 'Template 4',
		'category' => 'coming-soon',
	),
	'template-5' => array(
		'name'     => 'Template 5',
		'category' => 'coming-soon',
	),
	'template-6' => array(
		'name'     => 'Template 6',
		'category' => 'maintenance',
	),
	'template-7' => array(
		'name'     => 'Template 7',
		'category' => '404',
	),
	'template-8' => array(
		'name'     => 'Template 8',
		'category' => '404',
	),
);
$categories      = array(
	'all'         => 'All',
	'coming-soon' => 'Coming Soon',
	'maintenance' => 'Maintenance',
	'404'         => '404',
);
$active_cat      = '';
$active_template = '';

if ( isset( $_GET['template'] ) ) {
	$active_template = sanitize_text_field( wp_unslash( $_GET['template'] ) );
}

if ( isset( $_GET['cat'] ) ) {
	$active_cat = sanitize_text_field( wp_unslash( $_GET['cat'] ) );
	if ( 'maintenance' === $active_cat || 'coming-soon' === $active_cat || '404' === $active_cat ) {
		$sm_category = $active_cat;
	} else {
		$sm_category = 'coming-soon';
	}
} else {
	$sm_category = 'coming-soon';
}

?>
<!-- Please don't remove sm__wizard-wrapper class -->
<div class="sm__wizard-wrapper">
	<!-- Select Template -->
	<div class="wizard_overlay"></div>
	<div class="wizard__content">
		<?php require SITE_MODE_ADMIN . 'partials/wizard/header.php'; ?>
		<div class="wizard__start" style="display: block">
			<div class="wizard_container">
				<div class="wizard__start-content">
					<div class="wizard__start-content--title">
						<h1>Select a Mode, Create the Magic</h1>
					</div>
					<div class="wizard__start-content--cover">
						<div class="wizard__start-cards">
							<div class="wizard__start-cards--item">
								<label class="sm__card">
									<input name="plan" class="sm__card-radio" type="radio" <?php echo 'coming-soon' === $sm_category ? 'checked' : ''; ?> value="coming-soon">
									<div class="sm__card-cover">
										<div class="sm_select_page-icon">
											<svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M58.7563 24.1208L63.315 19.562L59.1909 15.4379L54.2092 20.4166C51.1467 18.5791 47.5767 17.4999 43.75 17.4999C32.4946 17.4999 23.3334 26.6583 23.3334 37.9166C23.3334 49.1749 32.4946 58.3333 43.75 58.3333C55.0055 58.3333 64.1667 49.1749 64.1667 37.9166C64.1644 32.8009 62.2323 27.8743 58.7563 24.1208ZM43.75 52.5C35.7088 52.5 29.1667 45.9579 29.1667 37.9166C29.1667 29.8754 35.7088 23.3333 43.75 23.3333C51.7913 23.3333 58.3334 29.8754 58.3334 37.9166C58.3334 45.9579 51.7913 52.5 43.75 52.5Z" fill="#FE4773"/>
												<path d="M40.8334 29.1667H46.6667V40.8333H40.8334V29.1667ZM37.9167 8.75H49.5834V14.5833H37.9167V8.75ZM8.75004 23.3333H20.4167V29.1667H8.75004V23.3333ZM8.75004 46.6667H20.4167V52.5H8.75004V46.6667ZM5.83337 35H17.4709V40.8333H5.83337V35Z" fill="#FE4773"/>
											</svg>
										</div>
										<div class="sm_select_page-title">
											Coming Soon Page
										</div>
										<div class="sm_select_page-desc">
											Tease your website's future with an enticing
											placeholder page.
										</div>
										<div class="sm_select_page-btn">
											<button class="sm__btn block_btn primary_button setup-button setup-coming-soon-page" data-template-category="coming-soon">Setup Coming Soon Page</button>
										</div>
									</div>
								</label>
							</div>
							<div class="wizard__start-cards--item">
								<label class="sm__card">
									<input name="plan" class="sm__card-radio" type="radio" <?php echo 'maintenance' === $sm_category ? 'checked' : ''; ?> value="maintenance">
									<div class="sm__card-cover">
										<div class="sm_select_page-icon">
											<svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M35 46.6667C41.4342 46.6667 46.6667 41.4342 46.6667 35C46.6667 28.5659 41.4342 23.3334 35 23.3334C28.5659 23.3334 23.3334 28.5659 23.3334 35C23.3334 41.4342 28.5659 46.6667 35 46.6667ZM35 29.1667C38.1617 29.1667 40.8334 31.8384 40.8334 35C40.8334 38.1617 38.1617 40.8334 35 40.8334C31.8384 40.8334 29.1667 38.1617 29.1667 35C29.1667 31.8384 31.8384 29.1667 35 29.1667Z" fill="#FE4773"/>
												<path d="M8.29789 47.0634L11.2146 52.1092C12.7633 54.7838 16.4908 55.7871 19.1771 54.2384L20.72 53.3459C22.4074 54.6732 24.2678 55.7644 26.25 56.5892V58.3334C26.25 61.5505 28.8662 64.1667 32.0833 64.1667H37.9166C41.1337 64.1667 43.75 61.5505 43.75 58.3334V56.5892C45.7314 55.7643 47.5918 54.6742 49.28 53.3488L50.8229 54.2413C53.515 55.7871 57.2337 54.7896 58.7883 52.1092L61.7021 47.0663C62.475 45.7267 62.6847 44.135 62.2849 42.6409C61.8851 41.1469 60.9086 39.8726 59.57 39.098L58.0971 38.2463C58.4102 36.0954 58.4102 33.9105 58.0971 31.7596L59.57 30.908C60.9081 30.1328 61.884 28.8585 62.2837 27.3647C62.6834 25.8708 62.4742 24.2794 61.7021 22.9396L58.7883 17.8967C57.2396 15.2134 53.515 14.2071 50.8229 15.7617L49.28 16.6542C47.5926 15.3269 45.7321 14.2357 43.75 13.4109V11.6667C43.75 8.44962 41.1337 5.83337 37.9166 5.83337H32.0833C28.8662 5.83337 26.25 8.44962 26.25 11.6667V13.4109C24.2685 14.2358 22.4082 15.3259 20.72 16.6513L19.1771 15.7588C16.4821 14.21 12.7604 15.2134 11.2116 17.8938L8.29789 22.9367C7.52492 24.2763 7.3153 25.868 7.71507 27.3621C8.11484 28.8561 9.0913 30.1304 10.43 30.905L11.9029 31.7567C11.5886 33.9065 11.5886 36.0906 11.9029 38.2405L10.43 39.0921C9.09169 39.8678 8.11568 41.1427 7.716 42.637C7.31631 44.1313 7.52557 45.7231 8.29789 47.0634ZM17.9987 39.0192C17.6694 37.7048 17.5019 36.3551 17.5 35C17.5 33.6525 17.6691 32.2992 17.9958 30.9809C18.1496 30.3664 18.099 29.7186 17.8517 29.1354C17.6043 28.5523 17.1737 28.0657 16.625 27.7492L13.3496 25.8534L16.2604 20.8105L19.6 22.7413C20.1446 23.0564 20.7767 23.1864 21.4015 23.1117C22.0263 23.0371 22.61 22.7617 23.065 22.3271C25.0382 20.4504 27.4176 19.0541 30.0183 18.2467C30.6157 18.0643 31.1388 17.695 31.5105 17.193C31.8823 16.691 32.083 16.083 32.0833 15.4584V11.6667H37.9166V15.4584C37.9169 16.083 38.1177 16.691 38.4894 17.193C38.8612 17.695 39.3842 18.0643 39.9816 18.2467C42.5818 19.0552 44.961 20.4514 46.935 22.3271C47.3905 22.7609 47.9741 23.0356 48.5986 23.1103C49.2232 23.1849 49.8551 23.0555 50.4 22.7413L53.7366 20.8134L56.6533 25.8563L53.375 27.7492C52.8266 28.066 52.3963 28.5527 52.1489 29.1357C51.9016 29.7187 51.8508 30.3664 52.0041 30.9809C52.3308 32.2992 52.5 33.6525 52.5 35C52.5 36.3446 52.3308 37.698 52.0012 39.0192C51.8482 39.634 51.8994 40.2819 52.1473 40.8649C52.3951 41.448 52.8261 41.9345 53.375 42.2509L56.6504 44.1438L53.7396 49.1867L50.4 47.2588C49.8555 46.9432 49.2233 46.8129 48.5984 46.8876C47.9735 46.9623 47.3897 47.2379 46.935 47.673C44.9618 49.5497 42.5823 50.946 39.9816 51.7534C39.3842 51.9358 38.8612 52.3051 38.4894 52.8071C38.1177 53.309 37.9169 53.9171 37.9166 54.5417L37.9225 58.3334H32.0833V54.5417C32.083 53.9171 31.8823 53.309 31.5105 52.8071C31.1388 52.3051 30.6157 51.9358 30.0183 51.7534C27.4181 50.9448 25.0389 49.5487 23.065 47.673C22.6109 47.2367 22.0268 46.9604 21.4014 46.8862C20.7761 46.812 20.1436 46.9438 19.6 47.2617L16.2633 49.1925L13.3466 44.1496L16.625 42.2509C17.1739 41.9345 17.6048 41.448 17.8527 40.8649C18.1005 40.2819 18.1518 39.634 17.9987 39.0192Z" fill="#FE4773"/>
											</svg>
										</div>
										<div class="sm_select_page-title">
											Maintenance Mode
										</div>
										<div class="sm_select_page-desc">
											Temporarily offline for necessary improvements. We'll be back soon!
										</div>
										<div class="sm_select_page-btn">
											<button class="sm__btn block_btn primary_button setup-button setup-maintenance-page" data-template-category="maintenance">Setup Maintenance Page</button>
										</div>
									</div>
								</label>
							</div>
							<div class="wizard__start-cards--item">
								<label class="sm__card">
									<input name="plan" class="sm__card-radio" type="radio" <?php echo '404' === $sm_category ? 'checked' : ''; ?> value="404" >
									<div class="sm__card-cover">
										<div class="sm_select_page-icon">
											<svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M32.0834 20.4166H37.9167V40.8333H32.0834V20.4166ZM32.0834 43.75H37.9167V49.5833H32.0834V43.75Z" fill="#CCCCCC"/>
												<path d="M63.3121 21.2713L48.7288 6.68796C48.4584 6.41659 48.137 6.20137 47.7831 6.05471C47.4292 5.90804 47.0498 5.83282 46.6667 5.83338H23.3334C22.9503 5.83282 22.5709 5.90804 22.217 6.05471C21.8631 6.20137 21.5417 6.41659 21.2713 6.68796L6.68796 21.2713C6.41659 21.5417 6.20137 21.8631 6.05471 22.217C5.90804 22.5709 5.83282 22.9503 5.83338 23.3334V46.6667C5.83338 47.4425 6.13963 48.1834 6.68796 48.7288L21.2713 63.3121C21.5417 63.5835 21.8631 63.7987 22.217 63.9454C22.5709 64.0921 22.9503 64.1673 23.3334 64.1667H46.6667C47.4425 64.1667 48.1834 63.8605 48.7288 63.3121L63.3121 48.7288C63.5835 48.4584 63.7987 48.137 63.9454 47.7831C64.0921 47.4292 64.1673 47.0498 64.1667 46.6667V23.3334C64.1673 22.9503 64.0921 22.5709 63.9454 22.217C63.7987 21.8631 63.5835 21.5417 63.3121 21.2713ZM58.3334 45.4592L45.4592 58.3334H24.5409L11.6667 45.4592V24.5409L24.5409 11.6667H45.4592L58.3334 24.5409V45.4592Z" fill="#CCCCCC"/>
											</svg>
										</div>
										<div class="sm_select_page-title">
											Error 404 Page
										</div>
										<div class="sm_select_page-desc">
											Error page for lost content, guiding users back.
										</div>
										<div class="sm_select_page-btn">
											<button class="sm__btn block_btn primary_button setup-button setup-404-page" data-template-category="404">Setup 404 Page</button>
										</div>
									</div>
								</label>
							</div>
							<div class="wizard__start-cards--item">
								<label class="sm__card">
									<input name="selected_page_type" class="sm__card-radio" type="radio" disabled value="landing_page_mode">
									<div class="sm__card-cover">
										<div class="sm_select_page-icon">
											<svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M61.0167 6.94166C57.7423 6.20832 54.3973 5.83665 51.0417 5.83333C47.8727 5.63212 44.6952 6.05937 41.6919 7.0905C38.6886 8.12163 35.9188 9.7363 33.5417 11.8417C30.4112 14.9722 27.3098 18.0931 24.2376 21.2042C20.7084 20.825 12.3375 20.6208 6.73755 26.2792C6.19432 26.8256 5.8894 27.5649 5.8894 28.3354C5.8894 29.106 6.19432 29.8452 6.73755 30.3917L39.6959 63.4083C40.2424 63.9516 40.9816 64.2565 41.7521 64.2565C42.5227 64.2565 43.2619 63.9516 43.8084 63.4083C49.4959 57.575 49.3209 49.35 48.9709 45.9083L58.3334 36.575C67.6375 27.2708 63.4084 9.79999 63.2334 9.07083C63.0987 8.54476 62.8199 8.06674 62.4283 7.69057C62.0366 7.3144 61.5478 7.05503 61.0167 6.94166ZM54.1334 32.4625L43.75 42.7875C43.4138 43.127 43.1661 43.544 43.0288 44.0017C42.8915 44.4595 42.8687 44.9439 42.9625 45.4125C43.5926 49.3144 43.0442 53.3156 41.3875 56.9042L13.1834 28.6417C16.8288 26.9639 20.9038 26.4545 24.85 27.1833C25.3169 27.2441 25.7916 27.191 26.2335 27.0284C26.6754 26.8659 27.0713 26.5988 27.3876 26.25C27.3876 26.25 31.4709 22.0208 37.625 15.8667C41.4092 12.8278 46.2003 11.328 51.0417 11.6667C53.319 11.6779 55.5917 11.873 57.8375 12.25C58.5375 16.4208 59.6459 26.95 54.1334 32.4625Z" fill="#CCCCCC"/>
												<path d="M45.8792 30.0417C49.1009 30.0417 51.7126 27.43 51.7126 24.2083C51.7126 20.9867 49.1009 18.375 45.8792 18.375C42.6576 18.375 40.0459 20.9867 40.0459 24.2083C40.0459 27.43 42.6576 30.0417 45.8792 30.0417Z" fill="#CCCCCC"/>
												<path d="M14.5833 46.6666C8.75 49.5833 8.75 61.25 8.75 61.25C14.149 61.0959 19.3175 59.0285 23.3333 55.4166L14.5833 46.6666Z" fill="#CCCCCC"/>
											</svg>
										</div>
										<div class="sm_select_page-title">
											Landing Page (coming soon)
										</div>
										<div class="sm_select_page-desc">
											Create a captivating entrance for your visitors with a high-converting landing page.
										</div>
										<div class="sm_select_page-btn">
											<button class="sm__btn block_btn primary_button">Build a Landing Page</button>
										</div>
									</div>
								</label>
							</div>

							<div class="wizard__start-cards--item">
								<label class="sm__card">
									<input name="plan" class="sm__card-radio" type="radio" disabled value="login">
									<div class="sm__card-cover">
										<div class="sm_select_page-icon">
											<svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M35 5.83337C26.9587 5.83337 20.4166 12.3755 20.4166 20.4167V26.25H17.5C14.2829 26.25 11.6666 28.8663 11.6666 32.0834V58.3334C11.6666 61.5505 14.2829 64.1667 17.5 64.1667H52.5C55.717 64.1667 58.3333 61.5505 58.3333 58.3334V32.0834C58.3333 28.8663 55.717 26.25 52.5 26.25H49.5833V20.4167C49.5833 12.3755 43.0412 5.83337 35 5.83337ZM26.25 20.4167C26.25 15.5925 30.1758 11.6667 35 11.6667C39.8241 11.6667 43.75 15.5925 43.75 20.4167V26.25H26.25V20.4167ZM52.5058 58.3334H37.9166V51.6892C39.652 50.6771 40.8333 48.8163 40.8333 46.6667C40.8333 43.4496 38.217 40.8334 35 40.8334C31.7829 40.8334 29.1666 43.4496 29.1666 46.6667C29.1666 48.8134 30.3479 50.6771 32.0833 51.6892V58.3334H17.5V32.0834H52.5L52.5058 58.3334Z" fill="#CCCCCC"/>
											</svg>
										</div>
										<div class="sm_select_page-title">
											Custom Login Page (coming soon)
										</div>
										<div class="sm_select_page-desc">
											Secure, branded login gateway with personalized options.
										</div>
										<div class="sm_select_page-btn">
											<button class="sm__btn block_btn primary_button setup-button" data-template-category="login">Setup Login Page</button>
										</div>
									</div>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="wizard__content-wrapper--actions">
				<button type="button" class="choose_page_type sm__btn primary_btn_outline">
					<span>Select Template</span>
					<svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M3.1567 7.68786L4 8.59375L8 4.29688L4 0L3.1567 0.905886L5.71701 3.65622H0V4.93753H5.71701L3.1567 7.68786Z" fill="white"/>
					</svg>
				</button>
			</div>
		</div>
		<div class="wizard__content-wrapper" style="display: none">
			<div class="wizard_container">
				<div class="wizard__templates">
					<div class="wizard__templates-filters">
						<div class="result__showing">
							Showing <span class="display_template_name"></span>templates. <span class="sm_clearfilter">Clear Filters</span>
						</div>
						<div class="wizard__templates-filter">
							<div class="wizard__templates-filter-cover">
								<?php foreach ( $categories as $key => $category ) : ?>
									<button type="button" class="template-category-filter filter_btn <?php echo 'all' === $key ? 'active' : ''; ?> " data-template-category="<?php echo esc_attr( $key ); ?>">
										<?php echo esc_html( $category ); ?>
									</button>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<div class="template_options wizard__templates-cards">
						<input type="hidden" name="template-name" id="selected-template-name" value="<?php echo esc_html( $active_template ); ?>">
						<?php foreach ( $templates as $key => $template ) : ?>
							<div class="template_card template-content-wrapper wizard__templates-cards--single <?php echo $active_template === $key ? 'active' : ''; ?>" data-category-name="<?php echo esc_attr( $template['category'] ); ?>" data-category-template="<?php echo esc_attr( $key ); ?>">
								<div class="template_card-img" style="background-image: url(<?php echo esc_url( SITE_MODE_ADMIN_URL . 'assets/templates/' . $key . '/screenshot.jpg' ); ?>);">
									<div class="template_card-actions">
										<button type="button" class="select_template" data-template-label="<?php echo esc_attr( $template['name'] ); ?>">
											<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M7.00008 1.16663C3.78358 1.16663 1.16675 3.78346 1.16675 6.99996C1.16675 10.2165 3.78358 12.8333 7.00008 12.8333C10.2166 12.8333 12.8334 10.2165 12.8334 6.99996C12.8334 3.78346 10.2166 1.16663 7.00008 1.16663ZM7.00008 11.6666C4.427 11.6666 2.33341 9.57304 2.33341 6.99996C2.33341 4.42688 4.427 2.33329 7.00008 2.33329C9.57316 2.33329 11.6667 4.42688 11.6667 6.99996C11.6667 9.57304 9.57316 11.6666 7.00008 11.6666Z" fill="white"/>
												<path d="M5.83272 7.92569L4.49164 6.58694L3.66797 7.41294L5.83389 9.57419L9.74572 5.66236L8.92089 4.83752L5.83272 7.92569Z" fill="white"/>
											</svg>
											<span>Select</span>
										</button>
									</div>
								</div>
								<div class="template_card-heading">
									<h2 class="template_card-content--title"><?php echo esc_html( $template['name'] ); ?></h2>
									<a href="<?php echo esc_url( 'https://site-mode.com/' . $key ); ?>" class="template_card-content--demo" target="_blank">Live Demo</a>
								</div>
							</div>
						<?php endforeach; ?>
						<div class="wizard__templates-cards--single template_empty_card">
							More Templates <br>
							Coming Soon
						</div>
					</div>
				</div>
			</div>
			<div class="wizard__content-wrapper--actions">
				<button class="back_wizard_start sm__btn secondary_btn_outline" type="button">
					<svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M4.8433 0.94495L4 0.0390625L0 4.33594L4 8.63281L4.8433 7.72693L2.28299 4.97659L8 4.97659V3.69528L2.28299 3.69528L4.8433 0.94495Z" fill="black"/>
					</svg>
					<span>Back</span>
				</button>
				<button class="select_template_btn sm__btn primary_btn_outline disabled__customize" disabled="disabled" type="button" data-template-name="<?php echo esc_attr( $key ); ?>" data-template-label="<?php echo esc_attr( $template['name'] ); ?>">
					<span>Customize</span>
					<svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M3.1567 7.68786L4 8.59375L8 4.29688L4 0L3.1567 0.905886L5.71701 3.65622H0V4.93753H5.71701L3.1567 7.68786Z" fill="white"/>
					</svg>
				</button>
			</div>
		</div>
		<?php require SITE_MODE_ADMIN . 'partials/wizard/customize-template.php'; ?>
		<?php require SITE_MODE_ADMIN . 'partials/wizard/import-template.php'; ?>
	</div>
</div>

<div id="importing__popup" class="sm-modal">
	<div class="modal_overlay"></div>
	<div class="sm-modal-content">
		<div class="import__content" style="display: block;">
			<div class="sm-modal-content-text">
				<div class="template-loader">
					<div class="loader">
						<svg class="circular-loader"viewBox="25 25 50 50" >
							<circle class="loader-path" cx="50" cy="50" r="20" fill="none" stroke-width="2" />
						</svg>
					</div>
				</div>
				<h3>Activating ...</h3>
				<p>Please be patient and don't refresh this page. The activation can take some time.</p>
			</div>
		</div>

		<div class="error__content" style="display: none;">
			<div class="error_icon">
				<div class="icon error_box">
						<span class="x-mark">
						<span class="errorLine left"></span>
						<span class="errorLine right"></span>
						</span>
				</div>
				<h3>Unfortunately, an unexpected hiccup disrupted the smooth import process.</h3>
			</div>
		</div>

		<div class="thank__you-content" style="display: none;">
				<a href="/wp-admin/admin.php?page=site-mode&setting=dashboard" class="close-popup">
					<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M24.288 9.51599L17.9235 15.879L11.5605 9.51599L9.43945 11.637L15.8025 18L9.43945 24.363L11.5605 26.484L17.9235 20.121L24.288 26.484L26.409 24.363L20.046 18L26.409 11.637L24.288 9.51599Z" fill="#CCCCCC"/>
					</svg>
				</a>
			<div class="sm-modal-content-text remove_animation">
				<div class="icon-success icon success animate">
					<span class="tip successLine animateSuccessTip"></span>
					<span class="long successLine animateSuccessLong"></span>
					<div class="placeholder"></div>
					<div class="fix"></div>
				</div>
				<h3>Congratulations</h3>
				<p class="sm-modal-success-message">Your {comingsoon} page is ready. Now you can view the page or start customizing it.</p>
				<div class="buttons__wrapper">
					<a href="#" class="outline_btn">Edit Page</a>
					<a href="<?php echo esc_url( home_url() . '?site-mode-preview=true' ); ?>" class="primary_btn" target="_blank">Preview Page</a>
				</div>
			</div>
		</div>
	</div>
</div>
