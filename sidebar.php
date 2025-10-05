<?php
/**
 * La plantilla para mostrar la barra lateral.
 * Contiene el área principal de widgets.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Obesita_Sirenita
 */

// Si no hay widgets activos en la barra lateral, no se muestra nada.
if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area md:w-1/3 lg:w-1/4 px-4">
	<div class="sticky top-24 space-y-8">
		<?php dynamic_sidebar( 'primary-sidebar' ); ?>
	</div>
</aside>
