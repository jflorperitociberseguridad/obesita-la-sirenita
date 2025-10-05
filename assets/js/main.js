document.addEventListener('DOMContentLoaded', () => {

    // --- Lógica del Header Fijo ---
    const header = document.getElementById('header');
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('py-2', 'shadow-xl');
                header.classList.remove('py-3');
            } else {
                header.classList.remove('py-2', 'shadow-xl');
                header.classList.add('py-3');
            }
        });
    }

    // --- Lógica del Menú Móvil ---
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    if (mobileMenuBtn && mobileMenu) {
        const mobileNavLinks = mobileMenu.querySelectorAll('a');
        const toggleMenu = () => {
            const isHidden = mobileMenu.classList.toggle('hidden');
            mobileMenuBtn.setAttribute('aria-expanded', !isHidden);
        };
        mobileMenuBtn.addEventListener('click', toggleMenu);
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (!mobileMenu.classList.contains('hidden')) toggleMenu();
            });
        });
    }

    // --- Lógica del Acordeón de FAQ ---
    const faqBtns = document.querySelectorAll('.faq-btn');
    faqBtns.forEach(button => {
        button.addEventListener('click', () => {
            const content = button.nextElementSibling;
            const icon = button.querySelector('i');
            const isExpanded = content.style.maxHeight;

            faqBtns.forEach(otherButton => {
                if (otherButton !== button) {
                    otherButton.nextElementSibling.style.maxHeight = null;
                    otherButton.querySelector('i').classList.remove('rotate-180');
                }
            });

            if (isExpanded) {
                content.style.maxHeight = null;
                icon.classList.remove('rotate-180');
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
                icon.classList.add('rotate-180');
            }
        });
    });

    // --- Lógica de los Modales (Pop-ups) ---
    const trailerModal = document.getElementById('trailerModal');
    const trailerBtn = document.getElementById('trailerBtn');
    const closeTrailerModal = document.getElementById('closeTrailerModal');
    const youtubePlayer = document.getElementById('youtube-player');
    if (trailerBtn && trailerModal && closeTrailerModal && youtubePlayer) {
        trailerBtn.addEventListener('click', () => trailerModal.classList.remove('hidden'));
        const stopVideo = () => {
            trailerModal.classList.add('hidden');
            youtubePlayer.contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', '*');
        };
        closeTrailerModal.addEventListener('click', stopVideo);
        trailerModal.addEventListener('click', (e) => {
            if (e.target === trailerModal) stopVideo();
        });
    }
    
    // --- Lógica del Slider de la Galería (Swiper.js) ---
    const gallerySlider = document.querySelector('.swiper-container');
    if (gallerySlider) {
        new Swiper('.swiper-container', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }

    // --- LÓGICA DEL GENERADOR DE CUENTOS (VERSIÓN AJAX SEGURA PARA WORDPRESS) ---
    const storyForm = document.getElementById('storyForm');
    if (storyForm) {
        const generateBtn = document.getElementById('generateStoryBtn');
        const storyResultWrapper = document.getElementById('storyResultWrapper');
        const storyResultDiv = document.getElementById('storyResult');
        const storyLoader = document.getElementById('storyLoader');

        storyForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const characterName = document.getElementById('characterName').value.trim();
            const storyValue = document.getElementById('storyValue').value.trim();
            const storyPlace = document.getElementById('storyPlace').value.trim();

            if (!characterName || !storyValue || !storyPlace) {
                alert('Por favor, completa todos los campos para crear tu cuento.');
                return;
            }

            storyResultWrapper.classList.remove('hidden');
            storyResultDiv.classList.add('hidden');
            storyLoader.classList.remove('hidden');
            generateBtn.disabled = true;
            generateBtn.querySelector('.btn-text').textContent = 'Creando magia...';

            const prompt = `Escribe un cuento infantil muy corto, de no más de 150 palabras, ideal para un niño de 6 años. El personaje principal se llama '${characterName}'. La historia debe enseñar el valor de la '${storyValue}' y sucede en '${storyPlace}'. Usa un lenguaje sencillo, positivo y mágico, al estilo del cuento 'Obesita la Sirenita'.`;

            const formData = new FormData();
            formData.append('action', 'get_gemini_story');
            formData.append('nonce', gemini_ajax_object.nonce);
            formData.append('prompt', prompt);

            fetch(gemini_ajax_object.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    storyResultDiv.innerHTML = `<p class="comic-font text-lg leading-relaxed text-gray-700">${result.data.replace(/\n/g, '<br>')}</p>`;
                } else {
                    storyResultDiv.innerHTML = `<p class="text-red-600 font-semibold">¡Oh, no! Hubo un problema creando tu cuento.</p><p class="text-red-500 text-sm mt-2">${result.data.message}</p>`;
                }
            })
            .catch(error => {
                console.error('Error en la llamada AJAX:', error);
                storyResultDiv.innerHTML = '<p class="text-red-600">Error de conexión. Por favor, revisa tu conexión a internet e inténtalo de nuevo.</p>';
            })
            .finally(() => {
                storyLoader.classList.add('hidden');
                storyResultDiv.classList.remove('hidden');
                generateBtn.disabled = false;
                generateBtn.querySelector('.btn-text').textContent = '✨ ¡Generar mi Cuento!';
            });
        });
    }
});

