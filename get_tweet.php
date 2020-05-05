<?php

    session_start();

    if(!$_SESSION['usuario']){
        header('Location: index.php?erro=1');
    }

    require_once('db.class.php');

    $id_usuario  = $_SESSION['id_usuario'];

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $sql = " SELECT DATE_FORMAT(t.data_inclusao,'%d %b %Y %T') AS data_inclusao_formatada, t.tweet, t.id_tweet, u.usuario, u.id ";
    $sql.= " FROM tweet AS t JOIN usuarios AS u ON (t.id_usuario = u.id) ";  
    $sql.= " WHERE id_usuario = $id_usuario ";
    $sql.= " OR id_usuario IN (select seguindo_id_usuario from usuarios_seguidores where id_usuario = $id_usuario) ";
    $sql.= " ORDER BY data_inclusao DESC ";


    $resultado_id = mysqli_query($link, $sql);

    
    if ($resultado_id) {
        while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
           echo '<a href="#" class= "list-group-item"> ';
            echo '<h4 class="list-group-item-heading"> '.$registro['usuario'].' <small> - '.$registro['data_inclusao_formatada'].'</small></h4>';
            echo '<p class="list-group-item-text" >'.$registro['tweet'].''; 
            echo '</p>';
            echo '<p class="list-groupitem-text pull-right">';
            
            $btn_excluir_display = 'block';
            $id_usuario_tweet = $registro['id'];
            if($id_usuario_tweet != $id_usuario){
                $btn_excluir_display = 'none';
            }    
            
            
            echo '<button type="button" id="btn_excluir_' .$registro['id_tweet']. '" style="display:'.$btn_excluir_display.'" class="btn btn-default btn_excluir" data-id_tweet="' .$registro['id_tweet']. '"><span class="glyphicon glyphicon-trash"></span></button> ';
            echo '</p>';
            echo '<div class="clearfix"> </div>';
           echo '</a>'; 
        }

    } else {

        echo 'Erro na consulta ao banco de dados'; 
    }

?>