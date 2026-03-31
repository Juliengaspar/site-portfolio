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
<section>
    <h2 class="form__titile"><?= $title ?></h2>

    <section class="forme__message">
        <div class="info__form">
            <h3 class="titile__bloc__form"><?php the_field("titile__page__form"); ?></h3>
            <p class="text__form"><?php the_field("text__form"); ?></p>
        </div>

        <?php if (!empty($success)): ?>
            <p style="color:<?php echo strpos($success, '✅') !== false ? 'green' : 'red'; ?>;"><?php echo $success; ?></p>
        <?php endif; ?>

        <section class="contact">
            <form class="form" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post">

                <div class="form__elements" id="form__last__name">
                    <label for="lastName">Nom <span>*</span></label>
                    <input type="text" name="lastName" id="lastName" value="<?php echo esc_attr($_POST['lastName'] ?? ''); ?>">
                    <?php if (isset($errors['lastName'])): ?><p class="field__error"><?php echo $errors['lastName']; ?></p><?php endif; ?>
                </div>

                <div class="form__elements" id="form__first__name">
                    <label for="firstName">Prénom <span>*</span></label>
                    <input type="text" name="firstName" id="firstName" value="<?php echo esc_attr($_POST['firstName'] ?? ''); ?>">
                    <?php if (isset($errors['firstName'])): ?><p class="field__error"><?php echo $errors['firstName']; ?></p><?php endif; ?>
                </div>

                <div class="form__elements" id="form__email">
                    <label for="email">Email <span>*</span></label>
                    <input type="email" name="email" id="email" value="<?php echo esc_attr($_POST['email'] ?? ''); ?>">
                    <?php if (isset($errors['email'])): ?><p class="field__error"><?php echo $errors['email']; ?></p><?php endif; ?>
                </div>

                <div class="form__elements" id="form__sujet">
                    <label for="subjetMessage">Sujet</label>
                    <select id="subjetMessage" name="subjetMessage">
                        <option>Proposition de projet ou collaboration</option>
                        <option>Demande d’informations supplémentaires</option>
                        <option>Opportunité d’embauche (CDI, CDD, stage…)</option>
                        <option>Autre (précisez dans le message)</option>
                    </select>
                </div>

                <div class="form__elements" id="form__message">
                    <label for="message">Message <span>*</span></label>
                    <textarea id="message" name="message" rows="5"><?php echo esc_textarea($_POST['message'] ?? ''); ?></textarea>
                    <?php if (isset($errors['message'])): ?><p class="field__error"><?php echo $errors['message']; ?></p><?php endif; ?>
                </div>

                <p class="form__elements"><span>*</span> Champs obligatoires</p>

                <button class="submit" type="submit" name="envoyer">Envoyer</button>
            </form>

            <section class="coordonnees">
                <h3 class="coordonnee">Coordonnées</h3>
                <ul>
                    <li class="coordonnee__info" id="email"><?php the_field("email"); ?></li>
                    <li class="coordonnee__info" id="number__tel"><?php the_field("number__tel"); ?></li>
                    <li class="coordonnee__info" id="adresse"><?php the_field("adresse"); ?></li>
                </ul>
            </section>
        </section>
    </section>
</section>
<?php get_footer(); ?>
