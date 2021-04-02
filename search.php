<?php
get_header(); ?>
<div class="container">
  <?php if ( function_exists( 'the_breadcrumbs' ) ) the_breadcrumbs(); ?>
  <h1 class="search-title">Результаты поиска по запросу</h1>
  <div class="search-favourites"> 
    <!--div class="main-digest"-->
      <ul class="search-digest search-digest-wrapper">
      <?php global $post;

			  $postlist = get_posts();

  			if ($postlist ) {
	  			foreach ( $postlist as $post) {
		  			setup_postdata($post);
			
      /*  global $post;
        $query = new WP_Query( [
          'posts_per_page' => 6,
          'category_name' => 'javascript, css, web-disign',
        ]);

        if ( $query->have_posts() ) {
          while ( $query->have_posts() ) {
            $query->the_post();*/
      ?>
        <!-- выводим записи -->
        <li class="search-digest-item">
          <a class="search-digest-item-permalink" href="<?php echo get_the_permalink(); ?>">
            <img src="
            <?php 
              if ( has_post_thumbnail() ) { 
                echo get_the_post_thumbnail_url(); 
              } 
              else {
                echo get_template_directory_url() . '/assets/images/default.png';
              }
            ?>" class="search-digest-thumb" alt="">
          </a>
          <div class="search-digest-info">
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
            <h2 class="search-digest-title"><?php echo mb_strimwidth(get_the_title(), 0, 40, '...'); ?></h2>
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
          <!-- /.digest-info -->
        </li>
      <?php
        }
      } else {}
      wp_reset_postdata(); // сбрасываем $post
    ?>
      </ul>
    
    <!-- подключаем нижний сайдбар -->
    <?php echo get_sidebar('home-bottom'); ?>
    </div>
    <?php 
      /* варианты
      $args = array(
        'prev_text' => '
          <svg fill="#e5e5e5" width="15" height="7" class="icon icon-arrow">
            <use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#left_arrow">
            </use>
          </svg>Назад
        ',
        'next_text' => '
          <svg fill="#000" width="20" height="20" class="icon icon-arrow">
            <use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#arrow">
            </use>
          </svg>Далее
        ',
         
        'prev_text' => __('<< Назад'),
        'next_text' => __('Далее >>'),
      );*/
      the_posts_pagination(); 
    ?>
  </div>
  <!-- /.favourites -->
</div>
<!-- /.container-->
<?php get_footer(); ?>