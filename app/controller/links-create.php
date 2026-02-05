<?php
$title = "Registrar Proyecto";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $url = $_POST['url'] ?? '';
    $description = $_POST['description'] ?? '';
    $errors = [];
}
if (empty($title)) {
    $errors[] = "El título es obligatorio.";
}
if (empty($url)) {
    $errors[] = "La url es obligatoria.";
} elseif (!filter_var($url, FILTER_VALIDATE_URL)) {
    $errors[] = "La url no es válida.";
}
if (empty($description)) {
    $errors[] = "La descripción es obligatoria.";
}
if (empty($errors)) {
    $db->query('INSERT INTO links (title, url, description) VALUES (:title, :url, :description)', [
        'title' => $title,
        'url' => $url,
        'description' => $description
    ]);
    header('Location: /links');
}

require __DIR__ . '/../../resources/links-create.template.php';
