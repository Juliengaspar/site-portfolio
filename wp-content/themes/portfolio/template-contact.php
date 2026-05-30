<?php /* Template Name: Contact */?>

<?php get_header(); ?>
<?php
$title = get_the_title();
// Traitement du formulaire
$success = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['envoyer'])) {
    $lastName   = sanitize_text_field($_POST['lastName']);
    $firstName  = sanitize_text_field($_POST['firstName']);
    $email      = sanitize_email($_POST['email']);
    $sujet      = sanitize_text_field($_POST['subjetMessage']);
    $message    = sanitize_textarea_field($_POST['message']);

    // Validation basique
    if (empty($lastName)) $errors['lastName'] = "Le nom est obligatoire.";
    if (empty($firstName)) $errors['firstName'] = "Le prénom est obligatoire.";
    if (!is_email($email)) $errors['email'] = "Adresse email invalide.";
    if (empty($message)) $errors['message'] = "Le message est obligatoire.";

    // Si pas d'erreurs, envoyer l'email
    if (empty($errors)) {
        $to = "jgaspar@oginformatique.be";
        $subject = "Nouveau message de $firstName $lastName : $sujet";
        $headers = "From: $firstName $lastName <$email>\r\nReply-To: $email\r\n";
        $body = "Nom : $lastName\nPrénom : $firstName\nEmail : $email\nSujet : $sujet\n\nMessage :\n$message";

        if (wp_mail($to, $subject, $body, $headers)) {
            $success = "✅ Votre message a bien été envoyé !";
        } else {
            $success = "❌ Une erreur est survenue. Merci de réessayer plus tard.";
        }
    }
}
?>
<main id="main" class="contact-page" itemscope itemtype="https://schema.org/ContactPage">

    <h2 class="contact-page__title title" itemprop="headline"><?= $title; ?></h2>

    <section class="contact-page__container"  aria-labelledby="contact-form-title">

        <!-- FORMULAIRE -->
        <section class="contact-form" itemscope itemtype="https://schema.org/ContactPoint">

            <header class="contact-form__header">
                <h3 class="contact-form__title" itemprop="name"><?php the_field("titile__page__form"); ?></h3>
                <p class="contact-form__description" itemprop="description"><?php the_field("text__form"); ?></p>
            </header>

            <?php if (!empty($success)): ?>
                <p class="form__success"  role="status" ><?= esc_html($success); ?></p>
            <?php endif; ?>

            <form  action="#"  method="post" class="form" novalidate aria-label="Formulaire de contact">

                <div class="form__group">
                    <label for="lastName" class="form__group__label">Nom <span class="form__note">*</span></label>
                    <input type="text" name="lastName" id="lastName" class="form__group__input" value="<?= esc_attr($_POST['lastName'] ?? '') ?>" placeholder="Votre nom de famille">
                    <?php if (isset($errors['lastName'])): ?>
                        <span class="error"><?= $errors['lastName']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form__group">
                    <label for="firstName" class="form__group__label">Prénom <span class="form__note">*</span></label>
                    <input type="text" name="firstName" id="firstName" class="form__group__input" value="<?= esc_attr($_POST['firstName'] ?? '') ?>" placeholder="votre prenom">
                </div>

                <div class="form__group">
                    <label for="email" class="form__group__label">Email <span class="form__note">*</span></label>
                    <input type="email" name="email" id="email" class="form__group__input" value="<?= esc_attr($_POST['email'] ?? '') ?>" placeholder="entrez votre adresse mail"  autocomplete="email" itemprop="email">
                </div>

                <div class="form__group">
                    <label for="subjectMessage" class="form__group__label" aria-label="Sujet du message">Sujet</label>
                    <select name="subjectMessage" id="subjectMessage">
                        <option>Collaboration</option>
                        <option>Informations</option>
                        <option>Emploi</option>
                        <option>Autre</option>
                    </select>
                </div>

                <div class="form__group">
                    <label for="message" class="form__group__label">Message <span class="form__note">*</span></label>
                    <textarea name="message" id="message" aria-required="true"><?= esc_textarea($_POST['message'] ?? '') ?></textarea>
                </div>

                <p class="form__note">* Champs obligatoires</p>

                <button type="submit" name="envoyer" class="btn-submit" aria-label="Envoyer le formulaire">
                    Envoyer
                </button>

            </form>
        </section>

        <!-- COORDONNÉES -->
        <aside class="contact-info" itemscope itemtype="https://schema.org/Organization">

            <?php $img = get_field('form__picture'); ?>
            <?php if ($img): ?>
                <img src="<?= esc_url($img['url']); ?>" alt="<?= esc_attr($img['alt']); ?>" class="contact-info__img" itemprop="image">
            <?php endif; ?>

            <h3 itemprop="name">><?= get_field('title__reseaux__sociaux'); ?></h3>

            <ul class="icones"

            <?php $img = get_field('form__picture'); ?>
            <?php if ($img): ?>
                <img src="<?= esc_url($img['url']); ?>" alt="<?= esc_attr($img['alt']); ?>" class="contact-info__img" itemprop="image">
        <?php endif; ?>

            <h3><?= get_field('title__reseaux__sociaux'); ?></h3>

            <ul class="icones">
                <li id="email" class="icones__liste" itemprop="email">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#email"></use>
                    </svg>
                    <span><?= get_field("email"); ?></span>
                </li>
                <li id="tel" class="icones__liste">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#Icone__tel"></use>
                    </svg>
                    <span><?= get_field("number__tel"); ?></span>
                </li>

                <li id="adresse" class="icones__liste">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#Icone__adresse"></use>
                    </svg>
                    <span><?= get_field("adresse"); ?></span>
                </li>
            </ul>
        </aside>

    </section>

</main>
<?php get_footer(); ?>
