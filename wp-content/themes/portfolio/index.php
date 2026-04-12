<?php /* Template Name: Homepage */?>
<?php
$titleListeProjet = get_field('title__projet');
$isteProjet = get_field('liste__projets');
$allLinkProjet = get_field('link__all__projet');

?>
<?php get_header(); ?>
<h2><?=  get_field('title__page')?></h2>
<section>
    <h3>
    <?= get_field('name')?> 
    </h3>
    <div>
        <?= get_field('descriptions')?>
    </div>
</section>

           <?php if( have_rows('liste__projets') ): ?>

            <section class="liste-projets">
                <h3><?= $titleListeProjet ?></h3>
                <?php while( have_rows('liste__projets') ): the_row(); ?>

                    <section class="projet">

                        <h4><?php the_sub_field('title__projet'); ?></h4>

                        <p><?php the_sub_field('description__projet'); ?></p>

                        <?php
                        $image = get_sub_field('projet__img');
                        if( $image ): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                        <?php endif; ?>

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