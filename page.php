<?php
/**
 * La plantilla para mostrar todas las páginas.
 *
 * @package Obesita_Sirenita
 */

get_header();
?>

<div class="container mx-auto py-12 px-4">
    <div class="flex flex-wrap lg:flex-nowrap -mx-4">

        <!-- Columna Principal de Contenido -->
        <div id="primary" class="content-area w-full lg:w-2/3 px-4">
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
                                            /* translators: %s: Name of current post. Only visible to screen readers */
                                            __( 'Editar <span class="screen-reader-text">%s</span>', 'obesitasirenita' ),
                                            array(
                                                'span' => array(
                                                    'class' => array(),
                                                ),
                                            )
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

        <!-- Columna de la Barra Lateral (Sidebar) -->
        <div class="w-full lg:w-1/3 px-4 mt-8 lg:mt-0">
            <?php get_sidebar(); ?>
        </div>

    </div>
</div>

<?php
get_footer();

