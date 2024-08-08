<?php

class Connection {

    private $server;
    private $user;
    private $password;
    private $database;
    private $conexion;

    public function __construct() {
        $this->setConect();
        $this->Conect();
    }

    private function setConect() {
        require "configuracion.php";

        $this->server = $server;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
    }

    public function Conect() {
        $this->conexion = mysql_connect($this->server, $this->user, $this->password);
        mysql_query("SET NAMES 'utf8'");
        if ($this->conexion) {
            $base = mysql_select_db($this->database, $this->conexion);
            if (!$base) {
                echo "error de base de datos";
            }

        } else {
            echo mysql_error();
        }
    }

    public function execute($sql) {
        $ejecutar = mysql_query($sql, $this->conexion);
        if (mysql_errno() == 0) {
            $result = array();
            while ($row = @mysql_fetch_row($ejecutar)) {
                array_push($result, $row);
            }
            return $result;
        } else {
            echo mysql_error();
        }
    }
}
