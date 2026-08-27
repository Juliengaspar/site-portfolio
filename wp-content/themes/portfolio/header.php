<?php /* Template Name: header */?>

<?php
$headerImg = get_field('logo__jg', 'option');
$acceuilLink = get_field('link__site', 'option');

?>
<!doctype html>
<html lang="fr">
<?php wp_head(); ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Création d’un site portfolio réalisé avec WordPress dans le cadre du cours de design web de deuxième année à la Haute École de la Province de Liège (HEPL)." />
    <meta  content="référencement,SEO,balise meta keywords, help, portfolio, julien, gaspar, woordpresse, developeur, UX, UI, ">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <meta name="author" content="Julien Gaspar">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); ?>">
    <meta property="og:url" content="<?= home_url(); ?>">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <link rel="stylesheet" type="text/css" href="<?=dw_asset('css')?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="<?= dw_asset('js')?>"  defer type="module" ></script>

</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<noscript>
    <div class="no-js-message">
        Pour profiter pleinement des fonctionnalités du site, veuillez activer JavaScript.
    </div>
</noscript>
<h1 class="sro"><?= get_the_title()?></h1>
<nav class="navigation__bars"> <!-- Menu de navigation par Wordpress -->
    <h2 class="sro">Menu de navigation</h2>
    <section>

        <?php if ($headerImg): ?>
            <div class="footer__logo">
                <a
                        href="<?= esc_url(home_url('/')); ?>"
                        class="site-logo"
                        aria-label="Retour à l'accueil">

                    <img
                            src="<?= esc_url($headerImg['url']); ?>"
                            alt="<?= esc_attr($headerImg['alt']); ?>">
                </a>            </div>
        <?php if ( function_exists('pll_the_languages') ) : ?>

            <nav class="language-switcher" aria-label="Sélecteur de langue">
                <ul class="language-switcher__list">

                    <?php
                    $languages = pll_the_languages(['raw' => 1]);

                    if ( ! empty($languages) ) :
                        foreach ( $languages as $lang ) :

                            $is_active = ! empty($lang['current_lang']) ? 'is-active' : '';
                            ?>

                            <li class="language-switcher__item">
                                <a class="language-switcher__link <?php echo esc_attr($is_active); ?>"
                                   href="<?php echo esc_url($lang['url']); ?>"
                                   aria-current="<?php echo $is_active ? 'page' : 'false'; ?>">
                                    <?php echo esc_attr($lang['name']); ?>
                                  
                                </a>
                            </li>

                        <?php
                        endforeach;
                    endif;
                    ?>

                </ul>
            </nav>

        <?php endif; ?>
        <?php endif; ?>
            <?php if (!empty($acceuilLink)) : ?>
                <h3 class="nav__title sro">lien Navigatiion
                    <a href="<?= esc_url($acceuilLink['url']); ?>"
                            target="<?= esc_attr($acceuilLink['target'] ?: '_self'); ?>">
                        <?= esc_html($acceuilLink['title']); ?>
                    </a>
                </h3>
            <?php endif; ?>
    </section>
        <?php
        wp_nav_menu([
                'theme_location' => 'header',
                'container' => false,
                'menu_class' => 'ul-container',
                'container_class' => 'div-container',
        ]);
        ?>
</nav>