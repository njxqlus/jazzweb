<?php
if( function_exists('acf_add_options_page') ) {	
	acf_add_options_page(array(
		'page_title' 	=> __('Theme Options', 'jazzweb-child'),
		'menu_slug'	=> 'theme_options',
        'icon_url'   => 'dashicons-hammer',
		'redirect' => true,
	));
	acf_add_options_sub_page(array(
		'page_title' => __('General', 'jazzweb-child'),
		'menu_slug' => 'general',
        'parent' => 'theme_options',
	));	
}
?>