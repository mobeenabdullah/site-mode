<?php
	$seo_info               = get_option( 'site_mode_seo' );
	$integrations_content   = get_option( 'site_mode_integrations' );
	$seo_image_url          = isset( $seo['meta_image'] ) ? wp_get_attachment_image_url( $seo['meta_image'], 'full' ) : '';
	$favicon                = isset( $seo['meta_favicon'] ) ? wp_get_attachment_image_url( $seo['meta_favicon'], 'full' ) : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">    

	 <!-- Facebook Meta Tags -->
	<meta property="og:url" content="<?php echo esc_url( site_url() ); ?>">
	<meta property="og:type" content="website">
	<meta property="og:title" content="<?php echo esc_attr( $seo_info['meta_title'] ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $seo_info['meta_description'] ); ?>">
	<meta property="og:image" content="<?php echo esc_url( $seo_image_url ); ?>" />

	  <!-- Twitter Meta Tags -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="<?php echo esc_attr( $seo_info['meta_title'] ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $seo_info['meta_description'] ); ?>">
	<meta name="twitter:image" content="<?php echo esc_url( $seo_image_url ); ?>">

	<?php if ( isset( $seo_info['meta_description'] ) ) : ?>
		<meta name="description" content="<?php echo esc_attr( $seo_info['meta_description'] ); ?>" />
	<?php endif; ?>

	<?php if ( isset( $seo_info['meta_favicon'] ) ) : ?>
		<link rel="icon" type="image/x-icon" href="<?php echo esc_url( $favicon ); ?>">
	<?php endif; ?>
	
	<?php if ( isset( $seo_info['meta_title'] ) ) : ?>        
		<title><?php echo esc_html( $seo_info['meta_title'] ); ?></title>
	<?php endif; ?>

	<?php
	if ( ! empty( $integrations_content['ga_id'] ) ) {
		?>

			<!-- Google tag (gtag.js) -->
			<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $integrations_content['ga_id'] ); ?>"></script>
			<script>
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());

				gtag('config', '<?php echo esc_attr( $integrations_content['ga_id'] ); ?>');
			</script>

			<?php
	}
	if ( ! empty( $integrations_content['fb_id'] ) ) {
		?>

			<script>
				!function(f,b,e,v,n,t,s)
				{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
					n.callMethod.apply(n,arguments):n.queue.push(arguments)};
					if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
					n.queue=[];t=b.createElement(e);t.async=!0;
					t.src=v;s=b.getElementsByTagName(e)[0];
					s.parentNode.insertBefore(t,s)}(window, document,'script',
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

	<?php wp_head(); ?>

</head>
<body>
