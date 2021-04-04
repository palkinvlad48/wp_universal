<?php 
/*
Template Name: Страница Уроки
Template Post Type: page, post, lesson
*/
get_header('post') ?>
<!--php if ( function_exists( 'the_breadcrumbs' ) ) the_breadcrumbs(); ?>
  <h1 class="category-title">
    <php single_cat_title() ?>
  </h1-->
<main id="primary" class="site-main">
	<div class="container">
	

	<?php
    // запускаем цикл вордпресс, прверяем, есть ли посты
		while ( have_posts() ) :
    // если есть - выводим содержимое
			the_post();
    // находим шаблон для вывода поста в папке template-parts
			get_template_part( 'template-parts/content-lesson', get_post_type() );

  		endwhile; // Конец цикла Wordpress
		?>
	
  </div>
<!-- /.container -->
</main> 
<?php get_footer()?>