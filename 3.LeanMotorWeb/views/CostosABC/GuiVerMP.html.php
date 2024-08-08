<table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
    <?php
  
    @session_start();   
    $FinalMO= $_SESSION['RegMatPrima'];
    $totalmp=0;
    
    
    if($FinalMO <> null)
    {       
        $posicion=$uneg-1; 
         echo"<tr>";
                echo"<td>Ingreso</td>";
                echo"<td>Cliente</td>";
                echo"<td>Numero Documento</td>";
                echo"<td>Tipo Documento</td>";
                echo"<td>Total</td>";


                echo"</tr>";

        for($i=0; $i<count($FinalMO); $i++)
        {           
            if($FinalMO[$i][5] ==$posicion)
                {

                echo"<tr>";
                echo"<td>".$FinalMO[$i][0]."</td>";
                echo"<td>".$FinalMO[$i][1]."</td>";
                 echo"<td>".$FinalMO[$i][2]."</td>";
                echo"<td>".$FinalMO[$i][3]."</td>";
                echo"<td><p class='text-right'>".number_format($FinalMO[$i][4],2)."</p></td>";
                $totalmp+= $FinalMO[$i][4]  ;                    
                echo"</tr>";

                }

        }

        echo"<tr><td colspan='4'>Total<td><p class='text-right'>".number_format($totalmp,2)."</p></td></tr>";
    }
    ?>
</table>
