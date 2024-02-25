<?php

use Core\Database;
use Core\Validator;

$config = require base_path('config.php');
$db = new Database($config);

$errors = [];


if (!Validator::string($_POST['body'], 1, 100)) {
    $errors['body'] = 'Body less than 100 characters and it not empty is required';
}

if (!empty($errors)) {
    view('notes/create.view.php', [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
    ':body' => $_POST['body'],
    ':user_id' => 4
]);

header('location: /notes');
exit();
