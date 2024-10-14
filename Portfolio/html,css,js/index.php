<?php

// Configurazione dell'email destinataria
$to = "ciro.cefariello2006@hotmail.com"; // Sostituisci con la tua email reale
$subject = "Nuovo messaggio dal Portfolio";

// Inizializza variabili per feedback
$feedback = "";
$feedback_class = "";

// Funzione per sanitizzare l'input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Gestione del modulo di contatto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera e sanitizza i dati
    $name = sanitize_input($_POST['name']);
    $cognome = sanitize_input($_POST['cognome']);
    $email = sanitize_input($_POST['email']);
    $message = sanitize_input($_POST['message']);

    // Validazione dei campi
    if (empty($name) || empty($cognome) || empty($email) || empty($message)) {
        $feedback = "Per favore, completa tutti i campi.";
        $feedback_class = "bg-red-100 text-red-700";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $feedback = "Indirizzo email non valido.";
        $feedback_class = "bg-red-100 text-red-700";
    } else {
        // Costruisci il corpo dell'email
        $body = "Nome: $name $cognome\n";
        $body .= "Email: $email\n\n";
        $body .= "Messaggio:\n$message";

        // Intestazioni dell'email
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Invio dell'email
        if (mail($to, $subject, $body, $headers)) {
            $feedback = "Messaggio inviato con successo!";
            $feedback_class = "bg-green-100 text-green-700";
        } else {
            $feedback = "Si è verificato un errore durante l'invio del messaggio. Riprova più tardi.";
            $feedback_class = "bg-red-100 text-red-700";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - Ciro Cefariello</title>
    
    <!-- Meta Tag SEO -->
    <meta name="description" content="Portfolio di Ciro Cefariello - Sviluppatore appassionato di tecnologia, editing video, programmazione e musica.">
    <meta property="og:title" content="Portfolio - Ciro Cefariello">
    <meta property="og:description" content="Portfolio di Ciro Cefariello - Sviluppatore appassionato di tecnologia, editing video, programmazione e musica.">
    <meta property="og:image" content="images/ciro.jpg">
    <meta property="og:url" content="https://www.tuodominio.com">
    <meta name="twitter:card" content="summary_large_image">
    
    <!-- Importa Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Importa Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Importa Font Awesome per le icone -->
    <script src="https://kit.fontawesome.com/tuo-codice-univoco.js" crossorigin="anonymous"></script>
    
    <!-- Importa GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    
    <!-- Configura Tailwind per utilizzare Google Fonts e Dark Mode -->
    <script>
      tailwind.config = {
        darkMode: 'class', // Abilita il dark mode
        theme: {
          extend: {
            fontFamily: {
              poppins: ['Poppins', 'sans-serif'],
            },
          }
        }
      }
    </script>
    
    <style>
        /* (Il tuo stile CSS personalizzato qui) */
        /* ... Mantieni il tuo stile originale ... */
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-poppins scroll-smooth dark:bg-gray-900 dark:text-gray-100">
    <!-- Loading Spinner -->
    <div id="loading">
        <svg class="animate-spin h-10 w-10 text-gray-900 dark:text-gray-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>
    </div>

    <!-- Dark Mode Toggle -->
    <div id="dark-mode-toggle" class="flex items-center justify-center" aria-label="Toggle Dark Mode">
        <!-- Icone Font Awesome per Luna e Sole -->
        <i id="theme-icon" class="fas fa-moon text-2xl"></i>
    </div>

    <!-- Header -->
    <header class="bg-gray-900 text-white fixed top-0 w-full flex justify-between items-center py-4 px-8 shadow-lg z-50">
        <!-- Logo con immagine e testo -->
        <div class="flex items-center relative">
            <img src="images/logo.png" alt="Logo di Ciro Cefariello" class="logo-img rounded-full mr-4 shadow-lg">
            <span class="text-2xl font-semibold tracking-wide">Il Mio Portfolio</span>
        </div>

        <!-- Navigazione principale -->
        <nav class="hidden md:flex space-x-6">
            <a href="#home" class="text-white hover:text-gray-300 transition">Home</a>
            <a href="#about" class="text-white hover:text-gray-300 transition">Chi Sono</a>
            <a href="#projects" class="text-white hover:text-gray-300 transition">Progetti</a>
            <a href="#info" class="text-white hover:text-gray-300 transition">Info</a>
            <a href="#contact" class="text-white hover:text-gray-300 transition">Contattami</a>
        </nav>

        <!-- Menu Hamburger (visibile su mobile) -->
        <div class="md:hidden flex flex-col items-center justify-center space-y-1 cursor-pointer hamburger" id="hamburger" aria-label="Menu">
            <span class="block w-6 h-0.5 bg-white line1"></span>
            <span class="block w-6 h-0.5 bg-white line2"></span>
            <span class="block w-6 h-0.5 bg-white line3"></span>
        </div>
    </header>

    <!-- Mobile Nav Links (nascosti di default) -->
    <div class="fixed top-0 right-0 h-full w-2/3 bg-gray-900 text-white flex flex-col items-center justify-start pt-20 transform translate-x-full transition-transform duration-300 ease-in-out z-1000" id="nav-links">
        <!-- Freccia Indietro -->
        <div id="back-arrow" aria-label="Torna indietro">
            <i class="fas fa-arrow-left"></i>
        </div>
        <a href="#home" class="mb-6 text-2xl hover:text-gray-300 transition">Home</a>
        <a href="#about" class="mb-6 text-2xl hover:text-gray-300 transition">Chi Sono</a>
        <a href="#projects" class="mb-6 text-2xl hover:text-gray-300 transition">Progetti</a>
        <a href="#info" class="mb-6 text-2xl hover:text-gray-300 transition">Info</a>
        <a href="#contact" class="mb-6 text-2xl hover:text-gray-300 transition">Contattami</a>
    </div>

    <!-- Sezione Home -->
    <section id="home" class="pt-32 h-screen parallax-bg bg-gradient-to-br from-yellow-400 to-gray-900 text-white flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-5xl font-bold mb-4 tracking-tight">Benvenuti nel mio Portfolio!</h1>
            <p class="text-2xl font-light tracking-wide">Esplora i miei progetti e scopri di più su di me.</p>
        </div>
    </section>

    <!-- Sezione Chi Sono -->
    <section id="about" class="py-16 bg-gray-100 text-center">
        <h2 class="text-4xl font-semibold mb-8 tracking-wide">Chi Sono</h2>
        <img src="images/ciro.jpg" alt="Foto Profilo di Ciro Cefariello" class="w-40 h-40 rounded-full mx-auto mb-6 shadow-lg transition-transform hover:scale-110">
        <p class="text-lg font-light max-w-2xl mx-auto leading-relaxed">
            Ciao, sono Ciro Cefariello. Sono uno sviluppatore appassionato di tecnologia, editing video, programmazione, musica e tanto altro...
        </p>
    </section>

    <!-- Sezione Progetti -->
    <section id="projects" class="py-16 bg-white text-center">
        <h2 class="text-4xl font-semibold mb-8 tracking-wide">Progetti</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-8">
            <!-- Progetto 1 -->
            <div class="bg-gray-200 p-6 rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
                <img src="images/accademia.png" alt="IlDitoNellOcchioAcademy" class="w-full h-48 object-cover rounded mb-4 cursor-pointer" onclick="openModal('modal-project1')">
                <h3 class="text-2xl font-semibold mb-2">IlDitoNellOcchioAcademy</h3>
                <p class="text-lg font-light">
                    <!-- Descrizione del progetto -->
                    <!-- ... -->
                </p>
            </div>
            <!-- Progetto 2 -->
            <div class="bg-gray-200 p-6 rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
                <img src="images/pegasus.png" alt="Pegasus Animation" class="w-full h-48 object-cover rounded mb-4 cursor-pointer" onclick="openModal('modal-project2')">
                <h3 class="text-2xl font-semibold mb-2">Pegasus Animation</h3>
                <p class="text-lg font-light">
                    <!-- Descrizione del progetto -->
                    <!-- ... -->
                </p>
            </div>
            <!-- Aggiungi altri progetti qui -->
        </div>
    </section>

    <!-- Sezione Info -->
    <section id="info" class="py-16 bg-gray-100 text-center">
        <h2 class="text-4xl font-semibold mb-8 tracking-wide">Info</h2>
        <p class="mb-8 text-lg font-light">Per qualsiasi informazione, puoi contattarmi su:</p>

        <!-- Contenitore per le Immagini Social -->
        <div class="flex justify-center space-x-6 mb-8">
            <!-- LinkedIn -->
            <a href="https://www.linkedin.com/in/tuo-profilo" target="_blank" class="transition transform hover:scale-110">
                <img src="images/linkedin.png" alt="LinkedIn" class="w-12 h-12 object-contain">
            </a>
            <!-- GitHub -->
            <a href="https://github.com/tuo-username" target="_blank" class="transition transform hover:scale-110">
                <img src="images/github.png" alt="GitHub" class="w-12 h-12 object-contain">
            </a>
            <!-- Twitter -->
            <a href="https://twitter.com/tuo-username" target="_blank" class="transition transform hover:scale-110">
                <img src="images/x.png" alt="Twitter" class="w-12 h-12 object-contain">
            </a>
            <!-- Instagram -->
            <a href="https://www.instagram.com/tuo-profilo" target="_blank" class="transition transform hover:scale-110">
                <img src="images/instagram.jpg" alt="Instagram" class="w-12 h-12 object-contain">
            </a>
            <!-- YouTube -->
            <a href="https://www.youtube.com/tuo-profilo" target="_blank" class="transition transform hover:scale-110">
                <img src="images/yt.jpg" alt="YouTube" class="w-12 h-12 object-contain">
            </a>
            <!-- TikTok -->
            <a href="https://www.tiktok.com/@ilditonellocchioacademy" target="_blank" class="transition transform hover:scale-110">
                <img src="images/tiktok.png" alt="TikTokages" class="w-12 h-12 object-contain">
            </a>
        </div>
    </section>

    <!-- Sezione Contattami -->
    <section id="contact" class="py-16 bg-white text-center">
        <div class="max-w-2xl mx-auto bg-gradient-to-r from-indigo-50 to-purple-100 p-8 rounded-3xl shadow-2xl" data-aos="fade-up">
            <h2 class="text-4xl font-semibold mb-6 text-gray-800 tracking-wide">Contattami</h2>

            <!-- Feedback dell'invio del modulo -->
            <?php if (!empty($feedback)): ?>
                <div class="mb-6 p-4 rounded <?php echo $feedback_class; ?>">
                    <?php echo $feedback; ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="space-y-6">
                <!-- Nome e Cognome in una riga -->
                <div class="flex flex-col md:flex-row md:space-x-4">
                    <div class="flex-1">
                        <label for="name" class="block text-left mb-2 text-gray-700">Nome:</label>
                        <input type="text" id="name" name="name" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow hover:shadow-lg 
                            placeholder-gray-400"
                            value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
                    </div>
                    <div class="flex-1 mt-4 md:mt-0">
                        <label for="cognome" class="block text-left mb-2 text-gray-700">Cognome:</label>
                        <input type="text" id="cognome" name="cognome" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow hover:shadow-lg 
                            placeholder-gray-400"
                            value="<?php echo isset($cognome) ? htmlspecialchars($cognome) : ''; ?>">
                    </div>
                </div>
                <!-- Email -->
                <div>
                    <label for="email" class="block text-left mb-2 text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow hover:shadow-lg 
                        placeholder-gray-400"
                        value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                </div>
                <!-- Messaggio -->
                <div>
                    <label for="message" class="block text-left mb-2 text-gray-700">Messaggio:</label>
                    <textarea id="message" name="message" rows="5" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow hover:shadow-lg 
                        placeholder-gray-400"><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea>
                </div>
                <!-- Pulsante Invia -->
                <button type="submit" 
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition-transform transform hover:-translate-y-1 
                    shadow-md">
                    Invia
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6">
        <div class="container mx-auto text-center">
            <p class="mb-2">&copy; 2024 Ciro Cefariello. Tutti i diritti riservati.</p>
            <div class="flex justify-center space-x-4">
                <a href="https://www.linkedin.com/in/tuo-profilo" target="_blank" class="hover:text-gray-300">
                    <i class="fab fa-linkedin text-xl"></i>
                </a>
                <a href="https://github.com/tuo-username" target="_blank" class="hover:text-gray-300">
                    <i class="fab fa-github text-xl"></i>
                </a>
                <a href="https://twitter.com/tuo-username" target="_blank" class="hover:text-gray-300">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
                <a href="https://www.instagram.com/tuo-profilo" target="_blank" class="hover:text-gray-300">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
                <a href="https://www.youtube.com/tuo-profilo" target="_blank" class="hover:text-gray-300">
                    <i class="fab fa-youtube text-xl"></i>
                </a>
                <a href="https://www.tiktok.com/@tuo-profilo" target="_blank" class="hover:text-gray-300">
                    <i class="fab fa-tiktok text-xl"></i>
                </a>
            </div>
        </div>
    </footer>

    <!-- Back-to-Top Button -->
    <div id="back-to-top" class="fixed bottom-80 right-20 bg-gray-700 text-white p-3 rounded-full cursor-pointer hover:bg-gray-800 transition-colors" aria-label="Back to Top">
        <i class="fas fa-chevron-up text-xl"></i>
    </div>

    <!-- JavaScript per gestire il menu, il toggle dark mode, il back-to-top, i modali e il loading spinner -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hamburger = document.getElementById('hamburger');
            const navLinks = document.getElementById('nav-links');
            const backArrow = document.getElementById('back-arrow');
            const backToTop = document.getElementById('back-to-top');
            const darkModeToggle = document.getElementById('dark-mode-toggle');
            const themeIcon = document.getElementById('theme-icon');
            const loading = document.getElementById('loading');
            const modals = document.querySelectorAll('.modal');
            const closeModalButtons = document.querySelectorAll('.close-modal');

            // Funzione per attivare/disattivare il menu mobile
            const toggleMenu = () => {
                navLinks.classList.toggle('translate-x-full');
                hamburger.classList.toggle('toggle');
                // Mostra o nascondi la freccia di ritorno in base allo stato del menu
                backArrow.style.display = navLinks.classList.contains('translate-x-full') ? 'none' : 'block';
            };

            // Event listener per l'hamburger
            hamburger.addEventListener('click', toggleMenu);

            // Event listener per la freccia indietro
            backArrow.addEventListener('click', toggleMenu);

            // Funzione per animare l'icona hamburger
            const animateHamburger = () => {
                const line1 = hamburger.querySelector('.line1');
                const line2 = hamburger.querySelector('.line2');
                const line3 = hamburger.querySelector('.line3');

                line1.classList.toggle('rotate-45');
                line1.classList.toggle('origin-top-left');

                line2.classList.toggle('opacity-0');

                line3.classList.toggle('-rotate-45');
                line3.classList.toggle('origin-bottom-left');
            };

            // Event listener per animare l'hamburger
            hamburger.addEventListener('click', animateHamburger);

            // Funzione per chiudere il menu mobile quando si clicca su un link
            const navItems = document.querySelectorAll('#nav-links a');
            navItems.forEach(item => {
                item.addEventListener('click', () => {
                    navLinks.classList.add('translate-x-full');
                    hamburger.classList.remove('toggle');
                    backArrow.style.display = 'none';

                    const line1 = hamburger.querySelector('.line1');
                    const line2 = hamburger.querySelector('.line2');
                    const line3 = hamburger.querySelector('.line3');

                    line1.classList.remove('rotate-45');
                    line1.classList.remove('origin-top-left');

                    line2.classList.remove('opacity-0');

                    line3.classList.remove('-rotate-45');
                    line3.classList.remove('origin-bottom-left');
                });
            });

            // Funzione per mostrare/nascondere il pulsante back-to-top
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    backToTop.classList.remove('hidden');
                    backToTop.classList.add('block');
                } else {
                    backToTop.classList.remove('block');
                    backToTop.classList.add('hidden');
                }
            });

            // Funzione per scrollare in cima quando si clicca sul pulsante back-to-top
            backToTop.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Funzione per attivare/disattivare la modalità scura
            darkModeToggle.addEventListener('click', () => {
                document.documentElement.classList.toggle('dark');
                // Cambia l'icona a seconda del tema
                if (document.documentElement.classList.contains('dark')) {
                    themeIcon.classList.remove('fa-moon');
                    themeIcon.classList.add('fa-sun');
                } else {
                    themeIcon.classList.remove('fa-sun');
                    themeIcon.classList.add('fa-moon');
                }
            });

            // Funzione per aprire il modal
            window.openModal = function(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'flex';
                    gsap.from(modal.querySelector('.modal-content'), { opacity: 0, scale: 0.8, duration: 0.3, ease: "power3.out" });
                }
            };

            // Funzione per chiudere il modal
            closeModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    modals.forEach(modal => {
                        gsap.to(modal.querySelector('.modal-content'), { opacity: 0, scale: 0.8, duration: 0.3, ease: "power3.in", onComplete: () => {
                            modal.style.display = 'none';
                        } });
                    });
                });
            });

            // Chiudi il modal cliccando fuori dal contenuto
            window.addEventListener('click', (event) => {
                modals.forEach(modal => {
                    if (event.target === modal) {
                        gsap.to(modal.querySelector('.modal-content'), { opacity: 0, scale: 0.8, duration: 0.3, ease: "power3.in", onComplete: () => {
                            modal.style.display = 'none';
                        } });
                    }
                });
            });

            // Gestione del caricamento della pagina (nasconde il loading spinner)
            window.addEventListener('load', () => {
                gsap.to("#loading", { opacity: 0, duration: 0.5, onComplete: () => {
                    loading.classList.add('hidden');
                } });

                // Animazioni con GSAP per le sezioni
                gsap.registerPlugin(ScrollTrigger);

                // Animazione di entrata per la sezione Home
                gsap.from("#home h1", { 
                    duration: 1, 
                    y: -50, 
                    opacity: 0, 
                    ease: "power3.out",
                    delay: 0.5
                });
                gsap.from("#home p", { 
                    duration: 1, 
                    y: 50, 
                    opacity: 0, 
                    ease: "power3.out",
                    delay: 1 
                });

                // Animazioni per le altre sezioni
                gsap.utils.toArray('section').forEach((section) => {
                    gsap.from(section, {
                        scrollTrigger: {
                            trigger: section,
                            start: "top 80%",
                        },
                        opacity: 0,
                        y: 50,
                        duration: 1,
                        ease: "power3.out",
                        stagger: 0.2
                    });
                });
            });
        });
    </script>
</body>
</html>