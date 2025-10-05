<?php get_header(); ?>

<div class="container mx-auto my-12 px-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Columna Principal (Contenido del Post) -->
        <div class="lg:col-span-2">
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        
                        <h1 class="text-4xl font-bold text-blue-900 mb-4 comic-font"><?php the_title(); ?></h1>

                        <div class="text-gray-500 mb-6">
                            <span>Publicado el <?php the_date(); ?></span> por <span><?php the_author(); ?></span>
                        </div>

                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="mb-8">
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded-md shadow-md']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="prose max-w-none text-gray-800">
                            <?php the_content(); ?>
                        </div>

                    </article>

                <?php endwhile; else : ?>
                    <p><?php _e( 'Lo siento, no se encontraron entradas que coincidan.' ); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Barra Lateral del Blog -->
        <aside class="lg:col-span-1">
            <?php get_sidebar('blog'); ?>
        </aside>

    </div>
</div>

<?php get_footer(); ?>
