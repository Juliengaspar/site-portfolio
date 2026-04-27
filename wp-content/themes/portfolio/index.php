<?php /* Template Name: Homepage */?>
<?php
$titleListeProjet = get_field('title__projet');
$isteProjet = get_field('liste__projets');
$allLinkProjet = get_field('link__all__projet');

?>
<?php get_header(); ?>
<h2 class="title__page"><?=  get_field('title__page')?></h2>
<section class="profile">
    <h3 class="profile__name">
    <?= get_field('name')?> 
    </h3>
    <div class="profile__detail">
        <?= get_field('descriptions')?>
    </div>
</section>

           <?php if( have_rows('liste__projets') ): ?>

            <section class="liste-projets">
                <h3 class="projets__title"><?= $titleListeProjet ?></h3>
                <?php while( have_rows('liste__projets') ): the_row(); ?>

                    <section class="projet">

                        <h4 class="projet__title"><?php the_sub_field('title__projet'); ?></h4>

                        <p class="projet__description"><?php the_sub_field('description__projet'); ?></p>

                        <div class="projet__img">
                            <?php
                            $image = get_sub_field('projet__img');
                            if( $image ): ?>
                                <img class="img" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                            <?php endif; ?>
                        </div>

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
<?php get_footer(); ?>