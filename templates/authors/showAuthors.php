    <?php include_once './templates/partials/header.php' ?>
    <header>
        <h2>
            <?= htmlspecialchars($author['name']) ?>
        </h2>
    </header>

    <main>
        <section>
            <p>
                <?= htmlspecialchars($author['biography']) ?>
            </p>
            <h2>Ouvrages publiés </h2>
            <ul>
                <?php foreach ($books as $book): ?>
                    <li><a href="?page=book&id=<?= htmlspecialchars($book['id']) ?>">
                            <?= htmlspecialchars($book['title']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>

    <?php
include_once './templates/partials/footer.php';
?>