<?php
    require('libapp.php');
    $context = new clientConex();
    $data['id'] = '"'.$_POST['id'].'"';
    $data['start_date'] = '"'.$_POST['start_date'].'"';
    $data['start_hour'] = '"'.$_POST['start_hour'].'"';
    $data['end_date'] = '"'.$_POST['end_date'].'"';
    $data['end_hour'] = '"'.$_POST['end_hour'].'"';
    if($data['id'] != 'undefined'){
        $resultado = $context->updateDataTable('events', $data, 'id ='.$data['id']); //Actualizar el registro que coincida con el id del evento a actualizar
        $response['msg'] = 'OK';
    }else{
        $response['msg'] = "Ha ocurrido un error al actualizar el evento";
    }
                
    echo json_encode($response);

//$con->cerrarConexion()


 ?>
