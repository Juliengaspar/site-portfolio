<?php /* Template Name: Apropos */?>

<?php get_header(); ?>
<section class="about__me sectionMargin">
    <?php
    $titlePage = get_field('title__page');
    $AbouteMeTitle = get_field('title__a__propos');
    $AbouteMeText = get_field('description__a__propos');

    ?>
        <h2 class="about__me__title title"><?= $titlePage?></h2>

        <section class="proflie">
            <div>
            <h3 class="proflie__title"><?= $AbouteMeTitle ?></h3>
            <div class="proflie__text"><?= $AbouteMeText ?></div>
            </div>
                <div class="proflie__image">
                    <!-- Image d'introduction -->
                    <?php
                    $image = get_field('photo_profile');
                    // var_dump($image); // temporaire pour voir ce qu'il y a dans le fichiers

                    if ($image) :
                        ?>
                        <div class="photo_profile">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                        </div>
                    <?php endif; ?>
                </div>
        </section>


        <!-- Compétences -->
        <section>
            <h2 class="title sectionMargin" id="title__competence ">Mes compétences</h2>
            <div class="competences">
                <?php $galerie = get_field('galerie__picture__competence'); ?>
                <?php if ($galerie) : ?>
                    <?php foreach ($galerie as $image) : ?>
                        <img class="competences__img" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    <section class="softSkillsContainer">
        <?php
        $titleSoftSkill = get_field('soft__Skills__title');
        $listeSoftSkill = get_field('liste__soft__skill');
        ?>

        <?php if ($titleSoftSkill) : ?>
            <h2><?= esc_html($titleSoftSkill) ?></h2>
        <?php endif; ?>

        <?php if (have_rows('liste__soft__skill')) : ?>
            <div class="softSkillsGrid">
                <?php while( have_rows('liste__soft__skill') ) : the_row();
                    $titleSkill = get_sub_field('soft__skill__title');
                    $textSkill = get_sub_field('soft__skill__description');
                    $imgSkill = get_sub_field('soft__skill__image');
                    ?>

                    <article class="softSkill">
                        <?php if ($imgSkill && !empty($imgSkill['url'])) : ?>
                            <div class="softSkill__imageWrapper">
                                <img
                                        src="<?= esc_url($imgSkill['url']) ?>"
                                        alt="<?= esc_attr($imgSkill['alt'] ?? 'Icône pour ' . $titleSkill) ?>"
                                        class="softSkill__img"
                                        loading="lazy"
                                >
                            </div>
                        <?php endif; ?>

                        <?php if ($titleSkill) : ?>
                            <h3 class="softSkill__title"><?= esc_html($titleSkill) ?></h3>
                        <?php endif; ?>

                        <?php if ($textSkill) : ?>
                            <div class="softSkill__description">
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

            <section class="parcours sectionMargin">
                <h2 class="parcours__title"><?php the_field('parcours__title'); ?></h2>

                <?php while( have_rows('liste__parcours') ): the_row();

                    $filiere = get_sub_field('title__filiere');
                    $date = get_sub_field('date__parcours');
                    $ecole = get_sub_field('name__school');
                    $explication = get_sub_field('explication--parcours');
                    ?>

                    <div class="parcours-item">
                        <h3><?= $filiere; ?></h3>
                        <span class="date"><?= $date; ?></span>
                        <p class="ecole"><?= $ecole; ?></p>
                        <div class="description"><?= $explication; ?></div>
                    </div>

                <?php endwhile; ?>

            </section>

        <?php endif; ?>

        <!-- Passions -->
        <section class="passion__me sectionMargin">
            <?php
            $titre = get_field('title__hobbie');
            $description = get_field('desctiption__title');
            $image_loisir = get_field('hobbies__image');
            ?>

            <section class="passion__content">
                <?php if( $titre ): ?>
                    <h2 class="title"><?php echo esc_html($titre); ?></h2>
                <?php endif; ?>
                <div class="passion__content__description">
                    <?php if( $description ): ?>
                        <div class="passion__content__description__text"><?php echo wp_kses_post($description); ?></div>
                    <?php endif; ?>
                    <?php if( $image_loisir && !empty($image_loisir['url']) ): ?>
                        <div class="passion__image">
                            <img src="<?php echo esc_url($image_loisir['url']); ?>"
                                 alt="<?php echo esc_attr($image_loisir['alt']); ?>">
                        </div>
                    <?php else: ?>
                        <div class="passion__image">
                            <p style="color: red; border: 1px solid red; padding: 10px;">
                                ⚠️ Image manquante : Vérifiez le champ ACF "hobbies__image"
                            </p>
                        </div>
                    <?php endif; ?>
                </div>

            </section>

        </section>
</section>

<?php get_footer(); ?>
