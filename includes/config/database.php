<?php

$url = '';
$user = '';
$pass = '';
$name_db = '';


function conectarDB(): mysqli
{
    $db = mysqli_connect('localhost', 'root', 'root', 'bienes_raices');
    $db->set_charset("utf8");

    if (!$db) {
        echo "Error, no se pudo conectar";

        exit;
    }
    return $db;
}
