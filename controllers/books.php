<?php

/**
 * Affiche la page de détail d'un livre (404 si le livre n'existe pas).
 */
function showBookCtrl() {

    $book_id = null;

    if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
        $book_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    }

    if (!$book_id) {
        die("Vous devez définir un paramètre id valide dans l'url");
    }

    $book = getBook($book_id);

    if (!$book) {
        http_response_code(404);
        die('Livre introuvable.');
    }

    $title = $book['title'];
    $heading = $book['title'];

    require_once DOCUMENT_ROOT . '/templates/books/showBooks.php';
}

/**
 * Supprime un livre puis redirige vers la page d'accueil.
 */
function deleteBookCtrl() {

    $book_id = null;

    if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
        // on nettoie le paramètre pour se protéger contre les injections de code.
        $book_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    }

    if (!$book_id) {
    die("Vous devez définir renseigner un id valide");
    }

    if (!getDeleteBook($book_id)) {
        http_response_code(404);
        die('Livre introuvable.');
    }

    header('location: /index.php');
}

/**
 * Affiche la page d'accueil avec la liste de tous les livres.
 */
function listBookCtrl() {

    $books = getAllBooks();

    $title = 'Accueil';
    $heading = 'Catalogue des livres';

    require_once DOCUMENT_ROOT . '/templates/books/index.php';
}