<?php
/**
 * Template pour l'affichage d'un projet individuel
 * Page détaillée d'un projet du portfolio
 *
 * @package Portfolio
 */
//TODO modifie class name projet similiaire
get_header();
?>

    <main id="main" class="single-projet main" role="main">
        <?php while (have_posts()) : the_post(); ?>
        <?php
            $titlePage = get_field('title__projet');
            $imgPage = get_field('projet__img');
            $descriptionPage = get_field('projet__description');
            $linkProjet = get_field('redirection__projet__ligne'); // lien externe
            ?>
        <h2 class="singel__projet__title title"><?= esc_html($titlePage) ?></h2>
        <article id="post-<?php the_ID(); ?>" <?php post_class('projet-single'); ?> itemscope itemtype="https://schema.org/CreativeWork">
            <!-- Hero Section avec titre et contexte -->
                <h3 id="projet-title" class="projet-hero__title" itemprop="name"><?php echo esc_html($titlePage ?: get_the_title()); ?></h3>
            <section class="projet-hero">
                <div class="projet-hero__contenu">
                    <?php if($imgPage): ?>
                        <img src="<?= esc_url($imgPage['url']); ?>"
                             alt="<?= esc_attr($imgPage['alt']); ?>"
                             class="projet-hero__img"
                             width="<?= esc_attr($imgPage['width']); ?>"
                             height="<?= esc_attr($imgPage['height']); ?>"
                             loading="lazy"
                             decoding="async"
                             itemprop="image">
                    <?php endif; ?>
                    <?php if ($descriptionPage) : ?>
                        <div class="projet-hero__description" itemprop="description">
                            <?=  wp_kses_post($descriptionPage); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
            <?php if ( $linkProjet && ! empty($linkProjet['url']) ) : ?>
                <div class="projet-redirection">
                    <a href="<?= esc_url($linkProjet['url']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                        <?= $linkProjet['title'] ?> →
                    </a>
                </div>
            <?php endif; ?>

<!--            Projets similaires -->
<!--            --><?php
//            $related_args = array(
//                    'post_type' => 'projet',
//                    'posts_per_page' => 3,
//                    'post__not_in' => array(get_the_ID()),
//                    'orderby' => 'date',
//                    'order'=> 'DESC'
//            );
//
//
//
//            $related = new WP_Query($related_args);
//
//            if ($related->have_posts()) : ?>
<!--                <section class="projets-similaires" aria-labelledby="related-title">-->
<!--                    <h2 id="related-title" class="section-title">Projets similaires</h2>-->
<!--                                <ul class="related-card related-grid">-->
<!--                            --><?php //while ($related->have_posts()) : $related->the_post(); ?>
<!--                                    <li class="related-card__content">-->
<!--                                        --><?php //if (has_post_thumbnail()) : ?>
<!--                                            <div class="related-card__image">-->
<!--                                                --><?php //the_post_thumbnail('medium', ['loading' => 'lazy']); ?>
<!--                                            </div>-->
<!--                                        --><?php //endif; ?>
<!--                        <div class="related-card__image">-->
<!--                                        <h3 class="related-card__title">-->
<!--                                            <a href="--><?php //the_permalink(); ?><!--">--><?php //the_title(); ?><!--</a>-->
<!--                                        </h3>-->
<!--                                        <a href="--><?php //the_permalink(); ?><!--" class="related-card__link"-->
<!--                                           aria-label="Découvrir le projet : --><?php //the_title_attribute(); ?><!--">-->
<!--                                            Découvrir le projet →-->
<!--                                        </a>-->
<!--                                    </li>-->
<!--                            --><?php //endwhile; ?>
<!--                                </ul>-->
<!--                </section>-->
<!--        </article>-->
<!--            --><?php //endif;


            wp_reset_postdata(); ?>
        <?php endwhile; ?>

    </main>

<?php get_footer(); ?>