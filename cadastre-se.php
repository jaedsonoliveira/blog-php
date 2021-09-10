<?php require 'pages/header.php'; ?>
<link rel="stylesheet" href="assets/css/style.css">


<div class="cadastrar">
    <h1>Cadastre-se</h1>

    <?php
    require 'classes/usuarios.class.php';
    $u = new Usuarios();
    if(isset($_POST['nome']) && !empty($_POST['nome'])){
        //Filtro
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $senha = $_POST['senha'];
        $telefone = addslashes($_POST['telefone']);

        //verificar se os campos estão vazios
        if(!empty($nome) &&  !empty($email) && !empty($senha)){
            if($u->cadastrar($nome, $email, $senha, $telefone)){ //envia os dados
                ?>
                <div>
                    Usuario Cadastrado com sucesso !
                    <a href="login.php">Faça o Login</a>
                </div>
                <?php
            } else{
                ?>
                <div>
                   Usuario já existe
                    <a href="login.php">Faça o Login</a>
                </div>
                <?php
            }
        }else{
            ?>
            <div>
                Preencha todos os campos
            </div>
            <?php
        }
       
    }
    ?>

    <form class="form-cadastrar" method="post">
        <div class="form-group">
        <label class="label" for="nome">Nome:</label>
        <input class="input" type="text" name="nome" id="nome">
        </div>

        <div class="form-group">
        <label class="label" for="email">Email:</label>
        <input class="input" type="email" name="email" id="nome">
        </div>

        <div class="form-group">
        <label class="label" for="senha">Senha:</label>
        <input class="input" type="password" name="senha" id="senha">
        </div>

        <div class="form-group">
        <label class="label" for="telefone">Telefone:</label>
        <input class="input" type="text" name="telefone" id="telefone">
        </div>
        <input class="btn-cadastrar" type="submit" value="Cadastrar">
    </form>
</div>

<?php require 'pages/footer.php';?>