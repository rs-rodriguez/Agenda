<?php
    session_start(); 
    require('libapp.php');
    $context = new clientConex();
    $response['msg'] = "OK";
    $resultQuery = $context->consultar(['events ev','usuarios usr'],['ev.*'], "WHERE usr.email='".$_SESSION['email']."' and usr.id=ev.fk_usuarios");
    $i = 0;
    /*Recorrer el arreglo de resultados*/
    while($fila = $resultQuery->fetch()){
        $response['eventos'][$i]['id']=$fila['id'];
        $response['eventos'][$i]['title']=$fila['titulo'];
        if ($fila['allDay'] > 0){ /*Verificar si el registro es fullday*/
        $allDay = false;
        /*Si no es full day, agregar hora de inicio al parametro start*/
        $response['eventos'][$i]['start']=$fila['start_date'].'T'.$fila['start_hour'];
        /*Si no es full day, agregar hora de inicio al parametro end*/
        $response['eventos'][$i]['end']=$fila['end_date'].'T'.$fila['end_hour'];
        }else{
        $allDay= true;
        /*Si no es full day, no agregar la hora en el parametro start*/
        $response['eventos'][$i]['start']=$fila['start_date'];
        /*Si no es full day, el parametro end debe ser vacio*/
        $response['eventos'][$i]['end']="";
        }
        $response['eventos'][$i]['allDay']=$allDay;
        /*sumar 1 al contador*/
        $i++;
    }
    /*Devolver respuesta positiva al obtener registros*/
    $response['getData'] = "OK";
    /*devolver el arreglo response en formato json*/
    echo json_encode($response);


 ?>
