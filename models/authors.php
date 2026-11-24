<?php

/**
 * On récupère l'auteur à partir de son id
 *
 * @param int $author_id
 */
function getAuthor(int $author_id ): array|false {
    
    global $pdo;

    $stmt = $pdo->prepare('SELECT * FROM `authors` WHERE `id` = ?');

    $stmt->execute([$author_id]);

    return $author = $stmt->fetch();
}

/**
 * On récupère les livres de l'auteur à partir de son id
 */
function getAuthorsBooks (int $author_id): array {
    
    global $pdo;
    
    $stmt = $pdo->prepare('SELECT * FROM `books` WHERE `books`.`author_id` = ?');

    $stmt->execute([$author_id]);

    return $books = $stmt->fetchAll();
}