<?php require 'pages/header.php'; ?>

<?php
//verifica se o usario está logado
if(empty($_SESSION['cLogin'])){
    ?>
    <script type="text/javascript">window.location.href="login.php"</script>
    <?php
    exit;
}
?>

<div>
    <h1>Meus Posts</h1>

    <a href="add-post.php">Adicionar Post</a>

    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Titulo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php
        require 'classes/posts.class.php';
        $p = new Posts();
        $posts = $p->getMeusPosts();

        //array de posts
        foreach($posts as $post):
        ?>
        <tr>
            <td>
                <?php if(!empty($post['url'])): ?>
                
                <img src="assets/images/posts/<?php echo $post['url']; ?>" height="100" border="0" alt="">
            <?php else: ?>
                <img src="assets/images/default.jpg" height="50" border="0" alt="">
                <?php endif; ?>
            </td>
            <td><?php echo $post['titulo']; ?></td>
            <td>
                <a href="editar-post.php?id=<?php echo $post['id']; ?>">Editar</a>
                <a href="excluir-post.php?id=<?php echo $post['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require 'pages/footer.php';?>