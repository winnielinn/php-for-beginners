<?php

use Core\Response;

function isURL($path)
{
    return $_SERVER['REQUEST_URI'] === $path;
}

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

function abort($status = Response::NOT_FOUND)
{
    http_response_code($status);
    require base_path("views/$status.view.php");
    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }

    return true;
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}

function redirect($path)
{
    header("location: $path");
    exit();
}
