<?php
require 'config.php';
//verifica se o usario está logado
if(empty($_SESSION['cLogin'])){
    header("Location: login.php");
    exit;

}

require 'classes/posts.class.php'; 

$a = new Posts();

if(isset($_GET['id']) && !empty($_GET['id'])){
    $a->excluirPost($_GET['id']);
}

header("Location: meus-posts.php");
