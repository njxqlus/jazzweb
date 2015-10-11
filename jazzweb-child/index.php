<?php get_header();?>
    <div id="content" class="site-content">
        <?php jazzweb()->breadcrumbs()->the()?>
        <?php get_sidebar();?>
        <main id="main" class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <?php jazzweb()->loadLoop();?>
        </main><!-- #main -->
    </div><!-- #content -->
<?php get_footer();