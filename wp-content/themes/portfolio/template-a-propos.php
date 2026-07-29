<?php /* Template Name: Apropos */?>

<?php get_header(); ?>
<main id="main" class="about__me main"     itemscope itemtype="https://schema.org/Person">
    <?php
    $titlePage = get_field('title__page');
    $AbouteMeTitle = get_field('title__a__propos');
    $AbouteMeText = get_field('description__a__propos');

    ?>
        <h2 class="about__me__title title"><?= esc_html($titlePage); ?></h2>

        <section class="profile">
            <div>
            <h3 class="profile__title subtitle" itemprop="name"><?= esc_html($AbouteMeTitle); ?></h3>
            <div class="profile__text" itemprop="description"><?= wp_kses_post($AbouteMeText); ?></div>
            </div>
                <div class="profile__image">
                    <!-- Image d'introduction -->
                    <?php
                    $image = get_field('photo_profile');
                    if ($image) :
                        ?>
                        <div class="photo_profile">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" itemprop="image" class="proflie__img"
                                 srcset="
                                <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-small')); ?> 400w,
                                <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-medium')); ?> 800w,
                                <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-large')); ?> 1200w
                                " sizes="(max-width: 768px) 90vw, (max-width: 1200px) 50vw,   400px" >
                        </div>
                    <?php endif; ?>
                </div>
        </section>


    <!-- Compétences -->
    <section class="competenceSection"   aria-labelledby="title__competence">
        <h2 class="subtitle competenceSection__title" id="title__hardSkills">
            Mes hard skills
        </h2>
        <?php $galerie = get_field('galerie__picture__competence'); ?>
        <?php if ($galerie) : ?>
           <?php $galerie_double = array_merge($galerie, $galerie); // double la liste
           ?>
            <div class="competences" aria-hidden="true">

                <div class="competences__track">

                    <!-- Première série -->
                    <?php foreach ($galerie as $image) : ?>
                        <div class="competences__item">
                            <img class="competences__img" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: 'Logo de compétence'); ?>" loading="lazy"
                                 width="<?php echo esc_attr($image['width']); ?>"
                                height="<?php echo esc_attr($image['height']); ?>"
                                 srcset="
                            <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-small')); ?> 400w,
                            <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-medium')); ?> 800w,
                            <?= esc_url(wp_get_attachment_image_url($image['ID'], 'square-large')); ?> 1200w
                            " sizes="(max-width: 768px) 90vw, (max-width: 1200px) 50vw,   400px"
                            >
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else : ?>
        <p class="error">Aucune compétence technique à afficher</p>
        <?php endif; ?>
    </section>
    <section class="softSkillsContainer" aria-labelledby="title__softskills">
        <h2 class="subtitle" id="title__softSkills">
            Mes soft skills
        </h2>
        <?php
        $titleSoftSkill = get_field('soft__Skills__title');
        $listeSoftSkill = get_field('liste__soft__skill');
        ?>

        <?php if ($titleSoftSkill) : ?>
            <h2 class="softSkillsContainer__subtitle subtitle"><?= esc_html($titleSoftSkill) ?></h2>
        <?php endif; ?>

        <?php if (have_rows('liste__soft__skill')) : ?>
            <div class="softSkillsGrid">
                <?php while( have_rows('liste__soft__skill') ) : the_row();
                    $titleSkill = get_sub_field('soft__skill__title');
                    $textSkill = get_sub_field('soft__skill__description');
                    $imgSkill = get_sub_field('soft__skill__image');
                    ?>

                    <article class="softSkill" itemscope itemtype="https://schema.org/DefinedTerm">
                        <?php if ($imgSkill && !empty($imgSkill['url'])) : ?>
                            <div class="softSkill__imageWrapper">
                                <img
                                        src="<?= esc_url($imgSkill['url']) ?>"
                                        alt="<?= esc_attr($imgSkill['alt']) ?>"
                                        class="softSkill__img"
                                        loading="lazy"
                                        itemprop="image"
                                >
                            </div>
                        <?php endif; ?>

                        <?php if ($titleSkill) : ?>
                            <h3 class="softSkill__title" itemprop="name"><?= esc_html($titleSkill) ?></h3>
                        <?php endif; ?>

                        <?php if ($textSkill) : ?>
                            <div class="softSkill__description" itemprop="description">
                                <?= wp_kses_post($textSkill) ?>
                            </div>
                        <?php endif; ?>
                    </article>

                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p>Aucune compétence soft à afficher pour le moment.</p>
        <?php endif; ?>
    </section>

        <!-- Parcours scolaire -->
        <?php if( have_rows('liste__parcours') ): ?>

                <h2 class="parcours__subtitle subtitle"><?php the_field('parcours__title'); ?></h2>
            <section class="parcours" aria-labelledby="parcours-title">

                <?php while( have_rows('liste__parcours') ): the_row();

                    $filiere = get_sub_field('title__filiere');
                    $date = get_sub_field('date__parcours');
                    $ecole = get_sub_field('name__school');
                    $explication = get_sub_field('explication--parcours');
                    ?>
                <ul class="parcours__carts" itemscope itemtype="https://schema.org/EducationalOccupationalCredential">
                    <li class="parcours-item">
                        <h3 class="parcours__carts__title" itemprop="name">  <?= esc_html($filiere); ?></h3>
                        <span class="parcours__carts__date date" itemprop="dateCreated">
                            <?= esc_html($date); ?>
                        </span>
                        <p class="parcours__carts__ecole ecole"><?= esc_html($ecole); ?></p>
                    </li>
                    <li class="description" itemprop="description">
                        <?= wp_kses_post($explication); ?>
                    </li>
                </ul>
                <?php endwhile; ?>
            </section>
        <?php else : ?>
    <p class="error">Aucun parcours pour le moment</p>
        <?php endif; ?>

        <!-- Passions -->
        <section class="passion__me sectionMargin" aria-labelledby="passion-title">
            <?php
            $titre = get_field('title__hobbie');
            $description = get_field('desctiption__title');
            $image_loisir = get_field('hobbies__image');
            ?>

            <section class="passion__content">
                <?php if( $titre ): ?>
                    <h2 class="passion__content__subtile subtitle" ><?= esc_html($titre); ?></h2>
                <?php endif; ?>
                <div class="passion__content__description">
                    <?php if( $description ): ?>
                        <div class="passion__content__description__text" itemprop="description"><?php echo wp_kses_post($description); ?></div>
                    <?php endif; ?>
                    <?php if( $image_loisir ): ?>
                        <div class="passion__image">
                            <img src="<?php echo esc_url($image_loisir['url']); ?>" alt="<?php echo esc_attr($image_loisir['alt']); ?>"
                            srcset="
                            <?= esc_url(wp_get_attachment_image_url($image_loisir['ID'], 'square-small')); ?> 400w,
                            <?= esc_url(wp_get_attachment_image_url($image_loisir['ID'], 'square-medium')); ?> 800w,
                            <?= esc_url(wp_get_attachment_image_url($image_loisir['ID'], 'square-large')); ?> 1200w
                            " sizes="(max-width: 768px) 90vw, (max-width: 1200px) 50vw,   400px" >
                        </div>
                    <?php else: ?>
                        <div class="passion__image">
                            <p  class="passion__image__error">
                                Image manquante : Vérifiez le champ ACF "hobbies__image"
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </section>

    <section class="social-section sectionMargin" aria-labelledby="social-title">
        <?php
        $reseauxSociauxTitle = get_field('reseaux__sociaux__title');
        ?>
        <?php if ($reseauxSociauxTitle) :?>
        <h2 id="social-title" class="subtitle"><?= esc_html($reseauxSociauxTitle);?></h2>
        <?php endif; ?>

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
        <p>aucun réseaux disponible</p>
    </section>

</main>

<?php get_footer(); ?>
