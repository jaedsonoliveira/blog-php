<?php require 'pages/header.php'; ?>

<?php require 'classes/posts.class.php';
$p = new Posts();

$posts = $p->getUltimosPosts();
?>

    <section>
        <div class="containerpost">
        <h1>Posts Recentes</h1>
            <div class="posts">
                <table>
                    <tbody>
                        <?php foreach($posts as $post): ?>
                            <tr>
                            <td>
                                <?php if(!empty($post['url'])): ?>
                                
                                <img src="assets/images/posts/<?php echo $post['url']; ?>" height="100" border="0" alt="">
                            <?php else: ?>
                                <img src="assets/images/default.jpg" height="50" border="0" alt="">
                                <?php endif; ?>
                            </td>
                                <td class="titulo">
                                    <a href="post.php?id=<?php echo $post['id']; ?>"><?php echo $post['titulo']; ?></a><br>
                                    <?php echo $post['categoria']; ?>
                                </td>
                                <td class="descricao"><?php echo $post['descricao']; ?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php require 'pages/footer.php';?>