<?php
/**
 * Set ACF path
 * @since 2.0.0
 */
add_filter('acf/settings/path',
    function() {
        $path = get_template_directory() . '/inc/acf/';
        return $path;
    }
);

/**
 * Set ACF directory
 * @since 2.0.0
 */
add_filter('acf/settings/dir',
    function() {
        $dir = get_template_directory_uri() . '/inc/acf/';
        return $dir;
    }
);

/**
 * Show ACF in admin menu
 * @since 2.0.0
 */
//add_filter('acf/settings/show_admin', '__return_false');

/**
 * Include ACF
 * @since 2.0.0
 */
include_once( get_template_directory() . '/inc/acf/acf.php' );

/**
 * Include theme settings
 * @since 2.0.0
 */
get_template_part ('/functions/ts/ts', 'additional');

/**
 * Include theme options
 * @since 2.0.0
 */
get_template_part ('/functions/ts/theme', 'options');
