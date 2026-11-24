<?php

function showBookCtrl() {

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

    $book = getBook($book_id);

    if (!$book) {
        http_response_code(404);
        die('Livre introuvable.');
    }

    $title = $book['title'];
    $heading = $book['title'];
}

function deleteBookCtrl() {

    // on déclare la variable qui va récevoir l'id et on l'initialise avec rien.
    $book_id = null;

    // on vérifie l'existance d'un id, non null, de type numérique
    if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
        // on nettoie le paramètre pour se protéger contre les injections de code.
        $book_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    }

    if (!$book_id) {
    die("Vous devez définir renseigner un id valide");
    }

    if ($stmt->rowCount() === 0) {
    http_response_code(404);
    die('Livre introuvable.');
    }
}

function listBookCtrl() {

    $book = getAllBooks();

    $title = 'Accueil';
    $heading = 'Catalogue des livres';

    require_once DOCUMENT_ROOT . './templates/books/index.php';
}