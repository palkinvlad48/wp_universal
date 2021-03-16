<footer class="footer">
  <div class="container">
    <?php 
      if ( !is_active_sidebar( 'sidebar-footer' )) {
        return;
      }
    ?>
    <div class="footer-menu-bar">
      <?php dynamic_sidebar( 'sidebar-footer' ); ?>
    </div>
    <!-- /footer-menu-bar -->
    <div class="footer-info">
    <?php 
      wp_nav_menu( [
        'theme_location'  => 'footer_menu',
        'container'       => 'nav',
        'menu_class'      => 'footer-nav',
        'echo'            => true,
      ] 
      );

      $instance = array (
        'link_Facebook' => 'https://www.facebook.com/',
		    'link_Twitter' => 'https://www.twitter.com/',
		    'link_Youtube' => 'https://www.youtube.com/',
		    'link_Instagram' => 'https://www.instagram.com/',
        'title' => '',
      );
      $args = array (
        'before_widget' => '<div class="footer-social">',
        'after_widget'  => '</div>',
      );
      the_widget('Social_Widget', $instance, $args);
    ?>
    </div>
    <!-- /footer-info -->
    <?php 
    if ( ! is_active_sidebar( 'sidebar-footer' )) {
      return;
    }
    ?>
    <div class="container">
    <div class="footer-text-wrapper">
      <?php dynamic_sidebar( 'sidebar-footer-text' ); ?>
      <span class="footer-copyright"><?php echo date('Y') . '&nbsp;&copy;&nbsp;' . get_bloginfo('name'); ?></span>
    </div>
    <!-- /footer-text-wrapper -->
  </div>
  <!-- /container -->
  </footer>
  <?php wp_footer(); ?> 
</body>
</html>