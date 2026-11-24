<?php

function showBook() {

    $book_id = null;

    // s'il n'existe pas de paramètre, on affiche le message d'erreur
    if (!$book_id) {
        die("Vous devez définir un paramètre id valide dans l'url");
    }

    // on vérifie l'existance d'un paramètre id, non null, de type numérique
    if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
        // on nettoie le paramètre pour se protéger contre les injections de code.
        $book_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    }

    $book = getbooks($book_id);

    if (!$book) {
        http_response_code(404);
        die('Livre introuvable.');
    }

    $title = $book['title'];
    $heading = $book['title'];
}

function deleteBook() {
    
}