<?php
/**
 * Responsible for subscribe table layout.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.0.7
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for subscribe table layout.
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.0.7
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */

$subscribeManager = new Site_Mode_Subscribe();

if ( $subscribeManager->hasSubscribes() ) {
	$subscribeManager->displayTable();
} else {
	$subscribeManager->displayNoSubscribesMessage();
}
