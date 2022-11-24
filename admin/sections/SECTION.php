<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Section is a generic interface, meant to be used from any class of the plugin.
 */
interface SECTION {
    public function add_section();
}