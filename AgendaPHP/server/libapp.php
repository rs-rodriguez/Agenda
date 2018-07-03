<?php

    class clientConex{
        private $host = 'localhost';
        private $user = 'root';
        private $password = '';
        private $conexion;
        private $databaseName = 'agenda_db';

        function initialContex(){
            $this->conexion = new PDO('mysql:host='.$this->host.';', $this->user, $this->password);
        }
        
        function conectedDB(){
            $conexionDB = new PDO('mysql:dbname='.$this->databaseName.';host='.$this->host.';', $this->user, $this->password);
            return $conexionDB;
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
                $conec = $this->conectedDB();
                $conec->exec($sqlTBL);
                echo "La Tabla fue creada exitosamente";
            } catch (PDOException $e) {
                print "Error: " . $e->getMessage()."<br/>";
                die();
            }
        }

        function nuevaRestriccion($tabla, $restriccion){
            $sql = 'ALTER TABLE '.$tabla.' '.$restriccion;
            $conec = $this->conectedDB();
            $conec->exec($sql);
        }
        
        function nuevaRelacion($from_tbl, $to_tbl, $fk_foreign_key_name, $from_field, $to_field){
            $sql = 'ALTER TABLE '.$from_tbl.' ADD CONSTRAINT '.$fk_foreign_key_name.' FOREIGN KEY ('.$from_field.') REFERENCES '.$to_tbl.'('.$to_field.');';
            $conec = $this->conectedDB();
            $conec->exec($sql);
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
            $conec = $this->conectedDB();
            $sql = 'SELECT COUNT(email) FROM usuarios';
            $totalUsers = $conec->prepare($sql);
            $totalUsers->execute();
            while ($row = $totalUsers->fetch()) {
                return $row['COUNT(email)'];
            }
        }

        function consultar($tablas, $campos, $condicion = ''){
            $sql = "SELECT ";
            $result = array_keys($campos);
            $ultima_key = end($result);
            foreach ($campos as $key => $value) {
              $sql .= $value;
              if ($key!=$ultima_key) {
                $sql.=", ";
              }else $sql .=" FROM ";
            }
            $result = array_keys($tablas);
            $ultima_key = end($result);
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
            $conexionDB = $this->conectedDB();
            $result = $conexionDB->prepare($sql);
            $result->execute();
            return $result;
        }

        function insertDataTable($tabla, $data){
            $sql = 'INSERT INTO '.$tabla.' (';
            $i = 1;
            foreach ($data as $key => $value) {
              $sql .= $key;
              if ($i<count($data)) {
                $sql .= ', ';
              }else $sql .= ')';
              $i++;
            }
            $sql .= ' VALUES (';
            $i = 1;
            foreach ($data as $key => $value) {
              $sql .= $value;
              if ($i<count($data)) {
                $sql .= ', ';
              }else $sql .= ');';
              $i++;
            }
            $conexionDB = $this->conectedDB();
            $result = $conexionDB->prepare($sql);
            $result->execute();
            return $result;
          }
        
          function updateDataTable($tabla, $data, $condicion){
            $sql = 'UPDATE '.$tabla.' SET ';
            $i=1;
            foreach ($data as $key => $value) {
              $sql .= $key.'='.$value;
              if ($i<sizeof($data)) {
                $sql .= ', ';
              }else $sql .= ' WHERE '.$condicion.';';
              $i++;
            }
            $conexionDB = $this->conectedDB();
            $result = $conexionDB->prepare($sql);
            $result->execute();
            return $result;
          }
          function deleteData($tabla, $condicion){
            $sql = "DELETE FROM ".$tabla." WHERE ".$condicion.";";
            $conexionDB = $this->conectedDB();
            $result = $conexionDB->prepare($sql);
            $result->execute();
            return $result;
          }
    }
?>