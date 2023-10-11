<?php
$design_settings         = get_option('site_mode_design');
$maintenance_page        = !empty($design_settings['page_setup']['maintenance_page_id']) && get_post_status($design_settings['page_setup']['maintenance_page_id']) === 'publish' ? intval($design_settings['page_setup']['maintenance_page_id']) : '';
$coming_soon_page        = !empty($design_settings['page_setup']['coming_soon_page_id']) && get_post_status($design_settings['page_setup']['coming_soon_page_id']) === 'publish' ? intval($design_settings['page_setup']['coming_soon_page_id']) : '';
$active_page             = !empty($design_settings['page_setup']['active_page']) && get_post_status($design_settings['page_setup']['active_page']) === 'publish' ? intval($design_settings['page_setup']['active_page']) : '';
$coming_soon_template    = !empty($design_settings['page_setup']['coming_soon_template']) ? $design_settings['page_setup']['coming_soon_template'] : '';
$maintenance_template    = !empty($design_settings['page_setup']['maintenance_template']) ? $design_settings['page_setup']['maintenance_template'] : '';

?>

<div class="sitemode__dashboard">
    <div class="smd-container">
        <div class="sitemode__dashboard-intro">
            <div class="sitemode__dashboard-intro--content">
                <h2 class="smd-intro-title">Welcome to Site Mode</h2>
                <p class="smd-intro-desc">Your trusted solution for captivating "Coming Soon" & "Maintenance" pages. We prioritize customization and user-friendliness, ensuring you have full control without any coding. Whether you're gearing up for a launch or managing updates, Site Mode has you covered.</p>
                <div class="dashboard__buttons" tabindex="-1">
                    <a href="#" role="button" class="solid__btn">
                        <span>Customize</span>
                    </a>
                    <a href="#" role="button" target="_blank" tabindex="-1">
                        <span>Preview</span>
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.00299 1.0035C5.34633 1.00105 4.69571 1.12892 4.08883 1.37971C3.48195 1.63049 2.93086 1.99921 2.46749 2.4645C0.518487 4.414 0.518487 7.586 2.46749 9.5355C3.40999 10.478 4.66549 10.997 6.00299 10.997C7.34049 10.997 8.59649 10.478 9.53849 9.5355C11.4875 7.5865 11.4875 4.4145 9.53849 2.4645C9.0751 1.99923 8.52401 1.63053 7.91713 1.37974C7.31025 1.12896 6.65964 1.00107 6.00299 1.0035ZM8.83149 8.828C8.07799 9.5815 7.07299 9.9965 6.00299 9.9965C4.93299 9.9965 3.92799 9.5815 3.17449 8.828C1.61549 7.2685 1.61549 4.731 3.17449 3.1715C3.92799 2.418 4.93249 2.0035 6.00299 2.0035C7.07349 2.0035 8.07799 2.418 8.83149 3.1715C10.3905 4.731 10.3905 7.2685 8.83149 8.828Z" fill="black"/>
                            <path d="M5.73346 5.5625L4.12646 7.1695L4.83346 7.8765L6.44046 6.2695L7.50296 7.3315V4.5H4.67146L5.73346 5.5625Z" fill="black"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="sitemode__dashboard-intro--video">
                <div class="sitemode__media-box">
                    <div class="site-mode-cards">
                        <?php wp_nonce_field( 'setup_action', 'setup_action_field' ); ?>
                        <div class="site-mode-cards--item <?php echo $coming_soon_page && $coming_soon_page === $active_page ? 'enabled__card' : '' ?>">
                            <div class="sm__card">
                                <span class="btn-toggle setup_pages btn-check-toggle">
                                    <?php if(empty($coming_soon_page)) : ?>
                                        <a href="<?php echo admin_url('/admin.php?page=site-mode&design=true&cat=coming-soon'); ?>">
                                    <?php endif; ?>
                                        <input type="checkbox" name="page__template" id="coming_soon_temp" <?php echo empty($coming_soon_page) ? 'disabled' : '';?> value="<?php echo esc_attr($coming_soon_page); ?>" <?php echo $coming_soon_page && $coming_soon_page === $active_page ? 'checked' : '' ?>>
                                        <label class="toggle" for="coming_soon_temp"></label>
                                    <?php if(empty($coming_soon_page)) : ?>
                                        </a>
                                    <?php endif; ?>
                                </span>
                                <div class="sm__card-cover">
                                    <div class="sm_select_page-icon">
                                        <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M58.7563 24.1208L63.315 19.562L59.1909 15.4379L54.2092 20.4166C51.1467 18.5791 47.5767 17.4999 43.75 17.4999C32.4946 17.4999 23.3334 26.6583 23.3334 37.9166C23.3334 49.1749 32.4946 58.3333 43.75 58.3333C55.0055 58.3333 64.1667 49.1749 64.1667 37.9166C64.1644 32.8009 62.2323 27.8743 58.7563 24.1208ZM43.75 52.5C35.7088 52.5 29.1667 45.9579 29.1667 37.9166C29.1667 29.8754 35.7088 23.3333 43.75 23.3333C51.7913 23.3333 58.3334 29.8754 58.3334 37.9166C58.3334 45.9579 51.7913 52.5 43.75 52.5Z" fill="#FE4773"/>
                                            <path d="M40.8334 29.1667H46.6667V40.8333H40.8334V29.1667ZM37.9167 8.75H49.5834V14.5833H37.9167V8.75ZM8.75004 23.3333H20.4167V29.1667H8.75004V23.3333ZM8.75004 46.6667H20.4167V52.5H8.75004V46.6667ZM5.83337 35H17.4709V40.8333H5.83337V35Z" fill="#FE4773"/>
                                        </svg>
                                    </div>
                                    <div class="sm_select_page-title">
                                        Coming Soon Page
                                    </div>
                                    <div class="sm_select_page-desc">
                                        Tease your website's future with an enticing
                                        placeholder page.
                                    </div>
                                    <div class="sm_select_page-btn">
                                        <?php
                                            if(!empty($coming_soon_page)) {
                                                ?>
                                                    <a href="<?php echo esc_url(get_edit_post_link(intval($coming_soon_page))); ?>" target="_blank" class="sm__btn block_btn secondary_btn">Edit Page</a>
                                                    <a href="<?php echo esc_url(get_permalink(intval($coming_soon_page))); ?>" target="_blank" class="sm__btn block_btn primary_button">Perview</a>
                                                <?php
                                            } else {
                                                ?>
                                                    <a href="<?php echo admin_url('/admin.php?page=site-mode&design=true&cat=coming-soon'); ?>" class="sm__btn block_btn primary_button setup-coming-soon-page" >Setup</a>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    <?php if(!empty($coming_soon_page)) : ?>
                                        <div class="sm_select_re_setup">
                                                <a href="<?php echo admin_url('/admin.php?page=site-mode&design=true&cat=coming-soon&template='. $coming_soon_template); ?>" class="reset_setup_again">Reset and setup again</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="site-mode-cards--item  <?php echo $maintenance_page && $maintenance_page === $active_page ? 'enabled__card' : '' ?>">
                            <div class="sm__card">
                                <span class="btn-toggle setup_pages btn-check-toggle">
                                    <?php if(empty($maintenance_page)) : ?>
                                        <a href="<?php echo admin_url('/admin.php?page=site-mode&design=true&cat=maintenance'); ?>">
                                    <?php endif; ?>
                                        <input type="checkbox" name="page__template" id="maintenance_temp" value="<?php echo esc_attr($maintenance_page); ?>" <?php echo empty($maintenance_page) ? 'disabled' : '';?> <?php echo $maintenance_page && $maintenance_page === $active_page ? 'checked' : '' ?>>
                                        <label class="toggle" for="maintenance_temp"></label>
                                    <?php if(empty($maintenance_page)) : ?>
                                        </a>
                                    <?php endif; ?>
                                </span>
                                <div class="sm_select_page-icon maintenance__icon">
                                    <svg width="50" height="50" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M35 46.6667C41.4342 46.6667 46.6667 41.4342 46.6667 35C46.6667 28.5659 41.4342 23.3334 35 23.3334C28.5659 23.3334 23.3334 28.5659 23.3334 35C23.3334 41.4342 28.5659 46.6667 35 46.6667ZM35 29.1667C38.1617 29.1667 40.8334 31.8384 40.8334 35C40.8334 38.1617 38.1617 40.8334 35 40.8334C31.8384 40.8334 29.1667 38.1617 29.1667 35C29.1667 31.8384 31.8384 29.1667 35 29.1667Z" fill="#FE4773"/>
                                        <path d="M8.29789 47.0634L11.2146 52.1092C12.7633 54.7838 16.4908 55.7871 19.1771 54.2384L20.72 53.3459C22.4074 54.6732 24.2678 55.7644 26.25 56.5892V58.3334C26.25 61.5505 28.8662 64.1667 32.0833 64.1667H37.9166C41.1337 64.1667 43.75 61.5505 43.75 58.3334V56.5892C45.7314 55.7643 47.5918 54.6742 49.28 53.3488L50.8229 54.2413C53.515 55.7871 57.2337 54.7896 58.7883 52.1092L61.7021 47.0663C62.475 45.7267 62.6847 44.135 62.2849 42.6409C61.8851 41.1469 60.9086 39.8726 59.57 39.098L58.0971 38.2463C58.4102 36.0954 58.4102 33.9105 58.0971 31.7596L59.57 30.908C60.9081 30.1328 61.884 28.8585 62.2837 27.3647C62.6834 25.8708 62.4742 24.2794 61.7021 22.9396L58.7883 17.8967C57.2396 15.2134 53.515 14.2071 50.8229 15.7617L49.28 16.6542C47.5926 15.3269 45.7321 14.2357 43.75 13.4109V11.6667C43.75 8.44962 41.1337 5.83337 37.9166 5.83337H32.0833C28.8662 5.83337 26.25 8.44962 26.25 11.6667V13.4109C24.2685 14.2358 22.4082 15.3259 20.72 16.6513L19.1771 15.7588C16.4821 14.21 12.7604 15.2134 11.2116 17.8938L8.29789 22.9367C7.52492 24.2763 7.3153 25.868 7.71507 27.3621C8.11484 28.8561 9.0913 30.1304 10.43 30.905L11.9029 31.7567C11.5886 33.9065 11.5886 36.0906 11.9029 38.2405L10.43 39.0921C9.09169 39.8678 8.11568 41.1427 7.716 42.637C7.31631 44.1313 7.52557 45.7231 8.29789 47.0634ZM17.9987 39.0192C17.6694 37.7048 17.5019 36.3551 17.5 35C17.5 33.6525 17.6691 32.2992 17.9958 30.9809C18.1496 30.3664 18.099 29.7186 17.8517 29.1354C17.6043 28.5523 17.1737 28.0657 16.625 27.7492L13.3496 25.8534L16.2604 20.8105L19.6 22.7413C20.1446 23.0564 20.7767 23.1864 21.4015 23.1117C22.0263 23.0371 22.61 22.7617 23.065 22.3271C25.0382 20.4504 27.4176 19.0541 30.0183 18.2467C30.6157 18.0643 31.1388 17.695 31.5105 17.193C31.8823 16.691 32.083 16.083 32.0833 15.4584V11.6667H37.9166V15.4584C37.9169 16.083 38.1177 16.691 38.4894 17.193C38.8612 17.695 39.3842 18.0643 39.9816 18.2467C42.5818 19.0552 44.961 20.4514 46.935 22.3271C47.3905 22.7609 47.9741 23.0356 48.5986 23.1103C49.2232 23.1849 49.8551 23.0555 50.4 22.7413L53.7366 20.8134L56.6533 25.8563L53.375 27.7492C52.8266 28.066 52.3963 28.5527 52.1489 29.1357C51.9016 29.7187 51.8508 30.3664 52.0041 30.9809C52.3308 32.2992 52.5 33.6525 52.5 35C52.5 36.3446 52.3308 37.698 52.0012 39.0192C51.8482 39.634 51.8994 40.2819 52.1473 40.8649C52.3951 41.448 52.8261 41.9345 53.375 42.2509L56.6504 44.1438L53.7396 49.1867L50.4 47.2588C49.8555 46.9432 49.2233 46.8129 48.5984 46.8876C47.9735 46.9623 47.3897 47.2379 46.935 47.673C44.9618 49.5497 42.5823 50.946 39.9816 51.7534C39.3842 51.9358 38.8612 52.3051 38.4894 52.8071C38.1177 53.309 37.9169 53.9171 37.9166 54.5417L37.9225 58.3334H32.0833V54.5417C32.083 53.9171 31.8823 53.309 31.5105 52.8071C31.1388 52.3051 30.6157 51.9358 30.0183 51.7534C27.4181 50.9448 25.0389 49.5487 23.065 47.673C22.6109 47.2367 22.0268 46.9604 21.4014 46.8862C20.7761 46.812 20.1436 46.9438 19.6 47.2617L16.2633 49.1925L13.3466 44.1496L16.625 42.2509C17.1739 41.9345 17.6048 41.448 17.8527 40.8649C18.1005 40.2819 18.1518 39.634 17.9987 39.0192Z" fill="#FE4773"/>
                                    </svg>
                                </div>
                                <div class="sm_select_page-title">
                                    Maintenance Page
                                </div>
                                <div class="sm_select_page-desc">
                                    Temporarily offline for necessary
                                    improvements. We'll be back soon!
                                </div>
                                <div class="sm_select_page-btn">

                                    <?php
                                    if(!empty($maintenance_page)) {
                                        ?>
                                        <a href="<?php echo esc_url(get_edit_post_link(intval($maintenance_page))); ?>" target="_blank" class="sm__btn block_btn secondary_btn">Edit Page</a>
                                        <a href="<?php echo esc_url(get_permalink(intval($maintenance_page))); ?>" target="_blank" class="sm__btn block_btn primary_button">Perview</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo admin_url('/admin.php?page=site-mode&design=true&cat=maintenance'); ?>" class="sm__btn block_btn primary_button setup-coming-soon-page">Setup</a>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php if(!empty($maintenance_page))  : ?>
                                    <div class="sm_select_re_setup">
                                        <a href="<?php echo admin_url('/admin.php?page=site-mode&design=true&cat=maintenance&template=' . $maintenance_template); ?>" class="reset_setup_again">Reset and setup again</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="smd-seperator"></div>
        <div class="sitemode__dashboard-cards">
            <?php
            $dashboard_cards = [
                [
                    'title' => 'Status',
                    'description' => 'Enable to display the coming soon/maintenance page on your website.',
                    'icon'  => '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 26.25c5.514 0 10-4.486 10-10 0-4.188-2.59-7.776-6.25-9.264v2.779a7.5 7.5 0 0 1 3.75 6.485c0 4.136-3.364 7.5-7.5 7.5s-7.5-3.364-7.5-7.5a7.499 7.499 0 0 1 3.75-6.485V6.986C7.59 8.474 5 12.063 5 16.25c0 5.514 4.486 10 10 10Z" fill="#FE4773"/><path d="M13.75 2.5h2.5V15h-2.5V2.5Z" fill="#FE4773"/></svg>',
                    'link'  => '?page=site-mode&setting=dashboard',
                    'link-text' => 'Go to settings'
                ],
                [
                    'title' => 'Templates',
                    'description' => 'Change layout of your coming soon/maintenance page from our free templates library.',
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.4 2.096a10.08 10.08 0 0 0-8.937 3.331A10.054 10.054 0 0 0 2.096 13.4c.53 3.894 3.458 7.207 7.285 8.246A9.981 9.981 0 0 0 12 22l.142-.001a3.002 3.002 0 0 0 2.516-1.426 2.989 2.989 0 0 0 .153-2.879l-.199-.416a1.919 1.919 0 0 1 .094-1.912 2.004 2.004 0 0 1 2.576-.755l.412.197c.412.198.85.299 1.301.299A3.022 3.022 0 0 0 22 12.14a9.937 9.937 0 0 0-.353-2.76c-1.04-3.826-4.353-6.754-8.247-7.284Zm5.158 10.909-.412-.197c-1.828-.878-4.07-.198-5.135 1.494-.738 1.176-.813 2.576-.204 3.842l.2.416a.982.982 0 0 1-.052.961.992.992 0 0 1-.844.479H12a8.063 8.063 0 0 1-2.095-.283c-3.063-.831-5.403-3.479-5.826-6.586-.32-2.355.352-4.623 1.893-6.389a8.002 8.002 0 0 1 7.16-2.664c3.107.423 5.755 2.764 6.586 5.826.198.73.293 1.474.282 2.207-.012.807-.845 1.183-1.44.894Z" fill="#FE4773"/><path d="M7.5 16a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Zm0-4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Zm3-3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Zm4 0a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" fill="#FE4773"/></svg>',
                    'link'  => '?page=site-mode&setting=templates',
                    'link-text' => 'View all templates'
                ],
                [
                    'title' => 'Settings',
                    'description' => 'Configure plugin settings and preferences.',
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 16c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4Zm0-6c1.084 0 2 .916 2 2s-.916 2-2 2-2-.916-2-2 .916-2 2-2Z" fill="#FE4773"/><path d="m2.845 16.136 1 1.73c.531.917 1.809 1.261 2.73.73l.529-.306A8.1 8.1 0 0 0 9 19.402V20c0 1.103.897 2 2 2h2c1.103 0 2-.897 2-2v-.598a8.132 8.132 0 0 0 1.896-1.111l.529.306c.923.53 2.198.188 2.731-.731l.999-1.729a2.001 2.001 0 0 0-.731-2.732l-.505-.292a7.723 7.723 0 0 0 0-2.224l.505-.292a2.002 2.002 0 0 0 .731-2.732l-.999-1.729c-.531-.92-1.808-1.265-2.731-.732l-.529.306A8.101 8.101 0 0 0 15 4.598V4c0-1.103-.897-2-2-2h-2c-1.103 0-2 .897-2 2v.598a8.132 8.132 0 0 0-1.896 1.111l-.529-.306c-.924-.531-2.2-.187-2.731.732l-.999 1.729a2.001 2.001 0 0 0 .731 2.732l.505.292a7.683 7.683 0 0 0 0 2.223l-.505.292a2.003 2.003 0 0 0-.731 2.733Zm3.326-2.758A5.703 5.703 0 0 1 6 12c0-.462.058-.926.17-1.378a.999.999 0 0 0-.47-1.108l-1.123-.65.998-1.729 1.145.662a.997.997 0 0 0 1.188-.142 6.071 6.071 0 0 1 2.384-1.399A1 1 0 0 0 11 5.3V4h2v1.3a1 1 0 0 0 .708.956 6.083 6.083 0 0 1 2.384 1.399.999.999 0 0 0 1.188.142l1.144-.661 1 1.729-1.124.649a1 1 0 0 0-.47 1.108c.112.452.17.916.17 1.378 0 .461-.058.925-.171 1.378a1 1 0 0 0 .471 1.108l1.123.649-.998 1.729-1.145-.661a.996.996 0 0 0-1.188.142 6.072 6.072 0 0 1-2.384 1.399A1 1 0 0 0 13 18.7l.002 1.3H11v-1.3a1 1 0 0 0-.708-.956 6.083 6.083 0 0 1-2.384-1.399.992.992 0 0 0-1.188-.141l-1.144.662-1-1.729 1.124-.651a1 1 0 0 0 .471-1.108Z" fill="#FE4773"/></svg>',
                    'link'  => '?page=site-mode&setting=settings',
                    'link-text' => 'View All Settings'
                ],
                [
                    'title' => 'Useful Plugins',
                    'description' => 'Explore our recommended list of plugins.',
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 8h2v5c0 2.206 1.794 4 4 4h2v5h2v-5h2c2.206 0 4-1.794 4-4V8h2V6H3v2Zm4 0h10v5c0 1.103-.897 2-2 2H9c-1.103 0-2-.897-2-2V8Zm0-6h2v3H7V2Zm8 0h2v3h-2V2Z" fill="#FE4773"/></svg>',
                    'link'  => '/',
                    'link-text' => 'View Plugins'
                ],
                [
                    'title' => 'Changelog',
                    'description' => 'View the plugin\'s version history and updates.',
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6h2v2H4V6Zm0 5h2v2H4v-2Zm0 5h2v2H4v-2Zm16-8V6H8.023v2H20ZM8 11h12v2H8v-2Zm0 5h12v2H8v-2Z" fill="#FE4773"/></svg>',
                    'link'  => '/',
                    'link-text' => 'View Changelog'
                ],
                [
                    'title' => 'Support',
                    'description' => 'Get help and support for our amazing plugin.',
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6a3.939 3.939 0 0 0-3.934 3.934h2C10.066 8.867 10.934 8 12 8c1.066 0 1.934.867 1.934 1.934 0 .598-.481 1.032-1.216 1.626-.24.188-.47.388-.691.599-.998.997-1.027 2.056-1.027 2.174V15h2l-.001-.633c0-.016.033-.386.44-.793.15-.15.34-.3.536-.458.779-.631 1.958-1.584 1.958-3.182A3.937 3.937 0 0 0 12 6Zm-1 10h2v2h-2v-2Z" fill="#FE4773"/><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8Z" fill="#FE4773"/></svg>',
                    'link'  => '?page=site-mode&setting=support',
                    'link-text' => 'Get Support'
                ],

            ];

            foreach ( $dashboard_cards as $dashboard_card ) :
                ?>
                <div class="smd-card">
                    <div class="smd-card-icon">
                        <?php echo $dashboard_card['icon']; ?>
                    </div>
                    <div class="smd-card-title">
                        <h2><?php echo $dashboard_card['title']; ?></h2>
                    </div>
                    <div class="smd-card-description">
                        <p><?php echo $dashboard_card['description']; ?></p>
                    </div>
                    <div class="smd-card-seperator"></div>
                    <div class="smd-card-actions">
                        <a href="<?php echo admin_url($dashboard_card['link']); ?>" role="button" tabindex="-1"><?php echo $dashboard_card['link-text']; ?></a>
                        <a href="<?php echo admin_url($dashboard_card['link']); ?>" role="button" tabindex="-1">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.49939 1.24561C4.05314 1.24623 1.24939 4.04998 1.24939 7.49623C1.24939 10.9425 4.05314 13.7462 7.50001 13.7462C10.9456 13.7462 13.7494 10.9425 13.75 7.49623C13.75 4.04998 10.9463 1.24623 7.49939 1.24561ZM7.50001 12.4962C4.74251 12.4962 2.49939 10.2531 2.49939 7.49623C2.49939 4.73936 4.74251 2.49623 7.49939 2.49561C10.2569 2.49623 12.5 4.73936 12.5 7.49623C12.4994 10.2531 10.2563 12.4962 7.50001 12.4962Z" fill="black"/>
                                <path d="M7.5 6.87126H5V8.12126H7.5V10L10.0031 7.49688L7.5 4.99438V6.87126Z" fill="black"/>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>
</div>
