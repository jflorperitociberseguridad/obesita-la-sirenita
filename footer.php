</main>
<footer class="bg-blue-900 text-white">
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <div class="flex flex-col items-center text-center md:items-start md:text-left">
                <a href="#home" class="flex items-center space-x-3 mb-4" aria-label="Inicio de Obesita la Sirenita">
                    <div class="w-12 h-12 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-water text-white text-2xl"></i>
                    </div>
                    <span class="text-xl font-bold comic-font"><?php bloginfo( 'name' ); ?></span>
                </a>
                <p class="text-blue-200 text-sm mb-6 max-w-xs">
                    <?php bloginfo( 'description' ); ?>
                </p>
                <div class="flex justify-center md:justify-start space-x-5">
                    <a href="#" class="text-blue-300 hover:text-white transition-colors" aria-label="Facebook"><i class="fab fa-facebook-f text-2xl"></i></a>
                    <a href="#" class="text-blue-300 hover:text-white transition-colors" aria-label="Instagram"><i class="fab fa-instagram text-2xl"></i></a>
                    <a href="#" class="text-blue-300 hover:text-white transition-colors" aria-label="YouTube"><i class="fab fa-youtube text-2xl"></i></a>
                    <a href="#" class="text-blue-300 hover:text-white transition-colors" aria-label="TikTok"><i class="fab fa-tiktok text-2xl"></i></a>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-bold mb-4 tracking-wider uppercase">Navegación</h3>
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer_nav',
                        'container'      => 'ul',
                        'menu_class'     => 'space-y-3'
                    ) );
                ?>
            </div>

            <div>
                <h3 class="text-lg font-bold mb-4 tracking-wider uppercase">Legal</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-blue-200 hover:text-white transition-colors">Política de Privacidad</a></li>
                    <li><a href="#" class="text-blue-200 hover:text-white transition-colors">Términos de Uso</a></li>
                    <li><a href="#" class="text-blue-200 hover:text-white transition-colors">Política de Cookies</a></li>
                    <li><a href="#faq" class="text-blue-200 hover:text-white transition-colors">Preguntas Frecuentes</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold mb-4 tracking-wider uppercase">Únete a la Aventura</h3>
                <p class="text-blue-200 text-sm mb-4">Recibe noticias y actividades gratuitas en tu email.</p>
                <form action="#" method="POST" class="flex flex-col sm:flex-row gap-2">
                    <label for="footer-email" class="sr-only">Tu email</label>
                    <input type="email" id="footer-email" placeholder="tu@email.com" class="w-full px-4 py-2 text-gray-800 bg-blue-50 rounded-md border-transparent focus:ring-2 focus:ring-cyan-400 focus:outline-none">
                    <button type="submit" class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 px-4 rounded-md transition-colors">
                        Suscribir
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-10 pt-8 border-t border-blue-800 text-center text-blue-300 text-sm">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
