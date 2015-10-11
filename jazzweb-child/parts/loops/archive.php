<?php
/**
 * Loop for CPT archives
 */
if( is_post_type_archive() ) {
    ?>
    <div class="entry-title">
        <h1>
            <?php post_type_archive_title();?>
        </h1>
    </div>
    <?php
    if( have_posts() ){
        while( have_posts() ){
            the_post();
            ?>
            <div <?php jazzweb()->post()->classANDid();?>>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php jazzweb()->post()->title();?>
                </a>
                <div class="post-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            </div>

        <?php
        }
    }
}

/**
 * Loop for all archives page. Must be the last loop on this page
 */
elseif( is_archive() ) {
    ?>
    <div class="entry-title">
        <h1>
            <?php post_type_archive_title();?>
        </h1>
    </div>
    <?php
    if( have_posts() ){
        while( have_posts() ){
            the_post();
            ?>
            <div <?php jazzweb()->post()->classANDid();?>>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php jazzweb()->post()->title();?>
                </a>
                <div class="post-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            </div>
        <?php
        }
    }
}


