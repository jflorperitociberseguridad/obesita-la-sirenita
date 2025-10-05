<?php
/**
 * OPCIÓN 4: La Versión Final con IA.
 *
 * Esta es la versión completa y recomendada. Incluye todas las características:
 * base, menús, widgets, personalizador y la lógica segura para la API de Gemini.
 *
 * @package Obesita_Sirenita
 */

if ( ! function_exists( 'obesita_sirenita_setup' ) ) :
	/**
	 * Configuración básica del tema.
	 */
	function obesita_sirenita_setup() {
		// Soporte para título dinámico.
		add_theme_support( 'title-tag' );

        // Habilitar imágenes destacadas.
        add_theme_support( 'post-thumbnails' );

		// Registrar menú de navegación principal.
		register_nav_menus( array(
			'menu-principal' => esc_html__( 'Menú Principal', 'obesitasirenita' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'obesita_sirenita_setup' );

/**
 * Encolar scripts y estilos.
 */
function obesita_sirenita_scripts() {
	// Hoja de estilos principal del tema (style.css).
	wp_enqueue_style( 'obesita-sirenita-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	// Tailwind CSS desde CDN.
	wp_enqueue_script( 'tailwind-css', 'https://cdn.tailwindcss.com', array(), null, false );

	// Font Awesome desde CDN.
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );

	// Google Fonts.
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Comic+Neue:wght@400;700&display=swap', array(), null );
    
    // Cargar la librería Swiper.js para el slider de la galería.
    wp_enqueue_style( 'swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css', array(), '11.0.5' );
    wp_enqueue_script( 'swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), '11.0.5', true );

    // Script principal del tema (main.js).
    wp_enqueue_script( 'obesita-sirenita-main-js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery', 'swiper-js' ), wp_get_theme()->get( 'Version' ), true );

    // Pasar datos de PHP a JavaScript de forma segura (para la llamada a Gemini).
    wp_localize_script( 'obesita-sirenita-main-js', 'gemini_ajax_object', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'gemini_nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'obesita_sirenita_scripts' );


/**
 * Registrar zona de widgets para la barra lateral.
 */
function obesita_sirenita_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Barra Lateral Principal', 'obesitasirenita' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Añade widgets aquí.', 'obesitasirenita' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s bg-white p-6 rounded-lg shadow-md mb-8">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title text-2xl font-bold text-blue-800 mb-4">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'obesita_sirenita_widgets_init' );


/**
 * Endpoint AJAX para gestionar la llamada a la API de Gemini de forma segura.
 */
function get_gemini_story_callback() {
    // 1. Verificación de seguridad (Nonce)
    if ( ! check_ajax_referer( 'gemini_nonce', 'nonce', false ) ) {
        wp_send_json_error( array('message' => 'Error de seguridad. Por favor, recarga la página.'), 403 );
        return;
    }

    // 2. Validar el prompt
    if ( ! isset( $_POST['prompt'] ) || empty( $_POST['prompt'] ) ) {
        wp_send_json_error( array('message' => 'El prompt está vacío.'), 400 );
        return;
    }
    $prompt = sanitize_textarea_field( $_POST['prompt'] );

    // 3. Comprobar la clave de API
    if ( ! defined( 'GEMINI_API_KEY' ) || empty( GEMINI_API_KEY ) ) {
        wp_send_json_error( array('message' => 'Error: La clave de la API de Gemini no está definida en tu archivo wp-config.php.'), 500 );
        return;
    }
    $api_key = GEMINI_API_KEY;
    $api_url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-preview-05-20:generateContent?key=' . $api_key;
    
    // 4. Hacer la llamada a la API
    $response = wp_remote_post( $api_url, array(
        'method'    => 'POST',
        'headers'   => array( 'Content-Type' => 'application/json' ),
        'body'      => json_encode( array('contents' => array(array('parts' => array(array('text' => $prompt)))))),
        'timeout'   => 30,
    ) );

    // 5. Gestionar errores de la llamada
    if ( is_wp_error( $response ) ) {
        wp_send_json_error( array('message' => 'Error de conexión con la API: ' . $response->get_error_message()), 500 );
        return;
    }

    $response_code = wp_remote_retrieve_response_code($response);
    if($response_code !== 200){
        $error_body = json_decode(wp_remote_retrieve_body($response), true);
        $error_message = $error_body['error']['message'] ?? 'Error desconocido en la API.';
        wp_send_json_error( array('message' => 'Error de la API (' . $response_code . '): ' . $error_message), 500 );
        return;
    }

    // 6. Procesar y devolver la respuesta correcta
    $response_body = json_decode( wp_remote_retrieve_body( $response ), true );
    $story = $response_body['candidates'][0]['content']['parts'][0]['text'] ?? '';

    if ( empty( $story ) ) {
        wp_send_json_error( array('message' => 'No se pudo generar el cuento. La respuesta de la API estaba vacía.'), 500 );
    } else {
        wp_send_json_success( $story );
    }
}
add_action( 'wp_ajax_get_gemini_story', 'get_gemini_story_callback' );
add_action( 'wp_ajax_nopriv_get_gemini_story', 'get_gemini_story_callback' );


/**
 * Añadir opciones de personalización al tema.
 */
function obesita_sirenita_customize_register( $wp_customize ) {
    $wp_customize->add_panel( 'frontpage_panel', array(
        'title' => __( 'Opciones de la Portada', 'obesitasirenita' ), 'priority' => 10,
    ) );
    $wp_customize->add_section( 'hero_section', array(
        'title' => __( 'Sección de Bienvenida', 'obesitasirenita' ), 'panel' => 'frontpage_panel', 'priority' => 10,
    ) );
    $wp_customize->add_setting( 'hero_title_part1', array( 'default' => 'Sumérgete en un Océano de', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'hero_title_part1', array( 'label' => __( 'Título (Parte 1)', 'obesitasirenita' ), 'section' => 'hero_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'hero_title_part2', array( 'default' => 'Valores y Aventura', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'hero_title_part2', array( 'label' => __( 'Título (Parte 2, resaltada)', 'obesitasirenita' ), 'section' => 'hero_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'hero_subtitle', array( 'default' => 'Descubre una historia...', 'sanitize_callback' => 'sanitize_textarea_field' ) );
    $wp_customize->add_control( 'hero_subtitle', array( 'label' => __( 'Subtítulo', 'obesitasirenita' ), 'section' => 'hero_section', 'type' => 'textarea' ) );
    $wp_customize->add_setting( 'hero_background_image', array( 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_background_image', array( 'label' => __( 'Imagen de Fondo', 'obesitasirenita' ), 'section' => 'hero_section' ) ) );

    // Sección de Galería
    $wp_customize->add_section( 'gallery_section', array(
        'title' => __( 'Galería de Fotos', 'obesitasirenita' ), 'panel' => 'frontpage_panel', 'priority' => 20,
    ) );
    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting( "gallery_image_$i", array( 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "gallery_image_$i", array(
            'label' => __( 'Imagen de la Galería ', 'obesitasirenita' ) . $i, 'section' => 'gallery_section',
        ) ) );
    }
}
add_action( 'customize_register', 'obesita_sirenita_customize_register' );


/**
 * Clases Walker personalizadas para los menús.
 */
class Obesita_Sirenita_Nav_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $output .= "<a href='" . esc_attr($item->url) . "' class='nav-link px-3 py-2 rounded-md text-gray-600 hover:bg-blue-100 hover:text-blue-700 font-semibold transition-colors'>";
        $output .= esc_html($item->title);
        $output .= "</a>";
    }
}
class Obesita_Sirenita_Mobile_Nav_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $output .= "<a href='" . esc_attr($item->url) . "' class='nav-link block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-50 font-semibold'>";
        $output .= esc_html($item->title);
        $output .= "</a>";
    }
}

