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

<title><?= $title ?></title>
<main id="main" class="contact-page">

    <h2 class="contact-page__title title"><?= esc_html($title); ?></h2>

    <section class="contact-page__container">

        <!-- FORMULAIRE -->
        <section class="contact-form">

            <header class="contact-form__header">
                <h3 class="contact-form__title" ><?php the_field("titile__page__form"); ?></h3>
                <p><?php the_field("text__form"); ?></p>
            </header>

            <?php if (!empty($success)): ?>
                <p class="form__success"><?= esc_html($success); ?></p>
            <?php endif; ?>

            <form method="post" novalidate>

                <div class="form__group">
                    <label for="lastName">Nom *</label>
                    <input type="text" name="lastName" id="lastName" value="<?= esc_attr($_POST['lastName'] ?? '') ?>">
                    <?php if (isset($errors['lastName'])): ?>
                        <span class="error"><?= $errors['lastName']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form__group">
                    <label for="firstName">Prénom *</label>
                    <input type="text" name="firstName" id="firstName" value="<?= esc_attr($_POST['firstName'] ?? '') ?>">
                </div>

                <div class="form__group">
                    <label for="email">Email *</label>
                    <input type="email" name="email" id="email" value="<?= esc_attr($_POST['email'] ?? '') ?>">
                </div>

                <div class="form__group">
                    <label for="subjectMessage">Sujet</label>
                    <select name="subjectMessage" id="subjectMessage">
                        <option>Collaboration</option>
                        <option>Informations</option>
                        <option>Emploi</option>
                        <option>Autre</option>
                    </select>
                </div>

                <div class="form__group">
                    <label for="message">Message *</label>
                    <textarea name="message" id="message"><?= esc_textarea($_POST['message'] ?? '') ?></textarea>
                </div>

                <p class="form__note">* Champs obligatoires</p>

                <button type="submit" name="envoyer" class="btn-submit">
                    Envoyer
                </button>

            </form>
        </section>

        <!-- COORDONNÉES -->
        <aside class="contact-info">

            <?php $img = get_field('form__picture'); ?>
            <?php if ($img): ?>
                <img src="<?= esc_url($img['url']); ?>" alt="<?= esc_attr($img['alt']); ?>">
            <?php endif; ?>

            <h3><?= get_field('title__reseaux__sociaux'); ?></h3>

            <ul>

                <li id="email">
                    <svg class="icon" aria-hidden="true" focusable="false" width="50px" height="50px">
                        <use xlink:href="#Icone__tel"></use>
                    </svg>
                    <?= get_field("email"); ?></li>
                <li id="tel"><?= get_field("number__tel"); ?></li>
                <li id="adresse"><?= get_field("adresse"); ?></li>
            </ul>

        </aside>

    </section>

</main>
<?php get_footer(); ?>
