<table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
    <?php
  
    @session_start();   
    $FinalGD= $_SESSION['RegGastosD'];
    //dd($FinalGD);
   
    $posicion=$uneg - 1;
    $totalgd=0; 
   if($FinalGD <> null)
   {
     echo"<tr>";
                echo"<td>Ingreso</td>";
                echo"<td>Cliente</td>";
                echo"<td>Fecha Documento</td>";
                //echo"<td>No Documento</td>";
                echo"<td>Total</td>";


                echo"</tr>";

        for($i=0; $i<count($FinalGD); $i++)
        {

            if($FinalGD[$i][4] ==$posicion)
                {

                echo"<tr>";
                echo"<td>".$FinalGD[$i][0]."</td>";
                echo"<td>".$FinalGD[$i][1]."</td>";
                echo"<td>".substr($FinalGD[$i][2], 0, 10)."</td>";          

                echo"<td><p class='text-right'>".number_format($FinalGD[$i][3],2)."</p></td>";
                $totalgd+= $FinalGD[$i][3]  ;   

                echo"</tr>";
                }

        }

        echo"<tr><td colspan='3'>Total<td><p class='text-right'>".number_format($totalgd,2)."</p></td></tr>";
   }
    ?>
</table>
