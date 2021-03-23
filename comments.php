<?php
/**
 * Шаблон для отображения комментариев
 *
 * Это шаблон, который отображает область страницы, содержащую оба текущих комментария.
 * и форма комментария.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package universal-example
 */

/*
 * Если текущий пост защищен паролем и посетитель еще не ввел пароль, 
 * то выходим, не загружая комментарии
 */
// Создаем свою функцию вывода каждого комментария

function universal_theme_comment( $comment, $args, $depth ) {
	// проверяем, в каком стиле родитель
	if ( 'div' === $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
	// Какие классы вешаем на каждый комментарий
	$classes = ' ' . comment_class( empty( $args['has_children'] ) ? '' : 'parent', null, null, false );
?>
<<?php echo $tag, $classes; ?> id="comment-<?php comment_ID() ?>">

<?php if ( 'div' != $args['style'] ) { ?>
	<div class="comment-body" id="div-comment-<?php comment_ID() ?>"><?php 
} ?>
		<div class="comment-author-avatar">

			<?php
				if ( $args['avatar_size'] != 0 ) {
					echo get_avatar( $comment, $args['avatar_size'] );
				}
			?>
		</div>
		<!-- /.-author-avatar -->
		<div class="comment-content">
			<div class="comment-author vcard">
			<?php
				printf(
					__( '<cite class="comment-author-name">%s</cite>' ),
					get_comment_author_link()
				);
			?>
				<span class="comment-meta commentmetadata">
					<a href="<?php echo htmlspecialchars( get_comment_link( [ 'post_id'=> $post->ID ] ) ); ?>">
				<?php
					printf(
						__( '%1$s, %2$s' ),
						get_comment_date('F jS'),
						get_comment_time()	
					); 
				?>
					</a>

		<?php edit_comment_link( __( '(Edit)' ), ' ', '' ); ?>

		<?php comment_text(); ?>
					<div class="comment-reply">
					<svg fill="#BCBFC2" width="14" height="14" class="icon comment-icon">
          	<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#comment">
          	</use>
					</svg>
					
					<?php 
						comment_reply_link( array_merge(
							array_merge(
								$args,
								array(
									'add_below' => $add_below,
									'depth'			=> $depth,
									'max_depth' => $args['max_depth']
								)
							)
						)); 
					?>
		
				</span>
			</div>
			<!-- /.comment-content -->
			<?php if ( $comment->comment_approved == '0' ) { ?>
			<em class="comment-awaiting-moderation">
				<?php _e( 'Your comment is awaiting moderation.' ); ?>
			</em><br>
			<?php } ?>

			<?php if ( 'div' != $args['style'] ) { ?>
		</div>
		<?php }
			}

			if ( post_password_required() ) {
				return;
			}
		?>

<div class="container">
	<div id="comments" class="comments-area">
		
		<?php
		// Есть ли комментарии
		if ( have_comments() ) :
		?>
		<div class="comments-header">
			<h2 class="comments-title">
			<?php echo 'Комментарии ' . 
			'<span class="comments-count">' . get_comments_number() . '</span>' 
			?>
			</h2>
			<a href="#commentform" class="comments-add-button">
				<svg width="18" height="18" class="icon comments-add-icon">
          <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#pencil">
          </use>
				</svg>Добавить комментарий
			</a>
		</div>
		<!-- /.comments-header -->
		<?php the_comments_navigation(); ?> <!-- м.б. несколько страниц комментов -->

		<!-- Выводим список комментариев -->
		<ol class="comments-list">
			<?php
			// Выводим каждый отдельный комментарий
			wp_list_comments(
				array(
					'style'      	=> 'ol',
					'short_ping' 	=> true,
					'avatar_size' => 75,
					'callback'    => 'universal_theme_comment',
					'login text'  => 'Зарегистрируйтесь, если хотите прокомментировать',
				)
			);
			?>
		</ol><!-- .comment-list -->
		<button class="comment-button-load">
			<!--svg fill="#BCBFC2" width="15" height="15" class="icon load-icon">
        <use xlink:href="<php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#loading">
        </use>
			</svg-->Загрузить еще
		</button>
		<?php
			the_comments_navigation();

		// Если комментарии закрыты и есть комментарии, оставим небольшую заметку?
		if ( ! comments_open() ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'universal-example' ); ?></p>
		<?php
		endif;

	endif; // Check for have_comments().

		comment_form(array (
			'comment_field' => '<div class="comment-form-comment">' . 
				'<label class="comment-label" for="comment">' . _x( 'Что вы думаете на этот счет?', 'noun' ) . 
				'</label></div><div class="comment-wrapper">' . get_avatar( get_current_user_id(), 75) .
				'<div class="comment-textarea-wrapper">' . 
				'<textarea class="comment-textarea" id="comment" name="comment" aria-required="true">' . 
				'</textarea></div></div>',
			'must_log_in'  	=> '',
			//'<p class="must-log-in">' . 
		 	//	sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), 
			//	 wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '
		 	//	</p>', 
			'logged_in_as' 	=> '',
			'comment_notes_before' => '',
			//'<p class="comment-notes"><span id="email-notes">' .
			// __( 'Your email address will not be published.' ) . '</span>' . ( $req ? $required_text : '' ) . 
			//	'</p>',
			'label_submit'  => 'Отправить',
			'class_submit'  => 'comment-submit more',
			'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>', 
			'title_reply'  	=> '',
		));
	?>

	</div><!-- #comments -->