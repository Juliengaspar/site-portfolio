<?php
/**
 * Récupère une valeur POST nettoyée (texte ou email).
 */
function contact_get_safe_post_value($key, $default = '') {
    if (!isset($_POST[$key])) {
        return $default;
    }
    $value = trim($_POST[$key]);
    // Si c'est un email, on utilise sanitize_email, sinon sanitize_text_field
    if ($key === 'email') {
        return sanitize_email($value);
    }
    return sanitize_text_field($value);
}

/**
 * Récupère un texte long (message) en nettoyant.
 */
function contact_get_safe_post_textarea($key, $default = '') {
    if (!isset($_POST[$key])) {
        return $default;
    }
    return sanitize_textarea_field(trim($_POST[$key]));
}

/**
 * Vérifie le nonce et le honeypot.
 * Retourne true si tout est valide, sinon un message d'erreur.
 */
function contact_check_security($config) {
    // Nonce
    if (!isset($_POST[$config['nonce_name']]) ||
        !wp_verify_nonce($_POST[$config['nonce_name']], $config['nonce_action'])) {
        return 'Erreur de sécurité, veuillez réessayer.';
    }
    // Honeypot
    if (!empty($_POST[$config['honeypot_field']])) {
        return 'Spam détecté.';
    }
    return true; // tout va bien
}