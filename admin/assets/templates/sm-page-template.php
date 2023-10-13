<?php
/**
 * Template Name: Full Width for Site Mode
 */

defined( 'ABSPATH' ) || exit;
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
        <head>
            <meta charset="<?php bloginfo( 'charset' ); ?>">
            <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
            <?php do_action( 'wpsm_head' ); ?>
            <?php wp_head(); ?>
        </head>
        <body  <?php body_class(); ?>>

            <?php
            wp_body_open();
            the_post();
            the_content();
            wp_footer();
            do_action( 'wpsm_footer' );
            ?>
        </body>
    </html>
<?php
    exit();
