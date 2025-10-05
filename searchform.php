<?php
/**
 * Plantilla para mostrar el formulario de búsqueda personalizado.
 *
 * @package Obesita_Sirenita
 */
?>

<form role="search" method="get" class="search-form flex items-center w-full" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="sr-only">
		<span class="screen-reader-text"><?php echo _x( 'Buscar:', 'label', 'obesitasirenita' ); ?></span>
	</label>
	<input
		type="search"
		class="search-field flex-grow p-3 border border-gray-300 rounded-l-full focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
		placeholder="<?php echo esc_attr_x( 'Buscar en el sitio…', 'placeholder', 'obesitasirenita' ); ?>"
		value="<?php echo get_search_query(); ?>"
		name="s"
	/>
	<button type="submit" class="search-submit bg-blue-600 text-white px-5 py-3 rounded-r-full font-bold hover:bg-blue-700 transition-colors">
		<i class="fas fa-search"></i>
		<span class="sr-only"><?php echo _x( 'Buscar', 'submit button', 'obesitasirenita' ); ?></span>
	</button>
</form>
```

### ¿Qué hacer ahora?

1.  **Sube este archivo:** Coloca `searchform.php` en la carpeta raíz de tu tema.
2.  **Añade el buscador a tu cabecera (opcional):** Si quieres que el buscador aparezca en todas las páginas, puedes añadir la siguiente línea en tu archivo `header.php`, por ejemplo, dentro de la navegación:
    ```php
    <?php get_search_form(); ?>
    
