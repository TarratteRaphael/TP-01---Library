<?php

// s'il n'existe pas de paramètre, on affiche le message d'erreur
function bookNotExsit(int $book_id) {
    if (!$book_id) {
        die("Vous devez définir un paramètre id valide dans l'url");
    }
}

// on vérifie l'existance d'un paramètre id, non null, de type numérique
function idIfExist() {
    if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
        // on nettoie le paramètre pour se protéger contre les injections de code.
        $book_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    }
}

function error(string $book) {
    if (!$book) {
        http_response_code(404);
        die('Livre introuvable.');
}
}
/**
 * On affiche la page
 */
function showPage(string $book) {
    $title = $book['title'];

    $heading = $book['title'];
}