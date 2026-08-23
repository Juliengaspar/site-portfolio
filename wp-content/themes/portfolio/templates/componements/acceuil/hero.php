<?php
$titlePage = get_field('title__page');
$subtitleAcceuil = get_field('hero__subtitle');
$isteProjet = get_field('liste__projets');
$photoProfile = get_field('img__profile');
$name = get_field('name');
$description = get_field('hero__description');

?>
    <section class="hero" aria-labelledby="profile-title">

        <div class="container">
            <div class="hero__content">
                <span class="line"></span>
                <div class="hero__text" itemprop="description">
                    <p class="hero__subtitle">
                        <?= $subtitleAcceuil?>
                    <h3 id="profile-title" class="hero__name">
                        <?=  esc_html($name);?>
                    </h3>
                    <p class="hero__subtitle">
                        <?=  esc_html($titlePage);?>
                    </p>
                    <div  class="hero__description">
                        <?= wp_kses_post($description); ?>
                    </div>
                    <?php if( have_rows('hero__features') ): ?>
                    <ul class="hero__features">
                        <?php while( have_rows('hero__features') ): the_row(); ?>
                        <?php
                        $title= get_sub_field('titre');
                        $icone = get_sub_field('icone');
                        ?>

                        <li>

                            <?php if( $icone ): ?>
                                <img
                                    src="<?= get_template_directory_uri(); ?>/assets/icons/SVG/<?= esc_attr($icone); ?>.svg"
                                    alt=""
                                    aria-hidden="true"
                                    class="hero__features-icon"
                                >
                            <?php endif; ?>

                            <div class="hero__features__text"><?= wp_kses_post($title) ?></div>
                            <?php endwhile; ?>

                            <?php else: ?>

                                <p>Aucun competence utilisé.</p>

                            <?php endif; ?>
                        </li>
                    </ul>
                </div>

                <div class="hero__image">

                    <?php if ($photoProfile): ?>

                        <img
                            src="<?= esc_url(wp_get_attachment_image_url($photoProfile['ID'], 'square-medium')); ?>"

                            srcset="
                <?= esc_url(wp_get_attachment_image_url($photoProfile['ID'], 'square-small')); ?> 400w,
                <?= esc_url(wp_get_attachment_image_url($photoProfile['ID'], 'square-medium')); ?> 800w,
                <?= esc_url(wp_get_attachment_image_url($photoProfile['ID'], 'square-large')); ?> 1200w
            " sizes="(max-width: 768px) 90vw,
                   (max-width: 1200px) 50vw,
                   400px"
                            alt="<?= esc_attr($photoProfile['alt'] ?: 'Photo de profil'); ?>"
                            loading="lazy"
                            decoding="async"
                            fetchpriority="high"
                            width="<?= esc_attr($photoProfile['width']); ?>"
                            height="<?= esc_attr($photoProfile['height']); ?>"
                            itemprop="image"
                        >

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>