<?php

/**
 * CE FICHIER EST LA PAGE D'ACCUEIL DU SITE. ELLE DOIT AFFICHER LA LISTE DES LIVRES DISPONIBLES DANS NOTRE BIBLIOTHEQUE.
 * 
 * On devra se connecter à la base de données et récupérer une liste de livres triés par ordre alphabétique de titre. On va boucler sur la liste pour afficher chaque item de la liste.
 */

/**
 * 1. Connexion à une base données mysql avec PDO.
 * On va créer une instance de PDO en précisant la source de données, les identifiants de connexion à la base base de données et deux options (facultatives)
 * - Le mode d'erreur exception : permet de léver des exceptions lorsqu'une erreur sql est rencontrée.
 * - Le mode de récupération des données par défault (tableau associatif).
 */
include_once './partials/config.php';
include_once DOCUMENT_ROOT.'/database/db_connect.php';
$pdo = db();


/**
 * 2. On récupère la liste des livres.
 */

// on utilise la méthode query car notre requête n'a pas besoin de paramètre.

$stmt = $pdo->query('SELECT * FROM `books` INNER JOIN `authors` ON `books`.`author_id` = `authors`.`id`');

//  on extrait les données de la réponse réçue.

$books = $stmt->fetchAll();


/**
 * On affiche la page
 */
$title = 'Accueil';

$heading = 'Catalogue des livres';
?>


    <?php include_once './partials/header.php' ?>
    <main>
        <?php foreach ($books as $book): ?>
            <div class="book-card">
                <h2 class="book-card__heading">
                    <?= $book['title'] ?>
                </h2>
                <!-- on crée un lien vers la page d'un auteur -->
                <div class="book-card__body">
                    <h3 class="book-card__subheading"><a href="/pages/author.php?id=<?= $book['author_id'] ?>">
                            <i>
                                <?= $book['name'] ?>
                            </i>
                        </a>
                    </h3>
                    <p class="book-card__description">
                        <?= $book['description'] ?>
                    </p>
                </div>
                <div class="book-card__footer">
                    <a href="pages/book.php?id=<?= $book['id'] ?>">En savoir plus</a>
                    <form id="form-<?= $book['id'] ?>" action="delete-book.php" method="post">
                        <input type="hidden" name="id" value="<?= $book['id'] ?>">
                        <button>Supprimer</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </main>

<?php
include_once './partials/footer.php';
?>

    <script>
        // on attend le chargement du DOM avec d'exécuter le code js
        window.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('form');
            forms.forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    let form = e.currentTarget;
                    Swal.fire({
                        title: 'Suppression d\'un livre',
                        text: 'Voulez vous supprimer définitivement le livre ?',
                        icon: 'warning',
                        confirmButtonText: 'Supprimer'
                    }).then(function (isConfirm) {
                        if (isConfirm) {
                            console.log('suppression confirmée', form);
                            // soumission du formulaire par le code
                            form.submit();
                        }
                    });
                })
            });
        })
    </script>
