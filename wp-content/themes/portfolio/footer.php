<?php
$footerImg = get_field('logo__footer__img', 'option');
$footerTitle = get_field('title__footer', 'option');
$footerTitleLinks = get_field('title__navigations', 'option');
$adresse = get_field('footer_adresse', 'option');
$telephone = get_field('footer_telephone', 'option');
$email = get_field('footer_email', 'option');
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
                <h2 class="footer__title" itemprop="name"><?= esc_html($footerTitle); ?></h2>
            <?php endif; ?>
            <div class="footer__contact">

                <?php if($adresse): ?>
                    <p><?= $adresse; ?></p>
                <?php endif; ?>

                <?php if($telephone): ?>
                    <p>
                        <a href="tel:<?= preg_replace('/[^0-9+]/', '', $telephone); ?>">
                            <?= $telephone; ?>
                        </a>
                    </p>
                <?php endif; ?>

                <?php if($email): ?>
                    <p>
                        <a href="mailto:<?= esc_attr($email); ?>">
                            <?= $email; ?>
                        </a>
                    </p>
                <?php endif; ?>

            </div>
        </div>

        <!-- Navigation -->
        <nav class="footer__nav" aria-label="Navigation du footer">
            <?php if ($footerTitleLinks): ?>
                <h2 class="footer__nav-title"><?=  esc_html($footerTitleLinks); ?></h2>
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
                    <?= esc_html($footerButton['title']); ?>
                </a>
            </div>
        <?php endif; ?>
        <section class="footer__liste__folowing">
            <h3><?= esc_html($footerFollowTitle) ?></h3>

                <div class="footer__liste__folowing__contenu">
                    <?php if (!empty($footerFollowimgs) && is_array($footerFollowimgs)) : ?>

                        <?php foreach ($footerFollowimgs as $footerFollowimg) : ?>

                            <img
                                    class="liste__folowing__img"
                                    src="<?= esc_url($footerFollowimg['url']); ?>"
                                    alt="<?= esc_attr($footerFollowimg['alt']); ?>"
                                    title="<?= esc_attr($footerFollowimg['title']); ?>"
                                    itemprop="image"
                            >

                        <?php endforeach; ?>

                    <?php endif; ?>
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
