<table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
<?php  
    @session_start();   
   foreach($datos as $dato)
   {
        echo"<tr>";
                    echo"<td>Usuario que Modifica</td><td>".$dato[0]."</td>";
                    echo"<td>Fecha</td><td>".$dato[1]."</td>";
                               
        echo"</tr>";

        echo"<tr>";
                    echo"<td>Usuario que Anula</td><td>".$dato[2]."</td>";
                    echo"<td>Fecha</td><td>".$dato[3]."</td>";                    
        echo"</tr>";

        echo"<tr>";
                    echo"<td colspan='4'>Por que Anulo</td>";                            
        echo"</tr>";

        echo"<tr>";
                    echo"<td colspan='4'>".$dato[4]."</td>";                            
        echo"</tr>";
    }
            
?>
</table>
