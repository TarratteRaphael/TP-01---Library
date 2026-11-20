<?php

/**
 * CE FICHIER DOIT AFFICHER UN LIVRE. 
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
$book_id = null;

// on vérifie l'existance d'un paramètre id, non null, de type numérique
if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    // on nettoie le paramètre pour se protéger contre les injections de code.
    $book_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
}

// s'il n'existe pas de paramètre, on affiche le message d'erreur

if (!$book_id) {
    die("Vous devez définir un paramètre id valide dans l'url");
}

/**
 * 2. Connexion à une base données mysql avec PDO.
 * On va créer une instance de PDO en précisant la source de données, les identifiants de connexion à la base base de données et deux options (facultatives)
 * - Le mode d'erreur exception : permet de léver des exceptions lorsqu'une erreur sql est rencontrée.
 * - Le mode de récupération des données par défault (tableau associatif).
 */

$pdo = new PDO('mysql:dbname=library;host=localhost;charset=utf8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

/**
 * 2. On récupère le livre.
 */

// on utilise la méthode prepare car notre requête a pas besoin d'un paramètre envoyé par l'utilisateur.

$stmt = $pdo->prepare('SELECT * FROM `books` INNER JOIN `authors` ON `books`.`author_id` = `authors`.`id` WHERE `books`.`id` = ?');

// on exécute la requête en précisant la valeur du paramètre

$stmt->execute([$book_id]);

//  on extrait les données de la réponse réçue.

$book = $stmt->fetch();


/**
 * On affiche la page
 */
$title = $book['title'];

$heading = $book['title'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>
    </title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script defer src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <header class="header">
        <div class="header__container">
            <a href="index.php"><img src="./assets/img/open-book.svg" alt="logo livre"></a>
            <h1>
                <?= $heading ?>
            </h1>
        </div>
    </header>
    <header>
        <h1><?= $book['title'] ?></h1>
    </header>

    <main>
        <section>
            <h2><?= $book['subtitle'] ?></h2>
            <h3><a href="author.php?id=<?= $book['author_id'] ?>"><i><?= $book['name'] ?></i></a></h3>
            <p><?= $book['description'] ?></p>
            <p>Édition <?= $book['publisher'] ?> | date <?= $book['published'] ?> | p. <?= $book['pages'] ?></p>
            <a href="<?= $book['website'] ?>">site internet</a>
        </section>
    </main>
    <footer class="footer">
        <p>&copy;<?= date('Y') ?></p>
        <div>Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a
                href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
    </footer>
</body>

</html>