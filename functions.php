<?php

//wp_enqueue_style( 'slick', get_template_directory_uri() . '/slick/slick.css');

//wp_enqueue_style( 'slick_theme', get_template_directory_uri() . '/slick/slick-theme.css');
//wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css');
//wp_enqueue_style( 'bootstrap-grid', get_template_directory_uri() . '/css/bootstrap-grid.min.css');
//wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css');

add_action( 'wp_enqueue_scripts', 'enqueue_universal_style' );
function enqueue_universal_style() {
	//wp_deregister_script( 'jquery' );
	//wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');
	wp_enqueue_style( 'style', get_template_directory_uri() );
  wp_enqueue_style( 'universal-theme', get_template_directory_uri() . '/assets/css/universal-theme.css', 'style', null, null );
}
// ' (T_ENCAPSED_AND_WHITESPACE), expecting ')'
