<?php
add_action( 'widgets_init',
    function() {
        register_sidebar(
            array(
                'id' => 'main_sidebar',
                'name' => __('Sidebar', 'jazzweb_child'),
                'description' => '',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>'
            )
        );
    }
);

 
