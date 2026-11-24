<?php


function showAuthorCtrl() {

    $author_id = null;
    
    if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
        // on nettoie le paramètre pour se protéger contre les injections de code.
        $author_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    }
    
    if (!$author_id) {
        die("Vous devez définir un paramètre id valide dans l'url");
    }

    $author = getAuthor($author_id);
    
    if (!$author) {
        http_response_code(404);
        die('Auteur introuvable.');
    }
    
    $books = getAuthorsBooks($author_id);

    $title = $author['name'];
    
    $heading = $author['name'];

    require_once DOCUMENT_ROOT . '/templates/authors/showAuthors.php';
}
