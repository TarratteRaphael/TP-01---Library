<?php 
function renderViews(string $template, array $data=[]) {
    extract($data);
    ob_start();
    require_once DOCUMENT_ROOT . '/templates/' . $template . '.php';
    $main = ob_get_clean();
    require_once DOCUMENT_ROOT . '/templates/default.php';
}