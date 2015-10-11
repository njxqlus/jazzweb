<?php
/**
 * Requerid Jasny Bootstrap
 */
?>
<style>
    .navmenu {
        width: 300px;
    }
    .navbar {
        height: 50px;
    }
    @media all and (min-width: 992px) {
        body {
            padding-left: 300px!important;
        }
    }
    @media all and (min-width: 783px) and (max-width: 991px) {
        .navmenu-fixed-left {
            margin-top: 50px;
        }
        .admin-bar .navmenu-fixed-left {
            margin-top: 82px!important;
        }
    }
    @media all and (max-width: 783px) {
        .admin-bar .navmenu-fixed-left {
            margin-top: 96px!important;
        }
    }
    @media all and (max-width: 782px) {
        .admin-bar .navbar, .admin-bar .navmenu  {
            margin-top: 46px;
        }
    }
    @media all and (min-width: 783px) {
        .admin-bar .navbar, .admin-bar .navmenu  {
            margin-top: 32px;
        }
    }
    @media all and (max-width: 991px) {
        body {
            padding-top: 50px;
        }
    }
    .navbar-toggle {
        display: block!important;
    }

    .navmenu-fixed-left {
        z-index: 1040!important;
    }
</style>
<nav class="navmenu navmenu-default navmenu-fixed-left offcanvas-sm">
    <?php
    wp_nav_menu( array(
            'menu'              => 'main',
            'theme_location'    => 'main',
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => '',
            'menu_class'        => 'nav navmenu-nav',
            'fallback_cb'       => jazzweb()->fallback_cb(),
            'walker'            => jazzweb()->walker()
        )
    );
    ?>
</nav>
<nav class="navbar navbar-default navbar-fixed-top hidden-md hidden-lg">
    <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
</nav>