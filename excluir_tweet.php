<?php

    session_start();

    if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}

    require_once('db.class.php');

    $id_usuario  = $_SESSION['id_usuario'];
    $id_tweet = $_POST['excluir_tweet_id'];

    echo $id_tweet;
    echo $id_usuario;

    if($id_usuario== '' || $id_tweet== ''){
        die();
    }
    
    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $sql = " DELETE FROM tweet WHERE id_usuario = $id_usuario AND id_tweet = $id_tweet ";
    

    
    mysqli_query($link, $sql);

?>