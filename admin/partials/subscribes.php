<?php
/**
 * Responsible for subscribe table layout.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for subscribe table layout.
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.1.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */

$subscribe_manager = new Site_Mode_Subscribe();

if ( ! $subscribe_manager->has_subscribes() ) {
	$subscribe_manager->display_no_subscribes_message();
} else {
	$subscribe_manager->display_table();
}
