<?php
/**
 * Template du détail d'un projet - Affiche UN SEUL projet en détail
 * Fichier : single-projet.php
 * URL : /projets/plai/ (ou autre nom de projet)
 */

get_header(); ?>

    <main id="main" class="site-main" role="main">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <!-- Hero du projet -->
            <section class="project-hero">
                <div class="container">

                    <!-- Badge du type (Web/3D/2D) -->
                    <?php
                    $project_types = get_the_terms(get_the_ID(), 'type_projet');
                    if ($project_types && !is_wp_error($project_types)) : ?>
                        <div class="project-badges">
                            <?php foreach ($project_types as $type) : ?>
                                <span class="badge badge--<?php echo esc_attr(strtolower($type->name)); ?>">
                                <?php echo esc_html($type->name); ?>
                            </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="project-title"><?php the_title(); ?></h1>

                </div>
            </section>

            <!-- Contenu détaillé du projet -->
            <section class="project-content">
                <div class="container">

                    <!-- Image principale -->
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="project-featured-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Description détaillée (WYSIWYG ACF) -->
                    <div class="project-description">
                        <?php
                        // Si vous utilisez ACF pour le contenu détaillé
                        $detailed_content = get_field('description_detaillee');
                        if ($detailed_content) {
                            echo $detailed_content;
                        } else {
                            // Sinon, affiche le contenu de l'éditeur classique
                            the_content();
                        }
                        ?>
                    </div>

                    <!-- Galerie d'images ACF (optionnel) -->
                    <?php
                    $gallery = get_field('galerie_projet');
                    if ($gallery) : ?>
                        <div class="project-gallery">
                            <h2>Galerie d'images</h2>
                            <div class="gallery-grid">
                                <?php foreach ($gallery as $image) : ?>
                                    <img src="<?php echo esc_url($image['url']); ?>"
                                         alt="<?php echo esc_attr($image['alt']); ?>">
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Liens utiles -->
                    <?php
                    $project_link = get_field('lien_du_projet');
                    if ($project_link) : ?>
                        <div class="project-links">
                            <a href="<?php echo esc_url($project_link); ?>"
                               class="btn-primary"
                               target="_blank"
                               rel="noopener noreferrer">
                                Voir le projet en ligne →
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- Navigation entre projets (précédent/suivant) -->
                    <nav class="project-navigation">
                        <div class="nav-previous">
                            <?php previous_post_link('%link', '← Projet précédent'); ?>
                        </div>
                        <div class="nav-back">
                            <a href="<?php echo get_post_type_archive_link('projet'); ?>">
                                ← Retour à la galerie
                            </a>
                        </div>
                        <div class="nav-next">
                            <?php next_post_link('%link', 'Projet suivant →'); ?>
                        </div>
                    </nav>

                </div>
            </section>

        <?php endwhile; endif; ?>

    </main>

<?php get_footer(); ?>