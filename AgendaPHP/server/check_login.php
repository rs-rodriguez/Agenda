<?php
    session_start();// se inicia en contexto de session
    require('libapp.php');
    $context = new clientConex();
    if(isset($_SESSION['email'])){
		$response['msg'] = 'OK';
		$response['acceso'] = 'Autorizado';
	}else{
        //se verifican los usuarios
        if ($context->verifyUsers() > 0) {
            // se consulta a la bd en base al mail
            $resultQuery = $context->consultar(['usuarios'],['email','password'], "WHERE email='".$_POST['username']."'");
            if ($resultQuery->rowCount() > 0) {
                $fila = $resultQuery->fetch();
                if (password_verify($_POST['password'],$fila["password"])) {
                    $response['msg'] = 'OK';
                    $response['acceso'] = 'Autorizado';
                    $_SESSION['email'] = $fila['email'];
                }else{
                    $response['msg'] = 'contraseña incorrecta';
                    $response['acceso'] = 'acceso denegado';
                }
            }
        }
    }
    echo json_encode($response);

 ?>
