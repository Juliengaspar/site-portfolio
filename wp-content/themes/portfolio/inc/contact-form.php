<?php
/**
 * Traitement du formulaire de contact
 * Retourne un tableau avec 'success', 'errors' et 'values'
 */
function portfolio_handle_contact_form() {
    // Initialisation
    $result = [
        'success' => '',
        'errors'  => [],
        'values'  => []
    ];

    // Si le formulaire n'est pas soumis, on retourne directement
    if ( $_SERVER['REQUEST_METHOD'] !== 'POST' || ! isset( $_POST['envoyer'] ) ) {
        return $result;
    }

    // Vérification du nonce de sécurité
    if ( ! isset( $_POST['contact_nonce'] ) || ! wp_verify_nonce( $_POST['contact_nonce'], 'contact_form' ) ) {
        $result['errors']['global'] = 'Erreur de sécurité, veuillez réessayer.';
        return $result;
    }

    // Honeypot : si rempli, c'est un robot
    if ( ! empty( $_POST['website'] ) ) {
        $result['errors']['global'] = 'Spam détecté.';
        return $result;
    }

    // Récupération et nettoyage des données
    $lastName   = isset( $_POST['lastName'] ) ? sanitize_text_field( trim( $_POST['lastName'] ) ) : '';
    $firstName  = isset( $_POST['firstName'] ) ? sanitize_text_field( trim( $_POST['firstName'] ) ) : '';
    $email      = isset( $_POST['email'] ) ? sanitize_email( trim( $_POST['email'] ) ) : '';
    $subject    = isset( $_POST['subjectMessage'] ) ? sanitize_text_field( $_POST['subjectMessage'] ) : '';
    $message    = isset( $_POST['message'] ) ? sanitize_textarea_field( trim( $_POST['message'] ) ) : '';

    // Stockage des valeurs pour réaffichage
    $result['values'] = compact( 'lastName', 'firstName', 'email', 'subject', 'message' );

    // Validation
    if ( empty( $lastName ) ) {
        $result['errors']['lastName'] = 'Le nom est obligatoire.';
    }
    if ( empty( $firstName ) ) {
        $result['errors']['firstName'] = 'Le prénom est obligatoire.';
    }
    if ( empty( $email ) || ! is_email( $email ) ) {
        $result['errors']['email'] = 'Veuillez saisir un email valide.';
    }
    if ( empty( $message ) ) {
        $result['errors']['message'] = 'Le message est obligatoire.';
    }

    // S'il y a des erreurs, on s'arrête là
    if ( ! empty( $result['errors'] ) ) {
        return $result;
    }

    // --- Tout est valide : on envoie l'e-mail ---

    $to = get_option( 'admin_email' ); // ou mettez une adresse fixe : 'votre@email.fr'
    $subject_mail = sprintf( '[Contact] %s - %s %s', $subject, $firstName, $lastName );
    $body = "Nom : $lastName\n";
    $body .= "Prénom : $firstName\n";
    $body .= "Email : $email\n";
    $body .= "Sujet : $subject\n\n";
    $body .= "Message :\n$message\n";
    $headers = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email );

    $mail_sent = wp_mail( $to, $subject_mail, $body, $headers );

    if ( $mail_sent ) {
        // --- Optionnel : sauvegarder le message dans WordPress ---
        // On crée un article de type 'contact_message' (à créer via CPT ou simple post)
        // Ou on peut simplement enregistrer comme commentaire, ou ne rien faire.
        // Je vous propose de stocker dans une table personnalisée ou un CPT.
        // Pour l'exemple, on va enregistrer en tant que post (type 'post' avec statut 'private')
        $post_data = [
            'post_title'   => sprintf( '%s %s - %s', $firstName, $lastName, $subject ),
            'post_content' => $message,
            'post_status'  => 'private',
            'post_type'    => 'post', // ou un custom post type
            'meta_input'   => [
                '_contact_email' => $email,
                '_contact_phone' => '', // si vous avez un champ téléphone
            ],
        ];
        wp_insert_post( $post_data );

        // Message de succès
        $result['success'] = 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.';
        // On vide les valeurs pour ne pas réafficher le formulaire rempli
        $result['values'] = [];
    } else {
        $result['errors']['global'] = 'Une erreur est survenue lors de l\'envoi. Veuillez réessayer ou nous contacter directement.';
    }

    return $result;
}