<?php
/**
 * Template Name: Full Width for Maintenance Page
 */

defined( 'ABSPATH' ) || exit;
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
        <head>
            <meta charset="<?php bloginfo( 'charset' ); ?>">
            <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
            <?php do_action( 'wpmm_head' ); ?>
            <?php wp_head(); ?>
        </head>
        <body  <?php body_class(); ?>>

            <?php
            wp_body_open();
            the_post();
            the_content();
            wp_footer();
            do_action( 'wpmm_footer' );
            ?>
        </body>
    </html>
<?php
    exit();
