<?php
class Posts{

    //Função de pegar posts
    public function getMeusPosts(){
        global $pdo;

        $array = array();
        $sql = $pdo->prepare("SELECT *, (select posts_imagens.url from posts_imagens where posts_imagens.id_post = posts.id limit 1) as url  FROM posts WHERE id_usuario = :id_usuario");
        $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }

    //pega os posts na pagina inicial
    public function getUltimosPosts(){
        global $pdo;

        $array = array();
        $sql = $pdo->prepare("SELECT *, (select posts_imagens.url from posts_imagens where posts_imagens.id_post = posts.id limit 1) as url, (select categorias.nome from categorias where categorias.id = posts.id_categoria) as categoria FROM posts ORDER BY id DESC");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }

    //Pegar dados salvos do Post
    public function getPost($id){
        $array = array();

        global $pdo;

        $sql= $pdo->prepare("SELECT * FROM posts WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
            $array['fotos'] = array();

            $sql= $pdo->prepare("SELECT id,url FROM posts_imagens WHERE id_post = :id_post");

            $sql->bindValue(":id_post", $id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $array['fotos'] = $sql->fetchAll();
            }
        }

        return $array;
    }

    //Adicionar Post
    public function addPost($titulo, $categoria, $descricao){
        global $pdo;

        $sql = $pdo->prepare("INSERT INTO posts SET titulo = :titulo, id_categoria = :id_categoria, id_usuario = :id_usuario, descricao = :descricao");
        $sql->bindValue(":titulo", $titulo);
        $sql->bindValue(":id_categoria", $categoria);
        $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
        $sql->bindValue(":descricao", $descricao);
        $sql->execute();
    }

    //Editar Anuncio
    public function editPost($titulo, $categoria, $descricao,$fotos, $id){
        global $pdo;

        $sql = $pdo->prepare("UPDATE posts SET titulo = :titulo, id_categoria = :id_categoria, id_usuario = :id_usuario, descricao = :descricao WHERE id =:id");
        $sql->bindValue(":titulo", $titulo);
        $sql->bindValue(":id_categoria", $categoria);
        $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if(count($fotos) > 0){
            
           for($q=0; $q<count($fotos['tmp_name']); $q++){
                $tipo = $fotos['type'][$q];
                if(in_array($tipo,array('image/jpeg', 'image/png'))){
                    $tmpname = md5(time().rand(0,9999)).'.jpg';
                    move_uploaded_file($fotos['tmp_name'][$q],'assets/images/posts/'.$tmpname);
 
                    list($width_orig, $height_orig) = getimagesize('assets/images/posts/'.$tmpname);
 
                    $ratio = $width_orig/$height_orig;
                    $width = 500;
                    $height = 500;
 
                    if($width/$height > $ratio){
                        $width = $height*$ratio;
                     
                    }else{
                        $height = $width/$ratio;
                    }
 
                    $img = imagecreatetruecolor($width, $height);
                    if($tipo == 'image/jpeg'){
                        $origi = imagecreatefromjpeg('assets/images/posts/'.$tmpname);
                    }elseif($tipo == 'image/png'){
                     $origi = imagecreatefrompng('assets/images/posts/'.$tmpname);
                    }
 
                    imagecopyresampled($img, $origi, 0,0,0,0, $width, $height, $width_orig, $height_orig);
 
                    imagejpeg($img, 'assets/images/posts/'. $tmpname, 80);
 
                    $sql = $pdo->prepare("INSERT INTO posts_imagens SET id_post = :id_post, url = :url");
                    $sql->bindValue(":id_post", $id);
                    $sql->bindValue(":url", $tmpname);
                    $sql->execute();
                }
            }
         }
    }

    public function excluirPost($id){
        global $pdo;

        $sql= $pdo->prepare("DELETE FROM posts_imagens WHERE id_post = :id_post");
        $sql->bindValue(":id_post", $id);
        $sql->execute();

        $sql= $pdo->prepare("DELETE FROM posts WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function excluirFoto($id){
        global $pdo;

        $id_post = 0;

        $sql = $pdo->prepare("SELECT id_post FROM posts_imagens WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $row = $sql->fetch();
            $id_post = $row['id_post'];
        }

        $sql= $pdo->prepare("DELETE FROM posts_imagens WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $id_post;
    }
}
?>