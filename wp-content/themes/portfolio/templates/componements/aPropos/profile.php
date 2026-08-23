<?php

$titlePage = get_field('title__page');
$AbouteMeTitle = get_field('title__a__propos');
$AbouteMeText = get_field('description__a__propos');


?>
<section class="profile" aria-labelledby="profile-title">
            <div>
            <h3 class="profile__title subtitle" itemprop="name"><?= esc_html($AbouteMeTitle); ?></h3>
<div class="profile__text" itemprop="description"><?= wp_kses_post($AbouteMeText); ?></div>
</div>
<div class="profile__image">
    <!-- Image d'introduction -->
    <?php
    $image = get_field('photo_profile');
    if ($image) :
        ?>
        <div class="profile__img">
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" itemprop="image" class="profile__img__img"
                 srcset="
                                <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-small')); ?> 400w,
                                <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-medium')); ?> 800w,
                                <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-large')); ?> 1200w
                                " sizes="(max-width: 768px) 90vw, (max-width: 1200px) 50vw,   400px"
                 loading="lazy"
                 fetchpriority="high"
                 width="<?= esc_attr($image['width']); ?>"
                 height="<?= esc_attr($image['height']); ?>"
            >

        </div>
    <?php endif; ?>
</div>
</section>