<?php /* Template Name: Projet */?>

<?php
get_header(); ?>
<?php

?>


    <main id="main" class="site-main main" role="main" itemscope itemtype="https://schema.org/CollectionPage">
        <?php get_template_part('templates/componements/ Projets/galeries');  ?>

    </main>

    <script>
        // Filtrage des projets en JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const projectCards = document.querySelectorAll('.project-card');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const filterValue = this.getAttribute('data-filter');

                    // Mettre à jour la classe active sur les boutons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    // Filtrer les projets
                    projectCards.forEach(card => {
                        if (filterValue === 'all') {
                            card.style.display = 'block';
                        } else {
                            const cardTypes = card.getAttribute('data-types');
                            if (cardTypes && cardTypes.includes(filterValue)) {
                                card.style.display = 'block';
                            } else {
                                card.style.display = 'none';
                            }
                        }
                    });
                });
            });
        });
    </script>

<?php get_footer(); ?>