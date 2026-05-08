<?php /* Template Name: Projets */ ?>

  <?php  get_header(); ?>

    <section class="projets-container">
        <h2 class="projets-titre"><?= get_the_title() ?>></h2>
        <section class="categorie-section">



            <section class="cartes-projets">
               <?php include 'archive-projets.php'?>
             </section>
    </section>

<?php get_footer(); ?>