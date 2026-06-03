<?php
/**
 * Template pour l'affichage d'un projet individuel
 * Page détaillée d'un projet du portfolio
 *
 * @package Portfolio
 */

get_header();
?>

    <main id="main" class="single-projet main" role="main">
        <?php while (have_posts()) : the_post(); ?>
        <?php
            $titlePage = get_field('title__projet');
            $imgPage = get_field('projet__img');
            $descriptionPage = get_field('projet__description');
            ?>
        <h2 class="singel__projet__title title"><?= $titlePage ?></h2>

            <!-- Hero Section avec titre et contexte -->
            <header class="projet-hero" aria-labelledby="projet-title">
                <h3 class="projet-hero__title"><?= get_the_title() ?></h3>

                <div class="projet-hero__contenu">
                    <?php if($imgPage): ?>

                        <img src="<?= $imgPage['url']; ?>" alt="<?= $imgPage['alt']; ?>" class="projet-hero__img" width="<?= $imgPage['width']; ?>" height="<?= $imgPage['height']; ?>">

                    <?php endif; ?>
                    <div class="projet-hero__description">
                        <?= $descriptionPage?>
                    </div>
                </div>
            </header>

            <!-- Contenu principal du projet -->
            <article class="projet-content" id="projet-content">
                <div class="container">
                    <div class="projet-content__grid">

                        <!-- Section principale : Description -->
                        <div class="projet-description">
                            <!-- Champs personnalisés ACF ou avancés -->
                            <?php
                            $challenge = get_post_meta(get_the_ID(), 'challenge', true);
                            $solution = get_post_meta(get_the_ID(), 'solution', true);
                            $resultats = get_post_meta(get_the_ID(), 'resultats', true);
                            ?>

                            <?php if ($challenge) : ?>
                                <div class="projet-section">
                                    <h2 class="projet-section__title">🎯 Défi & Objectifs</h2>
                                    <div class="projet-section__content prose">
                                        <?php echo wp_kses_post($challenge); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($solution) : ?>
                                <div class="projet-section">
                                    <h2 class="projet-section__title">💡 Solution apportée</h2>
                                    <div class="projet-section__content prose">
                                        <?php echo wp_kses_post($solution); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($resultats) : ?>
                                <div class="projet-section">
                                    <h2 class="projet-section__title">📊 Résultats & Impact</h2>
                                    <div class="projet-section__content prose">
                                        <?php echo wp_kses_post($resultats); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Galerie d'images -->
                            <?php
                            $gallery = get_post_meta(get_the_ID(), 'projet_gallery', true);
                            if ($gallery) :
                                $gallery_ids = explode(',', $gallery);
                                if (!empty($gallery_ids)) : ?>
                                    <div class="projet-gallery">
                                        <h2 class="projet-section__title">📸 Galerie du projet</h2>
                                        <div class="gallery-grid">
                                            <?php foreach ($gallery_ids as $image_id) :
                                                $image_url = wp_get_attachment_image_url($image_id, 'medium_large');
                                                $image_full = wp_get_attachment_image_url($image_id, 'full');
                                                $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                                ?>
                                                <a href="<?php echo esc_url($image_full); ?>" class="gallery-item" data-lightbox="projet-gallery">
                                                    <img src="<?php echo esc_url($image_url); ?>"
                                                         alt="<?php echo esc_attr($image_alt ?: get_the_title()); ?>"
                                                         loading="lazy">
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Projets similaires -->
            <?php
            $related_args = array(
                    'post_type' => 'projet',
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'rand'
            );



            $related = new WP_Query($related_args);

            if ($related->have_posts()) : ?>
                <section class="projets-similaires" aria-labelledby="related-title">
                    <div class="container">
                        <h2 id="related-title" class="section-title">Projets similaires</h2>
                        <div class="related-grid">
                            <?php while ($related->have_posts()) : $related->the_post(); ?>
                                <article class="related-card">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="related-card__image">
                                            <?php the_post_thumbnail('medium', ['loading' => 'lazy']); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="related-card__content">
                                        <h3 class="related-card__title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <a href="<?php the_permalink(); ?>" class="related-card__link">
                                            Découvrir →
                                        </a>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </section>
            <?php endif;
            wp_reset_postdata(); ?>

        <?php endwhile; ?>

    </main>

<?php get_footer(); ?>