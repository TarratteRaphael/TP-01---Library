<?php
/**
 * 2. On récupère les livres de l'auteur.
 */

// on utilise la méthode prepare car notre requête a pas besoin d'un paramètre envoyé par l'utilisateur.

$stmt = $pdo->prepare('SELECT * FROM `books` WHERE `books`.`author_id` = ?');

// on exécute la requête en précisant la valeur du paramètre

$stmt->execute([$author['id']]);

//  on extrait les données de la réponse réçue.

$books = $stmt->fetchAll();
