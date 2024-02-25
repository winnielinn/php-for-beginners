<?php

$config = require base_path('config.php');
$db = new Database($config);

$query = 'SELECT * FROM notes WHERE user_id = :user_id';

$notes = $db->query($query, [':user_id' => 4])->get();

view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes
]);
