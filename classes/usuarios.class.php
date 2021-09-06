<?php
class Usuarios{
    //Função de cadastart novo usuario
    public function cadastrar($nome, $email, $senha, $telefone){
        global $pdo;

        $sql= $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() == 0){ //Não há usuario cadastrado

            $sql = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, senha = :senha, telefone= :telefone");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", md5($senha));
            $sql->bindValue(":telefone", $telefone);
            $sql->execute();

            return true;

        }else{
            return false;
        }
    }

    //função de login
    public function login($email, $senha){
        global $pdo;

        $sql= $pdo->prepare("SELECT id FROM usuarios WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindvalue(":senha", md5($senha));
        $sql->execute();

        //Se há usuario
        if($sql->rowCount() > 0){ 
            $dado = $sql->fetch();
            $_SESSION['cLogin'] = $dado['id'];
            return true;
        }else{
            return false;
        }
    }

}

?>