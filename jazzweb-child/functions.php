<?php
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






