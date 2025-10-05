<?php get_header(); ?>

<div class="container mx-auto my-12 px-4">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <h1 class="text-4xl font-bold text-blue-900 mb-8 comic-font"><?php the_title(); ?></h1>

                <div class="prose max-w-none text-gray-800">
                    <?php the_content(); ?>
                </div>

            </article>

        <?php endwhile; endif; ?>
    </div>
</div>

<?php get_footer(); ?>
