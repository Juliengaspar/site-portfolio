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

        // Fonction de filtrage AJAX
        function filterProjects(category) {
            const xhr = new XMLHttpRequest();
            const url = new URL(window.location.href);

            if (category === 'all') {
                url.searchParams.delete('filter');
            } else {
                url.searchParams.set('filter', category);
            }

            xhr.open('GET', url);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = xhr.responseText;

                    const newGrid = tempDiv.querySelector('.grid-projets');
                    const oldGrid = document.querySelector('.grid-projets');

                    if (newGrid && oldGrid) {
                        oldGrid.innerHTML = newGrid.innerHTML;
                    }
                }
            };
            xhr.send();
        }

        // Gérer le bouton retour/précédent
        window.addEventListener('popstate', function() {
            const url = new URL(window.location.href);
            const filter = url.searchParams.get('filter') || 'all';

            filterLinks.forEach(link => {
                const linkFilter = link.getAttribute('data-filter');
                if (linkFilter === filter) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });

            filterProjects(filter);
        });
    });
})();