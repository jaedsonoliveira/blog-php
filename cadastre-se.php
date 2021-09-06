<?php require 'pages/header.php'; ?>

<div class="">
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

    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome">

        <label for="email">Email:</label>
        <input type="email" name="email" id="nome">

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha">

        <label for="telefobe">Telefone:</label>
        <input type="text" name="telefone" id="telefone">

        <input type="submit" value="Cadastrar">
    </form>
</div>

<?php require 'pages/footer.php';?>