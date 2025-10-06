</main><!-- #main -->

<footer class="bg-gray-900 text-white pt-16 pb-8">
    <div class="container mx-auto px-4 text-center">
         <a href="#home" class="inline-block mb-6" aria-label="Volver al inicio">
            <div class="w-16 h-16 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full flex items-center justify-center shadow-lg transform hover:scale-110 transition-transform">
                <i class="fas fa-water text-white text-3xl"></i>
            </div>
        </a>
        <h3 class="text-3xl font-bold comic-font mb-4"><?php bloginfo('name'); ?></h3>
        <p class="text-gray-400 max-w-xl mx-auto mb-8">
            <?php bloginfo('description'); ?>
        </p>
        <div class="flex justify-center space-x-6 mb-10">
            <a href="#" class="text-gray-400 hover:text-white transition-colors" aria-label="Facebook"><i class="fab fa-facebook-f text-2xl"></i></a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors" aria-label="Instagram"><i class="fab fa-instagram text-2xl"></i></a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors" aria-label="YouTube"><i class="fab fa-youtube text-2xl"></i></a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors" aria-label="TikTok"><i class="fab fa-tiktok text-2xl"></i></a>
        </div>
        <div class="text-gray-500 text-sm space-x-4">
            <a href="#" class="hover:text-white">Política de Privacidad</a>
            <span>&bull;</span>
            <a href="#" class="hover:text-white">Términos de Uso</a>
        </div>
        <p class="text-gray-500 text-sm mt-4">
            &copy; <span id="year"></span> <?php bloginfo('name'); ?>. Todos los derechos reservados.
        </p>
    </div>
</footer>

<!-- Botón Volver Arriba -->
<button id="back-to-top" class="fixed bottom-6 right-6 bg-blue-600 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center text-xl hover:bg-blue-700 transition-opacity duration-300 opacity-0 z-50">
  <i class="fas fa-arrow-up"></i>
</button>

<?php wp_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', () => {

    // --- Lógica del Header que se encoge con el scroll y Botón Volver Arriba ---
    const header = document.getElementById('header');
    const backToTopBtn = document.getElementById('back-to-top');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.querySelector('.flex').classList.remove('h-20');
            header.querySelector('.flex').classList.add('h-16');
            backToTopBtn.classList.remove('opacity-0');
        } else {
            header.querySelector('.flex').classList.add('h-20');
            header.querySelector('.flex').classList.remove('h-16');
            backToTopBtn.classList.add('opacity-0');
        }
    });

    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // --- Lógica del Menú Móvil ---
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenuPanel = document.getElementById('mobileMenuPanel');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const closeMobileMenuBtn = document.getElementById('closeMobileMenuBtn');
    const mobileNavLinks = document.querySelectorAll('#mobileMenuPanel a');

    const openMenu = () => {
        mobileMenuOverlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        mobileMenuPanel.classList.remove('translate-x-full');
    };

    const closeMenu = () => {
        mobileMenuOverlay.classList.add('hidden');
        document.body.style.overflow = '';
        mobileMenuPanel.classList.add('translate-x-full');
    };
    
    mobileMenuBtn.addEventListener('click', openMenu);
    closeMobileMenuBtn.addEventListener('click', closeMenu);
    mobileMenuOverlay.addEventListener('click', closeMenu);
    mobileNavLinks.forEach(link => link.addEventListener('click', closeMenu));
    
    // --- Actualizar año en el footer ---
    const yearEl = document.getElementById('year');
    if (yearEl) {
        yearEl.textContent = new Date().getFullYear();
    }
});
</script>

</body>
</html>
