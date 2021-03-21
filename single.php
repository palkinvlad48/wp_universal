<?php get_header('post'); ?>

<main id="primary" class="site-main">
	<div class="container">
		<?php
    // запускаем цикл вордпресс, прверяем, есть ли посты
		while ( have_posts() ) :
    // если есть - выводим содержимое
			the_post();
    // находим шаблон для вывода поста в папке template-parts
			get_template_part( 'template-parts/content', get_post_type() );
    // если тип пост, то ищет template-parts/content-post.php
    // выводим ссылки на предыдущий и следующий посты
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Назад:', 'universal-example' ) . '</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Вперед:', 'universal-example' ) . '</span>',
				)
			);

			// Если комментарии к записи открыты, выводим их
			if ( comments_open() || get_comments_number() ) :
      // Находит файл comment.php и выводит его
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		</div>
	</main>
  <!-- #main -->

<?php get_footer(); ?>