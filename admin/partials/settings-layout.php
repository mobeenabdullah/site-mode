

    <?php
    if(empty(get_option('sm-fresh-installation'))):
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

                        $current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'dashboard';

                        foreach ( $site_mode_tabs as $site_mode_tab ) :
                            $tab_class = ($current_tab === $site_mode_tab['link']) ? 'active' : '';
                            ?>
                                <a href="<?php echo admin_url('?page=site-mode&tab='. $site_mode_tab['link']);  ?>" class="<?php echo $tab_class; ?>"><?php echo $site_mode_tab['title']; ?></a>
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
                                require_once SITE_MODE_ADMIN . "classes/class-site-mode-general.php";
                                require_once SITE_MODE_ADMIN . "classes/class-site-mode-seo.php";
                                require_once SITE_MODE_ADMIN . "classes/class-site-mode-advanced.php";

                                $general_class = new Site_Mode_General();
                                $seo_class = new Site_Mode_Seo();
                                $advanced_class = new Site_Mode_Advanced();

                                $general_class->render();
                                $seo_class->render();
                                $advanced_class->render();

                            }

                        } elseif($current_tab === 'about-us') {
                            echo $current_tab;
                        } else {
                            require_once SITE_MODE_ADMIN . "partials/dashboard-setting-page.php";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>








    <div class="wrap site_mode__wrap" style="display: none;">
        <div class="site_mode__wrap--header">
            <img src="<?php echo esc_url( SITE_MODE_ADMIN_URL. '/assets/img/sitemode-logo.png' ); ?>" alt="Site Mode Logo" class="site_mode__wrap--logo">
        </div>
        <div class="site_mode__wrap--cover">
            <div class="site_mode__wrap--cover-content">
                <?php require_once SITE_MODE_ADMIN . 'partials/main-content.php'; ?>
            </div>
            <div class="site_mode__wrap--cover-sidebar">
                <?php require_once SITE_MODE_ADMIN . 'partials/sidebar.php'; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

