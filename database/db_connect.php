<?php

$pdo = new PDO('sqlite:' . DOCUMENT_ROOT . '/assets/sql/database.sqlite', null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

?>