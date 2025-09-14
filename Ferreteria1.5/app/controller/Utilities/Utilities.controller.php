<?php
include_once "../../config/connection.php";

class Utilities extends connection {

    public function GenerateRecordAudit($proceso, $descripcion) {
        
		$fecha=date("Y-m-d");
        $stime=date("h").":".date("i");
        $direccion = ObtenerIP();
        $hostname = gethostname();
        
        $cons="INSERT INTO auditoria (Numero_Registro, Fecha, Hora_Actualiza, Equipo, Direccion_Ip, Usuario, Proceso, Descripcion, Nit_Empresa)
         VALUES (null,'$fecha',CURRENT_TIMESTAMP, '$hostname', '$direccion','".$_SESSION["usua_nombreCompleto"]."','$proceso','$descripcion','".$_SESSION["Nit_Empresa"]."') ";
        $this->consult($cons);
    }

    public function validateKey(){
        extract($_POST);
        $answer = false;
        
        $sqlverificar = "SELECT $field AS Nit FROM $table WHERE $field = '$nit'";
        // echo  "SELECT $campo AS Nit FROM $table WHERE $campo = '$nit'";
        $verificar = $this ->consult($sqlverificar);

        if($verificar != null){
            if($verificar[0]['Nit'] == $nit){
                $answer=true;
            }
        }

        echo json_encode($answer);
    }

}
