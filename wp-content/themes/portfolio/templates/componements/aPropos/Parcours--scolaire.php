<!-- Parcours scolaire -->
<?php if( have_rows('liste__parcours') ): ?>
    <?php
    $parcoursTitle = get_field('parcours__title');
    ?>
    <h2 class="parcours__subtitle subtitle"><?= esc_html($parcoursTitle); ?></h2>
    <section class="parcours" aria-labelledby="parcours-title">

        <?php while( have_rows('liste__parcours') ): the_row();

            $filiere = get_sub_field('title__filiere');
            $date = get_sub_field('date__parcours');
            $ecole = get_sub_field('name__school');
            $explication = get_sub_field('explication--parcours');
            ?>
            <article class="parcours-item" itemscope itemtype="https://schema.org/EducationalOccupationalCredential">
                <section class="parcours-item__header">
                    <h3 class="parcours-item__title" itemprop="name"><?= esc_html($filiere); ?></h3>
                    <span class="parcours-item__date date" itemprop="dateCreated"><?= esc_html($date); ?></span>
                    <div class="parcours-item__school ecole" itemprop="educationalOrganization"><?= wp_kses_post($ecole); ?></div>
                </section>
                <div class="parcours-item__description" itemprop="description">
                    <?= wp_kses_post($explication); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </section>
<?php else : ?>
    <p class="error">Aucun parcours pour le moment</p>
<?php endif; ?>