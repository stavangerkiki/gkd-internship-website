<?php
$config = require basePath('config/db.php');
$db = new Database($config);

$id = $_GET['id'] ?? null;

// 验证 id 是否是正整数
if (!is_numeric($id) || (int)$id <= 0) {
    die('Invalid ID');
}

$params = [
    'id' => (int)$id
];

$listing = $db->query('SELECT * FROM listing WHERE id = :id', $params)->fetch();



// Load the view with the listing data
loadView('/listings/show', [
    'listing' => $listing
]);
