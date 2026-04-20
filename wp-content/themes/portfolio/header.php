<?php /* Template Name: header */?>
<?php
$acceuilLink = get_field('accueil__link');
$projetLink = get_field('projet__link');
$aProposProjetLink = get_field('a__propos__projet__link');
$contactLink = get_field('contact__link');
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="site crée avec woordpresse pour mon portfolio poour le cours de design web de deuxiéme années a l'hepl" />
    <meta name="keywords" content="référencement,SEO,balise meta keywords, help, portfolio, julien, gaspar, woordpresse, developeur, UX, UI, ">    <title><?= get_the_title()?></title>
    <link rel="stylesheet" type="text/css" href="<?=dw_asset('css')?>">
    <script src="<?= dw_asset('js')?>"  defer type="module" ></script>

</head>
<body>
<h1 class="sro"><?= get_the_title()?> - Wordpresse Demon 201</h1>
<nav> <!-- Menu de navigation par Wordpress -->
    <h2 class="sro">Menu de navigation</h2>
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
<h1 class="title">titre invisible</h1>

<nav>
    <ul>
        <li><?php get_field('accueil__link') ?></li>
        <?php if (!empty($acceuilLink)): ?>
        <li>
            <a title="<?= $acceuilLink['title'] ?>"
               target="<?= $acceuilLink['target'] ?>"
               href="<?= $acceuilLink['url'] ?>">
                <?= $acceuilLink['title'] ?>
            </a>
        </li>
        <?php endif; ?>
        <?php if (!empty($projetLink)): ?>
        <li>
            <a title="<?= $projetLink['title'] ?>"
               target="<?= $projetLink['target'] ?>"
               href="<?= $projetLink['url'] ?>">
                <?= $projetLink['title'] ?>
            </a>
        </li>
        <?php endif; ?>
        <?php if (!empty($aProposProjetLink)): ?>
        <li>
            <a title="<?= $aProposProjetLink['title'] ?>"
               target="<?= $aProposProjetLink['target'] ?>"
               href="<?= $aProposProjetLink['url'] ?>">
                <?= $aProposProjetLink['title'] ?>
            </a>
        </li>
        <?php endif; ?>
        <?php if (!empty($contactLink)): ?>
        <li>
            <a title="<?= $contactLink['title'] ?>"
               target="<?= $contactLink['target'] ?>"
               href="<?= $contactLink['url'] ?>">
                <?= $contactLink['title'] ?>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</nav>
<nav>
<ul class="navigation__list">

</ul>
</nav>

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