<div class="template__import" style="display: block">
    <?php include(SITE_MODE_ADMIN . 'partials/wizard/header.php'); ?>
    <div class="template__import-wrapper">
        <div class="template__import-cover">
            <div class="template__import-layout">
                <div class="template__import-sidebar" aria-label="Navigation" role="region" tabindex="-1">
                    <div class="sidebar_content">
                        <div class="sidebar_content-header">
                            <h1>header</h1>
                        </div>
                        <div class="sidebar_content-settings">
                            <h1>settings</h1>
                            <div>
                                <label for="show-countdown">Countdown</label>
                                <input type="checkbox" id="show-countdown" name="show-countdown" value="1" checked>
                            </div>
                            <div>
                                <label for="show-subscribe">Subscribe</label>
                                <input type="checkbox" id="show-subscribe" name="show-subscribe" value="1" checked>
                            </div>
                            <div>
                                <label for="show-social">Social</label>
                                <input type="checkbox" id="show-social" name="show-social" value="1" checked>
                            </div>

                            <?php wp_nonce_field( 'template_init_action', 'template_init_field' ); ?>

                            <button class="import-template" type="button">Start Importing</button>
                        </div>
                        <div class="sidebar_content-actions">
                            <h1>actions</h1>
                        </div>
                    </div>
                </div>
                <div class="template__import-content">
                    <div class="template__import-content--canvas">
                        <iframe src="https://site-mode.local/?site-mode-preview=true" id="sm-preview-iframe" name="page" height="700" width="100%"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--
    <iframe src="https://site-mode.com/" name="page" height="500"></iframe>
    <div class="sm_actions submit_button">
        <?php wp_nonce_field( 'template_init_action', 'template_init_field' ); ?>
        <button class="template-init-next" type="button">next</button>
        <button class="template-init-back" type="button">Back</button>
    </div>
    -->
</div>