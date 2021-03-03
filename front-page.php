<?php get_header(); ?>
<main class="front-page-header">
  <div class="container">
    <div class="hero">
      <div class="left">
        <?php
          global $post;

          $myposts = $posts = get_posts( [
	          'numberposts' => 1,
	          'category_name' => 'javascript, html, css, web-disign',
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
          <h2 class="post-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...'); ?></h2>
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
	          'numberposts' => 4,
            'offset' => 4,
            'category-name' => 'javascript, html, css, web-disign',
           // 'offset' => 5,
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
              <h4 class="post-title">
                <?php 
                  if (strlen($post->post_title) > 90)
                    // mb_strimwidth($post->title, 0, 64, ' ...');
                    echo substr($post->post_title, 0, 90) . ' ...';
                  else
                    echo $post->post_title; 
                ?>
              </h4>
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
<div class="container">
  <ul class="article-list">
        <?php
          global $post;

          $myposts = $posts = get_posts( [
	          'numberposts' => 4,
            //'offset' => 1,
            'category_name' => 'articles',
            ]
          );
          // Есть ли посты
          if ($myposts) {
            foreach( $myposts as $post ) {
              setup_postdata( $post );
        ?>
        <!-- выводим записи -->
        
          <li class="article-item">
            <a class="article-permalink" href="<?php echo get_the_permalink(); ?>">
             <h4 class="article-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...'); ?></h4>
            </a>
            <img width="65" height="65" src="<?php echo get_the_post_thumbnail_url( null, 'thumbnail'); ?>" alt="">
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