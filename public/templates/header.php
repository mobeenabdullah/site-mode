<?php
    $seo            = unserialize(get_option('site_mode_seo'));
    $og_image_url   = isset($seo['meta_image']) ? wp_get_attachment_image_url($seo['meta_image'], 'full') : '';
    $favicon   = isset($seo['meta_favicon']) ? wp_get_attachment_image_url($seo['meta_favicon'], 'full') : '';    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:image" content="<?php echo $og_image_url; ?>" />

    <?php if(isset($seo['meta_description'])) : ?>
        <meta name="description" content="<?php echo esc_html($seo['meta_description']); ?>" />    
    <?php endif; ?>

    <?php if(isset($seo['meta_favicon'])) : ?>
        <link rel="icon" type="image/x-icon" href="<?php echo $favicon; ?>">
    <?php endif; ?>
    
    <?php if(isset($seo['meta_title'])) : ?>        
        <title><?php echo esc_html($seo['meta_title']); ?></title>
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
<body>
