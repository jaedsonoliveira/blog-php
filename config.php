<?php
session_start();
global $pdo;
try{
    $pdo = new PDO("mysql:dbname=projeto_blog;host=localhost", "root", "");
} catch(PDOException $e){
    echo "FALHOU". $e->getMessage();
}

?>