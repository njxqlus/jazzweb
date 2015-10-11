<?php
class jazzweb_header {

    function __construct(){

    }

    /**
     * Echo favicon
     * @since 2.0.0
     */
    public function favicon() {
        $favicon = get_field('favicon', 'option');
        if ( $favicon ) { ?>
            <link rel="icon" type="image/png" href="<?php echo $favicon;?>">
        <?php }
    }

    /**
     * Echo charset metatag
     * @since 2.0.0
     */
    public function charset() {
        echo '<meta charset="'. get_bloginfo('charset') .'" />';
    }

    /**
     * Echo page title
     * @since 2.0.0
     */
    public function title() {
        ?>
        <title>
            <?php if( is_front_page() ) {
                bloginfo('name'); echo ' - '; bloginfo('description');
            } else {
                wp_title('');
            } ?>
        </title>
    <?php
    }

    /**
     * Load style.css
     * @since 2.0.0
     */
    public function style() {
        wp_enqueue_style(
            'style',
            get_stylesheet_directory_uri() .'/style.css',
            '',
            null,
            'all'
        );
    }

}
