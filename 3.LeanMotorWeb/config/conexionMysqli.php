<?php

class Connection {

    private $server;
    private $user;
    private $password;
    private $database;
    public $conexion;

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
        $this->conexion = new mysqli($this->server, $this->user, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>", mysqli_connect_error();
            exit();
        } else {
            $this->conexion->set_charset("utf8");
        }
    }

    public function getConect() {
        return $this->conexion;
    }

    public function closeConect() {
        mysqli_close($this->conexion);
    }
}
