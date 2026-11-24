<?php 
/**
 * 2. On récupère le livre.
 */
function getBook(int $book_id): array|false {

global $pdo;

// on utilise la méthode prepare car notre requête a pas besoin d'un paramètre envoyé par l'utilisateur.
$stmt = $pdo->prepare('SELECT * FROM `books` INNER JOIN `authors` ON `books`.`author_id` = `authors`.`id` WHERE `books`.`id` = ?');

// on exécute la requête en précisant la valeur du paramètre
$stmt->execute([$book_id]);

//  on extrait les données de la réponse réçue.
return $book = $stmt->fetch();
}

// On récupère tous les livres.
function getAllBooks() {
    global $pdo;

    $stmt = $pdo->prepare('SELECT * FROM `books` INNER JOIN `authors` ON `books`.`author_id` = `authors`.`id` ORDER BY `books`.`title`');

    $stmt->execute();

    return $stmt->fetchAll();
}

/**
 * 2. On récupère le livre et on le supprime.
 */
function getDeleteBook(int $book_id): bool {

    global $pdo;
    // on utilise la méthode prepare car notre requête a pas besoin d'un paramètre envoyé par l'utilisateur.
    $stmt = $pdo->prepare('DELETE FROM `books` WHERE `id` = ?');

    // on exécute la requête en précisant la valeur du paramètre
    return $stmt->execute([$book_id]);
}