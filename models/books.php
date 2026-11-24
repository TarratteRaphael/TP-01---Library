<?php 
/**
 * On récupère un livre à partir de son id
 * 
 * @param int $book_id
 */
function getBook(int $book_id): array|false {

global $pdo;

$stmt = $pdo->prepare('SELECT * FROM `books` INNER JOIN `authors` ON `books`.`author_id` = `authors`.`id` WHERE `books`.`id` = ?');

$stmt->execute([$book_id]);

return $book = $stmt->fetch();
}

/**
 * Récupère tous les livres avec le nom de leur auteur, triés par titre
 */
function getAllBooks() {
    global $pdo;

    $stmt = $pdo->prepare('SELECT * FROM `books` INNER JOIN `authors` ON `books`.`author_id` = `authors`.`id` ORDER BY `books`.`title`');

    $stmt->execute();

    return $stmt->fetchAll();
}

/**
 * Supprime un livre à partir de son id
 *
 * @param int $book_id
 */
function getDeleteBook(int $book_id): bool {

    global $pdo;
    // on utilise la méthode prepare car notre requête a pas besoin d'un paramètre envoyé par l'utilisateur.
    $stmt = $pdo->prepare('DELETE FROM `books` WHERE `id` = ?');

    // on exécute la requête en précisant la valeur du paramètre
    return $stmt->execute([$book_id]);
}