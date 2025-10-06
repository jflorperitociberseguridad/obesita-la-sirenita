<?php
/**
 * La plantilla para mostrar todas las páginas con su barra lateral específica.
 *
 * @package Obesita_Sirenita
 */

get_header();
?>

<div class="container mx-auto py-12 px-4">
    <div class="lg:grid lg:grid-cols-3 lg:gap-8">

        <!-- Columna Principal de Contenido (ocupa 2 de 3 columnas) -->
        <div id="primary" class="content-area lg:col-span-2">
            <main id="main" class="site-main bg-white p-8 rounded-lg shadow-md">

                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header mb-6 border-b pb-4">
                            <?php the_title( '<h1 class="entry-title text-3xl md:text-4xl font-bold text-blue-900 comic-font">', '</h1>' ); ?>
                        </header>

                        <div class="entry-content prose lg:prose-xl max-w-none text-gray-700">
                            <?php
                            the_content();

                            wp_link_pages(
                                array(
                                    'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'obesitasirenita' ),
                                    'after'  => '</div>',
                                )
                            );
                            ?>
                        </div><!-- .entry-content -->

                        <?php if ( get_edit_post_link() ) : ?>
                            <footer class="entry-footer mt-8 pt-4 border-t">
                                <?php
                                edit_post_link(
                                    sprintf(
                                        wp_kses(
                                            __( 'Editar <span class="screen-reader-text">%s</span>', 'obesitasirenita' ),
                                            array( 'span' => array( 'class' => array() ) )
                                        ),
                                        get_the_title()
                                    ),
                                    '<span class="edit-link text-sm text-blue-600 hover:underline">',
                                    '</span>'
                                );
                                ?>
                            </footer><!-- .entry-footer -->
                        <?php endif; ?>
                    </article><!-- #post-<?php the_ID(); ?> -->
                    <?php
                endwhile; // End of the loop.
                ?>

            </main><!-- #main -->
        </div><!-- #primary -->

        <!-- Columna de la Barra Lateral (ocupa 1 de 3 columnas) -->
        <div class="w-full lg:col-span-1 mt-8 lg:mt-0">
            <?php get_sidebar( 'page' ); // Llama específicamente a sidebar-page.php ?>
        </div>

    </div>
</div>

<?php
get_footer();

