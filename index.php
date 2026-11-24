<?php
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

require_once DOCUMENT_ROOT . '/database/db_connect.php';
require_once DOCUMENT_ROOT . '/models/authors.php';
require_once DOCUMENT_ROOT . '/models/books.php';
require_once DOCUMENT_ROOT . '/controllers/authors.php';
require_once DOCUMENT_ROOT . '/controllers/books.php';

$page = $_GET["page"] ?? "";

match ($page) {
  "", "home" => listBookCtrl(),
  "book" => showBookCtrl(),
  "author" => showAuthorCtrl(),
  "delete" => deleteBookCtrl(),
  default => listBookCtrl()
};