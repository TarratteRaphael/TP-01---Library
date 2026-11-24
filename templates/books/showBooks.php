    <?php include_once '../partials/header.php'?>
    <header>
        <h1><?= htmlspecialchars($book['title']) ?></h1>
    </header>

    <main>
        <section>
            <h2><?= htmlspecialchars($book['subtitle']) ?></h2>
            <h3><a href="author.php?id=<?= htmlspecialchars($book['author_id']) ?>"><i><?= htmlspecialchars($book['name']) ?></i></a></h3>
            <p><?= htmlspecialchars($book['description']) ?></p>
            <p>Édition <?= htmlspecialchars($book['publisher']) ?> | date <?= htmlspecialchars($book['published']) ?> | p. <?= htmlspecialchars($book['pages']) ?></p>
            <a href="<?= htmlspecialchars($book['website']) ?>">site internet</a>
        </section>
    </main>

<?php
include_once '../partials/footer.php';
