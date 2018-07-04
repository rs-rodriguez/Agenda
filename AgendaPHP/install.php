<?php
    require('server/libapp.php');

    $context = new clientConex();
    //se inicializan las conexxiones
    $context->initialContex();
    $context->createDB();
    //conexion base de datos principal
    $context->conectedDB();
    echo "<br />";
    $tablaUSers = 'usuarios';
    $propUSers['id']= 'INT';
    $propUSers['nombre']= 'VARCHAR(45)';
    $propUSers['password']= 'VARCHAR(255)';
    $propUSers['email']= 'VARCHAR(100)';
    $propUSers['telefono']= 'VARCHAR(10)';
    $propUSers['fecha']= 'VARCHAR(50)';
    $query = $context->getNewTableQuery($tablaUSers, $propUSers);
    $context->executeQUerys($query); // creacion de tablas
    echo "<br />";
    $tablaEvents = 'events';
    $propEvents['id']= 'INT';
    $propEvents['titulo']= 'VARCHAR(100)';
    $propEvents['start_date']= 'VARCHAR(20)';
    $propEvents['end_date']= 'VARCHAR(20)';
    $propEvents['allDay']= 'VARCHAR(255)';
    $propEvents['start_hour']= 'VARCHAR(10)';
    $propEvents['end_hour']= 'VARCHAR(10)';
    $propEvents['fk_usuarios']= 'INT';

    $query = $context->getNewTableQuery($tablaEvents, $propEvents);
    $context->executeQUerys($query);// creacion de tablas
    //se agregan las restricciones
    $context->nuevaRestriccion($tablaUSers, ' CHANGE COLUMN id id INT(11) NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (id)');
    $context->nuevaRestriccion($tablaEvents, ' CHANGE COLUMN id id INT(11) NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (id)');
    $context->nuevaRelacion($tablaEvents, $tablaUSers, 'fk_usuario_evento','fk_usuarios', 'id');






 ?>