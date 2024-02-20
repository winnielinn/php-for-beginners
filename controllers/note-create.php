<?php

$heading = 'Create Note';
$config = require('config.php');
$db = new Database($config);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (strlen($_POST['body']) === 0) {
        $errors['body'] = 'Body is required';
    }

    if (strlen($_POST['body']) > 100) {
        $errors['body'] = 'Body must be less than 100 characters';
    }

    if (empty($errors)) {
        $db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
            ':body' => $_POST['body'],
            ':user_id' => 4
        ]);
    }
}

require('views/note-create.view.php');
