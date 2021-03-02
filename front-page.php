<?php get_header(); ?>
<main class="front-page-header">
  <div class="container">
  <div class="hero">
  <div class="left">
  <img src="<?php echo get_template_directory_uri() . './assets/images/image.jpg'?>" 
  alt="" class="post-thumb">
  <a href="#" class="author">
  <img src="<?php echo get_template_directory_uri() . './assets/images/avatar.png'?>" 
  alt="" class="avatar">
  <div class="author-bio">
    <span class="author-name">Имя автора</span>
    <span class="author-rank">Должность</span> 
  </div>
  </a>
  <div class="post-text">
  <a href="#" class="categoru-name">Рубрики</a>
  <h2 class="post-title">Название поста</h2>
  <a href="#" class="more">Читать далее</a>
  </div>
  <div class="right">
    <h3 class="recommend">Рекомендуем</h3>
    <ul class="posts-list">
      <li class="post">
        <span class="category-name">Категория</span>
        <h4 class="post-title">Название поста в 2 строки</h4>
      </li>
      <li class="post">
        <span class="category-name">Категория</span>
        <h4 class="post-title">Название поста в 2 строки</h4>
      </li>
      <li class="post">
        <span class="category-name">Категория</span>
        <h4 class="post-title">Название поста в 2 строки</h4>
      </li>
      <li class="post">
        <span class="category-name">Категория</span>
        <h4 class="post-title">Название поста в 2 строки</h4>
      </li>
      <li class="post">
        <span class="category-name">Категория</span>
        <h4 class="post-title">Название поста в 2 строки</h4>
      </li>
    </ul>
  </div>
  <?php
global $post;

$myposts = $posts = get_posts( [
	'numberposts' => 5,
	'category_name' => 'javascript',
  ]
);

  if ($myposts) {
    foreach( $myposts as $post ) {
      setup_postdata( $post );
      ?>
      <!-- здесь формирование вывода постов, где работают теги шаблона относящиеся к the loop, 
      например, функции цикла: the_title и т.д. Например -->
      <p><?php the_title(); ?>
      <?php
    }
  } else {
    // Постов не найдено
  }
	
wp_reset_postdata(); // сбрасываем $post
?>
  </div>