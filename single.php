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