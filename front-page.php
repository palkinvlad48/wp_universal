<?php get_header(); ?>
<main class="front-page-header">
  <div class="container">
    <div class="hero">
      <div class="left">
        <?php
          global $post;

          $myposts = $posts = get_posts( [
	          'numberposts' => 1,
          //  'offset' => 1,
           // 'tag' => 'javascript, html, css, web-disign',
	          'category-name' => 'javascript, html, css, web-disign',
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
          <?php 
            foreach (get_the_category() as $category) {
              printf(
                '<a href="%s" class="category-link %s">%s</a>', 
                esc_url( get_category_link( $category )), // для безопасности
                esc_html( $category -> slug ),
                esc_html( $category -> name )
              );
            }
          ?>
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
	          'numberposts' => 5,
          //  'tag' => 'javascript, html, css, web-design', // N
          //  'category__not_in' => 14,?
            'offset' => 1,
            'category-name' => 'javascript, html, css, web-design',
            ]
          );
          // Есть ли посты
          if ($myposts) {
            foreach( $myposts as $post ) {
              setup_postdata( $post );
        ?>
        <!-- выводим записи -->
        
          <li class="post">
            <div class="category-name">
            <?php 
              foreach (get_the_category() as $category) {
                printf(
                  '<a href="%s" class="category-link %s">%s</a>', 
                  esc_url( get_category_link( $category )), // для безопасности
                  esc_html( $category -> slug ),
                  esc_html( $category -> name )
                );
              }
            ?>
            </div>
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
           // 'offset' => 23, // N
            'category-name' => 'articles, news', 
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
  
  <!-- /.article-grid -->
    <!-- Подключение сайдбара -->
  <div class="main-grid">
    <ul class="article-grid">
  <?php 
    global $post;

    $query = new WP_Query( [
      'posts_per_page' => 7,
      'tag' => 'popular', // N
      'category__not_in' => 27, // кроме id=27
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
        <span class="category-name">
        <?php 
            foreach (get_the_category() as $category) {
              printf(
                '<a href="%s" class="category-link %s">%s</a>', 
                esc_url( get_category_link( $category )), // для безопасности
                esc_html( $category -> slug ),
                esc_html( $category -> name )
              );
            }
          ?>
        <!--php 
          $category = get_the_category(); echo $category[0]->name; ?-->
        </span>
        <h4 class="article-grid-title"><?php echo get_the_title(); ?></h4>
        <div class="article-grid-excerpt"><?php the_excerpt(); ?></div>
        <div class="article-grid-info">
          <div class="author">
            <?php $autor_id = get_the_author_meta('ID'); ?>
            <img src="<?php echo get_avatar_url($autor_id); ?>" alt="Фото автора" class="author-avatar">
            <span class="author-name"><strong><?php the_author(); ?></strong>: 
              <?php echo mb_strimwidth(get_the_author_meta('description'), 0, 30, '...'); ?>
            </span>
          </div>
          <div class="comments">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/comment.svg' ?>" alt="icon comment" class="icon comments-icon">
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
          <?php $posttags = get_the_tags(); echo $posttags[0]->name . ' '; ?>
        </span>
        <span class="category-name">
          <?php $category = get_the_category(); echo $category[0]->name; ?>
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
  <?php get_sidebar('home-top'); ?>
  </div>
</div>
<!-- /container -->

<?php 
    global $post;

    $query = new WP_Query( [
      'posts_per_page' => 1,
      'category_name' => 'investigation',
    ]);

    if ( $query->have_posts() ) {
      while ( $query->have_posts() ) {
        $query->the_post();
  ?>
  
<section class="investigation" style="background: linear-gradient(0deg, rgba(64,48,61,0.35), 
  rgba(64,48,61,0.35)), url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center center ">
  <div class="container">
    <h2 class="investigation-title"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?></h2>
    <a href="<?php echo get_the_permalink() ?>" class="more">Читать статью</a>
<?php
      }
    }  else {
      // Нет постов
}
    wp_reset_postdata();
?>

</div>
</section>
<!--section class=""-->
  <div class="container">
    <div class="main-digest">
      <ul class="digest digest-wrapper">    
<?php 
    global $post;

    $myposts = $posts = get_posts( [
	          'numberposts' => 6,
          //  'offset' => 9,
            'category-name' => 'opinions, hot, compilations, articles', //'articles, opinions, hotter, compilations', //, collections',
            ]
          );
          // Есть ли посты
          if ($myposts) {
            foreach( $myposts as $post ) {
              setup_postdata( $post );
        ?>
        <!-- выводим записи -->
    <li class="post">
      <a class="" href="<?php the_permalink(); ?>">
        <div class="digest-item">
          <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="рисунок поста" class="digest-thumb">
          <div class="">
            <div class="favourites">
              <!--span class="category-name"-->
           <?php 
              foreach (get_the_category() as $category) {
                printf(
                '<span class="category-name %s">%s</span>', 
                //esc_url( get_category_link( $category )), // для безопасности
                esc_html( $category -> slug ),
                esc_html( $category -> name )
              );
            }
          ?>
              <!--span class="category-name" style="margin:0;color:<php echo $color_tag; ?>">
                <php $posttags = get_the_tags(); 
                  $color_tag = '#4592FF';
                  if ($posttags) {
                    if ( $posttags[0]->name === 'hot' ) {
                      $color_tag = 'red';
                    } 
                    if ( $posttags[0]->name === 'compilations' ) {
                      $color_tag = '#AC8EE3';
                    }
                  }
                ?>
                <php $category = get_the_category(); echo $category[0]->name; ?-->
              <!--/span-->
              <img src="<?php echo get_template_directory_uri() . '/assets/images/bookmark.svg' ?>" alt="icon comment" class="icon bookmark-icon">
            </div>
            <h2 class="digest-title"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?></h2>
      
            <div class="article-grid-excerpt"><?php echo mb_strimwidth(get_the_excerpt(), 0, 76, '...'); ?></div>  
            <div class="comments">
              <span class="date"><?php the_time( 'j F' )?></span>
              <img src="<?php echo get_template_directory_uri() . '/assets/images/comment.svg' ?>" alt="icon comment" class="icon comments-icon">
              <span class="comments-counter"><?php comments_number('0', '1', '%'  )?></span>
              <!-- likes -->
              <img class="icon-heart" src="<?php echo get_template_directory_uri() . '/assets/images/heart_gray.svg' ?>" alt="icon likes" class="icon likes-icon">
              <span class="comments-counter"><?php comments_number('0', '1', '%'  )?></span>
            </div>
          </div>
        </div>
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
  <!-- подключаем нижний сайдбар -->
  <?php echo get_sidebar('home-bottom'); ?>
</div>
<!--/section-->
<!-- /.investigation -->
<div class="container">
  <!--div class="sidebar-front-page"-->
  
  
 
  
  <!--/div-->
</div>
<!-- /.container-->