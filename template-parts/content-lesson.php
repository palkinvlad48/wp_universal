<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <!-- шапка поста -->
	<header class="entry-header <?php echo get_post_type(); ?>-header" style="background: linear-gradient(0deg, rgba(38,45,51, 0.75), 
    rgba(38,45,51, 0.75))">
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
				</div>
				<!-- /.post-header-nav  -->
				<?php 
					$mylink = get_field('video_link');
					$pos_youtube = strpos($mylink, 'youtube'); 
					$pos_vimeo = strpos($mylink, 'vimeo');
 				//	echo $mylink;
					if ($mylink) { 
						list($begin, $end) = explode('?v=', $mylink);
					  echo '<p>Отладка: ' . $end . '</p>'; //'i-2qrKrcXa8'; //end ($tmp);
					}
					if ($pos_youtube > -1) {
						 
					?>
					<div class="video">
					<iframe width="100%" height="450" src="https://www.youtube.com/embed/<?php echo $end; //'i-2qrKrcXa8';
						?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; 
						picture-in-picture" allowfullscreen>
					</iframe>
					<!-- "https://www.youtube.com/embed/i-2qrKrcXa8"  https://www.youtube.com/watch?v=qyvBFipJAbI&pp=wgIECgIIAQ%3D%3D&feature=push-sd&attr_tag=YE7Ywt-oisL6VCA9%3A6 -->
					<?php 
					} 
					if ($pos_vimeo > -1) {
					?>
					<div class="video" id="myVideo" data-vimeo-width="100%" data-vimeo-url="<?php echo $mylink; ?>">
					</iframe>
					<?php
					}
					?>
				</div>
				<!-- /.video -->
				<div class="lesson-header-title-wrapper"> <!--"post-title-wrapper"-->
					<?php  	
					// проверяем, точно ли мы на странице поста
					if ( is_singular() ) :
						the_title( '<h1 class="lesson-title">' , '</h1>');
					else :
						the_title( '<h2 class="lesson-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;
  				?>
					
				</div>
				<!-- /.post-title-wrapper -->
				
    	</div> 
			<!--/.post-header-wrapper -->
				
				<div class="post-header-info">
        	<span class="post-header-date">
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
  <div class="container">
  	<!-- выводим содержимое поста -->
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
		
	</div>
	<!-- /.container -->
	<!-- подвал поста -->
	<!--footer class="post-footer"-->
	
		<?php 
    	$tags_list = get_the_tag_list( '',  esc_html_x(', ', 'list item separator', 'universal-theme' ) ); 
    	if ( $tags_list ) {
      	printf( '<span class="tags-links">' . esc_html__('%1$s', 'universal_theme' ) . '</span>',
      	$tags_list ); //
    	}
			// Поделиться в соцсетях
			meks_ess_share();
    ?>
		</div>
		<!-- /.post-content -->
	</div>
	<!-- /.container -->
	<footer class="post-footer">
		
	</footer><!-- .post-footer подвал поста -->
	
</article><!-- #post -->
<!--/main-->