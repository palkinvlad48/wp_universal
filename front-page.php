<?php get_header(); ?>
<main class="front-page-header">
  <div class="container">
    <div class="hero">
      <div class="left">
        <?php
          global $post;

          $myposts = $posts = get_posts( [
	          'numberposts' => 1,
            'offset' => 2,
	          'category_name' => 'javascript',
            ]
          );
          // Есть ли посты
          if ($myposts) {
            foreach( $myposts as $post ) {
              setup_postdata( $post );
        ?>
        <!-- выводим записи -->
      
        <img src="<?php the_post_thumbnail_url(); ?>" class="post-thumb" alt="Фоновый рисунок">
        <?php $autor_id = get_the_author_meta('ID'); ?>
        <a href="<?php echo get_author_posts_url($autor_id); ?>" class="author">
          <img src="<?php echo get_avatar_url($autor_id); ?>" class="avatar" alt="Фото автора">
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
            'offset' => 12,
            'category-name' => 'javascript, html, css, web-disign',
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
                  if (strlen($post->post_title) > 94)
                    // mb_strimwidth($post->title, 0, 64, ' ...');
                    echo substr($post->post_title, 0, 94) . ' ...';
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
  <!-- Выводим записи -->
    <?php
          global $post;

          $myposts = $posts = get_posts( [
	          'numberposts' => 4,
            //'offset' => 1,
            'category_name' => 'html, css, javascript, web-design',
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
            <img width="65" height="65" src="<?php echo get_the_post_thumbnail_url( null, 'thumbnail'); ?>" alt="Миниатюра">
          </li>
          <?php
          }
        } else {
    // Постов не найдено
        }
        wp_reset_postdata(); // сбрасываем $post
      ?>
        </ul>
  <!-- ./article-list -->
  <ul class="article-grid">
  <?php 
    global $post;

    $query = new WP_Query( [
      'post_per_page' => 7,
    ]);

    if ( $query->have_posts() ) {
      // создаем счетчик постов
      $cnt = 0;
      while ( $query->have_posts() ) {
        $query->the_post();
        $cnt++;
        switch ($cnt) {
          case '1':
      // выводим 1-й пост
  ?>
    <li class="article-grid-item article-grid-item-1">
      <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
        <img class="article-grid-thumb" src="<?php echo get_the_post_thumbnail_url();?>"  alt="Рисунок поста">
        <span class="category-name"><?php 
          $category = get_the_category(); echo $category[0]->name; ?>
        </span>
        <h4 class="article-grid-title"><?php echo get_the_title(); ?></h4>
        <div class="article-grid-excerpt"><?php the_excerpt(); ?></div>
        <div class="article-grid-info">
          <div class="author">
            <?php $autor_id = get_the_author_meta('ID'); ?>
            <img src="<?php echo get_avatar_url($autor_id); ?>" alt="Фото автора" class="author-avatar">
            <span class="author-name"><strong><?php the_author(); ?></strong>: 
              <?php echo mb_strimwidth(the_author_meta('user_description'), 0, 20, '...'); ?>
            </span>
          </div>
          <div class="comments">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/comment.png' ?>" alt="icon comment" class="icon comments-icon">
            <span class="comments-counter"><?php comments_number('0', '1', '%'  )?></span>
          </div>
        </div>
      </a>
    </li>
  <?php
      break;
      case '2':
      // выводим 2-й пост
  ?>
    <li class="article-grid-item article-grid-item-2">
      <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="Фоновый рисунок" class="article-grid-thumb">
      <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
        <span class="tag">
        <?php $posttags = get_the_tags(); 
          if ($posttags) {
            echo $posttags[0]->name . ' ';
          }
        ?>
        </span>
        <span class="category-name"><?php $category = get_the_category(); echo $category[0]->name; ?>
        </span>
        <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?></h4>
        <div class="article-grid-info">
          <div class="author">
            <?php $autor_id = get_the_author_meta('ID'); ?>
            <img src="<?php echo get_avatar_url($autor_id); ?>" alt="Фото автора" class="author-avatar">
            <span class="author-name"><?php the_author(); ?></span>
            
          </div>
          <div class="comments">
            <span class="date"><?php the_time( 'j F' )?></span>
            <img src="<?php echo get_template_directory_uri() . '/assets/images/comment.svg' ?>" alt="icon comment" class="icon comments-icon">
            <!--span class="icon comment"></span-->
            <span class="comments-counter"><?php comments_number('0', '1', '%'  )?></span>
            <img src="<?php echo get_template_directory_uri() . '/assets/images/heart.svg' ?>" alt="icon likes" class="icon likes-icon">
            <!--span class="icon likes"></span-->
            <span class="comments-counter"><?php comments_number('0', '1', '%'  )?></span>
          </div>
        </div>
      </a>
    </li>
<?php
      break;
      case '3':
      // выводим 3-й пост
?>
    <li class="article-grid-item article-grid-item-3">
      <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
      <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="Рисунок поста" class="article-grid-thumb">
      <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?></h4>
    </a>
  </li>
<?php 
    break;
    default:
        // выводим остальные посты
?>
  <li class="article-grid-item article-grid-item-default">
    <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
      <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?></h4>
      <p class="article-grid-excerpt"><?php echo mb_strimwidth(get_the_excerpt(), 0, 76, '...'); ?></p>
      <span class="article-date"><?php the_time( 'j F' )?></span> 
      <!-- если the_date, то дата выводится только в 1-м посте  -->
    </a>
  </li>
<?php 
      break;
    }    
  }
} else {
      // Нет постов
}
    wp_reset_postdata();
?>    
</ul>
<!-- /.article-grid -->