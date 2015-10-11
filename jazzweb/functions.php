<?php
/**
 * Activate translations
 * @since 2.0.0
 */
load_theme_textdomain( 'jazzweb', get_theme_root() . '/jazzweb/lang' );

/**
 * Activate additional functions
 * @since 2.0.0.5
 */
get_template_part ('/functions/func');

/**
 * Activate hooks
 * @since 2.0.0
 */
get_template_part ('/functions/hooks');

/**
 * Activate Advanced Custom Fields
 * @since 2.0.0
 */
get_template_part ('/functions/acf');

/**
 * Add theme support: Thumbnails
 * @since 2.0.0
 */
if (function_exists('add_theme_support')) {
    add_theme_support( 'post-thumbnails' );
}

/**
 * Add theme support: Woocommerce
 * @since 2.0.0
 */
add_action( 'after_setup_theme',
    function() {
        add_theme_support( 'woocommerce' );
    }
);