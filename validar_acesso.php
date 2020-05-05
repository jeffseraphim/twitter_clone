<?php

    session_start();

    require_once('db.class.php');

    
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']);

    $sql = "SELECT id, usuario, email from usuarios where usuario = '$usuario' and senha = '$senha'  ";

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $resultado_id = mysqli_query($link,$sql);

    
    
    if ($resultado_id) {
        $dados_usuario =  mysqli_fetch_array($resultado_id);    
        if (isset($dados_usuario['usuario'])) {

            $_SESSION['id_usuario'] = $dados_usuario['id'];
            $_SESSION['usuario'] = $dados_usuario['usuario'];
            $_SESSION['email'] = $dados_usuario['email'];

            header('Location: home.php');

        }else {

            header('Location: index.php?erro=1');

        }
    } else {

        echo 'Erro na consulta. Favor entrar em contato com um admin do site';
    }

    //update

    //insert    

    //select

    //delete
?>