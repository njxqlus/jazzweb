<?php
/**
 * Loop for front page
 */
if( is_front_page() ) {
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
        }
    }
}