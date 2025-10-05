<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-blue-50 text-gray-800 antialiased' ); ?>>
<header id="header" class="bg-white/90 backdrop-blur-lg shadow-md sticky top-0 z-50 transition-all duration-300">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center space-x-3" aria-label="Inicio de Obesita la Sirenita">
                <div class="w-12 h-12 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-water text-white text-2xl"></i>
                </div>
                <span class="text-2xl font-bold text-blue-800 comic-font hidden sm:block"><?php bloginfo( 'name' ); ?></span>
            </a>
            
            <nav class="hidden md:flex items-center space-x-1 lg:space-x-3" aria-label="Navegación principal">
                 <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'items_wrap'     => '%3$s', // No wrapping <ul>
                        'walker'         => new Tailwind_Nav_Walker(),
                        'fallback_cb'    => false
                    ) );
                ?>
                 <a href="#contact" class="bg-blue-600 text-white px-5 py-2 rounded-full font-bold hover:bg-blue-700 transition-transform hover:scale-105 shadow-md">Contacto</a>
            </nav>
            
            <button id="mobileMenuBtn" class="md:hidden p-2 text-blue-700" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobileMenu">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </div>
    
    <nav id="mobileMenu" class="md:hidden bg-white border-t border-gray-200 hidden">
        <div class="px-4 pt-2 pb-4 space-y-2">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'mobile',
                'container'      => false,
                'items_wrap'     => '%3$s',
                'walker'         => new Tailwind_Mobile_Nav_Walker(),
                'fallback_cb'    => false
            ) );
            ?>
        </div>
    </nav>
</header>
<main>
