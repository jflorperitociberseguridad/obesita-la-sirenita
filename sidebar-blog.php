<?php
/**
 * La barra lateral que contiene el área de widgets para el blog.
 *
 * @package Obesita_Sirenita
 */

if ( ! is_active_sidebar( 'blog-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'blog-sidebar' ); ?>
</aside>
