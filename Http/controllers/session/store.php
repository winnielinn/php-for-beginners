<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Session;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {
    if ((new Authenticator)->attempt($email, $password)) {
        return redirect('/');
    }

    $form->error('email', 'No matching account found for that email address and password.');
}

Session::flash('errors', $form->errors());
Session::flash('old', [
    'email' => $email
]);

return redirect('/login');
