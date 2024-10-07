const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');
const navItems = document.querySelectorAll('.nav-links li');

// Funzione per gestire l'apertura/chiusura del menu
const toggleMenu = () => {
    navLinks.classList.toggle('active');
    hamburger.classList.toggle('toggle');
    
    // Aggiorna l'attributo aria per l'accessibilità
    const isActive = navLinks.classList.contains('active');
    hamburger.setAttribute('aria-expanded', isActive);
};

// Aggiungi transizione all'apertura/chiusura del menu
hamburger.addEventListener('click', toggleMenu);

// Chiudi il menu quando si clicca su un link
navItems.forEach(item => {
    item.addEventListener('click', () => {
        navLinks.classList.remove('active');
        hamburger.classList.remove('toggle'); // Ripristina l'icona hamburger
        hamburger.setAttribute('aria-expanded', 'false'); // Aggiorna l'attributo aria
    });
});

// Chiudi il menu se si fa clic all'esterno
document.addEventListener('click', (event) => {
    if (!navLinks.contains(event.target) && !hamburger.contains(event.target)) {
        navLinks.classList.remove('active');
        hamburger.classList.remove('toggle');
        hamburger.setAttribute('aria-expanded', 'false'); // Aggiorna l'attributo aria
    }
});
