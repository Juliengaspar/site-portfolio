<?php get_header(); ?>
<?php
//pour si une erreurs 404 erreurs genereiqur par default
// <a href="<?= home_url()  nous donne le href pour retours a la page acceuil
?>
<div>
    <h1>Page non trouvé 404</h1>
    <p>Désolé, la page que vous recherchez n'existe pas ou a été déplacer</p>
    <p>Retours à la <a href="<?= home_url() ?>" title="redireger vers la page d’acceuil">page d'aceuile</a> ou utiliser la recherch: </p>
</div>

<?php get_footer(); ?>
