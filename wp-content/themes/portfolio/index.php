<?php /* Template Name: Homepage */?>
<?php
$titlePage = get_field('title__page');
$subtitleAcceuil = get_field('hero__subtitle');
$titleListeProjet = get_field('title__projet');
$subtitleProjet = get_field('subtitle__projet');
$isteProjet = get_field('liste__projets');
$photoProfile = get_field('img__profile');
$name = get_field('name');
$description = get_field('hero__description');

?>
<?php get_header(); ?>
    <main class="main" id="primary" itemscope itemtype="https://schema.org/Person">
        <?php if ( $titlePage ) : ?>
<h2 class="title__page title"  itemprop="name"><?=  esc_html($titlePage);?></h2>
<?php endif; ?>

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

<!--TODO si j'ai un fichier cv -->
<!--                <a>-->
<!---->
<!--                    Télécharger mon CV-->
<!---->
<!--                </a>-->

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
                            class="hero__features-icon" ;
                    >
                <?php endif; ?>

                <p><?= $title ?></p>
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
<section class="projects">
    <div class="container">

        <header class="section-header">
                <h2 class="projects__title" itemprop="name"><?=esc_html($titleListeProjet); ?></h2>
            <p class="projects__description"> <?= esc_html($subtitleProjet) ?> </p>

        </header>
           <?php if( have_rows('liste__projets') ): ?>

            <ul class="projects__grid" itemscope itemtype="https://schema.org/ItemList">
                <?php while( have_rows('liste__projets') ): the_row();
                    $titleProjet = get_sub_field('title__projet');
                    $descriptionProjet = get_sub_field('description__projet');
                    $image = get_sub_field('projet__img');
                    $liensProjet = get_sub_field('link__projet');
                    ?>
                    <li class="liste-projets__projet"  itemprop="itemListElement" itemscope itemtype="https://schema.org/CreativeWork" role="list">
                        <article class="liste-projets__img">
                            <?php if($image): ?>
                                <img class="img" src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>" itemprop="image" width="<?= esc_attr($image['width']); ?>" height="<?= esc_attr($image['height']); ?>"
                                     loading="lazy"
                                     decoding="async"
                                srcset="
                                <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-small')); ?> 400w,
                                <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-medium')); ?> 800w,
                                <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-large')); ?> 1200w
                                " sizes="(max-width: 768px) 90vw, (max-width: 1200px) 50vw,   400px">
                            <?php endif; ?>

                            <section class="liste-projets__content">
                        <h3 class="liste-projets__singel-title" itemprop="name"><?= $titleProjet; ?></h3>
                        <div class="liste-projets__projet-description" itemprop="description">
                            <div class="description-wrapper">

                                <div class="description-text">
                                    <?= wp_kses_post($descriptionProjet); ?>
                                </div>

                                <button class="voir-plus" aria-expanded="false">
                                    Voir plus
                                </button>

                            </div>

                            <?php if( have_rows('technologies') ): ?>

                            <ul class="project-techs" aria-label="Technologies utilisées pour ce projet">
                                <?php while ( have_rows('technologies') ) : the_row();
                                    $techName = get_sub_field('nom_technologie');
                                    if ( $techName ) : ?>
                                        <li class="project-tech"><?= wp_kses_post($techName); ?></li>
                                    <?php endif;
                                endwhile; ?>
                            </ul>
                            <?php endif; ?>
                            <div class="liste-projets__btn">
                                <a href="<?=esc_url($liensProjet['url']); ?>" title="<?= esc_attr($liensProjet['title']); ?>" class="liste-projets__links" itemprop="url">Voir le projet </a><span>&rarr;</span>
                            </div>
                        </div>
                            </section>
                        </article>

                        <?php if($liensProjet): ?>
                        <?php endif; ?>
                <?php endwhile; ?>
                    </li>
            </ul>
        <?php else: ?>

            <p>Aucun projet trouvé.</p>

        <?php endif; ?>



        <div class="projects__footer">
            <?php
            $lienAll = get_field('link__all__projet');
            if ( $lienAll ) : ?>
                <div class="redirections btn">
                    <a href="<?= esc_url($lienAll['url']); ?>" class="redirections__link">
                        Voir tous mes projets <span>&rarr;</span> &nbsp;</a>
                </div>
            <?php endif; ?>
        </div>

    </div>

</section>


        <section class="cta">

            <div class="container">

                <div class="cta__content">

                    <div class="cta__text">

                        <h2>

                       <?php echo get_field("contact__title")?>

                        </h2>

                        <p>

                       <?php echo get_field("contact__description")?>

                        </p>

                    </div>

                    <?php $contactAcceuil = get_field("contact__button"); ?>

                    <a class="cta__button"
                       href="<?= esc_url($contactAcceuil['url']); ?>"
                       title="<?= esc_attr($contactAcceuil['title']); ?>">
                        <?= esc_html($contactAcceuil['title']); ?><span>&rarr;</span>
                    </a>

                </div>

            </div>

        </section>

</main>
<?php get_footer(); ?>