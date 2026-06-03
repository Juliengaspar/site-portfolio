<?php
get_header(); ?>
<?php

?>

    <main id="main" class="site-main main" role="main" itemscope itemtype="https://schema.org/CollectionPage">

        <section class="projects-archive" aria-labelledby="projects-title">
            <div class="container">

                <h2 class="archive-title title" itemprop="headline" >Mes Projets</h2>

                <!-- Filtres par type de projet -->
<!--                <div class="projects-filters" role="group" aria-label="Filtrer les projets">-->
<!--                    <button class="filter-btn active" data-filter="all">Tous</button>-->
<!--                    <button class="filter-btn" data-filter="web">Web</button>-->
<!--                    <button class="filter-btn" data-filter="2d">2D</button>-->
<!--                    <button class="filter-btn" data-filter="3d">3D</button>-->
<!--               </div>-->
               <div class="projects-filters" role="group" aria-label="Filtrer les projets">
               <a href="?type=all" class="filter-btn">Tous</a>
               <a href="?type=web" class="filter-btn">Web</a>
               <a href="?type=2d" class="filter-btn">2D</a>
               <a href="?type=3d" class="filter-btn">3D</a>
               </div>

                <noscript>
                    <div class="no-js-message">
                        Pour profiter pleinement des fonctionnalités du site, veuillez activer JavaScript.
                    </div>
                </noscript>

                <!-- Grille des projets -->
                <div class="projects-grid" id="projects-grid" itemscope itemtype="https://schema.org/ItemList">
                    <?php
                    $type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : 'all';

                    $args = array(
                            'post_type'      => 'projet',
                            'posts_per_page' => -1,
                            'orderby'        => 'date',
                            'order'          => 'DESC'
                    );

                    if ($type !== 'all') {
                        $args['tax_query'] = array(
                                array(
                                        'taxonomy' => 'type_projet',
                                        'field'    => 'slug',
                                        'terms'    => $type,
                                ),
                        );
                    }

                    $projects_query = new WP_Query($args);

                    if ($projects_query->have_posts()) :
                        while ($projects_query->have_posts()) : $projects_query->the_post();
                            $imgProjets = get_field('img__project');


                            // Récupérer les types de projet
                            $project_types = get_the_terms(get_the_ID(), 'type_projet');
                            $type_classes = array();

                            if ($project_types && !is_wp_error($project_types)) {
                                foreach ($project_types as $type) {
                                    $type_classes[] = strtolower($type->name);
                                }
                            }
                            ?>

                            <article class="project-card <?php echo implode(' ', $type_classes); ?>" itemscope itemtype="https://schema.org/CreativeWork" itemprop="itemListElement" data-types="<?php echo implode(',', $type_classes); ?>">
                               <h2 class="sro">Liste de mes different projet</h2>
                                <?php if($imgProjets): ?>
                                    <div class="projet__img">
                                        <img class="projet__img__img" src="<?= $imgProjets['url']; ?>" alt="<?= $imgProjets['alt']; ?>" itemprop="image">
                                    </div>
                                <?php elseif (has_post_thumbnail()) : ?>
                                    <div class="projet__img">
                                        <?php the_post_thumbnail('medium', ['class' => 'projet__img__img', 'itemprop' => 'image']); ?>
                                    </div>
                                <?php endif; ?>

                                <section class="project-card__content">
                                    <h3 class="project-card__title" itemprop="name">
                                        <?php the_title(); ?>
                                    </h3>

                                    <div class="project-card__exemple" itemprop="description">
                                        <?php echo get_field('description__project'); ?>
                                    </div>
                                    <div class="project-card__link">
                                    <a href="<?php the_permalink(); ?>" class="project-card__btn btn"  itemprop="url" aria-label="Voir le projet" >
                                        Découvrir
                                    </a>
                                    </div>
                                </section>
                            </article>

                        <?php endwhile;
                        wp_reset_postdata();
                    else : ?>
                        <p class="no-projects">Aucun projet trouvé.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

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