<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-blue-50 text-gray-800 antialiased'); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Saltar al contenido', 'obesitasirenita' ); ?></a>

<header id="header" class="bg-white/90 backdrop-blur-lg shadow-md sticky top-0 z-50 transition-all duration-300">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            
            <div class="site-branding">
                <?php
                if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center space-x-3" rel="home">
                        <div class="w-12 h-12 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full flex items-center justify-center shadow-lg">
                            <i class="fas fa-water text-white text-2xl"></i>
                        </div>
                        <span class="text-2xl font-bold text-blue-800 comic-font hidden sm:block"><?php bloginfo('name'); ?></span>
                    </a>
                    <?php
                }
                ?>
            </div>
            
            <nav class="hidden md:flex items-center space-x-1 lg:space-x-3" aria-label="<?php esc_attr_e( 'Navegación principal', 'obesitasirenita' ); ?>">
                <?php
                if ( has_nav_menu( 'menu-principal' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'menu-principal',
                        'container'      => false,
                        'items_wrap'     => '%3$s', // No envuelve los items en un <ul>
                        'walker'         => new Obesita_Sirenita_Nav_Walker(),
                    ) );
                }
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
            if ( has_nav_menu( 'menu-principal' ) ) {
                 wp_nav_menu( array(
                     'theme_location' => 'menu-principal',
                     'container'      => false,
                     'items_wrap'     => '%3$s',
                     'walker'         => new Obesita_Sirenita_Mobile_Nav_Walker(),
                 ) );
            }
            ?>
            <a href="#contact" class="nav-link block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-50 font-semibold">Contacto</a>
        </div>
    </nav>
</header>
<main id="primary" class="site-main">

