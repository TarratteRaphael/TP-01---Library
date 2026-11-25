<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script defer src="/assets/js/scripts.js"></script>
    <script defer src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>    
    <header class="header">
        <div class="header__container">
            <a href="/index.php"><img src="../assets/img/open-book.svg" alt="logo livre"></a>
            <h1>
                <?= $heading ?>
            </h1>
        </div>
    </header>
    <main>
        <?= $main ?>
    </main>
    <footer class="footer">
        <p>&copy; <?= date('Y') ?></p>
        <div>Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a
                href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
    </footer>
</body>
</html>