    <?php

    // fichier config qui définit la constante DOCUMENT_ROOT
    require_once __DIR__ . '/config/config.php';

    // Connexion à la base de données
    require_once DOCUMENT_ROOT . '/database/db_connect.php';
    $pdo = db();

    // Fichiers modèles
    require_once DOCUMENT_ROOT . '/models/authors.php';
    require_once DOCUMENT_ROOT . '/models/books.php';

    // Fichiers controleurs
    require_once DOCUMENT_ROOT . '/controllers/authors.php';
    require_once DOCUMENT_ROOT . '/controllers/books.php';  

    // Récupère la page demandée dans l'URL (vide si aucun paramètre "page")

    $page = $_GET["page"] ?? "";

    //Routeur
    match ($page) {
    "", "home" => listBookCtrl(),
    "book" => showBookCtrl(),
    "author" => showAuthorCtrl(),
    "delete" => deleteBookCtrl(),
    default => listBookCtrl()
    };