<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        /* Estilos personalizados para complementar Tailwind */
        body { font-family: 'Poppins', sans-serif; }
        .comic-font { font-family: 'Comic Neue', cursive; }
        
        /* Animación para el subrayado del menú */
        .nav-item {
            position: relative;
            padding-bottom: 4px;
        }
        .nav-item::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #3b82f6; /* Tailwind blue-600 */
            transition: width 0.3s ease-in-out;
        }
        .nav-item:hover::after, .nav-item.active::after, .current-menu-item > a::after {
            width: 100%;
        }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-blue-50 text-gray-800 antialiased'); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Saltar al contenido', 'obesitasirenita' ); ?></a>

<header id="header" class="bg-white/90 backdrop-blur-lg shadow-md sticky top-0 z-40 transition-all duration-300">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-20 transition-all duration-300">
            
            <div class="site-branding flex-shrink-0">
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
            
            <nav class="hidden md:flex items-center justify-end flex-grow gap-x-4 lg:gap-x-6" aria-label="<?php esc_attr_e( 'Navegación principal', 'obesitasirenita' ); ?>">
                <?php
                if ( has_nav_menu( 'menu-principal' ) ) {
                    // NOTA: Asegúrate de que tu 'Obesita_Sirenita_Nav_Walker' añade la clase 'nav-item' a cada enlace <a>.
                    wp_nav_menu( array(
                        'theme_location' => 'menu-principal',
                        'container'      => false,
                        'items_wrap'     => '%3$s', // No envuelve los items en un <ul>
                        'walker'         => new Obesita_Sirenita_Nav_Walker(),
                    ) );
                }
                ?>
                <a href="#contact" class="bg-blue-600 text-white px-4 py-2 rounded-full font-bold hover:bg-blue-700 transition-transform hover:scale-105 shadow-md whitespace-nowrap">Contacto</a>
            </nav>
            
            <button id="mobileMenuBtn" class="md:hidden p-2 text-blue-700" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobileMenuPanel">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Menu Panel -->
<div id="mobileMenuOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden"></div>
<div id="mobileMenuPanel" class="fixed top-0 right-0 h-full w-4/5 max-w-sm bg-white z-[60] transform translate-x-full transition-transform duration-300 ease-in-out">
    <div class="p-8">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-xl font-bold comic-font text-blue-800">Menú</h2>
            <button id="closeMobileMenuBtn" class="text-gray-600 hover:text-black text-3xl">&times;</button>
        </div>
        <nav class="flex flex-col space-y-6">
            <?php
            if ( has_nav_menu( 'menu-principal' ) ) {
                 // NOTA: Asegúrate de que tu 'Obesita_Sirenita_Mobile_Nav_Walker' añade la clase 'mobile-nav-item' a cada enlace <a>.
                wp_nav_menu( array(
                    'theme_location' => 'menu-principal',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new Obesita_Sirenita_Mobile_Nav_Walker(),
                ) );
            }
            ?>
            <a href="#contact" class="mobile-nav-item text-lg text-gray-700 hover:text-blue-600 font-semibold">Contacto</a>
        </nav>
    </div>
</div>

<main id="primary" class="site-main">
