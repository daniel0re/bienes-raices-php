<?php

function conectarDB(): mysqli
{
    $db = mysqli_connect('us-cdbr-east-04.cleardb.com', 'bab183f15ffced', '5f654c06', 'heroku_f27c8fd068ba326');
    $db->set_charset("utf8");

    if (!$db) {
        echo "Error, no se pudo conectar";

        exit;
    }
    return $db;
}
