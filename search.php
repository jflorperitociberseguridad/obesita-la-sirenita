<?php
/**
 * La plantilla para mostrar los resultados de búsqueda.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Obesita_Sirenita
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header underwater-bg py-16 text-white">
				<div class="container mx-auto px-4 text-center">
					<h1 class="text-4xl md:text-5xl font-bold comic-font">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Resultados de búsqueda para: %s', 'obesitasirenita' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</div>
			</header>

			<div class="py-20 bg-gray-50">
				<div class="container mx-auto px-4">
					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
						<?php
						/* Inicia el Loop */
						while ( have_posts() ) :
							the_post();
							?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-transform'); ?>>
								<div class="p-6">
									<header class="entry-header mb-4">
										<?php the_title( sprintf( '<h2 class="entry-title text-2xl font-bold text-blue-800 hover:text-blue-600"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
									</header>

									<div class="entry-summary text-gray-600">
										<?php the_excerpt(); ?>
									</div>
								</div>
							</article>
							<?php
						endwhile;
						?>
					</div>

					<?php
					// Paginación de resultados
					the_posts_navigation();
					?>
				</div>
			</div>


		<?php else : ?>

			<section class="no-results not-found underwater-bg text-white py-24 sm:py-32 flex items-center justify-center text-center">
				<div class="container mx-auto px-4 z-10 relative">
					<h1 class="text-3xl md:text-4xl font-bold mt-4">Nada encontrado</h1>
					<p class="text-lg md:text-xl mt-4 mb-8 max-w-2xl mx-auto">
						Lo sentimos, pero nada coincide con tus términos de búsqueda. Por favor, inténtalo de nuevo con palabras diferentes.
					</p>
					<?php get_search_form(); ?>
				</div>
			</section>

		<?php endif; ?>

		</main>
	</section>

<?php
get_footer();
