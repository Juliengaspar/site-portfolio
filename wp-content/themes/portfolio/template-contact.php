<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>
<?php
require_once get_template_directory() . '/inc/contact/contact-form.php';
$result = portfolio_handle_contact_form();
?>
    <main id="main" class="contact-page main" itemscope itemtype="https://schema.org/ContactPage">

        <noscript>
            <div class="no-js-message">
                Pour profiter pleinement des fonctionnalités du site, veuillez activer JavaScript.
            </div>
        </noscript>
        <h2 class="title"><?= get_the_title() ?></h2>

        <?php get_template_part('templates/componements/contact/contact-header.php'); ?>

        <section class="contact-form" itemscope itemtype="https://schema.org/ContactPoint">
            <header class="contact-form__header">
                <h3 class="contact-form__title" itemprop="name"><?php the_field("titile__page__form"); ?></h3>
                <p class="contact-form__description" itemprop="description"><?php the_field("text__form"); ?></p>
            </header>

            <!-- Affichage du message de succès -->
            <?php if ( ! empty( $result['success'] ) ) : ?>
                <p class="form__success" role="status"><?= esc_html( $result['success'] ); ?></p>
            <?php endif; ?>

            <!-- Affichage des erreurs globales -->
            <?php if ( ! empty( $result['errors']['global'] ) ) : ?>
                <p class="form__error-global" role="alert"><?= esc_html( $result['errors']['global'] ); ?></p>
            <?php endif; ?>

            <form action="#" method="post" class="form" novalidate aria-label="Formulaire de contact">
                <?php wp_nonce_field('contact_form', 'contact_nonce'); ?>

                <!-- Honeypot -->
                <div class="honeypot" aria-hidden="true">
                    <label for="website">Ne pas remplir ce champ</label>
                    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                </div>

                <!-- Nom -->
                <div class="form__group <?= isset($result['errors']['lastName']) ? 'has-error' : ''; ?>" id="champs_name">
                    <label for="lastName" class="form__group__label">Nom <span class="form__note">*</span></label>
                    <input type="text" name="lastName" id="lastName" class="form__group__input"
                           value="<?= esc_attr($result['values']['lastName'] ?? '') ?>"
                           placeholder="Votre nom de famille">
                    <?php if (isset($result['errors']['lastName'])) : ?>
                        <span class="error"><?= esc_html($result['errors']['lastName']); ?></span>
                    <?php endif; ?>
                </div>

                <!-- Prénom -->
                <div class="form__group <?= isset($result['errors']['firstName']) ? 'has-error' : ''; ?>" id="champs_first_name">
                    <label for="firstName" class="form__group__label">Prénom <span class="form__note">*</span></label>
                    <input type="text" name="firstName" id="firstName" class="form__group__input"
                           value="<?= esc_attr($result['values']['firstName'] ?? '') ?>"
                           placeholder="votre prénom">
                    <?php if (isset($result['errors']['firstName'])) : ?>
                        <span class="error"><?= esc_html($result['errors']['firstName']); ?></span>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div class="form__group <?= isset($result['errors']['email']) ? 'has-error' : ''; ?>" id="champs_email">
                    <label for="email" class="form__group__label">Email <span class="form__note">*</span></label>
                    <input type="email" name="email" id="email" class="form__group__input"
                           value="<?= esc_attr($result['values']['email'] ?? '') ?>"
                           placeholder="votre adresse mail" autocomplete="email" itemprop="email">
                    <?php if (isset($result['errors']['email'])) : ?>
                        <span class="error"><?= esc_html($result['errors']['email']); ?></span>
                    <?php endif; ?>
                </div>

                <!-- Sujet -->
                <div class="form__group" id="champs_subject">
                    <label for="subjectMessage" class="form__group__label" aria-label="Sujet du message">Sujet</label>
                    <select name="subjectMessage" id="subjectMessage">
                        <option value="Collaboration" <?= selected($result['values']['subject'] ?? '', 'Collaboration', false); ?>>Collaboration</option>
                        <option value="Informations" <?= selected($result['values']['subject'] ?? '', 'Informations', false); ?>>Informations</option>
                        <option value="Emploi" <?= selected($result['values']['subject'] ?? '', 'Emploi', false); ?>>Emploi</option>
                        <option value="Autre" <?= selected($result['values']['subject'] ?? '', 'Autre', false); ?>>Autre</option>
                    </select>
                </div>

                <!-- Message -->
                <div class="form__group <?= isset($result['errors']['message']) ? 'has-error' : ''; ?>" id="champs_message">
                    <label for="message" class="form__group__label">Message <span class="form__note">*</span></label>
                    <textarea name="message" id="message" aria-required="true"><?= esc_textarea($result['values']['message'] ?? '') ?></textarea>
                    <?php if (isset($result['errors']['message'])) : ?>
                        <span class="error"><?= esc_html($result['errors']['message']); ?></span>
                    <?php endif; ?>
                </div>

                <p class="form__note">* Champs obligatoires</p>

                <button type="submit" name="envoyer" class="btn-submit" aria-label="Envoyer le formulaire">
                    Envoyer
                </button>
            </form>
        </section>
    </main>
<?php get_footer(); ?>