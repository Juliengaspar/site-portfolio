<?php
$footerImg = get_field('logo__footer__img', 'option');
$footerTitle = get_field('title__footer', 'option');
$footerContact = get_field('contact__footer', 'option');
$footerTitleLinks = get_field('title__navigations', 'option');
$footerButton = get_field('contact__link__button', 'option');
$footerCopyright = get_field('copyright__footer', 'option');
$footerFollowTitle = get_field('title__folow', 'option');
$footerFollowimgs = get_field('galerie__folow', 'option');
?>

<footer class="footer" role="contentinfo" itemscope itemtype="https://schema.org/Organization">
    <div class="footer__container">

        <!-- Logo -->
        <?php if ($footerImg): ?>
            <div class="footer__logo">
                <img src="<?= $footerImg['url']; ?>" alt="<?= $footerImg['alt'] ?: 'Logo du site'; ?>" loading="lazy" itemprop="logo"
                srcset="
                <?= esc_url(wp_get_attachment_image_url($footerImg['ID'], 'square-small')); ?> 400w,
                <?= esc_url(wp_get_attachment_image_url($footerImg['ID'], 'square-medium')); ?> 800w,
                <?= esc_url(wp_get_attachment_image_url($footerImg['ID'], 'square-large')); ?> 1200w
                " sizes="(max-width: 768px) 90vw, (max-width: 1200px) 50vw,   400px" >
            </div>
        <?php endif; ?>

        <!-- Infos -->
        <div class="footer__info">
            <?php if ($footerTitle): ?>
                <h2 class="footer__title" itemprop="name"><?= $footerTitle; ?></h2>
            <?php endif; ?>

            <?php if ($footerContact): ?>
                <div class="footer__contact">
                    <?= $footerContact; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Navigation -->
        <nav class="footer__nav" aria-label="Navigation du footer">
            <?php if ($footerTitleLinks): ?>
                <h2 class="footer__nav-title"><?= $footerTitleLinks; ?></h2>
            <?php endif; ?>

            <?php
            wp_nav_menu([
                    'theme_location' => 'footer',
                    'container' => false,
                    'menu_class' => 'footer__menu',
            ]);
            ?>
        </nav>

        <!-- Bouton -->
        <?php if ($footerButton): ?>
            <div class="footer__cta">
                <a class="footer__button" href="<?= esc_url($footerButton['url']); ?>" target="<?= $footerButton['target'] ?: '_self'; ?>" title="<?= $footerButton['title']; ?>"  itemprop="url">
                    <?= $footerButton['title']; ?>
                </a>
            </div>
        <?php endif; ?>
        <section class="footer__liste__folowing">
            <h3><?= $footerFollowTitle ?></h3>

                <div class="footer__liste__folowing__contenu">
            <?php foreach ($footerFollowimgs as $footerFollowimg) : ?>
                    <img class="liste__folowing__img" src="<?= $footerFollowimg['url']; ?>" alt="<?= $footerFollowimg['alt']; ?>" title="<?= $footerFollowimg['title']; ?>" itemprop="image">
            <?php endforeach; ?>
                </div>
        </section>

    </div>

    <!-- Copyright -->

    <section class="footer__bottom">
        <?php if ($footerCopyright): ?>
            <h3 class="footer__bottom__title">
                <span itemprop="copyrightNotice">
                    <?= esc_html($footerCopyright); ?>
                </span>
            </h3>
        <?php endif; ?>
    </section>
</footer>

<?php wp_footer(); ?>
