<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package universal-example
 */

if ( ! is_active_sidebar( 'sidebar-javascript' ) ) {
	return;
}
?>

<aside id="javascript" class="sidebar-front-page">
	<?php dynamic_sidebar( 'sidebar-javascript' ); ?>
</aside><!-- #secondary -->
