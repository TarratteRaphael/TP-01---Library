    <?php include_once './templates/partials/header.php' ?>
    <main>
        <?php foreach ($books as $book): ?>
            <div class="book-card">
                <h2 class="book-card__heading">
                    <?= htmlspecialchars($book['title']) ?>
                </h2>
                <!-- on crée un lien vers la page d'un auteur -->
                <div class="book-card__body">
                    <h3 class="book-card__subheading"><a href="?page=author&id=<?= htmlspecialchars($book['author_id']) ?>">
                            <i>
                                <?= htmlspecialchars($book['name']) ?>
                            </i>
                        </a>
                    </h3>
                    <p class="book-card__description">
                        <?= htmlspecialchars($book['description']) ?>
                    </p>
                </div>
                <div class="book-card__footer">
                    <a href="?page=book&id=<?= htmlspecialchars($book['id']) ?>">En savoir plus</a>
                    <form id="form-<?= htmlspecialchars($book['id']) ?>" action="?page=delete" method="post">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($book['id']) ?>">
                        <button>Supprimer</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </main>


<script src="../assets/js/scripts.js"></script>

<?php
include_once './templates/partials/footer.php';
?>