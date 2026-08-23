<?php /* Template Name: Apropos */?>

<?php get_header(); ?>
<main id="main" class="about__me main"     itemscope itemtype="https://schema.org/Person">
    <?php
    $titlePage = get_field('title__page');
    $AbouteMeTitle = get_field('title__a__propos');
    $AbouteMeText = get_field('description__a__propos');

    ?>
        <h2 class="about__me__title title" itemprop="name"><?= esc_html($titlePage); ?></h2>
    <?php get_template_part('templates/componements/aPropos/profile');  ?>
    <?php get_template_part('templates/componements/aPropos/Hard--Skill');  ?>
    <?php get_template_part('templates/componements/aPropos/soft--skill');  ?>
    <?php get_template_part('templates/componements/aPropos/Parcours--scolaire');  ?>
    <?php get_template_part('templates/componements/aPropos/Passions');  ?>



        <?php if( have_rows('social_links') ) : // Vérifie si le répéteur ACF existe et contient des lignes ?>

            <div class="social-links">
                <?php while( have_rows('social_links') ) : the_row();
                    $name = get_sub_field('social_name');
                    $url  = get_sub_field('social_url');
                    $icon = get_sub_field('social_icon'); // Tableau ACF (url, alt, id...)
                    ?>
                    <a href="<?= esc_url($url); ?>"
                       class="social-link"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="<?= esc_attr($name); ?>"
                       title="<?= esc_attr($name); ?>">

                        <?php if( $icon && !empty($icon['url']) ) : ?>
                            <img src="<?= esc_url($icon['url']); ?>"
                                 alt="<?= esc_attr($icon['alt'] ?: $name); ?>"
                                 width="<?= esc_attr($icon['width']); ?>"
                                 height="<?= esc_attr($icon['height']); ?>"
                                 loading="lazy"
                                 class="social-link__icon">
                        <?php else : ?>
                            <!-- Fallback texte si l'image n'est pas chargée -->
                            <span class="social-link__text"><?= esc_html($name); ?></span>
                        <?php endif; ?>
                    </a>
                <?php endwhile; ?>
            </div>

        <?php endif; ?>
        <p>aucun réseau disponible</p>
    </section>

</main>

<?php get_footer(); ?>
