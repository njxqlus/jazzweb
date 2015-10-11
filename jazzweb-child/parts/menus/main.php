<nav id="main-navigation" class="navbar">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".menu-collapse">
            <?php echo __('Click to Open Menu','jazzweb-child');?>
        </button>
    </div>

    <?php
        wp_nav_menu( array(
            'menu'              => 'main',
            'theme_location'    => 'main',
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse menu-collapse',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => jazzweb()->fallback_cb(),
            'walker'            => jazzweb()->walker()
            )
        );
    ?>
</nav>
<!-- #main-navigation -->