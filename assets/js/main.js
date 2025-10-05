document.addEventListener('DOMContentLoaded', () => {

    /**
     * Smooth scroll for anchor links
     */
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    /**
     * Header scroll effect
     */
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

    /**
     * Mobile Menu Toggle
     */
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    if (mobileMenuBtn && mobileMenu) {
        const mobileNavLinks = mobileMenu.querySelectorAll('a.nav-link');
        const toggleMenu = () => {
            const isHidden = mobileMenu.classList.toggle('hidden');
            mobileMenuBtn.setAttribute('aria-expanded', String(!isHidden));
        };
        mobileMenuBtn.addEventListener('click', toggleMenu);
        mobileNavLinks.forEach(link => link.addEventListener('click', () => {
            if (!mobileMenu.classList.contains('hidden')) toggleMenu();
        }));
    }

    /**
     * FAQ Accordion
     */
    const faqBtns = document.querySelectorAll('.faq-btn');
    faqBtns.forEach(button => {
        button.addEventListener('click', () => {
            const content = button.nextElementSibling;
            const icon = button.querySelector('i');
            const isExpanded = content.style.maxHeight;

            // Close all other accordions
            faqBtns.forEach(otherButton => {
                if (otherButton !== button) {
                    otherButton.nextElementSibling.style.maxHeight = null;
                    otherButton.querySelector('i').classList.remove('rotate-180');
                }
            });

            // Toggle the clicked accordion
            if (isExpanded) {
                content.style.maxHeight = null;
                icon.classList.remove('rotate-180');
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
                icon.classList.add('rotate-180');
            }
        });
    });

    /**
     * Trailer Modal
     */
    const trailerModal = document.getElementById('trailerModal');
    const trailerBtn = document.getElementById('trailerBtn');
    const closeTrailerModal = document.getElementById('closeTrailerModal');
    const youtubePlayer = document.getElementById('youtube-player');
    if (trailerBtn && trailerModal && closeTrailerModal && youtubePlayer) {
        const openModal = () => trailerModal.classList.remove('hidden');
        const closeModal = () => {
            trailerModal.classList.add('hidden');
            youtubePlayer.contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', '*');
        };
        trailerBtn.addEventListener('click', openModal);
        closeTrailerModal.addEventListener('click', closeModal);
        trailerModal.addEventListener('click', (e) => {
            if (e.target === trailerModal) closeModal();
        });
    }

    /**
     * Subscription Modal (optional, can be part of the theme)
     */
    const subscriptionModal = document.getElementById('subscriptionModal');
    const closeSubscriptionModal = document.getElementById('closeSubscriptionModal');
    if (subscriptionModal && closeSubscriptionModal) {
        const showSubscriptionModal = () => {
            if (sessionStorage.getItem('subscribed')) return;
            subscriptionModal.classList.remove('invisible', 'opacity-0');
            subscriptionModal.querySelector('div').classList.remove('scale-95');
        };
        const hideSubscriptionModal = () => {
            subscriptionModal.classList.add('opacity-0');
            subscriptionModal.querySelector('div').classList.add('scale-95');
            setTimeout(() => subscriptionModal.classList.add('invisible'), 500);
        };
        setTimeout(showSubscriptionModal, 15000); // Show after 15 seconds
        closeSubscriptionModal.addEventListener('click', hideSubscriptionModal);
    }
    
    /**
     * Swiper.js Gallery Slider Initialization
     */
    const swiperContainer = document.querySelector('.swiper-container');
    if (swiperContainer) {
        new Swiper(swiperContainer, {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
             breakpoints: {
                640: {
                  slidesPerView: 2,
                  spaceBetween: 20,
                },
                1024: {
                  slidesPerView: 3,
                  spaceBetween: 30,
                },
            }
        });
    }

    /**
     * Gemini Story Generator AJAX Handler
     */
    const storyForm = document.getElementById('storyForm');
    if (storyForm) {
        const generateBtn = document.getElementById('generateStoryBtn');
        const storyResultWrapper = document.getElementById('storyResultWrapper');
        const storyResultDiv = document.getElementById('storyResult');
        const storyLoader = document.getElementById('storyLoader');

        storyForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const characterName = document.getElementById('characterName').value.trim();
            const storyValue = document.getElementById('storyValue').value.trim();
            const storyPlace = document.getElementById('storyPlace').value.trim();

            if (!characterName || !storyValue || !storyPlace) {
                alert('Por favor, completa todos los campos para crear tu cuento.');
                return;
            }

            // Show loader and prepare result area
            storyResultWrapper.classList.remove('hidden');
            storyResultDiv.classList.add('hidden');
            storyResultDiv.classList.remove('story-result-show');
            storyLoader.classList.remove('hidden');
            generateBtn.disabled = true;
            generateBtn.querySelector('.btn-text').textContent = 'Creando Magia...';

            const prompt = `Escribe un cuento infantil muy corto, de no más de 150 palabras, ideal para un niño de 6 años. El personaje principal se llama '${characterName}'. La historia debe enseñar el valor de la '${storyValue}' y sucede en '${storyPlace}'. Usa un lenguaje sencillo, positivo y mágico, al estilo del cuento 'Obesita la Sirenita'.`;

            // Prepare data for WordPress AJAX
            const formData = new FormData();
            formData.append('action', 'get_gemini_story');
            formData.append('nonce', gemini_ajax_object.nonce);
            formData.append('prompt', prompt);

            try {
                const response = await fetch(gemini_ajax_object.ajax_url, {
                    method: 'POST',
                    body: formData,
                });

                const result = await response.json();

                if (result.success) {
                    storyResultDiv.innerHTML = `<p class="comic-font text-lg leading-relaxed text-gray-700">${result.data.replace(/\n/g, '<br>')}</p>`;
                } else {
                    // Display the specific error message from the backend
                    storyResultDiv.innerHTML = `<p class="text-red-600 font-semibold">¡Oh, no! Hubo un problema.</p><p class="text-red-500 mt-2">${result.data.message}</p>`;
                }

            } catch (error) {
                storyResultDiv.innerHTML = '<p class="text-red-600">¡Oh, no! Hubo un error de conexión. Por favor, inténtalo de nuevo más tarde.</p>';
                console.error('Error during AJAX call:', error);
            } finally {
                storyLoader.classList.add('hidden');
                storyResultDiv.classList.remove('hidden');
                storyResultDiv.classList.add('story-result-show');
                generateBtn.disabled = false;
                generateBtn.querySelector('.btn-text').textContent = '✨ ¡Generar mi Cuento!';
            }
        });
    }

});

