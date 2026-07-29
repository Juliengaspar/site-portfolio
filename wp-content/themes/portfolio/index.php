<?php /* Template Name: Homepage */?>
<?php
$titlepage = get_field('title__page');
$titleListeProjet = get_field('title__projet');
$isteProjet = get_field('liste__projets');
$photoProfile = get_field('img__profile');

$titlePage = get_field('title__page');
$name = get_field('name');
$description = get_field('descriptions');

?>
<?php get_header(); ?>
    <main class="main" id="primary" itemscope itemtype="https://schema.org/Person">
        <?php if ( $titlePage ) : ?>
<h2 class="title__page title"  itemprop="name"><?=  esc_html($titlePage);?></h2>
<?php endif; ?>

<section class="hero" aria-labelledby="profile-title">
    <h3 id="profile-title" class="sro">
    <?= $name?>
    </h3>
    <div class="hero__content">
            <div class="hero__content__description" itemprop="description">
             <?= wp_kses_post($description); ?>
            </div>

        <div class="hero__image">
            
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
</section>

           <?php if( have_rows('liste__projets') ): ?>

            <ul class="liste-projets" itemscope itemtype="https://schema.org/ItemList">
                <h2 class="liste-projets__projets__title" itemprop="name"><?=esc_html($titleListeProjet); ?></h2>
                <?php while( have_rows('liste__projets') ): the_row();
                    $titleProjet = get_sub_field('title__projet');
                    $descriptionProjet = get_sub_field('description__projet');
                    $image = get_sub_field('projet__img');
                    $liensProjet = get_sub_field('link__projet');
                    $listeSkills = get_sub_field('liste__skill');
                    ?>
                    <li class="liste-projets__projet"  itemprop="itemListElement" itemscope itemtype="https://schema.org/CreativeWork">
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
                        <h3 class="liste-projets__singel-title" itemprop="name"><?= $titleProjet; ?></h3>
                        <div class="liste-projets__projet-description" itemprop="description">
                            <?= $descriptionProjet; ?>
                            <?php echo $listeSkills; ?>
                            <?php if( have_rows('technologies') ): ?>

                            <ul class="project-techs" aria-label="Technologies utilisées pour ce projet">
                                <?php while( have_rows('technologies')): the_row();
                                    $name = get_sub_field('nom_technologie');
                                    if( $name ) :?>
                                       <li class="project-tech"> <?= $name ?></li>
                                 <?php endif; ?>
            <?php
                                endwhile; ?>
                            </ul>
                            <?php endif; ?>

                        </div>
                        <?php if($liensProjet): ?>
                            <div class="liste-projets__btn">
                                <a href="<?=esc_url($liensProjet['url']); ?>" title="<?= $liensProjet['title']; ?>" class="liste-projets__links" itemprop="url"><?= $liensProjet['title']; ?></a>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>

        <?php else: ?>

            <p>Aucun projet trouvé.</p>

        <?php endif; ?>
    </ul>
            <div class="redirections btn">

                <?php
                $lien = get_field('link__all__projet');
                ?>

                <?php if($lien): ?>

                    <a href="<?= esc_url($lien['url']);?>"  title=" <?= $lien['title']; ?>" class="redirections__link">
                        <?= $lien['title']; ?>
                    </a>

                <?php endif; ?>

            </div>
</main>
<?php get_footer(); ?>