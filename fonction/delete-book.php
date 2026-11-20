<?php

/**
 * CE FICHIER DOIT SUPPRIMER UN LIVRE. 
 */

/**
 * On doit d'abord vérifier qu'il existe un id a été posté, sinon on affiche un message d'erreur.
 * 
 * Si l'id est trouvé, on va se connecter à la base de données et chercher le livre enregistrer avec cet id pour le supprimer.
 * Si aucun livre n'est trouvé, on affiche une erreur 404
 * Sinon, on supprime le livre et on fait une redirection vers le catalogue.
 */

/**
 * 1. On récupère l'id du post
 */
// on déclare la variable qui va récevoir l'id et on l'initialise avec rien.
$book_id = null;

// on vérifie l'existance d'un id, non null, de type numérique
if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
    // on nettoie le paramètre pour se protéger contre les injections de code.
    $book_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
}

// s'il n'existe pas de paramètre, on affiche le message d'erreur

if (!$book_id) {
    die("Vous devez définir renseigner un id valide");
}

/**
 * 2. Connexion à une base données mysql avec PDO.
 * On va créer une instance de PDO en précisant la source de données, les identifiants de connexion à la base base de données et deux options (facultatives)
 * - Le mode d'erreur exception : permet de léver des exceptions lorsqu'une erreur sql est rencontrée.
 * - Le mode de récupération des données par défault (tableau associatif).
 */

include_once DOCUMENT_ROOT.'/database/db_connect.php';

/**
 * 2. On récupère le livre.
 */

// on utilise la méthode prepare car notre requête a pas besoin d'un paramètre envoyé par l'utilisateur.

$stmt = $pdo->prepare('DELETE FROM `books` WHERE `id` = ?');

// on exécute la requête en précisant la valeur du paramètre

$stmt->execute([$book_id]);


/**
 * On redirige vers le catalogue de livres
 */

header('Location: index.php');
exit();
