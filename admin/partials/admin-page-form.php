<?php ?>
            <form action="options.php" method="post">
                <?php switch ($tab):
                    case 'content':
                        settings_fields('rex-maintenance-setting-content-group');
                        do_settings_sections('rex-maintenance-options-one');
                        submit_button(__('Save Changes', 'rex-maintenance-mode'),'um_btn');
                        break;
                    case 'social':
                        settings_fields('rex-maintenance-setting-social-group');
                        do_settings_sections('rex-maintenance-social-page');
                        submit_button(__('Save Changes', 'rex-maintenance-mode'),'um_btn');
                        break;
                    case 'design':
                        settings_fields('rex-maintenance-setting-design-group');
                        do_settings_sections('rex-maintenance-design-page');
                        submit_button(__('Save Changes', 'rex-maintenance-mode'),'um_btn');
                        break;
                    case 'seo':
                        settings_fields('rex-maintenance-setting-seo-group');
                        do_settings_sections('rex-maintenance-seo-page');
                        submit_button(__('Save Changes', 'rex-maintenance-mode'),'um_btn');
                        break;
                    case 'advanced':
                        settings_fields('rex-maintenance-setting-advanced-group');
                        do_settings_sections('rex-maintenance-advanced-page');
                        submit_button(__('Save Changes', 'rex-maintenance-mode'),'um_btn');
                        break;
                    case 'import-export':
                        echo 'import-export';
                        break;
                    default:
                        settings_fields('wprex-maintenance-general-group');
                        do_settings_sections('wprex-maintenance-general-page');
                        submit_button(__('Save Changes', 'rex-maintenance-mode'),'um_btn');
                        break;

                endswitch; ?>
            </form>