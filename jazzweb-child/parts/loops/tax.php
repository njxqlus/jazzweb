<?php
/**
* Loop for taxonomy
*/
if( is_tax() ) {
    ?>
    <div class="entry-title">
        <h1>
            <?php echo get_queried_object()->name;?>
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