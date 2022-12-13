<?php ?>
<!--            <form action="options.php" method="post">-->
                <?php switch ($tab):
                    case 'content':
                        echo '<form id="rex-content">';
                        require_once plugin_dir_path(__FILE__) . "content-setting-page.php";
                        echo '</form>';
                        break;
                    case 'social':
                        echo '<form id="rex-social">';
                        require_once plugin_dir_path(__FILE__) . "social-setting-page.php";
                        echo '</form>';
                        break;
                    case 'design':
//                        echo '<form id="rex-design">';
                        require_once plugin_dir_path(__FILE__) . "design-setting-page.php";
//                        echo '</form>';
                        break;
                    case 'seo':
                        echo '<form id="rex-seo">';
                        require_once plugin_dir_path(__FILE__) . "seo-setting-page.php";
                        echo '</form>';
                        break;
                    case 'advanced':
                        echo '<form id="rex-advanced">';
                        require_once plugin_dir_path(__FILE__) . "advanced-setting-page.php";
                        echo '</form>';
                        break;
                    case 'import-export':
//                        echo '<form id="rex-import-export">';
                        require_once plugin_dir_path(__FILE__) . "export-import-setting-page.php";
//                        echo '</form>';
                        break;
                    default:
                        echo '<form id="rex-general">';
                        require_once plugin_dir_path(__FILE__) . "general-setting-page.php";
                        echo '</form>';
                        break;

                endswitch; ?>
<!--            </form>-->