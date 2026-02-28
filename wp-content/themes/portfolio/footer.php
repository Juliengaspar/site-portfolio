<?php /* Template Name: footer */?>
<?php
$footerImg = get_field('logo__footer__img');
$footerTitle = get_field('title__footer');
$footerContact = get_field('contact__footer');
$footerTitleLinks = get_field('title__navigations');
$footerLinksAcceuil = get_field('acceuil__link');
$footerLinksprojets = get_field('projets__link');
$footerLinksApropos = get_field('a__propos__link');
$footerLinksContact = get_field('contact__link');
$footerButton = get_field('contact__link__button');
$footerCopyrinthe = get_field('copyright__footer');


?>

<footer>
<section>
    <div>
        <img src="<?= $footerImg['url'] ?>" alt="<?= $footerImg['alt'] ?>"  width="<?= $footerImg['width'] ?>" height="<?= $footerImg['height'] ?>" />
    </div>
    <div>
    <h2>
        <?php if (!empty($footerTitle)): ?>
               <?php echo $footerTitle; ?>
        <?php endif; ?>
    </h2>
        <p>
            <?php if (!empty($footerTitle)): ?>
                <?php echo $footerContact; ?>
            <?php endif; ?>
        </p>
    </div>
    <section>
        <h3>
            <?php if (!empty($footerTitleLinks)): ?>
                <?php echo $footerTitleLinks; ?>
            <?php endif; ?>
        </h3>
        <ul>
            <?php if (!empty($footerLinksAcceuil)): ?>
                <li>
                    <a title="<?= $footerLinksAcceuil['title'] ?>"
                       target="<?= $footerLinksAcceuil['target'] ?>"
                       href="<?= $footerLinksAcceuil['url'] ?>">
                        <?= $footerLinksAcceuil['title'] ?>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (!empty($footerLinksprojets)): ?>
                <li>
                    <a title="<?= $footerLinksprojets['title'] ?>"
                       target="<?= $footerLinksprojets['target'] ?>"
                       href="<?= $footerLinksprojets['url'] ?>">
                        <?= $footerLinksprojets['title'] ?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (!empty($footerLinksApropos)): ?>
                <li>
                    <a title="<?= $footerLinksApropos['title'] ?>"
                       target="<?= $footerLinksApropos['target'] ?>"
                       href="<?= $footerLinksApropos['url'] ?>">
                        <?= $footerLinksApropos['title'] ?>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (!empty($footerLinksContact)): ?>
                <li>
                    <a title="<?= $footerLinksContact['title'] ?>"
                       target="<?= $footerLinksContact['target'] ?>"
                       href="<?= $footerLinksContact['url'] ?>">
                        <?= $footerLinksContact['title'] ?>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
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

</section>
<section>
<h2>
    <?php if (!empty($footerCopyrinthe)): ?>
        <?php echo $footerCopyrinthe; ?>
    <?php endif; ?>
</h2>
</section>
</footer>
</body>
</html>