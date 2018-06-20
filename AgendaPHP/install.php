<?php
    require('server/libapp.php');

    $context = new clientConex();
    $context->initialContex();
    $context->createDB();
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
    $context->executeQUerys($query);
    echo "<br />";
    $tablaEvents = 'events';
    $propEvents['id']= 'INT';
    $propEvents['titulo']= 'VARCHAR(100)';
    $propEvents['start_date']= 'VARCHAR(20)';
    $propEvents['end_date']= 'VARCHAR(20)';
    $propEvents['allDay']= 'VARCHAR(255)';
    $propEvents['start_hour']= 'VARCHAR(10)';
    $propEvents['end_hour']= 'VARCHAR(10)';

    $query = $context->getNewTableQuery($tablaEvents, $propEvents);
    $context->executeQUerys($query);






 ?>