<table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
<?php  
    @session_start();   
   foreach($datos as $dato){
        echo"<tr>";
            echo"<td>Usuario que Crea</td>";
            echo"<td colspan='3'>".$dato["Nombre_Usuario"]."</td>";
        echo"</tr>";
        
        echo"<tr>";
                    echo"<td>Usuario que Modifica</td><td>".$usuModifica."</td>";
                    echo"<td>Fecha</td><td>".$fechaModifica."</td>";                               
        echo"</tr>";

        echo"<tr>";
                    echo"<td>Usuario que Anula</td><td>".$usuElimina."</td>";
                    echo"<td>Fecha</td><td>".$fechaElimina."</td>";                    
        echo"</tr>";

        echo"<tr>";
                    echo"<td colspan='4'>Por que Anulo</td>";                            
        echo"</tr>";

        echo"<tr>";
                    echo"<td colspan='4'>".$dato["Razon_Anula"]."</td>";                            
        echo"</tr>";
        
        if ($reproceso != null) {
            echo"<tr>";
            echo"<td>Orden Maestra</td>";
            echo"<td>".$reproceso[0]["Orden_Maestra"]."</td>";
            echo"<td>Fecha Orden</td>";
            echo"<td>".substr($reproceso[0]["Fecha_Creada"], 0, 10)."</td>";
            echo"</tr>";
        }
        // else{
        //     echo"<tr>";
        //     echo"<td>Orden Factura</td>";
        //     echo"<td>Esta Pendiente</td>";
        //     echo"<td>Fecha Factura</td>";
        //     echo"<td></td>";
        //     echo"</tr>";
        // }
    }
            
?>
</table>
