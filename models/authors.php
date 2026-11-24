<?php

/**
 * 2. On récupère l'auteur.
 */
function getAuthor(int $author_id ): array|false {
    
    global $pdo;
    
    // on utilise la méthode prepare car notre requête a pas besoin d'un paramètre envoyé par l'utilisateur.
    $stmt = $pdo->prepare('SELECT * FROM `authors` WHERE `id` = ?');

    // on exécute la requête en précisant la valeur du paramètre

    $stmt->execute([$author_id]);

    //  on extrait les données de la réponse réçue.

    return $author = $stmt->fetch();
}

/**
 * 2. On récupère les livres de l'auteur.
 */
function getAuthorsBooks (int $author_id): array {
    
    global $pdo;
    
    // on utilise la méthode prepare car notre requête a pas besoin d'un paramètre envoyé par l'utilisateur.
    $stmt = $pdo->prepare('SELECT * FROM `books` WHERE `books`.`author_id` = ?');

    // on exécute la requête en précisant la valeur du paramètre
    $stmt->execute([$author_id]);

    //  on extrait les données de la réponse réçue.
    return $books = $stmt->fetchAll();
}