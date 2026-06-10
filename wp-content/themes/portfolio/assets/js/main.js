console.log('test');
// JavaScript amélioré avec progressive enhancement
(function() {
    // Vérifier si JS est activé
    document.documentElement.classList.add('js-enabled');

    // Attendre que le DOM soit chargé
    document.addEventListener('DOMContentLoaded', function() {
        const filterContainer = document.querySelector('.filtres');
        const filterLinks = document.querySelectorAll('.filtre-link');

        if (!filterLinks.length) return;

        // Remplacer les liens par des boutons pour une meilleure UX (optionnel)
        filterLinks.forEach(link => {
            const filterValue = link.getAttribute('data-filter');
            if (!filterValue) return;

            // Garder le lien pour le fallback, mais ajouter un comportement JS
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Empêche la navigation en JS

                const category = this.getAttribute('data-filter');
                const currentUrl = new URL(window.location.href);

                // Mettre à jour l'URL sans rechargement
                if (category === 'all') {
                    currentUrl.searchParams.delete('filter');
                } else {
                    currentUrl.searchParams.set('filter', category);
                }

                window.history.pushState({}, '', currentUrl);

                // Filtrer avec AJAX
                filterProjects(category);

                // Mettre à jour la classe active
                filterLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        const projets = document.querySelectorAll('.projet');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        });

        projets.forEach(projet => {
            observer.observe(projet);
        });



    });
})();