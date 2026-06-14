<?php /* Template Name: Contact */?>

<?php get_header(); ?>
<?php
use controllers\ContactForm;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $form = new ContactForm(
            [
                    'nonce_field' => 'contact_nonce',
                    'identifier' => 'contact_form'
            ],
            $_POST
    );

    $form
            ->sanitize([
                    'lastName' => 'text_field',
                    'firstName' => 'text_field',
                    'email' => 'email',
                    'message' => 'textarea_field'
            ])
            ->validate([
                    'lastName' => ['required'],
                    'firstName' => ['required'],
                    'email' => ['required', 'email'],
                    'message' => ['required']
            ])
            ->send(
                    fn($data) => 'Nouveau message',
                    fn($data) => $data['message']
            )
            ->feedback();
}
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
<main id="main" class="contact-page main" itemscope itemtype="https://schema.org/ContactPage">

    <noscript>
        <div class="no-js-message">
            Pour profiter pleinement des fonctionnalités du site, veuillez activer JavaScript.
        </div>
    </noscript>
    <h2 class="title"><?= get_the_title() ?></h2>

    <?php get_template_part('templates/componements/contact/contact-header.php'); ?>


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
                <?php wp_nonce_field('contact_form', 'contact_nonce'); ?>

                <div class="honeypot" aria-hidden="true">
                    <label for="website">
                        Ne pas remplir ce champ
                    </label>

                    <input
                            type="text"
                            id="website"
                            name="website"
                            tabindex="-1"
                            autocomplete="off">
                </div>
                <div class="form__group" id="champs_name">
                    <label for="lastName" class="form__group__label">Nom <span class="form__note">*</span></label>
                    <input type="text" name="lastName" id="lastName" class="form__group__input" value="<?= esc_attr($_POST['lastName'] ?? '') ?>" placeholder="Votre nom de famille">
                    <?php if (isset($errors['lastName'])): ?>
                        <span class="error"><?= esc_html($errors['lastName']); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form__group" id="champs_first_name">
                    <label for="firstName" class="form__group__label">Prénom <span class="form__note">*</span></label>
                    <input type="text" name="firstName" id="firstName" class="form__group__input" value="<?= esc_attr($_POST['firstName'] ?? '') ?>" placeholder="votre prénom">
                </div>

                <div class="form__group" id="champs_email">
                    <label for="email" class="form__group__label">Email <span class="form__note">*</span></label>
                    <input type="email" name="email" id="email" class="form__group__input" value="<?= esc_attr($_POST['email'] ?? '') ?>" placeholder="votre adresse mail"  autocomplete="email" itemprop="email">
                </div>

                <div class="form__group" id="champs_subject">
                    <label for="subjectMessage" class="form__group__label" aria-label="Sujet du message">Sujet</label>
                    <select name="subjectMessage" id="subjectMessage">
                        <option>Collaboration</option>
                        <option>Informations</option>
                        <option>Emploi</option>
                        <option>Autre</option>
                    </select>
                </div>

                <div class="form__group" id="champs_message">
                    <label for="message" class="form__group__label">Message</label>
                    <textarea name="message" id="message" aria-required="true"><?= esc_textarea($_POST['message'] ?? '') ?></textarea>
                </div>

                <p class="form__note">* Champs obligatoires</p>

                <button type="submit" name="envoyer" class="btn-submit" aria-label="Envoyer le formulaire">
                    Envoyer
                </button>

            </form>
        </section>
</main>
<?php get_footer(); ?>
