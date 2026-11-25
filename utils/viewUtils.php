<?php 
function renderViews(string $templates, array $data=[]) {
    extract($data);
    ob_start();
    require_once DOCUMENT_ROOT . '/templates/' . $templates . '.php';
    $main = ob_get_clean();
    require_once DOCUMENT_ROOT ; '/templates/default.php';
}