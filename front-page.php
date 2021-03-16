<?php get_header(); ?>
<main class="front-page-header">
  <div class="container">
    <div class="hero">
      <div class="left">
        <?php
          global $post;

          $myposts = $posts = get_posts( [
	          'numberposts' => 1,
            'offset' => 26,
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
          
        $query = new WP_Query( [
      	  'posts_per_page' => 5,
          'tag' => 'javascript, html, css, web-design',
        // 'paged'          => get_query_var( 'page' ),
        ] );

  // Обрабатываем полученные в запросе продукты, если они есть
        if ( $query->have_posts() ) {

	        while ( $query->have_posts() ) {
		        $query->the_post();
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
          
      $query = new WP_Query( [
      	'posts_per_page' => 4,
        'tag' => 'articles, news',
      // 'paged'          => get_query_var( 'page' ),
      ] );

  // Обрабатываем полученные в запросе продукты, если они есть
  if ( $query->have_posts() ) {

	  while ( $query->have_posts() ) {
		  $query->the_post();
      ?>
    
        <!-- выводим записи -->      
          <li class="article-item">
            <a class="article-permalink" href="<?php echo get_the_permalink(); ?>">
             <h4 class="article-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...'); ?></h4>
            </a>
            <img width="65" height="65" src="<?php 
              if ( has_post_thumbnail() ) { 
                echo get_the_post_thumbnail_url( null, 'thumb'); 
              } 
              else {
                echo get_template_directory_url() . 'assets/images/img-default.png';
              } 
            ?>" alt="">
            <!-- ja -->
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
        <img class="article-grid-thumb" src="
          <?php 
              if ( has_post_thumbnail() ) { 
                echo get_the_post_thumbnail_url( null, 'thumb'); 
              } 
              else {
                echo get_template_directory_url() . 'assets/images/img-default.png';
              } 
          ?>" alt="Рисунок поста">
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
            <svg width="15" height="14" class="icon comments-icon">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#comment">
              </use>
            </svg>
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
      <img src="
      <?php 
        if ( has_post_thumbnail() ) { 
          echo get_the_post_thumbnail_url( null, 'thumb'); 
        } 
        else {
          echo get_template_directory_url() . 'assets/images/img-default.png';
        } 
      ?>" alt="Фоновый рисунок" class="article-grid-thumb">
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
            <svg width="15" height="14" class="icon comments-icon">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#comment">
              </use>
            </svg>
            <span class="comments-counter"><?php comments_number('0', '1', '%'  )?></span>
            <svg fill="#BCBFC2" class="icon likes-icon">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#heart">
              </use>
            </svg>
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
      <img src="
      <?php 
        if ( has_post_thumbnail() ) { 
          echo get_the_post_thumbnail_url( null, 'thumb'); 
        } 
        else {
          echo get_template_directory_url() . 'assets/images/img-default.png';
        } 
      ?>" alt="Рисунок поста" class="article-grid-thumb">
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
      'category_name' => 'investigations',
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
<div>
<div class="container">
<div class="favourites"
  <div class="main-digest">
      <ul class="digest digest-wrapper">    
  <?php 
    global $post;
    $query = new WP_Query( [
      'posts_per_page' => 6,
      'category_name' => 'opinions, hot, compilations',
    ]);

    if ( $query->have_posts() ) {
      while ( $query->have_posts() ) {
        $query->the_post();
  ?>
         
    <!-- выводим записи -->
        <li class="digest-item">
          <a class="digest-item-permalink" href="<?php echo get_the_permalink(); ?>"></a>
          <img src="
        <?php 
          if ( has_post_thumbnail() ) { 
            echo get_the_post_thumbnail_url(); 
          } 
          else {
            echo get_template_directory_url() . 'assets/images/img-default.png';
          }
        ?>" class="digest-thumb" alt="">
          
          <div class="digest-info">
            <button class="bookmark">
              <svg fill="#BCBFC2" width="14" height="18" class="icon bookmark-icon">
                <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#bookmark">
                </use>
              </svg>
            </button>
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
          <h2 class="digest-title"><?php echo mb_strimwidth(get_the_title(), 0, 40, '...'); ?></h2>
      
          <div class="article-grid-excerpt"><?php echo mb_strimwidth(get_the_excerpt(), 0, 190, '...'); ?></div>  
          <div class="comments">
            <span class="date"><?php the_time( 'j F' )?></span>
            <svg width="15" height="14" class="icon comments-icon">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#comment">
              </use>
            </svg>
            <span class="comments-counter"><?php comments_number('0', '1', '%'  )?></span>
            <!-- likes -->
            <svg width="15" height="15" fill="#BCBFC2" class="icon likes-icon">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#heart">
              </use>
            </svg>
            
            <span class="comments-counter"><?php comments_number('0', '1', '%'  )?></span>
          </div>
        </div>
        
        <!--/a-->
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
</div>
<!-- /.favourites -->
</div>
<!-- /.container-->
<div class="special">
  <div class="container special-grid">
    <div class="photo-report">
  <?php 
    global $post;
    $query = new WP_Query( [
      'posts_per_page' => 1,
      'category_name' => 'photo-report',
    ]);

    if ( $query->have_posts() ) {
      while ( $query->have_posts() ) {
        $query->the_post();
  ?>
      
      <!-- Slider main container -->
        <div class="swiper-container photo-report-slider">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <!-- Slides -->
        <?php $images = get_attached_media( 'image' );  // image надо брать не из библиотеки, а извне //
          foreach ($images as $image) {
            echo '<div class="swiper-slide"><img src="';
            print_r($image -> guid); 
            echo '"></div>';
          }
        ?>      
          </div>
          <div class="swiper-pagination"></div>
        </div>    
      
        <div class="photo-report-content">
      <?php 
        foreach (get_the_category() as $category) {
          printf(
          '<a href="%s" class="category-link">%s</a>', 
          esc_url( get_category_link( $category )), // для безопасности
        //  esc_html( $category -> slug ),
          esc_html( $category -> name )
        );
      }
   ?>
            <!--img src="<php the_post_thumbnail_url(); ?>" alt="Фото автора" class="post-thumb"-->
          <?php $author_id = get_the_author_meta('ID'); ?>
          <a href="<?php echo get_author_posts_url($autor_id); ?>" class="author">
            <img src="<?php echo get_avatar_url($autor_id); ?>" class="avatar" alt="Фото автора">
            <div class="author-bio">
              <span class="author-name"><?php the_author(); ?></span>
              <span class="author-rank">Фотограф</span> 
            </div>
          </a>
          <h3 class="photo-report-title"><?php the_title(); ?></h3>
          <a href="<?php echo get_the_permalink(); ?>" class="button photo-report-button">
            <svg width="19" height="15" class="icon photo-report-icon">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#images">
              </use>
            </svg>
            Смотреть фото
            <span class="photo-report-counter"><?php echo count($images); ?></span>
          </a>
        </div>
        <!-- /.photo-report-content -->
        <?php
          }
        } else {
    // Постов не найдено
      }
      wp_reset_postdata(); // сбрасываем $post
    ?>

      </div>
      <!-- /.photo-report -->
      <div class="other">
        <div class="career-post">
          <a href="#" class="career-post-link">Карьера</a>
          <h3 class="career-post-title">Вопросы на собеседовании для джуна</h3>
          <p class="career-post-excerpt">
            Каверзные и не очень вопросы, которых боятся новички, когда идут на собеседование
          </p>
          <a href="#" class="more">Читать далее</a>
        </div>
        <!-- /.career-post -->
        <div class="other-posts">
          <a href="#" class="other-post other-post-default">
            <h4 class="other-post-title">Самые крутые функции в...</h4>
            <p class="other-post-excerpt">Эти несколько упражнений помогут сохранить зрение. Можно делать их даже если...</p>
            <span class="other-post-date">3 декабря 2020</span>
          </a>
          <a href="#" class="other-post other-post-default">
            <h4 class="other-post-title">Новые возможности язык...</h4>
            <p class="other-post-excerpt">Какие плагины помогут быстро создать галерею, выпадающие списки или окна</p>
            <span class="other-post-date">3 декабря 2020</span>
          </a>
        </div>
        <!-- /.other-posts -->
      </div>
      <!-- /.other -->
    </div>
    <!-- /.special-grid -->
  </div>
  <!-- /.container -->
</div>
<!-- /.special -->
<?php wp_footer(); ?>