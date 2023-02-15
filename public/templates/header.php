<?php
    $seo_info            = unserialize(get_option('site_mode_seo'));
    $social         = unserialize(get_option('site_mode_social'));
    $seo_image_url   = isset($seo['meta_image']) ? wp_get_attachment_image_url($seo['meta_image'], 'full') : '';
    $favicon   = isset($seo['meta_favicon']) ? wp_get_attachment_image_url($seo['meta_favicon'], 'full') : '';    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    

     <!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo esc_url(site_url()); ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo esc_attr($seo_info['meta_title']); ?>">
    <meta property="og:description" content="<?php echo esc_attr($seo_info['meta_description']); ?>">
    <meta property="og:image" content="<?php echo esc_url($seo_image_url); ?>" />

      <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?php echo esc_attr($seo_info['meta_title']); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($seo_info['meta_description']); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($seo_image_url); ?>">

    <?php if(isset($seo_info['meta_description'])) : ?>
        <meta name="description" content="<?php echo esc_attr($seo_info['meta_description']); ?>" />
    <?php endif; ?>

    <?php if(isset($seo_info['meta_favicon'])) : ?>
        <link rel="icon" type="image/x-icon" href="<?php echo esc_url($favicon); ?>">
    <?php endif; ?>
    
    <?php if(isset($seo_info['meta_title'])) : ?>        
        <title><?php echo esc_html($seo_info['meta_title']); ?></title>
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
<body>
