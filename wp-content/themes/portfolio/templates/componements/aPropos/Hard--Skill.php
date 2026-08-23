<?php
?>

<section class="competenceSection"   aria-labelledby="title__competence">
    <h2 class="subtitle competenceSection__title" id="title__hardSkills">
        Mes hard skills
    </h2>
    <?php $galerie = get_field('galerie__picture__competence'); ?>
    <?php if ($galerie) : ?>
        <?php $galerie_double = array_merge($galerie, $galerie); // double la liste ?>

        <div class="competences" aria-hidden="true">

            <div class="competences__track">

                <!-- Première série -->
                <?php if (!empty($galerie_double)) {
                    foreach ($galerie_double as $image) : ?>
                        <div class="competences__item">
                            <img class="competences__img"
                                 src="<?php echo esc_url($image['url']); ?>"
                                 alt="<?php echo esc_attr($image['alt'] ?: 'Logo de compétence'); ?>"
                                 loading="lazy"
                                 width="<?php echo esc_attr($image['width']); ?>"
                                 height="<?php echo esc_attr($image['height']); ?>"
                                 srcset="
                                <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-small')); ?> 400w,
                                <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-medium')); ?> 800w,
                                <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-large')); ?> 1200w
                             "
                                 sizes="(max-width: 768px) 90vw, (max-width: 1200px) 50vw, 400px"
                            >
                        </div>
                    <?php endforeach;
                } ?>
            </div>
        </div>
    <?php else : ?>
        <p class="error">Aucune compétence technique à afficher</p>
    <?php endif; ?>
</section>
