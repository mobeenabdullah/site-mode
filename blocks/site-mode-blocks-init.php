<?php
/**
 * Responsible for site mode blocks init.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.0
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Site Mode Countdown Block
 *
 * @since 1.1.0
 */
require_once SITE_MODE_BLOCKS . 'site-mode-countdown/site-mode-countdown.php';

/**
 * Site Mode Subscribe Form Block
 *
 * @since 1.1.0 *
 */
require_once SITE_MODE_BLOCKS . 'site-mode-subscribe-form/site-mode-subscribe-form.php';

/**
 * Site Mode Contact Form Block
 *
 * @since 1.1.0 *
 */
require_once SITE_MODE_BLOCKS . 'site-mode-contact-form/site-mode-contact-form.php';


/**
 * Show request headers
 *
 * @since 1.1.0
 *
 * @param mixed $result result.
 * @param mixed $server server.
 * @param mixed $request request.
 * @return mixed
 */
function prefix_show_request_headers( $result, $server, $request ) {

	if ( is_user_logged_in() ) {
		return $result;
	} else {
		return $request->get_headers();
	}
}

add_filter( 'rest_pre_dispatch', 'prefix_show_request_headers', 10, 3 );
