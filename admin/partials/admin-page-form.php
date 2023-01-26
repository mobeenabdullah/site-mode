<?php

    switch ($tab):
        case 'content':
            require_once plugin_dir_path(__FILE__) . "content-setting-page.php";
            break;
        case 'social':
            require_once plugin_dir_path(__FILE__) . "social-setting-page.php";
            break;
        case 'design':
            require_once plugin_dir_path(__FILE__) . "design-setting-page.php";
            break;

        case 'seo':
//            require_once plugin_dir_path( __FILE__ ) . "seo-setting-page.php";
//            $seo->display_seo_settings_page();
            echo '<h1>SEO Tab</h1>';
            break;

        case 'advanced':
            require_once plugin_dir_path(__FILE__) . "advanced-setting-page.php";
            break;

        case 'import-export':
            require_once plugin_dir_path(__FILE__) . "export-import-setting-page.php";
            break;

        default:
            require_once plugin_dir_path(__FILE__) . "general-setting-page.php";
            break;

    endswitch;
