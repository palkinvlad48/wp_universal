<?php get_header(); ?>
    <!-- Подключение  -->
<main class="widget-main">  
  <div class="container">
    <h3 class="main-title">JavaScript</h3>
    <div class="main-java">
      <ul class="java-grid">
      <?php 
        global $post;

      $query = new WP_Query( [
        'posts_per_page' => 4,
    //  'tag' => 'popular', // N
        'category_name'      => 'javascript, news',
        'category__not_in' => 23, // кроме id=
      ]);

      if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
          $query->the_post();
      ?>
      <li class="java-grid-item">
        <img class="java-grid-thumb" src="
          <?php 
              if ( has_post_thumbnail() ) { 
                echo get_the_post_thumbnail_url( null, 'thumb'); 
              } 
              else {
                echo get_template_directory_url() . 'assets/images/img-default.png';
              } 
          ?>" alt="Рисунок поста">
        <div class="java-grid-info">
          <h4 class="java-grid-title"><?php echo get_the_title(); ?></h4>
          <div class="java-grid-excerpt"><?php the_excerpt(); ?></div>
        <!--/div-->
        <!--div class="java-grid-info"-->
          <div class="author">
            <?php $autor_id = get_the_author_meta('ID'); ?>
            <img src="<?php echo get_avatar_url($autor_id); ?>" alt="Фото автора" class="author-avatar">
            
            <div class="comments">
              <div class="author-name"><?php the_author(); ?></div>
              <div class="comments-wrap">
                <span class="date"><?php the_time( 'j F' )?></span>
                <svg width="15" height="14" class="icon comments-icon">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#comment">
                  </use>
                </svg>
                <span class="comments-counter"><?php comments_number('0', '1', '%'  ) ?></span>&nbsp;
                <svg fill="#BCBFC2" width="15" height="15" class="icon likes-icon">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#heart">
                  </use>
                </svg>
            <!--span class="icon likes"></span-->
                <span class="comments-counter"><?php comments_number('0', '1', '%'  )?></span>
              </div>
            </div>
          </div>
        </div>
        <!--/div-->
      </li>
  
      <?php 
        }
      } else {
      // Нет постов
      }
      wp_reset_postdata();
      ?>    
    </ul>
    <?php 
      if ( !is_active_sidebar( 'sidebar-javascript' )) {
        return;
      }
    ?>
    <!--div class=""-->
      <?php dynamic_sidebar( 'sidebar-javascript' ); ?>
    </div>
  <!--php get_sidebar('sidebar-top'); ?>  -sidebar-javascript'); -->
  </div>
  
</main>
<!-- /container -->

<!-- /.special -->
<?php get_footer(); ?>