<?php

    class clientConex{
        private $host = 'localhost';
        private $user = 'root';
        private $password = '';
        private $conexion;
        function initialContex(){
            $this->conexion = new PDO('mysql:host='.$this->host.';', $this->user, $this->password);
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
        function createTables(){
            
        }


    }


?>