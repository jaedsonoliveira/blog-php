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
    if(isset($_FILES['fotos'])){
        $fotos = $_FILES['fotos'];
    }else{
        $fotos = array();
    }
   

    //Adicionando no banco
    $p->editPost($titulo, $categoria, $descricao,$fotos, $_GET['id']);

    ?>
    <div>
    Produto Editado
    </div>

    <?php
}

//pegar os dados do post
if(isset($_GET['id']) && !empty($_GET['id'])){
    $info = $p->getPost($_GET['id']);
}else{
    ?>
    <script type="text/javascript">window.location.href="meus-posts.php"</script>
    <?php
    exit;
}


?>

<div>
    <h1>Editar Post</h1>

    <form  method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label class="label" for="categoria">Categoria:</label>
        <select class="categoria" name="categoria" id="categoria">
        <?php
        require 'classes/categorias.class.php'; //Categorias
        $c = new Categorias();
        $cats = $c->getLista();
        foreach($cats as $cat):
        ?>
        <option value="<?php echo $cat['id']; ?>" <?php echo ($info['id_categoria'] == $cat['id'])?'selected="selected"': ''; ?>><?php echo $cat['nome'];?>
            </option>
        <?php
    endforeach;
        ?>
    </select>
    </div>

    <div class="form-group">
        <label  class="label" for="titulo">Titulo:</label>
        <input class="input" type="text" name="titulo" id="titulo" value=" <?php echo $info['titulo']; ?>">
       
    </div>

    <div class="form-group">
        <label class="label" for="descricao">Descrição:</label>
        <textarea class="text-area" name="descricao" id="descricao"> <?php echo $info['descricao']; ?></textarea>
   
    </div>


    <div class="form-group">
        <label  class="label" for="add_foto">Fotos do Anúncio:</label>
        <input type="file" name="fotos[]" multiple/>
    </div>

    <div>
        <div>Fotos do anuncio</div>
        <div>
            <?php foreach($info['fotos'] as $foto): ?>
                <div>
                    <img src="assets/images/posts/<?php echo $foto['url']; ?>" alt="">
                    <br>
                    <a href="excluir-foto.php?id=<?php echo $foto['id']; ?>">Excluir Imagem</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <input type="submit" value="Salvar">
    </form>
</div>
<?php require 'pages/footer.php';?>