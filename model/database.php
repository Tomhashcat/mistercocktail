<?php


function databaseConnect(){
    $dsn = 'mysql:dbname=mister_cocktail;host=127.0.0.1;port=3306';
    $user = 'root';
    $password = '';

    $database = new PDO($dsn, $user, $password);
    return $database;
}
