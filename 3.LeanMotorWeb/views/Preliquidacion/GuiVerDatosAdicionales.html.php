<table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
<?php  
    @session_start();   
   foreach($datos as $dato)
   {
        echo"<tr>";
            echo"<td>Usuario que Crea</td>";
            echo"<td colspan='3'>".$dato[0]."</td>";
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
                    echo"<td colspan='4'>".$dato[4]."</td>";                            
        echo"</tr>";
        
       /* echo"<tr>";
            echo"<td>Numero Factura</td>";
            echo"<td>Esta Pendiente</td>";
            echo"<td>Fecha Factura</td>";
            echo"<td></td>";
        echo"</tr>";
        
        echo"<tr>";
            echo"<td>Numero Remision</td>";
            echo"<td></td>";
            echo"<td>Fecha Remision</td>";
            echo"<td></td>";
        echo"</tr>";*/
    }
            
?>
</table>
