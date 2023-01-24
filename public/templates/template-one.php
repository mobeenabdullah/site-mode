<h1>Template 1<h1>
<?php

/**
 *  Name : Template-one
 */

require_once 'header.php';

$design                 = unserialize(get_option('site_mode_design'));
$design_logo_background = unserialize(get_option('site_mode_design_lb'));
$design_colors          = unserialize(get_option('site_mode_design_colors'));
$social                 = unserialize(get_option('site_mode_social'));
$seo                    = unserialize(get_option('site_mode_seo'));

?>






