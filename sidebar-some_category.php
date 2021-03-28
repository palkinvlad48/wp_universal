<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package universal-example
 */

if ( ! is_active_sidebar( 'sidebar-some_category' ) ) {
	return;
}
?>

<aside id="same" class="sidebar-front-page">
	<?php dynamic_sidebar( 'sidebar-some_category' ); ?>
</aside><!-- #secondary -->
