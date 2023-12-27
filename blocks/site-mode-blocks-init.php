<?php
/*
 * Site Mode Countdown Block
 */
require_once SITE_MODE_BLOCKS . 'site-mode-countdown/site-mode-countdown.php';

/*
 * Site Mode Contact Form Block
 */
require_once SITE_MODE_BLOCKS . 'site-mode-subscribe-form/site-mode-subscribe-form.php';

add_filter( 'rest_pre_dispatch', 'prefix_show_request_headers', 10, 3 );

function prefix_show_request_headers( $result, $server, $request ) {

    if(is_user_logged_in()){
        return $result;
    } else {
        return $request->get_headers();
    }
}
