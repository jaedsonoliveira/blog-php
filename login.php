<?php require 'pages/header.php'; ?>
<link rel="stylesheet" href="assets/css/style.css">


<div class="login">
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
        

    <form class="formlogin" method="post">
        
        <div class="form-group">
        <label class="label" for="email">Email:</label>
        <input class="input" type="email" name="email" id="nome">
        </div>

        <div class="form-group">
        <label class="label" for="senha">Senha:</label>
        <input class="input" type="password" name="senha" id="senha">
        </div>
        
        <input class="btn-login" type="submit" value="Login">
        
    </form>
</div>

<?php require 'pages/footer.php';?>