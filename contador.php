<?php

    session_start();

    if(!$_SESSION['usuario']){
        header('Location: index.php?erro=1');
    }

    require_once('db.class.php');

    $id_usuario  = $_SESSION['id_usuario'];

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    echo "<h4>" .$_SESSION['usuario']. "</h4>";
	echo "<hr />";

   //--qtde tweets
	$sql = " SELECT COUNT(*) AS qtde_tweets FROM tweet WHERE id_usuario = $id_usuario ";
	
	$resultado_id = mysqli_query($link, $sql);

	$qtde_tweets = 0;

	if($resultado_id){
		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);

        $qtde_tweets = $registro['qtde_tweets'];
        echo '<div class="col-md-6"> ';
	    echo "   Tweets <br />" .$qtde_tweets. "";
	    echo "</div>";

	} else {
		echo 'Erro ao executar a query';
	}
	
	//--qtde de seguidores
	$sql = " SELECT COUNT(*) AS qtde_seguidores FROM usuarios_seguidores WHERE seguindo_id_usuario = $id_usuario ";
	
	$resultado_seg = mysqli_query($link, $sql);

	$qtde_seguidores = 0;

	if($resultado_seg){
		$registro = mysqli_fetch_array($resultado_seg, MYSQLI_ASSOC);

        $qtde_seguidores = $registro['qtde_seguidores'];
        echo '<div class="col-md-6">';
        echo "   Seguidores <br /> ".$qtde_seguidores. " ";
        echo "</div>";
        

	} else {
		echo 'Erro ao executar a query';
    }
    
    
	
	

?>