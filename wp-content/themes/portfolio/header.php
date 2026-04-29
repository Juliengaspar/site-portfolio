<?php /* Template Name: header */?>
<?php
$headerImg = get_field('logo__jg', 'option');
$acceuilLink = get_field('link__site', 'option');

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Création d’un site portfolio réalisé avec WordPress dans le cadre du cours de design web de deuxième année à la Haute École de la Province de Liège (HEPL)." />
    <meta name="keywords" content="référencement,SEO,balise meta keywords, help, portfolio, julien, gaspar, woordpresse, developeur, UX, UI, ">    <title><?= get_the_title()?></title>
    <meta name="author" content="Julien Gaspar">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?=dw_asset('css')?>">
    <script src="<?= dw_asset('js')?>"  defer type="module" ></script>

</head>
<body>
<h1 class="sro"><?= get_the_title()?> - Wordpresse Demon 201</h1>
<nav class="navigation__bars"> <!-- Menu de navigation par Wordpress -->
    <h2 class="sro">Menu de navigation</h2>
    <section>
    <?php if ($headerImg): ?>
        <div class="footer__logo">
            <img
                    src="<?= esc_url($headerImg['url']); ?>"
                    alt="<?= esc_attr($headerImg['alt'] ?: 'Logo du site'); ?>"
                    loading="lazy"
            >
        </div>
    <?php endif; ?>
        <?php if (!empty($acceuilLink)) : ?>
            <h2 class="nav__title">
                <a
                        href="<?= esc_url($acceuilLink['url']); ?>"
                        target="<?= esc_attr($acceuilLink['target'] ?: '_self'); ?>"
                >
                    <?= esc_html($acceuilLink['title']); ?>
                </a>
            </h2>
        <?php endif; ?>    </section>
    <?php
    wp_nav_menu([
            'theme_location' => 'header-fr',
            'container' => false,
            'menu_class' => 'ul-container',
            'container_class' => 'div-container',
    ]);
    ?>
</nav><!--
//appeler la fonction pour afficher Menu de navigation custom
//on a plus de contrôle à 100%  avec cet methode et plus facile a le structure-->
<?php if(!is_front_page()): ?>
<nav>
    ss
    <h2>Fil d'ariane</h2>
    <ul>
        <li>s
            <a href="<?= home_url() ?>">Accueil</a>
            ->
            <p><?= get_the_title() ?></p>
        </li>
    </ul>
</nav>
<?php endif; ?>
<?php
//affiche les 2 lange
//pll_the_languages(['show_flags'=>1, 'show_name'=>0]);
?>