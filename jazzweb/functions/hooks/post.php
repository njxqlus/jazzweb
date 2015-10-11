<?php
class jazzweb_post {

    function __construct() {

    }

    /**
     * Echo post thumbnail
     * @since 2.0.0.1
     * @param null $post_id - Post ID
     * @param string $size - Size of thumbnail
     * @param string $link - post|image|null; Use post for link to the post, image for link to the full size image or null for no link
     */
    public function thumbnail($size = 'thumbnail', $link = 'post', $post_id = null) {
        $thumbnail =  get_the_post_thumbnail($post_id, $size);
        if( $thumbnail ) {
            ?>
            <div class="<?php echo get_post_type(); ?>-thumbnail">
                <?php
                if ($link == 'post') {
                    ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php echo $thumbnail; ?>
                    </a>
                <?php
                } elseif ($link == 'image') {
                    $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
                    ?>
                    <a href="<?php echo $large_image_url[0]; ?>">
                        <?php echo $thumbnail; ?>
                    </a>
                <?php
                } else {
                    echo $thumbnail;
                }
                ?>
            </div>
        <?php
        }
    }

    /**
     * Return additional IDs. Used in id() function
     * @since 2.0.0.1
     * @param string $id - Additional IDs
     * @param null $post_id - Post ID
     * @return array - Array of IDs
     */
    private function get_id($id = '', $post_id = null) {
        $post = get_post( $post_id );
        $ids = array();
        if ( $id ) {
            if ( ! is_array( $id ) ) {
                $id = preg_split( '#\s+#', $id );
            }
            $ids = array_map( 'esc_attr', $id );
        }
        if ( !$post ) {
            return $ids;
        }
        $ids = array_map( 'esc_attr', $ids );
        return array_unique( $ids );
    }

    /**
     * Echo post html ID, like post-1, news-43 etc
     * @since 2.0.0.1
     * @param string $id - Additional IDs
     * @param string $separator - Separator between post type and post id
     * @param $post_id - Post ID
     */
    public function id($id = '', $separator = '-', $post_id = null) {
        if( is_null($post_id) ) {
            $post_id = get_the_ID();
        }
        $ids = '';
        if( $id ) {
            $ids = ' '. join( ' ', $this->get_id($id, $post_id) );
        }
        echo 'id="'. get_post_type(), $separator, $post_id, $ids .'"';
    }

    /**
     * Echo post class and post ID
     * @since 2.0.0.1
     * @version 1.1
     * @param string $class - Additional post class
     * @param string $id - Additional post IDs
     */
    public function classANDid($class = '', $id = '') {
        post_class($class);echo ' '; $this->id($id);
    }

    /**
     * Echo post title
     * @since 2.0.0.1
	 * @version 1.1
     * @param string $tag - h tag, ex: h1,h2,h3 etc
     * @param bool $link - true|false; Use link to post
     * @param null $post_id - Post ID
     */
    public function title($tag = 'h2', $link = false, $post_id = null) {
        $title = get_the_title($post_id);
        if($title) {
            ?>
            <div class="<?php echo get_post_type(); ?>-title entry-title">
                <?php
                if ($link == true) {
                    ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php
                        echo '<'. $tag . '>'. $title . '</'. $tag .'>';
                        ?>
                    </a>
                <?php
                } else {
                    echo '<'. $tag . '>'. $title . '</'. $tag .'>';;
                }
                ?>
            </div>
            <?php
        }
    }
}