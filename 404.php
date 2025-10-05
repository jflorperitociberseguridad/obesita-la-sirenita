<?php
/**
 * La plantilla para mostrar páginas 404 (no encontradas).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Obesita_Sirenita
 */

get_header();
?>

	<section class="error-404 not-found underwater-bg text-white py-24 sm:py-32 flex items-center justify-center text-center">
		<div class="container mx-auto px-4 z-10 relative">
			
			<header class="page-header mb-8">
				<h1 class="text-9xl font-bold comic-font text-yellow-300">404</h1>
				<p class="text-3xl md:text-4xl font-bold mt-4">¡Oh, no! Te has perdido en el océano.</p>
			</header>

			<div class="page-content max-w-2xl mx-auto">
				<p class="text-lg md:text-xl mb-8">
					La página que buscas parece haberse sumergido en las profundidades. ¡No te preocupes! Puedes volver a la superficie o buscar lo que necesitas.
				</p>

				<?php get_search_form(); ?>

				<div class="mt-12">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bg-white text-blue-800 px-8 py-3 rounded-full font-bold text-lg hover:bg-blue-100 transition-transform hover:scale-105 shadow-2xl">
						<i class="fas fa-home mr-2"></i> Volver a la página principal
					</a>
				</div>
			</div>
			
		</div>
	</section>

<?php
get_footer();
