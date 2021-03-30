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
			'flex-height' => true, // чтобы менялась
			'header-text' => 'Universal',
			'unlink-homepage-logo' => true, // с wp 5.5
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

// подключение стилей
function enqueue_universal_style() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
  
	wp_enqueue_style( 'swiper-slider', get_template_directory_uri() . '/assets/css/swiper-bundle.css', 'style', time() );
	wp_enqueue_style( 'universal-theme', get_template_directory_uri() . '/assets/css/universal-theme.css', 'style', time() );
	wp_enqueue_style( 'Roboto-Slab', 'https://fonts/googleapis.com/css2?family=Roboto+Slab:widht@700&display=swap');
	wp_deregister_script( 'jquery-core');
	wp_register_script( 'jquery-core', get_template_directory_uri() . '/assets/js/jquery-3.5.1.min.js', null, time() );//code.jquery.com/
	wp_enqueue_script( 'jquery-core' );
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.js', null, time(), true );

	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/scripts.js', 'swiper', time(), true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_universal_style' );

// Подключаем локализацию в самом конце подключаемых к выводу скриптов, чтобы скрипт
// 'twentyfifteen-script', к которому мы подключаемся, точно был добавлен в очередь на вывод.
// Заметка: код можно вставить в любое место functions.php темы
add_action( 'wp_enqueue_scripts', 'adminAjax_data', 99 );

function adminAjax_data(){
	// Первый параметр 'jquery' означает, что код будет прикреплен к скрипту с ID 
	// 'jquery'
	// 'jquery' должен быть добавлен в очередь на вывод, иначе WP не поймет куда вставлять код 
	// локализации. Заметка: обычно этот код нужно добавлять в functions.php в том месте, где подключаются скрипты, 
	// после указанного скрипта
	wp_localize_script( 'jquery-core', 'adminAjax',
		array(
			'url' => admin_url('admin-ajax.php')
		)
	);
}

add_action( 'wp_ajax_contacts_form', 'ajax_form' );
add_action( 'wp_ajax_nopriv_contacts_form', 'ajax_form' );
function ajax_form(){
	$contact_name = $_POST['contact_name'];
	$contact_email = $_POST['contact_email'];
	$contact_comment = $_POST['contact_comment'];
	$headers = 'From: Артем <islamovtema@yandex.ru>' . "\r\n"; 
	$message = 'Пользователь ' . $contact_name;
	$sent_message = wp_mail('palkinw@mail.ru', 'Заявка: ' . ' Содержание: ', $message, $headers);
	if ($sent_message) {
		echo 'Все хорошо';
	} else {
		echo 'Ошибка';
	}/**/
	//mail('palkinw@mail.ru', 'Новая заявка', $message, $headers);
	// выход нужен, чтобы в ответе не было ничего лишнего, только то, что вернет ф-я
	wp_die();
}
// Подключение сайдбара

function universal_theme_widgets_init() {
	register_sidebar( 
		array(
			'name'          => esc_html__('Сайдбар на главной сверху', 'universal-theme'),
			'id'						=> 'main-sidebar-top', //'home-top',
			'description'		=> esc_html__('Добавьте виджеты сюда', 'universal-theme'),
			'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</section>',
			'before_title'	=> '<h2 class="widget-title">',
			'after_title'		=> '</h2>',
		)
	 );
	 register_sidebar( 
		array(
			'name'          => esc_html__('Сайдбар на главной снизу', 'universal-theme'),
			'id'						=> 'main-sidebar-bottom', //'home-bottom,
			'description'		=> esc_html__('Добавьте виджеты сюда', 'universal-theme'),
			'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</section>',
			'before_title'	=> '<h2 class="widget-title">',
			'after_title'		=> '</h2>',
		)
	);
	register_sidebar( 
		array(
			'name'          => esc_html__('Меню в подвале', 'universal-theme'),
			'id'						=> 'sidebar-footer', 
			'description'		=> esc_html__('Добавьте меню сюда', 'universal-theme'),
			'before_widget'	=> '<section id="%1$s" class="footer-menu %2$s">',
			'after_widget'	=> '</section>',
			'before_title'	=> '<h2 class="footer-menu-title">',
			'after_title'		=> '</h2>',
		)
	);
	register_sidebar( 
		array(
			'name'          => esc_html__('Текст в подвале', 'universal-theme'),
			'id'						=> 'sidebar-footer-text', 
			'description'		=> esc_html__('Добавьте текст сюда', 'universal-theme'),
			'before_widget'	=> '<section id="%1$s" class="footer-text %2$s">',
			'after_widget'	=> '</section>',
			'before_title'	=> '',
			'after_title'		=> '',
		)
	);
	register_sidebar( 
		array(
			'name'          => esc_html__('Посты вашей рубрики', 'universal-theme'),
			'id'						=> 'sidebar-some_category', //javascript', 
			'description'		=> esc_html__('Добавьте виджет сюда', 'universal-theme'),
			'before_widget'	=> '<section id="%1$s" class="same-widget %2$s">',
			'after_widget'	=> '</section>',
			'before_title'	=> '', //<h2 class="widget-title">',
			'after_title'		=> '', //</h2>',
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
	 * Downloader_Widget
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
			echo '<p class="widget-desc">' . $description . '</p>';
		}
		if ( ! empty( $link ) ) {
			echo '<a target="_blank" class="widget-link" href="' . $link . '" download>
			<svg fill="#96E2E3" width="20" heigth="20" class="icon widget-link-icon">
        <use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#download">
				</use>
      </svg>	
			Скачать</a>';
		}
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 * Downloader_Widget
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
	 * downloader_widget

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
		$link_Facebook = $instance['link_Facebook'];
	  $link_Twitter = $instance['link_Twitter'];
		$link_Youtube = $instance['link_Youtube'];
		$link_Instagram = $instance['link_Instagram'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'] . 
		  '<div class="widget-social-wrapper">';
		}
		if ( ! empty( $link_Facebook ) ) {
			//echo '<a target="_blank" class="" href="' . $link . '"><a>';
			echo '<a target="_blank" class="widget-social" href="' . $link_Facebook . 
			'"><img class="widget-link-icon" src="' . get_template_directory_uri() . 
			'/assets/images/facebook.svg" alt="icon facebook"></a>';
		}
		if ( ! empty( $link_Twitter ) ) {
			echo '<a target="_blank" class="widget-social" href="' . $link_Twitter . 
			'"><img class="widget-social-icon" src="' . get_template_directory_uri() . 
			'/assets/images/twitter.svg" alt="icon twitter"></a>';
		}
		if ( ! empty( $link_Youtube ) ) {
			echo '<a target="_blank" class="widget-social" href="' . $link_Youtube . 
			'"><img class="widget-link-icon" src="' . get_template_directory_uri() . 
			'/assets/images/youtube.svg" alt="icon youtube"></a>';
		}
		if ( ! empty( $link_Instagram ) ) {
			echo '<a target="_blank" class="widget-social" href="' . $link_Instagram . 
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
		
		$link_Facebook = @ $instance['link_Facebook'] ?: 'https://www.facebook.com/';
		$link_Twitter = @ $instance['link_Twitter'] ?: 'https://www.twitter.com/';
		$link_Youtube = @ $instance['link_Youtube'] ?: 'https://www.youtube.com/';
		$link_Instagram = @ $instance['link_Instagram'] ?: 'https://www.instagram.com/';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widget" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php 
			echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_Facebook' ); ?>"><?php _e( 'Ссылка на facebook:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link_Facebook' ); ?>" name="<?php 
			echo $this->get_field_name( 'link_Facebook' ); ?>" type="text" value="<?php echo esc_attr( $link_Facebook ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_Twitter' ); ?>"><?php _e( 'Ссылка на twitter:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link_Twitter' ); ?>" name="<?php 
			echo $this->get_field_name( 'link_Twitter' ); ?>" type="text" value="<?php echo esc_attr( $link_Twitter ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_Youtube' ); ?>"><?php _e( 'Ссылка на youtube:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link_Youtube' ); ?>" name="<?php 
			echo $this->get_field_name( 'link_Youtube' ); ?>" type="text" value="<?php echo esc_attr( $link_Youtube ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_Instagram' ); ?>"><?php _e( 'Ссылка на instagram:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link_Instagram' ); ?>" name="<?php 
			echo $this->get_field_name( 'link_Instagram' ); ?>" type="text" value="<?php echo esc_attr( $link_Instagram ); ?>">
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
		$instance['link_Facebook'] = ( ! empty( $new_instance['link_Facebook'] ) ) ? strip_tags( $new_instance['link_Facebook'] ) : '';
		$instance['link_Twitter'] = ( ! empty( $new_instance['link_Twitter'] ) ) ? strip_tags( $new_instance['link_Twitter'] ) : '';
		$instance['link_Youtube'] = ( ! empty( $new_instance['link_Youtube'] ) ) ? strip_tags( $new_instance['link_Youtube'] ) : '';
		$instance['link_Instagram'] = ( ! empty( $new_instance['link_Instagram'] ) ) ? strip_tags( $new_instance['link_Instagram'] ) : '';
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
	$args['link_Facebook'] = '';
	$args['link_Twitter'] = '';
	$args['link_Youtube'] = '';
	$args['link_Instagram'] = '';
	return $args;
}*/

/**
 * Добавление нового виджета Recent_Posts_Widget
*/
class Recent_Posts_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'recent_posts_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре
			'Последние посты',
			array( 'description' => 'Последние посты', 'classname' => 'widget-recent-posts', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_recent_posts_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_recent_posts_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 * Recent_Posts_Widget
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	*/ 
	function widget( $args, $instance ) {
		$title = $instance['title']; 
		$count = $instance['count'];

		echo $args['before_widget'];
		echo '<div class="widget-recent-posts-wrapper">';
		if ( ! empty( $count ) ) {
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			//echo '<div class="wrapper-link">';
			global $post;

			$postlist = get_posts( [
				'numberposts' => $count,  
			//	'offset' => 4,
				'category_name' => 'news',
			]);
			//	array( 'post-per-page' => $count, 'order' => 'ASC', 'orderby' => 'title' ));
			if ($postlist ) {
				foreach ( $postlist as $post) {
					setup_postdata($post);
			?>
			
			<a class="recent-post-link" href="<?php get_the_permalink(); ?>">
				<img class="recent-post-thumb" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
				<div class="recent-post-info">	
					<h4 class="recent-post-title"><?php echo mb_strimwidth(get_the_title(), 0, 42, '...'); ?></h4>	
					<span class="recent-post-time">
						<?php $time_diff = human_time_diff( get_post_time('U'), current_time('timestamp')); 
							echo "$time_diff назад"; // Опубликовано
						?>
					</span>
				</div>
			</a>
			<?php
			 
			}
			wp_reset_postdata();
			//echo '</div>';
			echo '<p style="text-align: center; font-weight: 700; margin-bottom:10px;">Read more</p></div';
		}
		echo $args['after_widget'];
		}
	}
	/**
	 * Админ-часть виджета
	 * Recent_Posts_Widget
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Последние посты';
		$count  = @ $instance['count'] ?: '7';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php 
			echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Количество постов:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php 
			echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>">
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
	 * Recent_Posts_Widget

	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '0';
		
		return $instance;
	}

	// скрипт виджета (add_my_widget_scripts - было)
	function add_recent_posts_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_recent_posts_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('recent_posts_widget_script', $theme_url . '/recent_posts_widget_script.js' );
	}

	// стили виджета
	function add_recent_posts_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_recent_posts_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.recent_posts_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Recent_Posts_Widget

// регистрация Recent_Posts_Widget в WordPress
function register_recent_posts_widget() {
	register_widget( 'Recent_Posts_Widget' );
}
add_action( 'widgets_init', 'register_recent_posts_widget' );
/* ??? */
/**
 * Добавление нового виджета Heading_Posts_Widget
*/
class Heading_Posts_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'heading_posts_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре
			'Посты вашей рубрики',
			array( 'description' => '', 'classname' => 'widget-heading-posts', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
		//	add_action('wp_enqueue_scripts', array( $this, 'add_heading_posts_widget_scripts' ));
		//	add_action('wp_head', array( $this, 'add_heading_posts_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 * Heading_Posts_Widget
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	*/ 
	function widget( $args, $instance ) {
		$title = $instance['title']; 
		$count = $instance['count'];
	//	$category = $instance['category'];

		//echo $args['before_widget'];
		//echo '<div class="widget-heading-posts-wrapper">';
		if ( ! empty( $count ) ) {
	//		if ( ! empty( $title ) ) {
	//			echo $args['before_title']; // . $title . $args['after_title'];
	//		}
		//	$posttags = get_the_tags(); 
		//	$tags_list = get_the_tag_list( '',  esc_html_x(', ', 'list item separator', 'universal-theme' ) );
		//	$tag = $posttags[0]->name;
		//	'<p>' . $tags_list . '</p>';
			$tag = '';
			$posttags = get_the_tags();
			$category = get_the_category();
			if ( $posttags ) {
				$tag = $posttags[0]->name . ' ';
			}
			global $post;

			$postlist = get_posts( [
				'numberposts' => $count,  
				'offset'      => 1,
				'tag'					=> $tag,
			//	'category' => $category->term_id, 
				'category_name' => $category->name, //'javascript', 
				'post__not_in' => array( $post->ID)
			]);
			//	array( 'post-per-page' => $count, 'order' => 'ASC', 'orderby' => 'title' ));
			if ($postlist ) {
				foreach ( $postlist as $post) {
					setup_postdata($post);
			?>
			
			<li class="same-grid-item">
			<a href="<?php the_permalink(); ?>" class="article-grid-permalink">
        <img class="same-grid-thumb" src="
          <?php 
              if ( has_post_thumbnail() ) { 
                echo get_the_post_thumbnail_url( null, 'thumb'); 
              } 
              else {
                echo get_template_directory_url() . 'assets/images/default.png';
              } 
          ?>" alt="Рисунок поста">
        <div class="same-grid-info">
          <h4 class="same-grid-title"><?php echo mb_strimwidth(get_the_title(), 0, 30, '...'); ?></h4> 
          <div class="same-comments">
						<svg fill="#BCBFC2" width="15" height="11" class="icon likes-icon">
							<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#eye"></use>
            </svg>
            <span class="comments-counter"><?php comments_number('0', '1', '%'  ) ?></span>&nbsp;
            <svg width="15" height="14" class="icon comments-icon">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#comment"></use>
						</svg>
            <span class="comments-counter"><?php comments_number('0', '1', '%'  )?></span>
          </div>
        </div>
        <!-- /.same-grid-info -->
				</a>
      </li>
		<!--/div-->
			<?php
			 
			}
			wp_reset_postdata();
		}
		//	echo $args['after_widget'];
		}
	}
	/**
	 * Админ-часть виджета
	 * Heading_Posts_Widget
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Посты вашей рубрики';
	//	$category = @ $instance['category'] ?: '';
		$count  = @ $instance['count'] ?: '4';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php 
			echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Количество постов:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php 
			echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>">
		</p>
		
		<?php 
	}
}
	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update() 
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 * 
	 * Heading_Posts_Widget

	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '0';
		$instance['category'] = ( ! empty( $new_instance['category'] ) ) ? strip_tags( $new_instance['category'] ) : '';
		
		return $instance;
	}

	// скрипт виджета 
	function add_heading_posts_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_heading_posts_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('heading_posts_widget_script', $theme_url . '/heading_posts_widget_script.js' );
	}

	// стили виджета
	function add_heading_posts_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_heading_posts_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.heading_posts_widget a{ display:inline; }
		</style>
		<?php
	}

//} 
// конец класса Heading_Posts_Widget

// регистрация Heading_Posts_Widget в WordPress
function register_heading_posts_widget() {
	register_widget( 'Heading_Posts_Widget' );
}
add_action( 'widgets_init', 'register_heading_posts_widget' );
/* ??? */

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

// меняем стиль многоточия в открывках
add_filter('excerpt_more', function($more){
	return ' ...';
});

// склоняем слова после числительных
function plural_form($number, $after) {
	$cases = array (2,0,1,1,1,2);
	echo $number . ' ' . $after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
}