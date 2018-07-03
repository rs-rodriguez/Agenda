<?php
    session_start();
    require('libapp.php');
    $context = new clientConex();
    $data['titulo'] = '"'.$_POST['titulo'].'"';
    $data['start_date'] = '"'.$_POST['start_date'].'"';
    $data['start_hour'] = '"'.$_POST['start_hour'].':00"';/*Add ":00" to fill datetime format*/
    $data['end_date'] = '"'.$_POST['end_date'].'"';
    $data['end_hour'] = '"'.$_POST['end_hour'].':00"'; /*Add ":00" to fill datetime format*/
    $data['allday'] = $_POST['allDay'];
    $resultQuery = $context->consultar(['usuarios'],['id'], "WHERE email='".$_SESSION['email']."'");
    if ($resultQuery->rowCount() > 0) {
        $fila = $resultQuery->fetch();
        $data['fk_usuarios'] = '"'.$fila['id'].'"';
        if($context->insertDataTable('events', $data)){ //Insertar la información en la base de datos
            /*Mostrar mensaje success*/
            $resultado = $context->consultar(['events'],['MAX(id)'],""); //Obtener el id registrado perteneciente al nuevo registro
            while($fila = $resultado->fetch()){
                $response['id']=$fila['MAX(id)']; //Enviar ultimo Id guardado como parámetro para el calendario
            }
            $response['msg'] = 'OK';
        }else{
            /*Mostrar mensaje de error*/
            $response['msg'] = "Ha ocurrido un error al guardar el evento";
        }
        echo json_encode($response);
    }
 ?>
