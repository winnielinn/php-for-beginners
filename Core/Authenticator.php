<?php

namespace Core;

use Core\App;
use Core\Database;
use Core\Session;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)
            ->query('SELECT * FROM users WHERE email = :email', [
                'email' => $email
            ])->find();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login($email);

                return true;
            }
        }

        return false;
    }

    public function login($email)
    {
        $_SESSION['user'] = [
            'email' => $email
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}
