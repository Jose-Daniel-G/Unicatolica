<table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
    <?php
  
    @session_start();   
    $FinalFact= $_SESSION['RegFacturados'];
   // dd($FinalFact);

    if($FinalFact <> null)
    {                
        $posicion=$uneg-1;
        $totalfact=0; 
      
         echo"<tr>";
                echo"<td>Ingreso</td>";
                echo"<td>Cliente</td>";
                echo"<td>Total</td>";               
               

                echo"</tr>";

        for($i=0; $i<count($FinalFact); $i++)
        {

            if($FinalFact[$i][3] ==$posicion)
            {                
                echo"<tr>";
                echo"<td>".$FinalFact[$i][0]."</td>";
                echo"<td>".$FinalFact[$i][1]."</td>";
                echo"<td><p class='text-right'>".number_format($FinalFact[$i][2],2)."</p></td>";
                $totalfact+= $FinalFact[$i][2]  ;                    
                echo"</tr>";
            }

               

        }

        echo"<tr><td colspan='2'>Total<td><p class='text-right'>".number_format($totalfact,2)."</p></td></tr>";
    }
    ?>
</table>
