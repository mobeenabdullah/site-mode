<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo('name');?></title>
    <?php
        $bg_url = wp_get_attachment_image_url(get_option('content-bg-image-settings'), 'full');
    ?>

    <style>
        body {
            background-image: url("<?php echo $bg_url;?>") !important;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover !important;
        }
    </style>
</head>
<body>

