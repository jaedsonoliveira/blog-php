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
    $id_post = $a->excluirFoto($_GET['id']);
}

if(isset($id_post)){
    header("Location: editar-post.php?id=".$id_post);
}else{
    header("Location: meus-posts.php");

}
