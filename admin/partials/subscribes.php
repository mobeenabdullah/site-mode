<?php
$subscribeManager = new Site_Mode_Subscribe();

if ( $subscribeManager->hasSubscribes() ) {
	$subscribeManager->displayTable();
} else {
	$subscribeManager->displayNoSubscribesMessage();
}
