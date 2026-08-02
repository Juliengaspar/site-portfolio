<?php /* Template Name: Projet */?>

<?php
get_header(); ?>
<?php

?>


    <main id="main" class="site-main main" role="main" itemscope itemtype="https://schema.org/CollectionPage">

        <section class="projects-archive" aria-labelledby="projects-title">
            <div class="container">
                <?php
                $page_id = get_the_ID(); // ou $post->ID
                var_dump( get_field('description_projet', $page_id) );
                $descriptionPage = get_field('description_projet', $page_id);
                ?>


                <h2 class="archive-title title" itemprop="headline">Découvrez mes projets.</h2>
<!--                <p class="text" itemprop="headline">-->
<!--                    --><?php //esc_html_e(
//                            'Découvrez mes projets en développement web, design graphique et modélisation 3D.',
//                            'portfolio'
//                    ); ?>
<!--                </p>-->
                <?php if ( $descriptionPage ) : ?>
                    <div><?php echo wp_kses_post( $descriptionPage ); ?></div>
                <?php else : ?>
<!--                    <p>Aucune description renseignée.</p>-->
                <?php endif; ?>

                <!-- Filtres par type de projet -->
<!--                <div class="projects-filters" role="group" aria-label="Filtrer les projets">-->
<!--                    <button class="filter-btn active" data-filter="all">Tous</button>-->
<!--                    <button class="filter-btn" data-filter="web">Web</button>-->
<!--                    <button class="filter-btn" data-filter="2d">2D</button>-->
<!--                    <button class="filter-btn" data-filter="3d">3D</button>-->
<!--               </div>-->
                <div class="projects-filters" role="group" aria-label="Filtrer les projets">

                    <?php
                    $current = $_GET['type'] ?? 'all';
                    ?>

                    <a href="?type=all"
                       class="filter-btn <?= $current === 'all' ? 'active' : ''; ?>">
                        Tous
                    </a>

                    <?php
                    $terms = get_terms(array(
                            'taxonomy'   => 'type_projet',
                            'hide_empty' => true,
                    ));

                    if (!is_wp_error($terms)) :
                        foreach ($terms as $term) :
                            ?>

                            <a href="?type=<?= esc_attr($term->slug); ?>"
                               class="filter-btn <?= $current === $term->slug ? 'active' : ''; ?>">
                                <?= esc_html($term->name); ?>
                            </a>

                        <?php
                        endforeach;
                    endif;
                    ?>

                </div>


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

                    $projects_query = new WP_Query($args); ?>

<?php if ($projects_query->have_posts()) : ?>
                    <?php while ($projects_query->have_posts()) : $projects_query->the_post(); ?>
                    <?php
                    $imgProjets = get_field('img__project');
                    $project_types = get_the_terms(get_the_ID(), 'type_projet');
                    $type_classes = array();
                    if ($project_types && !is_wp_error($project_types)) {
                        foreach ($project_types as $type) {
                            $type_classes[] = strtolower($type->name);
                        }
                    }
                    ?>

                    <article class="project-card <?php echo implode(' ', $type_classes); ?>" itemscope itemtype="https://schema.org/CreativeWork" itemprop="itemListElement" data-types="<?php echo implode(',', $type_classes); ?>">

                        <!-- Titre caché pour accessibilité -->
                        <h2 class="sro">Liste de mes différents projets</h2>

                        <!-- Image du projet -->
                        <?php if ($imgProjets) : ?>
                            <div class="projet__img">
                                <img class="projet__img__img"
                                     src="<?= esc_url($imgProjets['url']); ?>"
                                     alt="<?= esc_attr($imgProjets['alt']); ?>"
                                     itemprop="image"
                                     srcset="
                            <?= esc_url(wp_get_attachment_image_url($imgProjets['ID'], 'square-small')); ?> 400w,
                            <?= esc_url(wp_get_attachment_image_url($imgProjets['ID'], 'square-medium')); ?> 800w,
                            <?= esc_url(wp_get_attachment_image_url($imgProjets['ID'], 'square-large')); ?> 1200w
                            " sizes="(max-width: 768px) 90vw, (max-width: 1200px) 50vw,   400px"
                                >
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
                                <?php echo wp_kses_post(get_field('description__project')); ?>
                            </div>

                            <!-- ===== AJOUT DU RÉPÉTEUR TECHNOLOGIES ===== -->
                            <?php if (have_rows('liste__technologies')) : ?>
                                <ul class="project-techs" aria-label="Technologies utilisées pour ce projet">
                                    <?php while (have_rows('liste__technologies')) : the_row();
                                        // Récupération du sous-champ "technologies" (texte simple)
                                        $tech_name = get_sub_field('technologies');
                                        if ($tech_name) : ?>
                                            <li class="project-tech"><?= $tech_name; ?></li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                            <!-- ===== FIN AJOUT ===== -->

                            <div class="project-card__link">
                                <a href="<?php the_permalink(); ?>" class="project-card__btn btn" itemprop="url" aria-label="Voir le projet">
                                    Voir les détails →
                                </a>
                            </div>
                        </section>
                    </article>

                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                    <p class="no-projects">Aucun projet trouvé.</p>
                    <?php endif; ?>
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