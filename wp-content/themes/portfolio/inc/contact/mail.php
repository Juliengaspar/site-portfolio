<?php
/**
 * Envoie l'e-mail.
 * Retourne true si l'envoi a réussi, false sinon.
 */
function contact_send_email($data, $config) {
    $to = $config['recipient_email'];
    $subject = $config['subject_prefix'] . $data['subject'] . ' - ' . $data['firstName'] . ' ' . $data['lastName'];

    $body = "Nom : " . $data['lastName'] . "\n";
    $body .= "Prénom : " . $data['firstName'] . "\n";
    $body .= "Email : " . $data['email'] . "\n";
    $body .= "Sujet : " . $data['subject'] . "\n\n";
    $body .= "Message :\n" . $data['message'] . "\n";

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $data['email']
    );

    return wp_mail($to, $subject, $body, $headers);
}

/**
 * Stocke le message dans la base de données (en tant qu'article privé).
 */
function contact_store_message($data, $config) {
    if (!$config['store_in_db']) {
        return false;
    }
    $post_data = array(
        'post_title'   => sprintf('%s %s - %s', $data['firstName'], $data['lastName'], $data['subject']),
        'post_content' => $data['message'],
        'post_status'  => 'private',
        'post_type'    => $config['post_type'],
        'meta_input'   => array(
            '_contact_email' => $data['email'],
        ),
    );
    return wp_insert_post($post_data);
}