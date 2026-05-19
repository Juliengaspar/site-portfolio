<?php /* Template Name: Homepage */?>
<?php
$titleListeProjet = get_field('title__projet');
$isteProjet = get_field('liste__projets');
$allLinkProjet = get_field('link__all__projet');
$photoProfile = get_field('img__profile');

$titlePage = get_field('title__page');
$name = get_field('name');
$description = get_field('descriptions');

?>
<?php get_header(); ?>
    <main class="main">
<h2 class="title__page"><?=  get_field('title__page')?></h2>
<section class="profile" aria-labelledby="profile-title">
    <h3 id="profile-title" class="sr-only">
    <?= $name?>
    </h3>
    <div class="profile__content">
            <div class="profile__content__description">
             <?= ($description); ?>
            </div>

        <div class="profile__image">
            <?php if ($photoProfile): ?>
                <img
                        src="<?= esc_url($photoProfile['url']); ?>"
                        alt="<?= esc_attr($photoProfile['alt'] ?: 'Photo de profil'); ?>"
                        loading="lazy"
                >
            <?php endif; ?>
        </div>

    </div>
</section>

           <?php if( have_rows('liste__projets') ): ?>

            <section class="liste-projets">
                <h3 class="liste-projets__projets__title"><?= $titleListeProjet ?></h3>
                <?php while( have_rows('liste__projets') ): the_row(); ?>

                    <section class="liste-projets__projet">

                        <div class="liste-projets__projet__img">
                            <?php
                            $image = get_sub_field('projet__img');
                            if( $image ): ?>
                                <img class="img" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                            <?php endif; ?>
                        </div>
                        <h4 class="liste-projets__singel-title"><?php the_sub_field('title__projet'); ?></h4>

                        <p class="liste-projets__projet-description"><?php the_sub_field('description__projet'); ?></p>


                        <?php
                        $lien = get_sub_field(' link__projet ');
                        if( $lien ): ?>
                            <a href="<?php echo esc_url($lien); ?>" class="btn">Voir le projet</a>
                        <?php endif; ?>

                    </section>

                <?php endwhile; ?>

        <?php else: ?>

            <p>Aucun projet trouvé.</p>

        <?php endif; ?>
    </section>
</main>
<?php get_footer(); ?>