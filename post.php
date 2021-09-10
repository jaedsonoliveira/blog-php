<?php require 'pages/header.php'; ?>

<?php require 'classes/posts.class.php';
$p = new Posts();

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = addslashes($_GET['id']);
}else{
    ?>
    <script type="text/javascript">window.location.href="login.php"</script>
    <?php
    exit;
}

$info = $p->getPost($id);
?>

    <section>
        <div class="container">
            <div class="posts">
                <?php foreach($info['fotos'] as $foto) : ?>
                    <img src="assets/images/posts/<?php echo $foto['url']; ?>" alt="">
                <?php endforeach; ?><br>
                
                <h1><?php echo $info['titulo']; ?></h1><br>
                <p><?php echo $info['descricao']; ?></p>
                
            
            </div>
        </div>
    </section>
<?php require 'pages/footer.php';?>