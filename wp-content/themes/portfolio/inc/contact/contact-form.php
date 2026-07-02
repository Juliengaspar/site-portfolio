<?php
/**
 * Gestionnaire principal du formulaire de contact.
 * Retourne un tableau avec 'success', 'errors' et 'values'.
 */
function portfolio_handle_contact_form() {
    // Charger les dépendances
    require_once __DIR__ . '/config.php';
    require_once __DIR__ . '/helpers.php';
    require_once __DIR__ . '/validation.php';
    require_once __DIR__ . '/mail.php';

    $config = include __DIR__ . '/config.php';

    // Initialisation du résultat
    $result = [
        'success' => '',
        'errors'  => [],
        'values'  => []
    ];

    // Si le formulaire n'est pas soumis, on retourne directement
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['envoyer'])) {
        return $result;
    }

    // Vérification sécurité (nonce + honeypot)
    $security_check = contact_check_security($config);
    if ($security_check !== true) {
        $result['errors']['global'] = $security_check;
        return $result;
    }

    // Récupération des données
    $data = [
        'lastName'  => contact_get_safe_post_value('lastName'),
        'firstName' => contact_get_safe_post_value('firstName'),
        'email'     => contact_get_safe_post_value('email'),
        'subject'   => contact_get_safe_post_value('subjectMessage', 'Autre'),
        'message'   => contact_get_safe_post_textarea('message'),
    ];

    $result['values'] = $data; // pour réaffichage

    // Validation
    $errors = contact_validate_fields($data);
    if (!empty($errors)) {
        $result['errors'] = $errors;
        return $result;
    }

    // Envoi de l'e-mail
    $mail_sent = contact_send_email($data, $config);

    if (!$mail_sent) {
        $result['errors']['global'] = 'Une erreur est survenue lors de l\'envoi. Veuillez réessayer ou nous contacter directement.';
        return $result;
    }

    // Stockage en base
    if ($config['store_in_db']) {
        contact_store_message($data, $config);
    }

    // Succès
    $result['success'] = 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.';
    $result['values'] = []; // vider pour ne pas réafficher les données

    return $result;
}

