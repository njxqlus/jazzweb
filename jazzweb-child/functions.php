<?php
/**
 * Activate Hiweb debug
 */
if( function_exists('hiweb') ) {
    //hiweb()->debug();
} else {
    function hiweb_dosent_exists(){
        ?>
        <div class="updated">
            <p>Jazzweb Child Template: plugin `hiWeb Core` dosen't exist or activate...<a href="plugin-install.php?tab=search&s=hiweb">Install hiWeb Core from WordPress repository</a></p>
        </div>
    <?php
    }
    add_action('admin_notices','hiweb_dosent_exists');
    return;
}

/**
 * Activate child theme translation
 */
load_theme_textdomain( 'jazzweb-child', get_stylesheet_directory() . '/lang' );

/**
 * Register menus
 */
register_nav_menus( array(
    'main' => __( 'Main Menu', 'jazzweb-child' ),
) );

/**
 * Register sidebars
 */
get_template_part('/functions/sidebars');

/**
 * Register custom post types and taxonomies
 */
get_template_part('functions/cpt');






