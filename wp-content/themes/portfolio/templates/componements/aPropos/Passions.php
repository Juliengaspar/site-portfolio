<?php
?>

<!-- Passions -->
<section class="passion__me sectionMargin" aria-labelledby="passion-title">
    <?php
    $titre = get_field('title__hobbie');
    $description = get_field('desctiption__title');
    $image_loisir = get_field('hobbies__image');
    ?>

    <div class="passion__content">
        <div class="passion__content__description">
            <?php if ( $description ) : ?>
                <div class="passion__content__description__text" itemprop="description"><?= wp_kses_post($description); ?></div>
            <?php endif; ?>
            <?php if ( $image_loisir ) : ?>
                <div class="passion__image">
                    <img src="<?= esc_url($image_loisir['url']); ?>"
                         alt="<?= esc_attr($image_loisir['alt']); ?>"
                         srcset="
                                <?= esc_url(wp_get_attachment_image_url($image_loisir['ID'], 'square-small')); ?> 400w,
                                <?= esc_url(wp_get_attachment_image_url($image_loisir['ID'], 'square-medium')); ?> 800w,
                                <?= esc_url(wp_get_attachment_image_url($image_loisir['ID'], 'square-large')); ?> 1200w
                             "
                         sizes="(max-width: 768px) 90vw, (max-width: 1200px) 50vw, 400px"
                         loading="lazy">
                </div>
            <?php else : ?>
                <div class="passion__image">
                    <p class="passion__image__error">Image manquante : Vérifiez le champ ACF "hobbies__image"</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
