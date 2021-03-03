<?php get_header(); ?>
<main class="front-page-header">
  <div class="container">
    <div class="hero">
      <div class="left">
        <?php
          global $post;

          $myposts = $posts = get_posts( [
	          'numberposts' => 1,
	         // 'category_name' => 'javascript',
            ]
          );
          // Есть ли посты
          if ($myposts) {
            foreach( $myposts as $post ) {
              setup_postdata( $post );
        ?>
        <!-- выводим записи -->
      
        <img src="<?php the_post_thumbnail_url(); ?> class="post-thumb" alt="">
        <?php $autor_id = get_the_author_meta('ID'); ?>
        <a href="<?php echo get_author_posts_url($autor_id); ?>" class="author">
          <img src="<?php echo get_avatar_url($autor_id); ?>" class="avatar"alt="">
          <div class="author-bio">
            <span class="author-name"><?php the_author(); ?></span>
            <span class="author-rank">Должность</span> 
          </div>
        </a>
        <!-- Например выводим заголовки постов -->
        <!--p><!-php the_title(); ?></p-->
        <div class="post-text">
          <?php the_category(); ?>
          <h2 class="post-title"><?php the_title(); ?></h2>
          <a href="<?php echo get_permalink(); ?>" class="more">Читать далее</a>
          
        </div>
        <?php
            }
          } else {
    // Постов не найдено
          }
          wp_reset_postdata(); // сбрасываем $post
        ?>
      </div>
      <div class="right">
        <h3 class="recommend">Рекомендуем</h3>
        <ul class="posts-list">
        <?php
          global $post;

          $myposts = $posts = get_posts( [
	          'numberposts' => 5,
            'offset' => 1,
            ]
          );
          // Есть ли посты
          if ($myposts) {
            foreach( $myposts as $post ) {
              setup_postdata( $post );
        ?>
        <!-- выводим записи -->
        
          <li class="post">
            <span class="category-name"><?php the_category(); ?></span>
            <a class="post-permalink" href="<?php echo get_the_permalink(); ?>
             <h4 class="post-title"><?php the_title(); ?></h4>
            </a>
          </li>
          <?php
          }
        } else {
    // Постов не найдено
        }
        wp_reset_postdata(); // сбрасываем $post
      ?>
        </ul>
      </div>
  
    </div>
  </div>
</main>