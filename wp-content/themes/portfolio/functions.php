<?php
// Gutenberg est le nouvel éditeur de contenu propre à Wordpress
// il ne nous intéresse pas pour l'utilisation du thème que nous
// allons créer. On va donc le désactiver :

// Disable Gutenberg on the back end.
add_filter( 'use_block_editor_for_post', '__return_false' );
// Disable Gutenberg for widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );
// Disable default front-end styles.
add_action( 'wp_enqueue_scripts', function() {
// Remove CSS on the front end.
    wp_dequeue_style( 'wp-block-library' );
// Remove Gutenberg theme.
    wp_dequeue_style( 'wp-block-library-theme' );
// Remove inline global CSS on the front end.
    wp_dequeue_style( 'global-styles' );
}, 20 );

//parametre un string et en retour (:) en string
// function regarder si une clef est bien present dans le fichier si oui ob le fais
function dw_asset(string $file): string {
    $manifest_path = get_theme_file_path( '/public/.vite/manifest.json' );
    if ( file_exists( $manifest_path ) ) {
        //retourn un tableaux asscciatif
        $manifest = json_decode( file_get_contents( $manifest_path ), true );
//tester si le tableaux associatif possede la valleur entrée
        if ( isset($manifest['wp-content/themes/portfolio/assets/css/styles.scss']) && $file === 'css' ) {
            return get_theme_file_uri( '/public/'.$manifest['wp-content/themes/portfolio/assets/css/styles.scss']['file']);
        }
        if ( isset($manifest['wp-content/themes/portfolio/assets/js/main.js']) && $file === 'js' ) {
            return get_theme_file_uri( '/public/'.$manifest['wp-content/themes/portfolio/assets/js/main.js']['file']);

        }

    }
    return '';
}
// Déclaration des menus dans wordpress
register_nav_menu('header', 'Le menu de navigation principal qui se trouve en haut de la page');
register_nav_menu('footer', 'Le menu de navigation de fin de page');

function hepl_execute_contact_form()
{
    $config = [
        //on vas récupérer le name d'un nonce(jeton de sécuriter) que nous avecs crée dans le template du formulaire
        'nonce_field'=>'contact_nonce',
        //on vas récupérer l’action d'un formulaoire qui contient le nonce
        'nonce_identifier'=>'hepl_contact_nonce',
    ];//contenir tous les jetons de sécuriser
    (new ContactForm($config, $_POST))->sanitize([
        'name'=>'text_field',
        'email'=>'email_field',
        'object'=>'text_field',
        'message'=>'textarea_field',
    ])
        ->validate([
            'name'=>['required'],
            'email'=>['required', 'email'],//verifier si la chaine n'est pa vide et si c'est bien un emial qui est bien entrée
            'object'=>[],//peux etres vide null
            'message'=>['required'],
        ])
        ->save(
        //Julien Gaspar - julien.gaspar@student.hepl.be - Objet du message
            title: fn($data) => $data['name'] . ' - ' .$data['email'] . ' -  ' . $data['object'],//la valeur du title avec une fonction anonyme avec une tableaux contenat la valeur du champs name
            content: fn($data) => $data['message'],//le contenu de la message
        )//stoker les message de de formulaire
        ->send(
            title: fn($data) => 'Nouveaux message de ' . $data['name'],
            content: fn($data) => 'Nom complet :  ' . $data['name'] .PHP_EOL . 'Adresse mail: ' . $data['email'] . PHP_EOL . 'Objet: ' . $data['object'] . PHP_EOL . 'Message: ' . $data['message'],
        )//message envoyer par l'utilisateur par mail
        ->feedback();//les parrametres passer dans le constructor qui permetre de verifier les donner envoyer et apres de valider les reponser avec une autre methode puis les sauvgarder puis les envoyer a l'utilisateur et envoi un feedback si on a bien tous remplis et si pas d'erreur

}