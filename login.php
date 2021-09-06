<?php require 'pages/header.php'; ?>

<div class="">
    <h1>Login</h1>

    <?php
    require 'classes/usuarios.class.php';
    $u = new Usuarios();
    if(isset($_POST['email']) && !empty($_POST['email'])){
        //Filtro
        $email = addslashes($_POST['email']);
        $senha = $_POST['senha'];

        //verifica e manda para home
        if($u->login($email, $senha)){ 
            ?>
            <script type="text/javascript">window.location.href="./"</script>
            <?php
        }else{
            ?>
            <div>
                Usuario e/ou senha errado
            </div>
            <?php
        }
        
    }
    ?>
        

    <form method="post">
        

        <label for="email">Email:</label>
        <input type="email" name="email" id="nome">

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha">

        <input type="submit" value="Login">
    </form>
</div>

<?php require 'pages/footer.php';?>