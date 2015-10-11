<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php
    jazzweb()->header()->charset();
    jazzweb()->header()->favicon();
    jazzweb()->header()->title();
    wp_head();
	jazzweb()->header()->style();

    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body <?php body_class(); ?>>

<?php jazzweb()->part('header');
