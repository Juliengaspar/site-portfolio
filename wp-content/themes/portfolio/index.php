<?php /* Template Name: Homepage */?>
<?php
$titleListeProjet = get_field('title__projet');
$isteProjet = get_field('liste__projets');
$photoProfile = get_field('img__profile');

$titlePage = get_field('title__page');
$name = get_field('name');
$description = get_field('descriptions');

?>
<?php get_header(); ?>
    <main class="main" itemscope itemtype="https://schema.org/Person">

        <noscript>
            <div class="no-js-message">
                Pour profiter pleinement des fonctionnalités du site, veuillez activer JavaScript.
            </div>
        </noscript>
<h2 class="title__page title"  itemprop="name"><?=  get_field('title__page')?></h2>
<section class="profile" aria-labelledby="profile-title">
    <h3 id="profile-title" class="sr-only">
    <?= $name?>
    </h3>
    <div class="profile__content">
            <div class="profile__content__description" itemprop="description">
             <?= ($description); ?>
            </div>

        <div class="profile__image">
            <div class="profile__image">
                <?php if ($photoProfile): ?>

                    <img
                            src="<?= esc_url(wp_get_attachment_image_url($photoProfile['ID'], 'square-medium')); ?>"

                            srcset="
                <?= esc_url(wp_get_attachment_image_url($photoProfile['ID'], 'square-small')); ?> 400w,
                <?= esc_url(wp_get_attachment_image_url($photoProfile['ID'], 'square-medium')); ?> 800w,
                <?= esc_url(wp_get_attachment_image_url($photoProfile['ID'], 'square-large')); ?> 1200w
            "

                            sizes="(max-width: 768px) 90vw,
                   (max-width: 1200px) 50vw,
                   400px"

                            alt="<?= esc_attr($photoProfile['alt'] ?: 'Photo de profil'); ?>"

                            loading="lazy"
                            decoding="async"

                            width="<?= esc_attr($photoProfile['width']); ?>"
                            height="<?= esc_attr($photoProfile['height']); ?>"

                            itemprop="image"
                    >

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

           <?php if( have_rows('liste__projets') ): ?>

            <section class="liste-projets" itemscope itemtype="https://schema.org/ItemList">
                <h3 class="liste-projets__projets__title" itemprop="name"><?= $titleListeProjet ?></h3>
                <?php while( have_rows('liste__projets') ): the_row();
                    $titleProjet = get_sub_field('title__projet');
                    $descriptionProjet = get_sub_field('description__projet');
                    $image = get_sub_field('projet__img');
                    $liensProjet = get_sub_field('link__projet');
                    ?>
                    <section class="liste-projets__projet"  itemprop="itemListElement" itemscope itemtype="https://schema.org/CreativeWork">
                        <div class="liste-projets__img">
                            <?php if($image): ?>
                                <img class="img" src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>" itemprop="image" width="<?= esc_attr($image['width']); ?>" height="<?= esc_attr($image['height']); ?>"
                                srcset="
                                <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-small')); ?> 400w,
                                <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-medium')); ?> 800w,
                                <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-large')); ?> 1200w
                                " sizes="(max-width: 768px) 90vw, (max-width: 1200px) 50vw,   400px"
                            <?php endif; ?>
                        </div>
                        <h4 class="liste-projets__singel-title" itemprop="name"><?= $titleProjet; ?></h4>
                        <p class="liste-projets__projet-description" itemprop="description"><?= $descriptionProjet; ?></p>
                        <?php if($liensProjet): ?>
                            <div class="liste-projets__btn">
                                <a href="<?= $liensProjet['url']; ?>" title="<?= $liensProjet['title']; ?>" class="liste-projets__links" itemprop="url" aria-label="Découvrir le projet"><?= $liensProjet['title']; ?></a>
                            </div>
                        <?php endif; ?>
                    </section>
                <?php endwhile; ?>

        <?php else: ?>

            <p>Aucun projet trouvé.</p>

        <?php endif; ?>
    </section>
        <section>
            <h2 class="redirections btn">

                <?php
                $lien = get_field('link__all__projet');
                ?>

                <?php if($lien): ?>

                    <a href="<?=$lien['url']?>"  title=" <?= $lien['title']; ?>" class="redirections__link">
                        <?= $lien['title']; ?>
                    </a>

                <?php endif; ?>

            </h2>
        </section>
</main>
<?php get_footer(); ?>