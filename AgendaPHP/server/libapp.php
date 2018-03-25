<?php

    class clientConex{
        private $host = 'localhost';
        private $user = 'root';
        private $password = '';
        private $conexion;
        private $conexionDB;
        public $databaseName = 'agenda_db';
        function initialContex(){
            $this->conexion = new PDO('mysql:host='.$this->host.';', $this->user, $this->password);
        }
        
        function conectedDB($database){
            $this->conexionDB = new PDO('mysql:dbname='.$database.';host='.$this->host.';', $this->user, $this->password);
        }

        function createDB(){
            try {
                $sql = 'CREATE DATABASE IF NOT EXISTS agenda_db';
                $this->conexion->exec($sql);
                echo "La base de datos agenda_db fue creada exitosamente";
            } catch (PDOException $e) {
                print "Error: " . $e->getMessage()."<br/>";
                die();
            }
        }

        function executeQUerys($sqlTBL){
            try {
                $this->conexionDB->exec($sqlTBL);
                echo "La Tabla fue creada exitosamente";
            } catch (PDOException $e) {
                print "Error: " . $e->getMessage()."<br/>";
                die();
            }
        }

        function getNewTableQuery($nombre_tbl, $campos){
            $sql = 'CREATE TABLE '.$nombre_tbl.' (';
            $length_array = count($campos);
            $i = 1;
            foreach ($campos as $key => $value) {
                $sql .= $key.' '.$value;
                if ($i!= $length_array) {
                    $sql .= ', ';
                }else {
                    $sql .= ');';
                }
              $i++;
            }
            return $sql;
        }

        function verifyUsers(){
            $sql = 'SELECT COUNT(email) FROM usuarios';
            $totalUsers = $this->$conexionDB->exec($sql);
            while ($row = $totalUsers->fetch_assoc()) {
  
                return $row['COUNT(email)'];
            }
        }

        function consultar($tablas, $campos, $condicion = ""){
            $sql = "SELECT ";
            $ultima_key = end(array_keys($campos));
            foreach ($campos as $key => $value) {
              $sql .= $value;
              if ($key!=$ultima_key) {
                $sql.=", ";
              }else $sql .=" FROM ";
            }
      
            $ultima_key = end(array_keys($tablas));
            foreach ($tablas as $key => $value) {
              $sql .= $value;
              if ($key!=$ultima_key) {
                $sql.=", ";
              }else $sql .= " ";
            }
      
            if ($condicion == "") {
              $sql .= ";";
            }else {
              $sql .= $condicion.";";
            }
      
            return $this->$conexionDB->exec($sql);
        }
    }
?>