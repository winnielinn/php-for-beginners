<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config);

$currentUserId = 4;

$note = $db->query(
    'SELECT * FROM notes WHERE id = :id',
    [
        'id' => $_GET['id']
    ]
)->findOrFail();

authorize($note['user_id'] === $currentUserId);

$db->query(
    'DELETE FROM notes WHERE id = :id',
    [
        'id' => $_GET['id']
    ]
);

header('location: /notes');
exit();
