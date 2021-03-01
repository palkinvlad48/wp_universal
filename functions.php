<?php
// Добавление расширенных возможностей

if ( ! function_exists( 'universal_theme_setup' ) ) :

	function universal_theme_setup() {
		// добавление тэга title
		add_theme_support( 'title-tag' );

		// добавление кастомного логотипа
		add_theme_support( 'custom-logo', [
			'width'		=> 163,
			'flex-height' => true,
			'header-text' => 'Universal',
			'unlink-homepage-logo' => false, // с wp 5.5
		]);
		// Регистрация меню
		register_nav_menus( [
				'header_menu' => 'Меню в шапке',
				'footer_menu' => 'Меню в подвале'
			] 
		);

	}
endif;
add_action( 'after_setup_theme', 'universal_theme_setup');


// Подключение стилей и скраптов

function enqueue_universal_style() {
	wp_enqueue_style( 'style', get_template_directory_uri() );
  wp_enqueue_style( 'universal-theme', get_template_directory_uri() . '/assets/css/universal-theme.css', 'style', time() );
}
add_action( 'wp_enqueue_scripts', 'enqueue_universal_style' );
