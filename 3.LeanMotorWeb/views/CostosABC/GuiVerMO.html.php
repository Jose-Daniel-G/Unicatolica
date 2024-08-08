<table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
    <?php
  
    @session_start();   
    $FinalMO= $_SESSION['ActMonObra'];
   // dd($FinalMO);

    if($FinalMO <> null)
    {                
        $posicion=$uneg-1;
        $totalmo=0; 
      
         echo"<tr>";
                echo"<td>Ingreso</td>";
                echo"<td>Cliente</td>";
                echo"<td>Equipo</td>";
                echo"<td>Total</td>";               
               

                echo"</tr>";

        for($i=0; $i<count($FinalMO); $i++)
        {

            if($FinalMO[$i][7] ==$posicion)
            {                
                echo"<tr>";
                echo"<td>".$FinalMO[$i][0]."</td>";
                echo"<td>".$FinalMO[$i][1]."</td>";
              
                echo"<td>".$FinalMO[$i][6]."</td>";
                echo"<td><p class='text-right'>".number_format($FinalMO[$i][2],2)."</p></td>";
                $totalmo+= $FinalMO[$i][2]  ;                    
                echo"</tr>";
            }

               

        }

        echo"<tr><td colspan='3'>Total<td><p class='text-right'>".number_format($totalmo,2)."</p></td></tr>";
    }
    ?>
</table>
