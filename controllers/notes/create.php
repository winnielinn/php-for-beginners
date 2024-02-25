<?php
require('Validator.php');

$heading = 'Create Note';
$config = require('config.php');
$db = new Database($config);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    if (!Validator::string($_POST['body'], 1, 100)) {
        $errors['body'] = 'Body less than 100 characters and it not empty is required';
    }

    if (empty($errors)) {
        $db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
            ':body' => $_POST['body'],
            ':user_id' => 4
        ]);
    }
}

require('views/notes/create.view.php');
