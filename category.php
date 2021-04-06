<?php get_header() ?>
<div class="container">
<?php if ( function_exists( 'the_breadcrumbs' ) ) the_breadcrumbs(); ?>
  <h1 class="category-title">
    <?php single_cat_title() ?>
  </h1>
  <!--php  // пример вывода всех тегов рубрики
$post_ids = get_objects_in_term( get_query_var( 'cat' ), 'category' );
if ( ! empty( $post_ids ) && ! is_wp_error( $post_ids ) ) {
	$tags = wp_get_object_terms( $post_ids, 'post_tag' );
	if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
?>
    <ul>
    <php foreach( $tags as $tag ) { ?>
      <li><a href="<php echo get_term_link( $tag, 'post_tag' ); ?>"><php echo $tag->name; ?></a></li>
    <php } ?>
    </ul>
	<php } ?>
<php } ?--> <!-- конец примера -->
  <div class="post-list">
    <!--div class="post-wrap"-->
    <!-- выводим посты -->
    <?php while ( have_posts() ) { the_post(); ?>
    
      <div class="post-card">
      <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
        <img src="
        <?php 
          if ( has_post_thumbnail() ) { 
            echo get_the_post_thumbnail_url( null, 'thumb'); 
          } 
          else {
              echo get_template_directory_uri() . '/assets/images/undefined.png';
            } 
        ?>" alt="Фоновый рисунок" class="post-card-thumb">
        <div class="post-card-text">
          <div class="post-card-title"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?></div>
          <p><?php echo mb_strimwidth(get_the_excerpt(), 0, 72, '...'); ?></p>
          <div class="author">
            <?php $autor_id = get_the_author_meta('ID'); ?>
            <img src="<?php echo get_avatar_url($autor_id); ?>" alt="Фото автора" class="author-avatar">
            <div class="author-info">
              <span class="author-name"><strong><?php the_author(); ?></strong></span>
              <span class="date"><?php echo mb_strimwidth(get_the_time( 'j F' ), 0, 6, ''); ?></span>
              <div class="comments">
                <svg fill="#BCBFC2" width="15" height="14" class="icon comments">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#comment">
                  </use>
                </svg>
                <span class="comments-counter"><?php comments_number('0', '1', '%'  )?></span>
                <svg fill="#BCBFC2" width="15" height="15" class="icon likes">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#heart">
                  </use>
                </svg>
                <span class="comments-counter"><?php comments_number('0', '1', '%'  )?></span>
              </div>
              <!-- comments -->
            </div>
            <!-- /.author-info -->  
          </div>
          <!-- /.author -->
        </div>
        <!-- /.post-card-text -->
        </a>
      </div>
      <!-- /.card -->
      <?php } ?>
      <?php if ( ! have_posts() ) { ?>
      Записей нет!
      <?php } ?>
  </div>
  <!-- /.post-list -->
  <?php 
    the_posts_pagination(); 
  ?>
</div>
<!-- /.container --> 
<?php get_footer()?>