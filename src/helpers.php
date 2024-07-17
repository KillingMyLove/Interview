<?php
require_once __DIR__."/config.php";

function getPDO(): PDO
{
    try {
        return new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD);
    } catch (\PDOException $e){
        die ($e->getMessage());
    }
}

function redirect(string $path)
{
    header("Location: $path");
    die();
}