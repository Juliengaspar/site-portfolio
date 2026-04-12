<?php /* Template Name: footer */?>
<?php
$footerImg = get_field('logo__footer__img', 'option');
$footerTitle = get_field('title__footer', 'option');
$footerContact = get_field('contact__footer', 'option');
$footerTitleLinks = get_field('title__navigations', 'option');
$footerLinksAcceuil = get_field('acceuil__link');
$footerLinksprojets = get_field('projets__link');
$footerLinksApropos = get_field('a__propos__link');
$footerLinksContact = get_field('contact__link');
$footerButton = get_field('contact__link__button', 'option');
$footerCopyrinthe = get_field('copyright__footer', 'option');


?>

<footer>
    <?php
    if( $footerImg ): ?>
    <div>
        <img src="<?php echo esc_url($footerImg['url']); ?>" alt="<?php echo esc_attr($footerImg['alt']); ?>">
    </div>
    <?php endif; ?>
<section>
    <h2> <?php if (!empty($footerTitle)): ?>
            <?php echo $footerTitle; ?>
        <?php endif; ?>
        <?php echo "pas de valeur"; ?></h2>
    <div>
            <?php if (!empty($footerTitle)): ?>
                <?php echo $footerContact; ?>
            <?php endif; ?>
    </div>

</section>
    <section>
        <h3>
            <?php if (!empty($footerTitleLinks)): ?>
                <?php echo $footerTitleLinks; ?>
            <?php endif; ?>
        </h3>
        <?php
        wp_nav_menu([
                'theme_location' => 'footer-fr',
                'container' => false,
                'menu_class' => 'ul-container',
                'container_class' => 'div-container',
        ]);
        ?>
    </section>
    <section>
        <h3>
            <?php if (!empty($footerButton)): ?>
                <a title="<?= $footerButton['title'] ?>"
                   target="<?= $footerButton['target'] ?>"
                   href="<?= $footerButton['url'] ?>">
                    <?= $footerButton['title'] ?>
                </a>
            <?php endif; ?>
        </h3>
    </section>
    <section>
        <h2>
            <?php if (!empty($footerCopyrinthe)): ?>
                <?php echo $footerCopyrinthe; ?>
            <?php endif; ?>
        </h2>
        <p>
        <strong>©2026</strong> Site  réalisé par Julien gaspar
        </p>

    </section>
</footer>
</body>
</html>