<?php
$footerImg = get_field('logo__footer__img', 'option');
$footerTitle = get_field('title__footer', 'option');
$footerContact = get_field('contact__footer', 'option');
$footerTitleLinks = get_field('title__navigations', 'option');
$footerButton = get_field('contact__link__button', 'option');
$footerCopyright = get_field('copyright__footer', 'option');
?>

<footer class="footer" role="contentinfo">
    <div class="footer__container">

        <!-- Logo -->
        <?php if ($footerImg): ?>
            <div class="footer__logo">
                <img
                        src="<?= esc_url($footerImg['url']); ?>"
                        alt="<?= esc_attr($footerImg['alt'] ?: 'Logo du site'); ?>"
                        loading="lazy"
                >
            </div>
        <?php endif; ?>

        <!-- Infos -->
        <div class="footer__info">
            <?php if ($footerTitle): ?>
                <h2 class="footer__title"><?= esc_html($footerTitle); ?></h2>
            <?php endif; ?>

            <?php if ($footerContact): ?>
                <p class="footer__contact">
                    <?= wp_kses_post($footerContact); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Navigation -->
        <nav class="footer__nav" aria-label="Navigation du footer">
            <?php if ($footerTitleLinks): ?>
                <h2 class="footer__nav-title"><?= esc_html($footerTitleLinks); ?></h2>
            <?php endif; ?>

            <?php
            wp_nav_menu([
                    'theme_location' => 'footer-fr',
                    'container' => false,
                    'menu_class' => 'footer__menu',
            ]);
            ?>
        </nav>

        <!-- Bouton -->
        <?php if ($footerButton): ?>
            <div class="footer__cta">
                <a
                        class="footer__button"
                        href="<?= esc_url($footerButton['url']); ?>"
                        target="<?= esc_attr($footerButton['target'] ?: '_self'); ?>"
                        title="<?= esc_attr($footerButton['title']); ?>"
                >
                    <?= esc_html($footerButton['title']); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>

    <!-- Copyright -->
    <div class="footer__bottom">
        <?php if ($footerCopyright): ?>
            <p><?= esc_html($footerCopyright); ?></p>
        <?php endif; ?>

        <p class="copyright-text">
            <strong>© <?= date('Y'); ?></strong> <?= $footerCopyright ?>>
        </p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>