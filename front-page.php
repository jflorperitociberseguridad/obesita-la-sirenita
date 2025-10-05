<?php get_header(); ?>

    <!-- =========== Hero Section =========== -->
    <section id="home" class="underwater-bg text-white py-24 sm:py-32">
        <div class="container mx-auto px-4 z-10 relative text-center">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold leading-tight comic-font mb-6 text-shadow-strong">
                Sumérgete en un Océano de <span class="text-yellow-300">Valores y Aventura</span>
            </h1>
            <p class="text-lg md:text-xl max-w-3xl mx-auto mb-10 text-shadow-strong">
                Descubre una historia mágica que enseña a los más pequeños a quererse, respetar a los demás y cuidar nuestro maravilloso planeta.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="#book" class="bg-yellow-400 text-blue-900 px-8 py-3 rounded-full font-bold text-lg hover:bg-yellow-300 transition-transform hover:scale-105 shadow-2xl">
                    <i class="fas fa-book-open mr-2"></i>Descubre el Libro
                </a>
                <button id="trailerBtn" class="bg-white/20 backdrop-blur-sm border-2 border-white text-white px-8 py-3 rounded-full font-bold text-lg hover:bg-white/30 transition-transform hover:scale-105">
                    <i class="fas fa-play-circle mr-2"></i>Ver Trailer
                </button>
            </div>
        </div>
    </section>

    <!-- =========== Values Section =========== -->
    <section id="values" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="section-title text-3xl md:text-4xl font-bold text-blue-900">Valores que Dejan Huella</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto mt-4">
                    Cada página es una semilla de empatía, confianza y amor por el mundo que nos rodea.
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 text-center">
                <div class="flex flex-col items-center">
                    <div class="bg-gradient-to-br from-pink-100 to-pink-200 w-24 h-24 rounded-full flex items-center justify-center mb-4 transition-transform hover:scale-110">
                        <i class="fas fa-heart text-pink-500 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-800">Autoestima</h3>
                </div>
                 <div class="flex flex-col items-center">
                    <div class="bg-gradient-to-br from-purple-100 to-purple-200 w-24 h-24 rounded-full flex items-center justify-center mb-4 transition-transform hover:scale-110">
                       <i class="fas fa-users text-purple-500 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-800">Respeto</h3>
                </div>
                 <div class="flex flex-col items-center">
                    <div class="bg-gradient-to-br from-green-100 to-green-200 w-24 h-24 rounded-full flex items-center justify-center mb-4 transition-transform hover:scale-110">
                       <i class="fas fa-handshake-angle text-green-500 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-800">Amistad</h3>
                </div>
                 <div class="flex flex-col items-center">
                    <div class="bg-gradient-to-br from-yellow-100 to-yellow-200 w-24 h-24 rounded-full flex items-center justify-center mb-4 transition-transform hover:scale-110">
                       <i class="fas fa-globe-americas text-yellow-500 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-800">Diversidad</h3>
                </div>
                 <div class="flex flex-col items-center">
                    <div class="bg-gradient-to-br from-cyan-100 to-cyan-200 w-24 h-24 rounded-full flex items-center justify-center mb-4 transition-transform hover:scale-110">
                        <i class="fas fa-leaf text-cyan-500 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-800">Ecología</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Book Section =========== -->
    <section id="book" class="py-20 bg-gradient-to-b from-blue-50 to-indigo-100">
        <div class="container mx-auto px-4">
             <div class="text-center mb-16">
                <h2 class="section-title text-3xl md:text-4xl font-bold text-blue-900">El Cuento que lo Empezó Todo</h2>
            </div>
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16 bg-white p-8 sm:p-12 rounded-2xl shadow-xl">
                <div class="lg:w-2/5">
                    <img src="https://placehold.co/500x600/3b82f6/ffffff?text=Portada+del+Libro" alt="Portada del libro Obesita la Sirenita" class="w-full rounded-lg shadow-2xl transform hover:scale-105 transition-transform duration-500" loading="lazy">
                </div>
                
                <div class="lg:w-3/5 space-y-6">
                    <h3 class="text-4xl font-bold text-blue-800 comic-font">Obesita la Sirenita</h3>
                    <p class="text-lg text-gray-700">Acompaña a Obesita en un emocionante viaje de autodescubrimiento. Aprenderá que la verdadera magia reside en su corazón y que ser diferente es su mayor superpoder. Una historia que te recordará el valor de ser auténtico.</p>
                    
                    <div class="p-5 bg-blue-50 rounded-lg border-l-4 border-blue-500 text-gray-600">
                        <ul class="space-y-2">
                            <li><i class="fas fa-check-circle text-blue-500 mr-2"></i><strong>Edad recomendada:</strong> 4-8 años</li>
                            <li><i class="fas fa-check-circle text-blue-500 mr-2"></i>48 páginas a todo color con ilustraciones preciosas</li>
                            <li><i class="fas fa-check-circle text-blue-500 mr-2"></i>Incluye actividades para fomentar la creatividad</li>
                            <li><i class="fas fa-check-circle text-blue-500 mr-2"></i>Impreso en papel reciclado con tintas ecológicas</li>
                        </ul>
                    </div>
                    
                    <div>
                        <p class="text-4xl font-bold text-blue-800 mb-4">15.99 €</p>
                        <a href="#" class="w-full text-center bg-blue-600 text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-blue-700 transition-transform hover:scale-105 shadow-lg inline-block">
                            <i class="fas fa-shopping-cart mr-3"></i>Comprar Ahora
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- =========== Gemini API Section =========== -->
    <section id="create-story" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="section-title text-3xl md:text-4xl font-bold text-blue-900">Crea Tu Propio Cuento Mágico</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto mt-4">
                    ¡Usa tu imaginación y crea una nueva aventura! Escribe tus ideas y la magia de la IA creará un cuento solo para ti.
                </p>
            </div>
            <div class="max-w-2xl mx-auto bg-gradient-to-br from-blue-50 to-indigo-100 p-8 rounded-2xl shadow-xl">
                <form id="storyForm" class="space-y-6">
                    <div>
                        <label for="characterName" class="block text-gray-700 font-semibold mb-2">1. Nombre del protagonista</label>
                        <input type="text" id="characterName" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition" placeholder="Ej: El pececito Valiente" required>
                    </div>
                    <div>
                        <label for="storyValue" class="block text-gray-700 font-semibold mb-2">2. Un valor importante</label>
                        <input type="text" id="storyValue" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition" placeholder="Ej: la amistad, compartir, ser amable" required>
                    </div>
                    <div>
                        <label for="storyPlace" class="block text-gray-700 font-semibold mb-2">3. Un lugar mágico</label>
                        <input type="text" id="storyPlace" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition" placeholder="Ej: la cueva de los corales cantores" required>
                    </div>
                    <button type="submit" id="generateStoryBtn" class="w-full bg-yellow-400 text-blue-900 px-6 py-4 rounded-full font-bold text-lg hover:bg-yellow-500 transition-transform hover:scale-105 shadow-lg flex items-center justify-center">
                        <span class="btn-text">✨ ¡Generar mi Cuento!</span>
                    </button>
                </form>
            </div>

            <div id="storyResultWrapper" class="max-w-3xl mx-auto mt-12 hidden">
                 <div id="storyLoader" class="text-center hidden">
                    <div class="loader"></div>
                    <p class="text-lg text-blue-800 comic-font mt-4">Creando tu historia mágica...</p>
                </div>
                <div id="storyResult" class="bg-white p-8 sm:p-10 rounded-2xl border-4 border-blue-200 opacity-0">
                    <!-- El cuento generado aparecerá aquí -->
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Mission Section =========== -->
    <section id="mission" class="py-20 bg-gradient-to-b from-blue-50 to-indigo-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="section-title text-3xl md:text-4xl font-bold text-blue-900">Nuestra Misión</h2>
                 <p class="text-lg text-gray-600 max-w-3xl mx-auto mt-4">
                    Inspirar a los niños a ser ellos mismos, a quererse y a cuidar nuestro hermoso planeta.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <div class="bg-gray-50 rounded-xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-blue-800 mb-4">Nuestro Propósito</h3>
                    <p class="text-gray-600 mb-4">
                        Creemos que cada niño merece sentirse especial y valorado. Creamos historias que celebran la diversidad, fomentan la autoestima y enseñan valores a través de aventuras emocionantes y personajes inolvidables.
                    </p>
                </div>
                <div class="bg-gray-50 rounded-xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-blue-800 mb-4">Cómo Lo Hacemos</h3>
                    <ul class="list-disc list-inside text-gray-600 space-y-2">
                        <li>Creando personajes diversos y representativos.</li>
                        <li>Incorporando valores positivos en cada historia.</li>
                        <li>Colaborando con ilustradores de gran talento.</li>
                        <li>Donando parte de las ganancias a la conservación marina.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Author Section =========== -->
    <section id="author" class="py-20 bg-white">
        <div class="container mx-auto px-4">
             <div class="text-center mb-16">
                <h2 class="section-title text-3xl md:text-4xl font-bold text-blue-900">Conoce a la Autora</h2>
            </div>
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16 bg-white p-8 sm:p-12 rounded-2xl shadow-xl">
                <div class="lg:w-2/5">
                    <img src="https://placehold.co/500x500/818cf8/ffffff?text=Foto+de+Ana" alt="Retrato de Ana Alicia Gutiérrez Rupérez, la autora del libro." class="w-full rounded-full lg:rounded-lg shadow-md aspect-square object-cover" loading="lazy">
                </div>
                <div class="lg:w-3/5 space-y-5">
                    <h3 class="text-4xl font-bold text-blue-800">Ana Alicia Gutiérrez Rupérez</h3>
                    <p class="text-xl text-gray-600 font-light italic">"Mi misión es crear historias que abracen el corazón de los niños, que les susurren que son perfectos tal como son y que les inspiren a ser los guardianes de nuestro planeta."</p>
                    <p class="text-gray-700">Con más de 15 años de experiencia en educación infantil, Ana combina su pasión por la literatura y el mar para crear cuentos que no solo entretienen, sino que también educan y empoderan.</p>
                    <div class="flex space-x-5">
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-3xl" aria-label="Facebook de la autora"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-pink-600 hover:text-pink-800 text-3xl" aria-label="Instagram de la autora"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-cyan-600 hover:text-cyan-800 text-3xl" aria-label="Twitter de la autora"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Team Section =========== -->
    <section id="team" class="py-20 bg-gradient-to-b from-blue-50 to-indigo-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="section-title text-3xl md:text-4xl font-bold text-blue-900">Equipo Creativo</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto mt-4">
                    El talentoso equipo que da vida al mundo de Obesita.
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 max-w-5xl mx-auto">
                <div class="text-center bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform">
                    <img src="https://placehold.co/150x150/3b82f6/ffffff?text=Angélica" alt="Angélica Aguiar" class="w-32 h-32 rounded-full mb-4 mx-auto shadow-md">
                    <h3 class="text-2xl font-bold text-blue-800 mb-1">Angélica Aguiar</h3>
                    <p class="font-semibold text-blue-500 mb-3">Ilustradora Principal</p>
                    <p class="text-gray-600">Creadora de los hermosos mundos visuales que acompañan nuestras historias.</p>
                </div>
                <div class="text-center bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform">
                    <img src="https://placehold.co/150x150/06b6d4/ffffff?text=Carlos" alt="Carlos Martínez" class="w-32 h-32 rounded-full mb-4 mx-auto shadow-md">
                    <h3 class="text-2xl font-bold text-blue-800 mb-1">Carlos Martínez</h3>
                    <p class="font-semibold text-blue-500 mb-3">Editor Creativo</p>
                    <p class="text-gray-600">Garante de la calidad narrativa y coherencia de nuestras historias.</p>
                </div>
                <div class="text-center bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform">
                    <img src="https://placehold.co/150x150/10b981/ffffff?text=Luisa" alt="Luisa González" class="w-32 h-32 rounded-full mb-4 mx-auto shadow-md">
                    <h3 class="text-2xl font-bold text-blue-800 mb-1">Luisa González</h3>
                    <p class="font-semibold text-blue-500 mb-3">Especialista en Educación</p>
                    <p class="text-gray-600">Asegura que las historias sean adecuadas para el desarrollo infantil.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- =========== Testimonials Section =========== -->
    <section id="testimonials" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="section-title text-3xl md:text-4xl font-bold text-blue-900">Lo que dicen nuestros lectores</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform">
                    <i class="fas fa-quote-left text-blue-200 text-5xl absolute top-4 left-6 opacity-50 -z-1"></i>
                    <p class="text-gray-600 italic mb-6">"Mis hijos adoran a Obesita. Este cuento ha cambiado nuestra forma de hablar sobre la autoestima y el respeto en casa. ¡Una joya!"</p>
                    <div class="flex items-center">
                        <div class="w-14 h-14 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">M</div>
                        <div>
                            <h4 class="font-bold text-blue-800">María González</h4>
                            <p class="text-sm text-gray-500">Madre de dos</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform">
                    <i class="fas fa-quote-left text-blue-200 text-5xl absolute top-4 left-6 opacity-50 -z-1"></i>
                    <p class="text-gray-600 italic mb-6">"Utilizo este cuento en mi clase para enseñar valores. Los niños se identifican con Obesita y aprenden lecciones sobre amistad y ecología de una forma divertida."</p>
                     <div class="flex items-center">
                        <div class="w-14 h-14 bg-green-500 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">C</div>
                        <div>
                            <h4 class="font-bold text-blue-800">Carlos Martínez</h4>
                            <p class="text-sm text-gray-500">Maestro de Primaria</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform">
                    <i class="fas fa-quote-left text-blue-200 text-5xl absolute top-4 left-6 opacity-50 -z-1"></i>
                    <p class="text-gray-600 italic mb-6">"La historia de Obesita es perfecta para trabajar la diversidad. Los niños quedan fascinados con el mundo submarino y sus personajes."</p>
                     <div class="flex items-center">
                        <div class="w-14 h-14 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">L</div>
                        <div>
                            <h4 class="font-bold text-blue-800">Lucía Pérez</h4>
                            <p class="text-sm text-gray-500">Educadora infantil</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== FAQ Section =========== -->
    <section id="faq" class="py-20 bg-gradient-to-b from-blue-50 to-indigo-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="section-title text-3xl md:text-4xl font-bold text-blue-900">Preguntas Frecuentes</h2>
            </div>
            <div class="max-w-3xl mx-auto space-y-4">
                <div>
                    <button class="faq-btn flex justify-between items-center w-full text-left p-5 bg-white rounded-lg hover:bg-blue-100 transition-colors shadow-sm">
                        <span class="font-semibold text-lg text-blue-900">¿Para qué edad está recomendado el cuento?</span>
                        <i class="fas fa-chevron-down text-blue-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content">
                        <p class="text-gray-600 p-5 bg-white rounded-b-lg">El cuento está diseñado para niños de <strong>4 a 8 años</strong>. Es ideal para leer en voz alta a los más pequeños y para que los que empiezan a leer lo disfruten por sí mismos.</p>
                    </div>
                </div>
                 <div>
                    <button class="faq-btn flex justify-between items-center w-full text-left p-5 bg-white rounded-lg hover:bg-blue-100 transition-colors shadow-sm">
                        <span class="font-semibold text-lg text-blue-900">¿Qué valores principales se trabajan en la historia?</span>
                        <i class="fas fa-chevron-down text-blue-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content">
                        <p class="text-gray-600 p-5 bg-white rounded-b-lg">La historia se centra en la <strong>autoestima</strong>, el <strong>respeto a la diversidad</strong>, la <strong>amistad verdadera</strong> y la importancia de <strong>cuidar el ecosistema marino</strong>.</p>
                    </div>
                </div>
                 <div>
                    <button class="faq-btn flex justify-between items-center w-full text-left p-5 bg-white rounded-lg hover:bg-blue-100 transition-colors shadow-sm">
                        <span class="font-semibold text-lg text-blue-900">¿Realizáis envíos internacionales?</span>
                        <i class="fas fa-chevron-down text-blue-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content">
                        <p class="text-gray-600 p-5 bg-white rounded-b-lg">¡Sí! Realizamos envíos a todo el mundo. Los costes y tiempos de entrega varían según el destino. Puedes calcular el coste exacto en la página de pago.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Contact Section =========== -->
    <section id="contact" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="section-title text-3xl md:text-4xl font-bold text-blue-900">¡Hablemos!</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mt-4">
                    ¿Tienes preguntas, ideas o simplemente quieres saludar? ¡Nos encantará saber de ti!
                </p>
            </div>
            <div class="max-w-2xl mx-auto bg-white p-8 sm:p-10 rounded-2xl shadow-2xl">
                <form id="contactForm" action="https://formspree.io/f/TU_ID_UNICO" method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre</label>
                            <input type="text" id="name" name="name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition" placeholder="Tu nombre" required>
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                            <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition" placeholder="tu@email.com" required>
                        </div>
                    </div>
                    <div>
                        <label for="message" class="block text-gray-700 font-semibold mb-2">Mensaje</label>
                        <textarea id="message" name="message" rows="5" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition" placeholder="Escribe tu mensaje aquí..." required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-full font-bold text-lg hover:bg-blue-700 transition-transform hover:scale-105 shadow-lg">
                        Enviar Mensaje
                    </button>
                </form>
                <p id="formStatus" class="mt-4 text-center"></p>
            </div>
        </div>
    </section>
    
    <!-- =========== Modals (Pop-ups) =========== -->
    <div id="trailerModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center p-4 z-50 hidden" aria-modal="true" role="dialog">
        <div class="bg-white rounded-lg w-full max-w-3xl relative">
            <button id="closeTrailerModal" class="absolute -top-4 -right-4 w-10 h-10 bg-white text-black rounded-full text-2xl" aria-label="Cerrar vídeo">&times;</button>
            <div class="aspect-w-16 aspect-h-9">
                <iframe id="youtube-player" src="https://www.youtube.com/embed/dQw4w9WgXcQ?enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    
    <div id="subscriptionModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center p-4 z-50 opacity-0 invisible transition-opacity duration-500">
        <div class="bg-white rounded-xl p-8 max-w-md w-full relative transform scale-95 transition-transform duration-500">
            <button id="closeSubscriptionModal" class="absolute top-3 right-4 text-gray-500 hover:text-gray-800" aria-label="Cerrar suscripción">
                <i class="fas fa-times text-2xl"></i>
            </button>
            <div class="text-center">
                <h3 class="text-2xl font-bold text-blue-800 comic-font mb-2">¡Únete a la Aventura!</h3>
                <p class="text-gray-600 mb-6">Suscríbete para recibir noticias, actividades gratuitas y ofertas especiales.</p>
                <form id="subscriptionForm" action="https://formspree.io/f/TU_ID_UNICO_SUSCRIPCION" method="POST" class="space-y-4">
                    <div>
                        <label for="popup-email" class="sr-only">Email</label>
                        <input type="email" id="popup-email" name="email" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="tu@email.com" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-full font-bold hover:bg-blue-700 transition-transform hover:scale-105">
                        ¡Suscribirme!
                    </button>
                </form>
                 <p id="subscriptionStatus" class="mt-4 text-center"></p>
            </div>
        </div>
    </div>
    
    <!-- NOTA: El JavaScript se debe mover a un archivo main.js y encolarse en functions.php -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
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

        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        if (mobileMenuBtn && mobileMenu) {
            const mobileNavLinks = mobileMenu.querySelectorAll('a.nav-link');
            const toggleMenu = () => {
                const isHidden = mobileMenu.classList.toggle('hidden');
                mobileMenuBtn.setAttribute('aria-expanded', !isHidden);
            };
            mobileMenuBtn.addEventListener('click', toggleMenu);
            mobileNavLinks.forEach(link => link.addEventListener('click', () => {
                if (!mobileMenu.classList.contains('hidden')) toggleMenu();
            }));
        }

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
            setTimeout(showSubscriptionModal, 10000);
            closeSubscriptionModal.addEventListener('click', hideSubscriptionModal);
        }

        async function handleFormSubmit(event, form, statusElement) {
            event.preventDefault();
            const data = new FormData(event.target);
            try {
                const response = await fetch(form.action, {
                    method: form.method,
                    body: data,
                    headers: { 'Accept': 'application/json' }
                });
                if (response.ok) {
                    statusElement.textContent = "¡Gracias por tu mensaje!";
                    statusElement.className = 'mt-4 text-center text-green-600 font-semibold';
                    form.reset();
                    if(form.id === 'subscriptionForm') {
                         sessionStorage.setItem('subscribed', 'true');
                         setTimeout(hideSubscriptionModal, 2000);
                    }
                } else {
                    const responseData = await response.json();
                    statusElement.textContent = responseData.errors.map(error => error.message).join(", ");
                    statusElement.className = 'mt-4 text-center text-red-600 font-semibold';
                }
            } catch (error) {
                statusElement.textContent = "Oops! Hubo un problema al enviar el formulario.";
                statusElement.className = 'mt-4 text-center text-red-600 font-semibold';
            }
        }

        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            const contactStatus = document.getElementById('formStatus');
            contactForm.addEventListener('submit', (e) => handleFormSubmit(e, contactForm, contactStatus));
        }

        const subscriptionForm = document.getElementById('subscriptionForm');
        if (subscriptionForm) {
            const subscriptionStatus = document.getElementById('subscriptionStatus');
            subscriptionForm.addEventListener('submit', (e) => handleFormSubmit(e, subscriptionForm, subscriptionStatus));
        }

        const sections = document.querySelectorAll('main section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        if (sections.length > 0 && navLinks.length > 0) {
            const observerOptions = { root: null, rootMargin: '0px 0px -75% 0px', threshold: 0 };
            const sectionObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    const id = entry.target.id;
                    const correspondingNavLink = document.querySelector(`.nav-link[href="#${id}"]`);
                    if (entry.isIntersecting) {
                        navLinks.forEach(link => link.classList.remove('active-link'));
                        if (correspondingNavLink) {
                            correspondingNavLink.classList.add('active-link');
                        }
                    }
                });
            }, observerOptions);
            sections.forEach(section => {
                sectionObserver.observe(section);
            });
        }
        
        const storyForm = document.getElementById('storyForm');
        if (storyForm) {
            const generateBtn = document.getElementById('generateStoryBtn');
            const storyResultWrapper = document.getElementById('storyResultWrapper');
            const storyResultDiv = document.getElementById('storyResult');
            const storyLoader = document.getElementById('storyLoader');

            const callGeminiAPI = async (prompt, retries = 3, delay = 1000) => {
                const apiKey = "";
                const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-preview-05-20:generateContent?key=${apiKey}`;
                const payload = { contents: [{ parts: [{ text: prompt }] }] };
                
                for (let i = 0; i < retries; i++) {
                    try {
                        const response = await fetch(apiUrl, {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify(payload)
                        });
                        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                        const result = await response.json();
                        const candidate = result.candidates?.[0];
                        if (candidate && candidate.content?.parts?.[0]?.text) {
                            return candidate.content.parts[0].text;
                        } else {
                            throw new Error('Respuesta inesperada de la API.');
                        }
                    } catch (error) {
                        console.error(`Intento ${i + 1} fallido:`, error);
                        if (i === retries - 1) throw error;
                        await new Promise(res => setTimeout(res, delay * Math.pow(2, i)));
                    }
                }
            };

            storyForm.addEventListener('submit', async (e) => {
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
                storyResultDiv.classList.remove('story-result-show');
                storyLoader.classList.remove('hidden');
                generateBtn.disabled = true;

                const prompt = `Escribe un cuento infantil muy corto, de no más de 150 palabras, ideal para un niño de 6 años. El personaje principal se llama '${characterName}'. La historia debe enseñar el valor de la '${storyValue}' y sucede en '${storyPlace}'. Usa un lenguaje sencillo, positivo y mágico, al estilo del cuento 'Obesita la Sirenita'.`;

                try {
                    const generatedStory = await callGeminiAPI(prompt);
                    storyResultDiv.innerHTML = `<p class="comic-font text-lg leading-relaxed text-gray-700">${generatedStory.replace(/\n/g, '<br>')}</p>`;
                } catch (error) {
                    storyResultDiv.innerHTML = '<p class="text-red-600">¡Oh, no! Hubo un problema creando tu cuento. Por favor, inténtalo de nuevo más tarde.</p>';
                    console.error('Error al llamar a la API de Gemini:', error);
                } finally {
                    storyLoader.classList.add('hidden');
                    storyResultDiv.classList.remove('hidden');
                    storyResultDiv.classList.add('story-result-show');
                    generateBtn.disabled = false;
                }
            });
        }
    });
    </script>

<?php get_footer(); ?>
