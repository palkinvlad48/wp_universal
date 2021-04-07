<?php
/*
Template Name: Страница Глвная Уроки
Template Post Type: page, post, lesson
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <!-- шапка поста -->
	<header class="entry-header <?php echo get_post_type(); ?>-header" style="background: linear-gradient(0deg, rgba(38,45,51, 0.75), 
    rgba(38,45,51, 0.75))">
  	<div class="container lesson-div">
			<?php
	  			// выводим ссылки на предыдущий и следующий посты
						the_post_navigation(
							array(
								'prev_text' => '<span class="lesson-nav-text" style="color:#fff;">
										<svg fill="#fff" width="15" height="7" class="icon prev-icon">
          						<use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#left_arrow"></use>
        						</svg>
									' . esc_html__( 'Back to', 'universal' ) . 
								'</span>',
								'next_text' => '<span class="lesson-nav-text" style="color:#fff;">' . esc_html__( 'Forward', 'universal' ) . 
									'<svg fill="#fff" width="15" height="7" class="icon next-icon">	
										<use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#arrow_next"></use>
      		  			</svg>
								</span>',
						)
					);
					?>
			<!--php if ( function_exists( 'the_breadcrumbs' ) ) the_breadcrumbs(); ? хлебные крошки -->
			<div class="post-header-wrapper">
				
				<div class="post-header-nav lesson">
					<?php
						$args = array(
							'post_type' => 'lesson'
						);
						//echo '<a class="lesson">' .  . '</a>'
						the_taxonomies( $args );
					?>
				</div>
				<!-- /.post-header-nav  -->
				<div class="lesson-header-title-wrapper"> <!--"post-title-wrapper"-->
					<?php  	
					// проверяем, точно ли мы на странице поста
					if ( is_singular() ) :
						the_title( '<h1 class="lesson-title">' , '</h1>');
					else :
						the_title( '<h2 class="lesson-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif
  				?>
					
				</div>
				<!-- /.post-title-wrapper -->
				
    	</div> 
			<!--/.post-header-wrapper -->
				
				<div class="post-header-info">
        	<span class="lesson-header-date">
						<svg width="14" height="14" class="icon clock-icon">
						  <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#clock">
							</use>
						</svg>
						<?php the_time('j F G:i'); ?>
					</span>
        </div>
				<!--/.post-header-info -->
		</div>
		<!--/.container -->
	</header><!-- / шапка поста -->
  <!--div class="container">
  	<!-- выводим содержимое поста -->
		<!--div class="post-content">
			<php
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
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'universal' ),
					'after'  => '</div>',
				)
			);
			?>
		
	</div>
	< /.container -->
	<!-- подвал поста -->
	<!--footer class="post-footer"-->

	</div>
	<!-- /.container -->
	<footer class="post-footer">
		
	</footer><!-- .post-footer подвал поста -->
	
</article><!-- #post -->
<!--/main-->