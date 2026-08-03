<?php
/**
 * Valide les données du formulaire.
 * Retourne un tableau d'erreurs (clé => message).
 */
function contact_validate_fields($data) {
    $errors = [];

    if (empty($data['lastName'])) {
        $errors['lastName'] = 'Le nom est obligatoire.';
    }
    if (empty($data['firstName'])) {
        $errors['firstName'] = 'Le prénom est obligatoire.';
    }
    if (empty($data['email']) || !is_email($data['email'])) {
        $errors['email'] = 'Veuillez saisir un email valide.';
    }
    if (empty($data['message'])) {
        $errors['message'] = 'Le message est obligatoire.';
    }
    if ( empty($data['rgpd']) ) {
        $errors['rgpd'] = 'Vous devez accepter la politique de confidentialité pour envoyer ce formulaire.';
    }
    // On peut ajouter d'autres validations (longueur, etc.)

    return $errors;
}