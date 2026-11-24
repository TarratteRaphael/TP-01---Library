<?php

/**
 * CE FICHIER DOIT AFFICHER UN AUTEUR ET SES LIVRES. 
 */

/**
 * On doit d'abord vérifier qu'il existe un paramètre id, sinon on affiche un message d'erreur.
 * 
 * Si le paramètre est trouvé, on va se connecter à la base de données et chercher le livre enregistrer avec cet id.
 * Si aucun livre n'est trouvé, on affiche une erreur 404
 * Sinon, on affiche le livre.
 */

/**
 * 1. On récupère le paramètre d'url id
 */
// on déclare la variable qui va récevoir l'id et on l'initialise avec rien.
$author_id = null;

// on vérifie l'existance d'un paramètre id, non null, de type numérique
if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    // on nettoie le paramètre pour se protéger contre les injections de code.
    $author_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
}

// s'il n'existe pas de paramètre, on affiche le message d'erreur

if (!$author_id) {
    die("Vous devez définir un paramètre id valide dans l'url");
}

/**
 * 2. Connexion à une base données mysql avec PDO.
 * On va créer une instance de PDO en précisant la source de données, les identifiants de connexion à la base base de données et deux options (facultatives)
 * - Le mode d'erreur exception : permet de léver des exceptions lorsqu'une erreur sql est rencontrée.
 * - Le mode de récupération des données par défault (tableau associatif).
 */
include_once '../partials/config.php';
include_once DOCUMENT_ROOT.'/database/db_connect.php';
$pdo = db();

if (!$author) {
    http_response_code(404);
    die('Auteur introuvable.');
}

/**
 * On affiche la page
 */
$title = $author['name'];

$heading = $author['name'];
?>