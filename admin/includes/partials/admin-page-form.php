<?php 
    switch ($tab):
        case 'content':                        
            require_once plugin_dir_path( __FILE__ ) . "content-setting-page.php";                        
            break;
        case 'social':
            require_once plugin_dir_path( __FILE__ ) . "social-setting-page-original.php";
            break;
        case 'design':                        
            require_once plugin_dir_path( __FILE__ ) . "design-setting-page-original.php";
            break;

        case 'seo':                        
            require_once plugin_dir_path( __FILE__ ) . "seo-setting-page-original.php";
            break;

        case 'advanced':                        
            require_once plugin_dir_path( __FILE__ ) . "advanced-setting-page-original.php";
            break;

        case 'import-export':                        
            require_once plugin_dir_path( __FILE__ ) . "export-import-setting-page-original.php";
            break;

        default:                        
            require_once plugin_dir_path( __FILE__ ) . "general-setting-page.php";
            break;

    endswitch;