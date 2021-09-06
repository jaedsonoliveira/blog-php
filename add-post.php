<?php require 'pages/header.php'; ?>


<?php
//verifica se o usario está logado
if(empty($_SESSION['cLogin'])){
    ?>
    <script type="text/javascript">window.location.href="login.php"</script>
    <?php
    exit;

}

//Posts
require 'classes/posts.class.php';
$p = new Posts();
if(isset($_POST['titulo']) && !empty($_POST['titulo'])){ //Valida pelo titulo
    $titulo = addslashes($_POST['titulo']);
    $categoria = addslashes($_POST['categoria']);
    $descricao = addslashes($_POST['descricao']);

    //Adicionando no banco
    $p->addPost($titulo, $categoria, $descricao);

    ?>
    <div>
    Produto Adicionado
    </div>

    <?php
}

?>

<div>
    <h1>Adicionar Post</h1>

    <form method="POST" encytpe="multipart/form-data">
    <div class="form-group">
        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria">
        <?php
        require 'classes/categorias.class.php'; //Categorias
        $c = new Categorias();
        $cats = $c->getLista();
        foreach($cats as $cat):
        ?>
        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['nome']; ?></option>
        <?php
    endforeach;
        ?>
    </select>
    </div>

    <div class="form-group">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" id="titulo">
    </div>

    <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" cols="100" rows="10"></textarea>
    </div>

    <input type="submit" value="Adicionar">
    </form>
</div>
<?php require 'pages/footer.php';?>