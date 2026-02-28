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
    <title><?= get_the_title()?></title>
    <link rel="stylesheet" type="text/css" href="<?=dw_asset('css')?>">
    <script src="<?= dw_asset('js')?>" defer ></script>

</head>
<body>
<h1 class="hidden">titre invisible</h1>

<nav>
    <ul>
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

</body>
</html>