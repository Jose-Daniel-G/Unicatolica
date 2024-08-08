 <?php 
@session_start();
$totalmo=0;
$totalmp=0;
$totalmgd=0;
$totalcif=0;
$totalfact=0;

 if($Ucosto<>null)
 {


$cantY=count($Ucosto);
  //dd($tablaCostosMO);
    echo"<tr>";   
     echo"<td></td>";
       foreach($Ucosto as $Ucostos)
        {       
            echo"<td id='uneg".$Ucostos[0]."' data-id='".$Ucostos[0]."' style='font-size:x-small' ><p class='text-right'>".$Ucostos[1]."</p></td>";                                                     
        }
        echo"<td>Total</td>";
    echo"</tr>";
    
    echo"<tr>";
        echo"<td style='font-size:small'>M. Obra</td>";
    
        for($i=1; $i<=$cantY; $i++)   
        {
           echo"<td id='mo' data-id='".$Ucosto[$i][0]."' data-url='".  getUrl("CostosABC", "CostosABC", "VerMO", FALSE, "ajax")."'><p class='text-right'>".number_format($tablaCostosMO[$i],2)."</p></td>";                   
           $totalmo=$totalmo+ $tablaCostosMO[$i];                      
        }
        
        echo"<td><p class='text-right'>".number_format($totalmo,2)."</p></td>";        
    echo"</tr>";
   
  
    echo"<tr>";
        echo"<td style='font-size:small'>M. Prima</td>";
    
        for($i=1;  $i<=$cantY; $i++)
        {
            echo"<td id='mp' data-id='".$Ucosto[$i][0]."' data-url='".  getUrl("CostosABC", "CostosABC", "VerMP", FALSE, "ajax")."'><p class='text-right'>".number_format($tablaCostoMP[$i],2)."</p></td>";                   
            $totalmp=$totalmp+$tablaCostoMP[$i];                               
        }
        echo"<td><p class='text-right'>".number_format($totalmp,2)."</p></td>";        
    echo"</tr>";
    
  
    echo"<tr>";
        echo"<td style='font-size:small'>Gastos Directos</td>";
        for($i=1; $i<=$cantY; $i++)
        {                  
            echo"<td id='gd' data-id='".$Ucosto[$i][0]."' data-url='".  getUrl("CostosABC", "CostosABC", "VerGD", FALSE, "ajax")."'><p class='text-right'>".number_format($tablaGactosDirect[$i],2)."</p></td>";                   
            $totalmgd=$totalmgd+$tablaGactosDirect[$i];              
        }
       
        echo"<td><p class='text-right'>".number_format($totalmgd,2)."</p></td>";
    echo"</tr>";
     
    echo"<tr>";
      echo"<td style='font-size:small'>CIF</td>";      
       for($i=1; $i<=$cantY; $i++)
        {          
           
            echo"<td id='cif'  data-id='".$Ucosto[$i-1][0]."' data-url='". getUrl("CostosABC", "CostosABC", "VerCif", FALSE, "ajax")."'><p class='text-right'>".number_format($TablaCifOI[$i],2)."</p></td>";                   
            $totalcif+=$TablaCifOI[$i];        
        }         
      echo"<td><p class='text-right'>".number_format($totalcif,2)."</p></td>";
    echo"</tr>";  
  
    echo"<tr>";
        echo"<td style='font-size:small'>Costos Almacenamiento</td>";                         
        echo"<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";                   
        echo"<td><p class='text-right'>".number_format($tablaCostoAlmacenamiento,2)."</p></td>";
    echo"</tr>";
    
  
    
    echo"<tr>";
        echo"<td style='font-size:small'>Tot Costos</td>"; 
        for($i=1; $i<=$cantY; $i++)
        {
            $tc[$i]=$tablaCostosMO[$i]+ $tablaCostoMP[$i]+$tablaGactosDirect[$i]+$TablaCifOI[$i];
            echo"<td><p class='text-right'>".number_format($tc[$i],2)."</td>";              
            $ttc+=$tc[$i];
        }
           
        
      
        $ttc=$ttc+$totalcif+$tablaCostoAlmacenamiento;
        echo"<td><p class='text-right'>".number_format($ttc,2)."</td>";   
       
        
        
    echo"</tr>";
  
          
    echo"<tr>";
      echo"<td style='font-size:small'>Facturado</td>";
      for($i=1; $i<=$cantY;  $i++)
      {                  
          echo"<td id='fact' data-id='".$Ucosto[$i][0]."' data-url='".  getUrl("CostosABC", "CostosABC", "VerFcaturado", FALSE, "ajax")."'><p class='text-right'>".number_format($tablafacturado[$i],2)."</p></td>";
          $totalfact+=$tablafacturado[$i];
      }
       echo"<td><p class='text-right'>".number_format($totalfact,2)."</td>";  
    
    echo"</tr>";
    
    echo"<tr>";
   
    echo"<td style='font-size:small'>Renta. $</td>";
      for($i=1; $i<=$cantY; $i++)
      {           
          $renta=$tablafacturado[$i]- $tc[$i];
          echo"<td><p class='text-right'>".number_format($renta,2)."</td>";                    
      }   
      $renta=$totalfact- $ttc;
       echo"<td><p class='text-right'>".number_format($renta,2)."</td>";    
    echo"</tr>";
   
    echo"<td style='font-size:small'>Renta. %</td>";
      for($i=1; $i<=$cantY; $i++)
      {      
          if($tc[$i] >0 and $tablafacturado[$i] >0)
          {
               $rentap=round(((($tablafacturado[$i]-$tc[$i])/$tablafacturado[$i])  *100),2);
          }
          else
          {
              $rentap=0;
          }
          echo"<td><p class='text-right'>".number_format($rentap,2)."</td>";                    
      }   
      $rentap=  round((($totalfact-$ttc)/ $totalfact)*100,2);
      echo"<td><p class='text-right'>".number_format($rentap,2)."</td>";    
    echo"</tr>";
  
 }
 else
 {
     echo"<td><strong>$horas</strong></td>";
 }
?>