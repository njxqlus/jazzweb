<?php
/**
 * Loop for blogstyle homepage
 */
if( have_posts() ){
    while( have_posts() ){
        the_post();
        ?>
        <div class="entry-title">
            <h1>
                <?php post_type_archive_title();?>
            </h1>
        </div>
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