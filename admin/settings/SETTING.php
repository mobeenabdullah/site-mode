<?php


if (!defined('ABSPATH')) {
    exit;
}

/**
 * SETTING is a generic interface, meant to be used from any class of the plugin.
 */
interface SETTING
{
    public function add_section();
}