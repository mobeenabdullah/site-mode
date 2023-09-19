<?php
    $get_current_user = wp_get_current_user();
    $current_user = $get_current_user->user_email

?>
<div class="customize__template template__import" style="display: none">
    <?php include(SITE_MODE_ADMIN . 'partials/wizard/header.php'); ?>
    <!--
    <button class="template-init-next import-template" type="button">
        <span>Start Importing</span>
    </button>
    -->
    <div class="customize__template-wrapper">
        <div class="customize__template-cover">
            <div class="customize__template-layout">
                <div class="setting_dropdown wizard_show_mobile">
                    <div class="setting_dropdown-cover">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12 16c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.084 0 2 .916 2 2s-.916 2-2 2-2-.916-2-2 .916-2 2-2z"></path><path d="m2.845 16.136 1 1.73c.531.917 1.809 1.261 2.73.73l.529-.306A8.1 8.1 0 0 0 9 19.402V20c0 1.103.897 2 2 2h2c1.103 0 2-.897 2-2v-.598a8.132 8.132 0 0 0 1.896-1.111l.529.306c.923.53 2.198.188 2.731-.731l.999-1.729a2.001 2.001 0 0 0-.731-2.732l-.505-.292a7.718 7.718 0 0 0 0-2.224l.505-.292a2.002 2.002 0 0 0 .731-2.732l-.999-1.729c-.531-.92-1.808-1.265-2.731-.732l-.529.306A8.1 8.1 0 0 0 15 4.598V4c0-1.103-.897-2-2-2h-2c-1.103 0-2 .897-2 2v.598a8.132 8.132 0 0 0-1.896 1.111l-.529-.306c-.924-.531-2.2-.187-2.731.732l-.999 1.729a2.001 2.001 0 0 0 .731 2.732l.505.292a7.683 7.683 0 0 0 0 2.223l-.505.292a2.003 2.003 0 0 0-.731 2.733zm3.326-2.758A5.703 5.703 0 0 1 6 12c0-.462.058-.926.17-1.378a.999.999 0 0 0-.47-1.108l-1.123-.65.998-1.729 1.145.662a.997.997 0 0 0 1.188-.142 6.071 6.071 0 0 1 2.384-1.399A1 1 0 0 0 11 5.3V4h2v1.3a1 1 0 0 0 .708.956 6.083 6.083 0 0 1 2.384 1.399.999.999 0 0 0 1.188.142l1.144-.661 1 1.729-1.124.649a1 1 0 0 0-.47 1.108c.112.452.17.916.17 1.378 0 .461-.058.925-.171 1.378a1 1 0 0 0 .471 1.108l1.123.649-.998 1.729-1.145-.661a.996.996 0 0 0-1.188.142 6.071 6.071 0 0 1-2.384 1.399A1 1 0 0 0 13 18.7l.002 1.3H11v-1.3a1 1 0 0 0-.708-.956 6.083 6.083 0 0 1-2.384-1.399.992.992 0 0 0-1.188-.141l-1.144.662-1-1.729 1.124-.651a1 1 0 0 0 .471-1.108z"></path></svg>
                        <span>Show Customize Settings</span>
                    </div>
                </div>
                <div class="customize__template-sidebar" aria-label="Navigation" role="region" tabindex="-1">
                    <div class="sidebar_content">
                        <div class="sidebar_content-header">
                            <span>Template: <span class="template__name">Flavor Food</span></span>
                            <button class="sm__edit-template template-init-back" type="button">
                                <span tooltip="Edit Template" flow="left">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.3535 9.85344L9 5.20694L6.793 2.99994L2.1465 7.64644C2.08253 7.71049 2.03709 7.79066 2.015 7.87844L1.5 10.4999L4.121 9.98494C4.209 9.96294 4.2895 9.91744 4.3535 9.85344ZM10.5 3.70694C10.6875 3.51941 10.7928 3.2651 10.7928 2.99994C10.7928 2.73478 10.6875 2.48047 10.5 2.29294L9.707 1.49994C9.51947 1.31247 9.26516 1.20715 9 1.20715C8.73484 1.20715 8.48053 1.31247 8.293 1.49994L7.5 2.29294L9.707 4.49994L10.5 3.70694Z" fill="black"/>
                                    </svg>
                                </span>
                            </button>
                        </div>
                        <div class="sidebar_content-settings">
                            <div class="settings__card">
                                <div class="settings__card-title sm_open_panel">
                                    <h2 class="settings_card_heading">Import Settings</h2>
                                </div>
                                <div class="settings__card-options">
                                    <div class="settings__card-options-box">
                                        <div class="settings__card-options--label subscribe_label">
                                            <h3>Subscribe</h3>
                                            <p class="sm__helper-text">Subscribe to learn about new templates & features for Site Mode.</p>
                                        </div>
                                        <div class="settings__card-options--field">
                                            <span class="btn-toggle">
                                                <input type="checkbox" name="show-subscribe-field" id="show-subscribe-field" class="show-subscribe-field" value="1" checked>
                                                <label class="toggle" for="show-subscribe-field"></label>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="subscribe_box" style="display: none;">
                                        <div class="settings__card-options-box">
                                            <div class="settings__card-options--label subscribe__label">
                                                <h4>Email</h4>
                                                <p class="sm__helper-text">We do not spam, unsubscribe antime.</p>
                                            </div>
                                            <div class="settings__card-options--field">
                                                <input type="text" name="sm-subscribe-field" id="sm-subscribe-field" class="show-subscribe-field" value="<?php echo $current_user; ?>">
                                                <label for="sm-subscribe-field"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="open-popup open-import-popup" data-popup="importing__popup" type="button">Open Importing Popup</button>
                                    <button class="open-popup open-thank-you-popup" data-popup="thank_yo_popup" type="button">Open Thank You Popup</button>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar_content-actions">
                            <?php wp_nonce_field( 'template_init_action', 'template_init_field' ); ?>
                            <button class="template-back-customize" type="button">
                                <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.8433 0.94495L4 0.0390625L0 4.33594L4 8.63281L4.8433 7.72693L2.28299 4.97659L8 4.97659V3.69528L2.28299 3.69528L4.8433 0.94495Z" fill="black"/>
                                </svg>
                                <span>Back</span>
                            </button>
                            <button class="next_button import-template" type="button">
                                <span>Start Importing</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="customize__template-content">
                    <div class="fullscreen_actions">
                        <button class="sm_full_screen" type="button" style="display: flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>
                        </button>
                        <button class="sm_exit_full_screen" type="button" style="display: none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12 16c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.084 0 2 .916 2 2s-.916 2-2 2-2-.916-2-2 .916-2 2-2z"></path><path d="m2.845 16.136 1 1.73c.531.917 1.809 1.261 2.73.73l.529-.306A8.1 8.1 0 0 0 9 19.402V20c0 1.103.897 2 2 2h2c1.103 0 2-.897 2-2v-.598a8.132 8.132 0 0 0 1.896-1.111l.529.306c.923.53 2.198.188 2.731-.731l.999-1.729a2.001 2.001 0 0 0-.731-2.732l-.505-.292a7.718 7.718 0 0 0 0-2.224l.505-.292a2.002 2.002 0 0 0 .731-2.732l-.999-1.729c-.531-.92-1.808-1.265-2.731-.732l-.529.306A8.1 8.1 0 0 0 15 4.598V4c0-1.103-.897-2-2-2h-2c-1.103 0-2 .897-2 2v.598a8.132 8.132 0 0 0-1.896 1.111l-.529-.306c-.924-.531-2.2-.187-2.731.732l-.999 1.729a2.001 2.001 0 0 0 .731 2.732l.505.292a7.683 7.683 0 0 0 0 2.223l-.505.292a2.003 2.003 0 0 0-.731 2.733zm3.326-2.758A5.703 5.703 0 0 1 6 12c0-.462.058-.926.17-1.378a.999.999 0 0 0-.47-1.108l-1.123-.65.998-1.729 1.145.662a.997.997 0 0 0 1.188-.142 6.071 6.071 0 0 1 2.384-1.399A1 1 0 0 0 11 5.3V4h2v1.3a1 1 0 0 0 .708.956 6.083 6.083 0 0 1 2.384 1.399.999.999 0 0 0 1.188.142l1.144-.661 1 1.729-1.124.649a1 1 0 0 0-.47 1.108c.112.452.17.916.17 1.378 0 .461-.058.925-.171 1.378a1 1 0 0 0 .471 1.108l1.123.649-.998 1.729-1.145-.661a.996.996 0 0 0-1.188.142 6.071 6.071 0 0 1-2.384 1.399A1 1 0 0 0 13 18.7l.002 1.3H11v-1.3a1 1 0 0 0-.708-.956 6.083 6.083 0 0 1-2.384-1.399.992.992 0 0 0-1.188-.141l-1.144.662-1-1.729 1.124-.651a1 1 0 0 0 .471-1.108z"></path></svg>
                        </button>
                    </div>
                    <div class="customize__template-content--canvas sm-scroll">
                        <iframe src="https://site-mode-blocks.local/?site-mode-preview=true" id="sm-preview-iframe" name="page" height="700" width="100%"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>