<?php

// Función para encolar los scripts y estilos
function obesita_sirenita_assets() {
    // Hoja de estilos principal
    wp_enqueue_style( 'main-style', get_stylesheet_uri() );
    
    // Tailwind CSS desde CDN
    wp_enqueue_script( 'tailwind-css', 'https://cdn.tailwindcss.com', array(), null, false );
    
    // Font Awesome desde CDN
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css' );

    // Google Fonts
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Comic+Neue:wght@400;700&display=swap' );

    // Hoja de estilos personalizada (si la creaste)
    wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/style.css' );

    // JavaScript principal (asumiendo que crearás un archivo main.js en una carpeta js)
    // wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'obesita_sirenita_assets' );

// Soportes básicos del tema
function obesita_sirenita_setup() {
    // Habilitar el título dinámico
    add_theme_support( 'title-tag' );

    // Habilitar imágenes destacadas
    add_theme_support( 'post-thumbnails' );

    // Registrar menús de navegación
    register_nav_menus( array(
        'primary'    => __( 'Menú Principal (Escritorio)', 'obesitasirenita' ),
        'mobile'     => __( 'Menú Móvil', 'obesitasirenita' ),
        'footer_nav' => __( 'Navegación en Pie de Página', 'obesitasirenita' ),
    ) );
}
add_action( 'after_setup_theme', 'obesita_sirenita_setup' );

// Registrar zona de widgets (sidebar)
function obesita_sirenita_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Barra Lateral Principal', 'obesitasirenita' ),
        'id'            => 'primary-sidebar',
        'description'   => esc_html__( 'Añade widgets aquí para que aparezcan en tu barra lateral.', 'obesitasirenita' ),
        'before_widget' => '<section id="%1$s" class="widget bg-white p-6 rounded-lg shadow-md %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title text-xl font-bold text-blue-800 mb-4">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'obesita_sirenita_widgets_init' );


// Clases personalizadas para aplicar estilos de Tailwind a los menús
class Tailwind_Nav_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $classes = 'nav-link px-3 py-2 rounded-md text-gray-600 hover:bg-blue-100 hover:text-blue-700 font-semibold transition-colors';
        $output .= '<a href="' . esc_attr($item->url) . '" class="' . esc_attr($classes) . '">' . esc_html($item->title) . '</a>';
    }
}

class Tailwind_Mobile_Nav_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $classes = 'nav-link block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-50 font-semibold';
        $output .= '<a href="' . esc_attr($item->url) . '" class="' . esc_attr($classes) . '">' . esc_html($item->title) . '</a>';
    }
}

?>

