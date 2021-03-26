<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <!-- шапка поста -->
	<header class="entry-header <?php echo get_post_type(); ?>-header" style="background: linear-gradient(0deg, rgba(38,45,51, 0.75), 
    rgba(38,45,51, 0.75)), url(
  		<?php 
  	  if ( has_post_thumbnail() ) {
  	    echo get_the_post_thumbnail_url();
  	  }
  	  else {
  	    echo get_template_directory_uri() . '/assets/images/default.png';
  	  }
  		?>
    ); background-repeat: no-repeat; background-size: cover; background-position: center;">
  <div class="container">
		<div class="post-header-wrapper">
			<div class="post-header-nav">
				<?php
					foreach (get_the_category() as $category) {
						printf(
							'<a href="%s" class="category-link %s">%s</a>',
							esc_url( get_category_link( $category )),
							esc_html( $category -> slug ),
							esc_html( $category -> name ),
						);
					}
			?>
			<!-- Ссылка на главную -->
				<a class="home-link" href="<?php echo get_home_url(); ?>">
					<svg width="18" height="17" class="icon home-icon">
        		<use xlink:href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#home"></use>
      		</svg>На главную
				</a>
				<?php
	  		// выводим ссылки на предыдущий и следующий посты
					the_post_navigation(
						array(
							'prev_text' => '<span class="post-nav">
								<svg width="15" height="7" class="icon prev-icon">
          				<use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#left_arrow"></use>
        				</svg>
							' . esc_html__( 'Назад:', 'universal-theme' ) . 
							'</span>',
							'next_text' => '<span class="post-nav-next">' . esc_html__( 'Вперед:', 'universal-theme' ) . 
							'<svg width="15" height="7" class="icon next-icon">	
								<use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#arrow_next"></use>
      		  	</svg>
						</span>',
						)
					);
				?>
			</div>
			<!-- /.post-header-nav  -->
			<div class="post-header-title-wrapper"> <!--"post-title-wrapper"-->
				<?php  	
					// проверяем, точно ли мы на странице поста
					if ( is_singular() ) :
						the_title( '<h1 class="post-title">' , '</h1>');
					else :
						the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;
  			?>
				<button class="bookmark-post">
      	  <svg fill="#BCBFC2" width="14" height="18" class="icon bookmark-icon">
      	    <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#bookmark">
      	    </use>
      	  </svg>
      	</button>
				
			</div>
			<!-- /.post-title-wrapper -->
			<div class="post-excerpt">
					<?php echo mb_strimwidth(get_the_excerpt(), 0, 200, '...'); ?>
				</div>	
			<div class="post-header-info">
        <span class="post-header-date">
					<svg width="14" height="14" class="icon clock-icon">
					  <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#clock">
						</use>
					</svg>
					<?php the_time('j F G:i'); ?>
				</span>
        <div class="comments post-header-comments">
          <svg width="19" height="15" class="icon comments-icon">
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
          </svg>
          <span class="header-comments-counter"><?php comments_number( '0', '1', '%' )?></span>
        </div>
				<div class="likes post-header-likes">
          <svg width="15" height="15" class="icon heart-icon">
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#heart"></use>
          </svg>
          <span class="header-likes-counter"><?php comments_number( '0', '1', '%' )?></span>
        </div>
			</div>
			<!--/.post-header-info -->
			<div class="post-author">
				<div class="post-author-info">
					<?php $author_id = get_the_author_meta('ID'); ?>
          <img src="<?php echo get_avatar_url($author_id); ?>" class="avatar" alt="Фото автора">
          <span class="post-author-name"><?php the_author(); ?></span>
          <span class="post-author-rank">Должность</span> 
					<span class="post-author-posts">
						<?php plural_form(
							count_user_posts($author_id),
							/* варианты написания для кол-ва 1, 2, 5 */
							array('статья','статьи','статей'),
							)
						?>
					</span>
				</div>
				<!--/.post-author-info -->
				<a href="<?php echo get_author_posts_url($author_id) ?>" class="post-author-link">
					Страница автора
				</a>
			</div>
			<!--/.post-author -->
    </div> 
		<!--/.post-header-wrapper -->
		</div>
		<!--/.container -->
	</header><!-- / шапка поста -->
  <div class="container">

  <!-- выводим содержимое поста -->
	<div class="post-wrap">
		<div class="post-content">
			<?php
				the_content(
					sprintf(
						wp_kses(
						/* translators: %s: Название текущего поста. Видно только для программ чтения с экрана */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'universal-theme' ),
							array(
								'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Страницы:', 'universal-example' ),
					'after'  => '</div>',
				)
			);
			?>
			
		</div><!-- .post-content -->
		<div class="post-sidebar">
		<?php 
      if ( !is_active_sidebar( 'sidebar-some_category' )) {
        return;
      }
    ?>
    <!-- новый сайдбар -->
      <?php dynamic_sidebar( 'sidebar-some_category' ); ?>
    </div>
		<!-- /.post-sidebar -->
		</div>
		<!-- /.post-wrap -->
	</div>
	<!-- /.container -->
	<!-- подвал поста -->
	<footer class="entry-footer">
		<?php 
    $tags_list = get_the_tag_list( '',  esc_html_x(', ', 'list item separator', 'universal-theme' ) ); 
    if ( $tags_list ) {
      printf( '<span class="tags-links">' . esc_html__('%1$s', 'universal_theme' ) . '</span>',
      $tags_list ); //
    }
		// Поделиться в соцсетях
		meks_ess_share();
    ?>
	</footer><!-- .post-footer подвал поста -->
</article><!-- #post-<php the_ID(); -->