<table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
    <?php
  
    @session_start(); 
    
    //dd($_SESSION['RegCifOi']);
    $unegPos=$uneg;
    $posicion=  number_format($unegPos);
    $regCifOi=$_SESSION['RegCifOi'];
    $totalcif=0;     
    
    if($regCifOi <> null)
    {      
      
         echo"<tr>";
                echo"<td>Ingreso</td>";
                echo"<td>Cliente</td>";
                echo"<td>Equipo</td>";
               // echo"<td>Total</td>";               
               

                echo"</tr>";
      
        for($i=1; $i<count($regCifOi[$posicion]); $i++)
        {    
            
            if($regCifOi[$posicion][$i][4] == $posicion)
            {                       
                echo"<tr>";
                echo"<td>".$regCifOi[$posicion][$i][0]."</td>";
                echo"<td>".$regCifOi[$posicion][$i][1]."</td>";              
                echo"<td>".$regCifOi[$posicion][$i][2]."</td>";
                //echo"<td><p class='text-right'>".number_format($regCifOi[$posicion][$i][3],2)."</p></td>";
                $totalcif+= $regCifOi[$posicion][$i][3]  ;                    
                echo"</tr>";
             }              
        }
       
        //echo"<tr><td colspan='3'>Total<td><p class='text-right'>".number_format($totalcif,2)."</p></td></tr>";
    }
     echo"<input type='hidden' id='Tcif' value=".$totalcif.">";
    ?>
</table>


