<?php /* Template Name: Homepage */?>
<?php get_header(); ?>
<h2><?=  get_field('title__page')?></h2>
<section>
    <h3>
    <?= get_field('name')?> 
    </h3>
    <div>
        <?= get_field('descriptions')?>
    </div>
</section>
<?php get_footer(); ?>