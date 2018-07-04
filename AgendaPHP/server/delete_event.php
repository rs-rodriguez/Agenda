<?php
require('libapp.php');
$context = new clientConex();
//eliminando datos
if ($context->deleteData('events', 'id='.$_POST['id'])) {
    $response['msg'] = 'OK';
}else{
    $response['msg'] = 'No se a podido eliminar el registro';
}
echo json_encode($response)

 ?>
