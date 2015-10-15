<?php
function jazzweb() {
    static $jazzweb;
    if(is_null($jazzweb)) {
        $jazzweb = new jazzweb();
    }
    return $jazzweb;
}


class jazzweb {

    function __construct() {

    }

    /**
     * Echo loop
     * @since 2.0.0
     * @version 1.2
     */
    public function loadLoop() {
        if( is_404() ) {
            $this->loop('404');
        }
        elseif( is_front_page() ) {
            $this->loop('front');
        }
        elseif( is_page() ) {
            $this->loop('page');
        }
        elseif( is_archive() ) {
            if( is_tax() ) {
                $this->loop('tax');
            }
            else {
                $this->loop('archive');
            }
        }
        elseif( is_single() ) {
            $this->loop('single');
        }
        elseif( is_home() ) {
            $this->loop('home');
        }
        elseif( is_search() ) {
            $this->loop('search');
        }
    }

    /**
     * Collection of ACF functions
     * @since 2.0.0
     * @return jazzweb_field
     */
    public function field() {
        static $field;
        if(is_null($field)) {
            get_template_part('functions/hooks/field');
            $field = new jazzweb_field();
        }
        return $field;
    }

    /**
     * Return fallback cb
     * @since 2.0.0
     * @return null|string
     */
    public function fallback_cb() {
        if( class_exists('wp_bootstrap_navwalker') ) {
            $fallback_cb = 'wp_bootstrap_navwalker::fallback';
        }
        else {
            $fallback_cb = null;
        }
        return $fallback_cb;
    }

    /**
     * Return navwalker class
     * since 2.0.0
     * @return null|wp_bootstrap_navwalker
     */
    public function walker() {
        if( class_exists('wp_bootstrap_navwalker') ) {
            $walker = new wp_bootstrap_navwalker();
        }
        else {
            $walker = null;
        }
        return $walker;
    }

    /**
     * Collection of header functions
     * @since 2.0.0
     * @return jazzweb_header
     */
    public function header() {
        static $header;
        if(is_null($header)) {
            get_template_part('functions/hooks/header');
            $header = new jazzweb_header();
        }
        return $header;
    }

    /**
     * Return file from /parts/
     * @since 2.0.0
     * @param $part - File name
     */
    public function part($part) {
        get_template_part('parts/' .$part);
    }

    /**
     * Echo wordpress loop from /parts/loops/
     * @since 2.0.0
     * @param $loop - File name
     */
    public function loop($loop) {
        get_template_part('/parts/loops/' .$loop);
    }

    /**
     * Echo menu
     * @since 2.0.0
     * @param $menu - File name
     */
    public function menu($menu) {
        get_template_part('/parts/menus/'. $menu);
    }

    /**
     * Collection of post functions
     * @since 2.0.0.1
     * @return jazzweb_post
     */
    public function post() {
        static $post;
        if(is_null($post)) {
            get_template_part('functions/hooks/post');
            $post = new jazzweb_post();
        }
        return $post;
    }

    /**
     * Collection of breadcrumbs function
     * @since 2.0.0.5
     * @return breadcrumbs
     */
    public function breadcrumbs() {
        static $breadcrumbs;
        if(is_null($breadcrumbs)) {
            get_template_part('functions/hooks/breadcrumbs');
            $breadcrumbs = new breadcrumbs();
        }
        return $breadcrumbs;
    }
}

