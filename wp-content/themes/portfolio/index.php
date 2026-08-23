<?php /* Template Name: Homepage */?>
<?php
$titlePage = get_field('title__page');


?>
<?php get_header(); ?>
    <main class="main" id="primary" itemscope itemtype="https://schema.org/Person">
        <?php if ( $titlePage ) : ?>
<h2 class="title__page title"  itemprop="name"><?=  esc_html($titlePage);?></h2>
<?php endif; ?>

<?php get_template_part('templates/componements/acceuil/hero'); ?>
<?php get_template_part('templates/componements/acceuil/projets'); ?>


</main>
<?php get_footer(); ?>