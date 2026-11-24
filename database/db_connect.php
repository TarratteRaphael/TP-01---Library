<?php

 function db() {
    try {

    $options = [
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
    ];

    $db = new PDO('sqlite:' . DOCUMENT_ROOT . '/assets/sql/database.sqlite', null, null, 
    $options
);
    return $db;
    }
    catch (PDOException $error) {
        var_dump($error);
        die;
    }
}

