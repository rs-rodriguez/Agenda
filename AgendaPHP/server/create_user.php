<?php
require('libapp.php');
$context = new clientConex();
$conexion = $context->conectedDB();
$insert = $conexion->prepare('INSERT INTO usuarios (email, nombre, password , fecha, telefono) VALUES (?,?,?,?,?)');

$d_password = "1234";
$email = "alejandro@mail.com";
$nombre = "alejandro";
$password = password_hash($d_password, PASSWORD_DEFAULT);
$fecha_nacimiento = "1998-12-08";
$telefono = "77777777";
$insert = $conexion->prepare('INSERT INTO usuarios (email, nombre, password , fecha, telefono) VALUES (?,?,?,?,?)');
$insert->execute(array($email, $nombre, $password, $fecha_nacimiento, $telefono));

$email = 'carlos@mail.com';
$nombre = 'carlos';
$password = password_hash($d_password, PASSWORD_DEFAULT);
$fecha_nacimiento = '1997-12-03';
$telefono = "77777777";

$insert = $conexion->prepare('INSERT INTO usuarios (email, nombre, password , fecha, telefono) VALUES (?,?,?,?,?)');
$insert->execute(array($email, $nombre, $password, $fecha_nacimiento, $telefono));
$email = 'usuario@mail.com';
$nombre = 'usuario';
$password = password_hash($d_password, PASSWORD_DEFAULT);
$fecha_nacimiento = '1997-12-03';
$telefono = "77777777";

$insert = $conexion->prepare('INSERT INTO usuarios (email, nombre, password , fecha, telefono) VALUES (?,?,?,?,?)');
$insert->execute(array($email, $nombre, $password, $fecha_nacimiento, $telefono));
$response['resultado'] = "1";
$response['msg']= 'Informacio de inicio:';

$getUsers = $context->consultar(['usuarios'],['*'],$condicion = "");
while ($fila= $getUsers->fetch()) {
    $response['msg'].=$fila['email'].' ----    ';
}
$response['msg'].= 'contraenia: '.$d_password;
echo json_encode($response);
 ?>
