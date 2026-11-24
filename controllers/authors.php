<?php

function showAuthorCtrl() {

    // on déclare la variable qui va récevoir l'id et on l'initialise avec rien.
    $author_id = null;
    
    // on vérifie l'existance d'un paramètre id, non null, de type numérique
    if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
        // on nettoie le paramètre pour se protéger contre les injections de code.
        $author_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    }
    
    // s'il n'existe pas de paramètre, on affiche le message d'erreur
    if (!$author_id) {
        die("Vous devez définir un paramètre id valide dans l'url");
    }

    $author = getAuthor($author_id);
    
    if (!$author) {
        http_response_code(404);
        die('Auteur introuvable.');
    }
    
    $books = getAuthorsBooks($author_id);

    /**
     * On affiche la page
     */
    $title = $author['name'];
    
    $heading = $author['name'];

    require_once DOCUMENT_ROOT . './templates/authors/showAuthors.php';
}

// function listAuthorCtrl() {
//     $author = getAllAuhtors();

//     $title = '';
//     $heading = '';

//     require_once DOCUMENT_ROOT . './templates/authors/index.php';
// }
