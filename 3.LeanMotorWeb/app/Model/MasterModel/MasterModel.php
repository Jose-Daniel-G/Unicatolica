<?php

include "../../config/conexionMysqli.php";

class MasterModel extends Connection {
    public function execute($sql) {
        if ($this->conexion->connect_errno == 0) {
            $result = $this->conexion->query($sql);
        } else {
            echo mysqli_errno();
        }
    }

    public function Consultar($sql) {
        if (!isset($result)) {
            $result = '';
        }
        $resultado = mysqli_query($this->getConect(), $sql);
        if ($this->conexion->connect_errno == 0) {
            $result = array();
            while ($row = mysqli_fetch_array($resultado)) {
                $result[] = $row;
            }
            return $result;
        } else {
            echo mysqli_error();
        }
    }

    public function Consultar2($sql) {
        if (!isset($result)) {
            $result = '';
        }
        $resultado = mysqli_query($this->getConect(), $sql);
        if ($this->conexion->connect_errno == 0) {
            $result = array();
            while ($row = mysqli_fetch_assoc($resultado)) {
                $result[] = $row;
            }
            return $result;
        } else {
            echo mysqli_error();
        }
    }

    public function Insertar($sql) {
        $result = $this->execute($sql);
    }

    public function Actualizar($sql) {
        $result = $this->execute($sql);
    }

    public function Anular($sql) {
        $respuesta = $this->execute($sql);
    }

    public function autoIncrement($id, $tabla) {
        $sql = "select max($id) from $tabla";
        $resultado = $this->execute($sql);

        if ($resultado[0][0] != null) {
            $num_doc = $resultado[0][0] + 1;
        } else {
            $num_doc = 0;
        }
        return $num_doc;
    }
}
