<?php
/**
 * Template de la galerie - Affiche TOUS les projets en grille
 * Fichier : archive-projet.php
 * URL : /projets/
 */

get_header(); ?>

    <main id="main" class="site-main" role="main">

        <!-- En-tête de la galerie -->
        <section class="gallery-hero">
            <div class="container">
                <h1>Mes Projets</h1>
                <p>Découvrez l'ensemble de mes réalisations</p>
            </div>
        </section>

        <!-- Filtres Web/3D/2D (UNIQUEMENT sur la galerie) -->
        <section class="filters-section">
            <div class="container">
                <div class="filters-wrapper">
                    <button class="filter-btn active" data-filter="all">Tous</button>
                    <button class="filter-btn" data-filter="web">Web</button>
                    <button class="filter-btn" data-filter="3d">3D</button>
                    <button class="filter-btn" data-filter="2d">2D</button>
                </div>
            </div>
        </section>

        <!-- GRILLE des projets (PLUSIEURS projets) -->
        <section class="projects-grid-section">
            <div class="container">
                <div class="projects-grid">

                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>

                            <article class="project-card">
                                <a href="<?php the_permalink(); ?>" class="project-card__link">

                                    <figure class="project-card__image-wrapper">
                                        <?php the_post_thumbnail('medium_large'); ?>
                                    </figure>

                                    <div class="project-card__content">
                                        <h2><?php the_title(); ?></h2>
                                        <p><?php echo get_the_excerpt(); ?></p>

                                        <!-- BOUTON DÉCOUVRIR qui mène vers single-projet.php -->
                                        <span class="project-card__cta">
                                        Découvrir →
                                    </span>
                                    </div>

                                </a>
                            </article>

                        <?php endwhile; ?>
                    <?php endif; ?>

                </div>
            </div>
        </section>

    </main>

<?php get_footer(); ?>