<?php
/**
 * 2. On récupère les livres de l'auteur.
 */

// on utilise la méthode prepare car notre requête a pas besoin d'un paramètre envoyé par l'utilisateur.
function getAuthors (int $author_id): array|false {

global $pdo;

$stmt = $pdo->prepare('SELECT * FROM `books` WHERE `books`.`author_id` = ?');

// on exécute la requête en précisant la valeur du paramètre

$stmt->execute([$author_id]);

//  on extrait les données de la réponse réçue.

return $books = $stmt->fetchAll();
}
