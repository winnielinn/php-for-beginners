<?php

$heading = 'My Notes';

$config = require('config.php');
$db = new Database($config);

$query = 'SELECT * FROM notes WHERE user_id = :user_id';

$notes = $db->query($query, [':user_id' => 4])->get();

require('views/notes.view.php');