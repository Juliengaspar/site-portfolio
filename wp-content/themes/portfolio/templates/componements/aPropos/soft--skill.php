<?php
?>

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
