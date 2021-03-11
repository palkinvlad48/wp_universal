<?php
// Добавление расширенных возможностей

if ( ! function_exists( 'universal_theme_setup' ) ) :

	function universal_theme_setup() {
		// добавление тэга title
		add_theme_support( 'title-tag' );

		// добавление миниатюр
		add_theme_support( 'post-thumbnails', array( 'post' ) );


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

// Подключение сайдбара

function universal_theme_widgets_init() {
	register_sidebar( 
		array(
			'name'          => esc_html__('Сайдбар на главной ', 'universal-theme'),
			'id'						=> 'main-sidebar',
			'description'		=> esc_html__('Добавьте виджеты сюда', 'universal-theme'),
			'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</section>',
			'before_title'	=> '<h2 class="widget-title">',
			'after_title'		=> '</h2>',
		)
	 );
}
add_action('widgets_init', 'universal_theme_widgets_init');

/**
 * Добавление нового виджета Downloader_Widget.
 */
class Downloader_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'downloader_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: Downloader_Widget
			'Полезные файлы',
			array( 'description' => 'Файлы для скачивания', 'classname' => 'widget-downloader', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_downloader_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_downloader_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title']; //apply_filters( 'widget_title', $instance['title'] );
		$description = $instance['description'];
		$link = $instance['link'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		if ( ! empty( $description ) ) {
			echo '<p>' . $description . '</p>';
		}
		if ( ! empty( $link ) ) {
			echo '<a target="_blank" class="widget-link" href="' . $link . '">
			<img class="widget-link-icon" src="' . get_template_directory_uri() . '/assets/images/download.svg">Скачать</a>';
		}
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Полезные файлы';
		$description  = @ $instance['description'] ?: 'Описание';
		$link  = @ $instance['link'] ?: 'http://yandex.ru/';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php 
			echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Описание:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php 
			echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Ссылка на файл:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php 
			echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update() 
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 * 
	 *downloader_widget

	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
		
		return $instance;
	}

	// скрипт виджета (add_my_widget_scripts - было)
	function add_downloader_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_downloader_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

	//	wp_enqueue_script('downloader_widget_script', $theme_url .'/downloader_widget_script.js' );
	}

	// стили виджета
	function add_downloader_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_downloader_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.downloader_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Downloader_Widget

// регистрация Downloader_Widget в WordPress
function register_downloader_widget() {
	register_widget( 'Downloader_Widget' );
}
add_action( 'widgets_init', 'register_downloader_widget' );
//
// Подключение стилей и скриптов

function enqueue_universal_style() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
  wp_enqueue_style( 'universal-theme', get_template_directory_uri() . '/assets/css/universal-theme.css', 'style', time() );
	wp_enqueue_style( 'Roboto-Slab', 'https://fonts/googleapis.com/css2?family=Roboto+Slab:widht@700&display=swap');

}
add_action( 'wp_enqueue_scripts', 'enqueue_universal_style' );

/**
 * Добавление нового виджета Social_Widget.
 */
class Social_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'social_widget', // ID виджета, если не указать (оставить ''), 
			//то ID будет равен названию класса в нижнем регистре: social_widget
			'Социальные сети',
			array( 'description' => 'Социальные сети', 'classname' => 'widget-social', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
		//	add_action('wp_enqueue_scripts', array( $this, 'add_social_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_social_widget_style' ) );
		}
	}

	/** social_widget
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title']; //apply_filters( 'widget_title', $instance['title'] );
		//$description = $instance['description'];
		
		$link_1 = $instance['link_1'];
	  $link_2 = $instance['link_2'];
		$link_3 = $instance['link_3'];
		$link_4 = $instance['link_4'];
/**/
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		//if ( ! empty( $description ) ) {
			//echo '<p>' . $description . '</p>';
		//}
		echo '<div class="widget-social-wrapper">';
		if ( ! empty( $link_1 ) ) {
			//echo '<a target="_blank" class="widget-social.widget-link-face" href="' . $link . '"><a>';
			echo '<a target="_blank" class="" href="' . $link_1 . 
			'"><img class="widget-link-icon" src="' . get_template_directory_uri() . 
			'/assets/images/facebook.svg" alt="icon facebook"></a>';
		}
		if ( ! empty( $link_2 ) ) {
			echo '<a target="_blank" class="" href="' . $link_2 . 
			'"><img class="widget-social-icon" src="' . get_template_directory_uri() . 
			'/assets/images/twitter.svg" alt="icon twitter"></a>';
		}
		if ( ! empty( $link_3 ) ) {
			echo '<a target="_blank" class="" href="' . $link_3 . 
			'"><img class="widget-link-icon" src="' . get_template_directory_uri() . 
			'/assets/images/youtube.svg" alt="icon youtube"></a>';
		}
		if ( ! empty( $link_4 ) ) {
			echo '<a target="_blank" class="" href="' . $link_4 . 
			'"><img class="widget-link-icon" src="' . get_template_directory_uri() . 
			'/assets/images/instagram.svg" alt="icon instagram"></a>';
		}
		echo '</div>'; 
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 * social_widget
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Социальные сети';
		//$description  = @ $instance['description'] ?: 'Ссылки';
		$link_1  = @ $instance['link_1'] ?: 'http://facebook.ru/';
		$link_2  = @ $instance['link_2'] ?: 'http://twitter.ru/';
		$link_3  = @ $instance['link_3'] ?: 'http://youtube.ru/';
		$link_4  = @ $instance['link_4'] ?: 'http://instagram.ru/';/**/
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widget" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php 
			echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_1' ); ?>"><?php _e( 'Ссылка на facebook:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link_1' ); ?>" name="<?php 
			echo $this->get_field_name( 'link_1' ); ?>" type="text" value="<?php echo esc_attr( $link_1 ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_2' ); ?>"><?php _e( 'Ссылка на twitter:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link_2' ); ?>" name="<?php 
			echo $this->get_field_name( 'link_2' ); ?>" type="text" value="<?php echo esc_attr( $link_2 ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_3' ); ?>"><?php _e( 'Ссылка на youtube:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link_3' ); ?>" name="<?php 
			echo $this->get_field_name( 'link_3' ); ?>" type="text" value="<?php echo esc_attr( $link_3 ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_4' ); ?>"><?php _e( 'Ссылка на instagram:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link_4' ); ?>" name="<?php 
			echo $this->get_field_name( 'link_4' ); ?>" type="text" value="<?php echo esc_attr( $link_4 ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		//$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['link_1'] = ( ! empty( $new_instance['link_1'] ) ) ? strip_tags( $new_instance['link_1'] ) : '';
		$instance['link_2'] = ( ! empty( $new_instance['link_2'] ) ) ? strip_tags( $new_instance['link_2'] ) : '';
		$instance['link_3'] = ( ! empty( $new_instance['link_3'] ) ) ? strip_tags( $new_instance['link_3'] ) : '';
		$instance['link_4'] = ( ! empty( $new_instance['link_4'] ) ) ? strip_tags( $new_instance['link_4'] ) : '';
		return $instance;
	}

// скрипт виджета 
	function add_social_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_social_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

	//	wp_enqueue_script('social_widget_script', $theme_url .'/social_widget_script.js' );
	}

	// стили виджета
	function add_social_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_social_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.social_widget a { display:inline; }
		</style>
		<?php
	}

} 
// конец класса Social_Widget

// регистрация Social_Widget в WordPress
function register_social_widget() {
	register_widget( 'Social_Widget' );
}
add_action( 'widgets_init', 'register_social_widget' );
//
/* изменение настроек - работает и без этого
add_filter( 'widget_social_widget_args', 'edit_social_widget_args');

function edit_social_widget_args($args) {
	$args['link_1'] = '';
	$args['link_2'] = '';
	$args['link_3'] = '';
	$args['link_4'] = '';
	return $args;
}*/

/* изменение настроек облака тегов */
add_filter( 'widget_tag_cloud_args', 'edit_widget_tag_cloud_args');

function edit_widget_tag_cloud_args($args) {
	$args['unit'] = 'px';
	$args['smallest'] = '14';
	$args['largest'] = '14';
	$args['number'] = '10';
	return $args;
}
// отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );

function delete_intermediate_image_sizes( $sizes ) {
	// размеры, которые удаляются
	return array_diff( $sizes, [
		'medium_large',
		'large',
		'1536X1536',
		'2048x2048',
	]);
}

if ( function_exists( 'add_image_size') ) {
	//add_image_size( 'front-page-thumb', 65, 999 ); // без ограничения по высоте
	add_image_size( 'homepage-thumb', 65, 65, true ); // кадрирование картинки
}