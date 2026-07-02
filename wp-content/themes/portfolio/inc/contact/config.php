<?php
/**
 * Configuration du formulaire de contact
 * Retourne un tableau de paramètres.
 */
return [
    // Destinataire principal (peut être modifié via le champ ACF ou une option)
    'recipient_email' => get_option('admin_email'), // ou 'votre@email.fr' en dur

    // Préfixe du sujet du mail
    'subject_prefix'  => '[Contact] ',

    // Enregistrer le message dans la base de données ? (post privé)
    'store_in_db'     => true,

    // Type de publication pour le stockage (peut être un CPT)
    'post_type'       => 'messages',

    // Clé du nonce
    'nonce_action'    => 'contact_form',
    'nonce_name'      => 'contact_nonce',

    // Nom du champ honeypot
    'honeypot_field'  => 'website',
];