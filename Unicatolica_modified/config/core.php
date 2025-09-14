<?php

class core {

    private $server;
    private $user;
    private $password;
    private $database;
    public $conexion;

    public function __construct() {
        $this->setConfig();
        $this->connect();
    }

    private function setConfig() {
        require "configuracion.php";

        $this->server = $server;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;

    }

    public function connect() {
        $this->conexion = new mysqli($this->server, $this->user, $this->password, $this->database);
        if ($this->conexion->connect_errno) {
            die("Error de conexión a la base de datos: " . $this->conexion->connect_error);
        }
            $this->conexion->set_charset("utf8");
    }

    public function getConexion() {
        return $this->conexion;
    }

    public function closeConexion()
    {
        if ($this->conexion) {
            $this->conexion->close();
        }
    }

    public function execute($sql)
    {
        $result = $this->conexion->query($sql);

        if (!$result) {
            die("Error en la consulta: " . $this->conexion->error);
        }

        return $result;
    }

    function uuId($serverID = 1) {
        $t = explode(" ", microtime());
        return sprintf('%04x-%08s-%08s-%04s-%04x%04x',
            $serverID,
            uniqid(),
            substr("00000000" . dechex($t[1]), -8), // get 8HEX of unixtime
            substr("0000" . dechex(round($t[0] * 65536)), -4), // get 4HEX of microtime
            mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}
