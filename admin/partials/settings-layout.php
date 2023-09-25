<?php
    if((isset($_GET['design']) && $_GET['design'] == true ) || empty(get_option('sm-fresh-installation'))) :
        require_once SITE_MODE_ADMIN . 'partials/wizard/wizard.php';
    else :
        ?>

    <div class="sm__dasboard-wrapper">
        <div class="smd__header">
            <div class="smd__header-logo">
                <img src="<?php echo esc_url( SITE_MODE_ADMIN_URL. '/assets/img/sitemode-logo.png' ); ?>" alt="Site Mode Logo" class="site_mode__wrap--logo">
            </div>
            <div class="smd__header-nav">
                <div class="smd-navbar">
                    <?php
                        $site_mode_tabs = [
                            [
                                'title' => 'Dashboard',
                                'icon'  => '<i class="fa-solid fa-gear"></i>',
                                'link'  => 'dashboard'
                            ],
                            [
                                'title' => 'Templates',
                                'icon'  => '<i class="fa-solid fa-palette"></i>',
                                'link'  => 'templates'
                            ],
                            [
                                'title' => 'Settings',
                                'icon'  => '<i class="fa-solid fa-chart-pie"></i>',
                                'link'  => 'settings'
                            ],
                            [
                                'title' => 'About Us',
                                'icon'  => '<i class="fa-solid fa-sliders"></i>',
                                'link'  => 'about-us'
                            ],
                        ];

                        $current_tab = isset($_GET['setting']) ? $_GET['setting'] : 'dashboard';

                        foreach ( $site_mode_tabs as $site_mode_tab ) :
                            $tab_class = ($current_tab === $site_mode_tab['link']) ? 'active' : '';
                            ?>
                                <a href="<?php echo admin_url('?page=site-mode&setting='. $site_mode_tab['link']);  ?>" class="<?php echo $tab_class; ?>"><?php echo $site_mode_tab['title']; ?></a>
                            <?php
                        endforeach;
                    ?>
                </div>
            </div>
        </div>
        <div class="sm__dashboard-content">
            <div class="smd-fluid-container">
                <div class="tab__contents">
                    <div class="smd-tab-content" id="<?php echo $current_tab; ?>">
                        <?php

                        if($current_tab === 'settings' || $current_tab === 'templates') {

                            if($current_tab === 'templates'){
                                require_once SITE_MODE_ADMIN . "classes/class-site-mode-design.php";
                                $class_name = 'Site_Mode_Design';
                                $class      = new $class_name();
                                $class->render();
                            } else {


                                ?>
                                <div class="tabs_wrapper">
                                    <ul class="sm_tabs">
                                        <?php
                                        $site_mode_tabs = [
                                            [
                                                'title' => 'General',
                                                'icon'  => '<i class="fa-solid fa-gear"></i>',
                                            ],
                                            [
                                                'title' => 'SEO',
                                                'icon'  => '<i class="fa-solid fa-chart-pie"></i>',
                                            ],
                                            [
                                                'title' => 'Integrations',
                                                'icon'  => '<i class="fa-solid fa-palette"></i>',
                                            ],
                                            [
                                                'title' => 'Advanced',
                                                'icon'  => '<i class="fa-solid fa-sliders"></i>',
                                            ],
                                        ];
                                        $active_tab     = isset( $_GET['tab'] ) ?  sanitize_text_field( strtolower($_GET['tab']) ) : 'general';

                                        foreach ( $site_mode_tabs as $site_mode_tab ) :
                                            $tab_class = strtolower( $site_mode_tab['title'] ) === $active_tab ? 'sm_tabs-link current' : 'sm_tabs-link';
                                            $tab_data  = 'tab-' . strtolower( $site_mode_tab['title'] );
                                            $tab_link = '?page=site-mode&setting=settings&tab=' . strtolower($site_mode_tab['title']);
                                            ?>
                                            <li class="<?php echo esc_attr( $tab_class ); ?>" data-tab="<?php echo esc_attr( $tab_data ); ?>">
                                                <a href="<?php echo esc_url(admin_url($tab_link));  ?>" >
                                                    <span class="menu_icon"><?php $this->wp_kses_svg( $site_mode_tab['icon'] ); ?> </span>
                                                    <span class="menu_label"><?php echo esc_html( $site_mode_tab['title']); ?></span>
                                                </a>
                                            </li>
                                        <?php
                                        endforeach;
                                        ?>
                                    </ul>

                                    <div class="tab-content current">
                                        <?php
                                        require_once SITE_MODE_ADMIN . "classes/class-site-mode-{$active_tab}.php";
                                        $class_name = 'Site_Mode_' . ucfirst( $active_tab );
                                        $class      = new $class_name();
                                        $class->render();
                                        ?>
                                    </div>

                                </div>
                                <?php
                            }

                        } elseif($current_tab === 'about-us' || $current_tab === 'support') {
                            require_once SITE_MODE_ADMIN . "partials/dashboard-about-page.php";
                        } else {
                            require_once SITE_MODE_ADMIN . "partials/dashboard-setting-page.php";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

