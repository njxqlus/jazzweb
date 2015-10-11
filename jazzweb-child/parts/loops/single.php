<?php
/**
 * Loop for posts
 */
if ( is_singular('post') ){
    if( have_posts() ){
        while( have_posts() ){
            the_post();
            ?>

            <div <?php jazzweb()->post()->classANDid();?>>
                <?php jazzweb()->post()->title('h1');?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>

        <?php
        } // end while
    } // end if
}

/**
 * Loop for all other single posts. Must be the last loop on this page
 */
elseif ( is_singular() ){
    if( have_posts() ){
        while( have_posts() ){
            the_post();
            ?>

            <div <?php jazzweb()->post()->classANDid();?>>
                <?php jazzweb()->post()->title('h1');?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>

        <?php
        } // end while
    } // end if
}


