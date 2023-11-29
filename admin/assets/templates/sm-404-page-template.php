<?php
/**
 * Template Name: 404 template for Site Mode
 *
 * @package Site_Mode
 */

defined( 'ABSPATH' ) || exit;
$seo_image_url = '';
$favicon       = '';

$seo_info             = get_option( 'site_mode_seo' );
$integrations_content = get_option( 'site_mode_integrations' );
$sm_design_data       = get_option( 'site_mode_design' );

$sm_404_template_active  = isset( $sm_design_data['page_setup']['404_template_active'] ) ? $sm_design_data['page_setup']['404_template_active'] : '';
$seo_title               = ! empty( $seo_info['meta_title'] ) ? $seo_info['meta_title'] : '';
$seo_desc                = ! empty( $seo_info['meta_description'] ) ? $seo_info['meta_description'] : '';
$sm_404_template_content = ( isset( $sm_design_data ) && isset( $sm_design_data['page_setup']['404_template_content'] ) ) ? $sm_design_data['page_setup']['404_template_content'] : '';

if ( ! empty( $seo_info ) && ! empty( $seo_info['meta_image'] ) ) {
	$seo_image_url = wp_get_attachment_image_url( $seo_info['meta_image'], 'full' );
}

if ( ! empty( $seo_info ) && ! empty( $seo_info['meta_favicon'] ) ) {
	$favicon = wp_get_attachment_image_url( $seo_info['meta_favicon'], 'full' );
}

?>
	<!DOCTYPE html>
	<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">

		<!-- Meta Tags -->
		<meta property="og:url" content="<?php echo esc_url( site_url() ); ?>">
		<meta property="og:type" content="website">
		<meta name="twitter:card" content="summary">

		<?php if ( ! empty( $seo_title ) ) : ?>
			<meta property="og:title" content="<?php echo esc_attr( $seo_title ); ?>">
			<meta name="twitter:title" content="<?php echo esc_attr( $seo_title ); ?>">
		<?php endif; ?>

		<?php if ( ! empty( $seo_desc ) ) : ?>
			<meta property="og:description" content="<?php echo esc_attr( $seo_desc ); ?>">
			<meta name="twitter:description" content="<?php echo esc_attr( $seo_desc ); ?>">
		<?php endif; ?>

		<?php if ( ! empty( $seo_image_url ) ) : ?>
			<meta property="og:image" content="<?php echo esc_attr( $seo_image_url ); ?>"/>
			<meta name="twitter:image" content="<?php echo esc_attr( $seo_image_url ); ?>">
		<?php endif; ?>

		<?php if ( isset( $seo_info['meta_description'] ) ) : ?>
			<meta name="description" content="<?php echo esc_attr( $seo_info['meta_description'] ); ?>"/>
		<?php endif; ?>

		<?php if ( ! empty( $favicon ) ) : ?>
			<link rel="icon" type="image/x-icon" href="<?php echo esc_url( $favicon ); ?>">
		<?php endif; ?>

		<?php if ( ! empty( $seo_title ) ) : ?>
			<title><?php echo esc_html( $seo_title ); ?></title>
		<?php endif; ?>

		<?php
		if ( ! empty( $integrations_content['ga_id'] ) ) {
			?>

			<!-- Google tag (gtag.js) -->
			<script async
					src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $integrations_content['ga_id'] ); ?>"></script>
			<script>
				window.dataLayer = window.dataLayer || [];

				function gtag() {
					dataLayer.push(arguments);
				}

				gtag('js', new Date());

				gtag('config', '<?php echo esc_attr( $integrations_content['ga_id'] ); ?>');
			</script>

			<?php
		}
		if ( ! empty( $integrations_content['fb_id'] ) ) {
			?>

			<script>
				!function (f, b, e, v, n, t, s) {
					if (f.fbq) return;
					n = f.fbq = function () {
						n.callMethod ?
							n.callMethod.apply(n, arguments) : n.queue.push(arguments)
					};
					if (!f._fbq) f._fbq = n;
					n.push = n;
					n.loaded = !0;
					n.version = '2.0';
					n.queue = [];
					t = b.createElement(e);
					t.async = !0;
					t.src = v;
					s = b.getElementsByTagName(e)[0];
					s.parentNode.insertBefore(t, s)
				}(window, document, 'script',
					'https://connect.facebook.net/en_US/fbevents.js');
				fbq('init', '<?php echo esc_attr( $integrations_content['fb_id'] ); ?>');
				fbq('track', 'PageView');
			</script>
			<noscript>
				<img height="1" width="1" style="display:none"
					src="https://www.facebook.com/tr?id=<?php echo esc_attr( $integrations_content['fb_id'] ); ?>&ev=PageView&noscript=1"/>
			</noscript>
			<?php
		}
		?>
		<?php do_action( 'wpsm_head' ); ?>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

	<?php
	wp_body_open();

	if ( $sm_404_template_content ) {
		$parsed_blocks = parse_blocks( $sm_404_template_content );

		if ( $parsed_blocks ) {
			foreach ( $parsed_blocks as $block ) {
				echo wp_kses_post( apply_filters( 'the_content', render_block( $block ) ) );
			}
		}
	} else {
		echo '<div class="sm-404-template">';
		echo '<h1 class="sm-404-template__title">' . esc_html__( '404', 'site-mode' ) . '</h1>';
		echo '<p class="sm-404-template__desc">' . esc_html__( 'Page not found', 'site-mode' ) . '</p>';
		echo '</div>';
	}
	wp_footer();
	do_action( 'wpsm_footer' );
	?>
	</body>
	</html>
<?php
exit();
