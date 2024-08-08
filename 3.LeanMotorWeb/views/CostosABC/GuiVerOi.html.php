

<table>
   
        <?php
       //dd($priv_equipo);
        if($priv_equipo <> null)
        {   
            ?>
           <tr>
               <td ALIGN=right>Cliente &nbsp;</td><td><?php echo $priv_equipo[0][1]?></td>
           </tr>           
            <?php
            echo"<tr>";
                echo"<td ALIGN=right>Fecha OI &nbsp;</td><td>".substr($priv_equipo[0][2],0,10)."</td>";
             echo"</tr>";  

            echo"<tr>";
                echo"<td ALIGN=right>Fecha de OE &nbsp;</td></td><td>".$fechaOE."</td>";
             echo"</tr>";

            echo"<tr>";
                echo"<td ALIGN=right>Fecha de Entrega &nbsp;</td><td>".$fechaE."</td>";
            echo"</tr>";   

            echo"<tr>";
                echo"<td  ALIGN=right>Dif entre OE - F.entrega &nbsp;</td><td>".$difOeE."</td>";
            echo"</tr>";   

            echo"<tr>";
                echo"<td  ALIGN=right>Días Prometidos al Cliente &nbsp;</td><td>".$dprometidos."</td>";
             echo"</tr>";

            echo"<tr>";
                echo"<td  ALIGN=right>Días de este equipo en Planta  &nbsp;</td><td>".$dplanta."</td>";
             echo"</tr>";

            echo"<tr>";
                echo"<td  ALIGN=right>&nbsp;</td>&nbsp;<td></td>";
            echo"</tr>";
            
            echo"<tr>";
                echo"<td  ALIGN=right>Equipo &nbsp;</td><td>".$priv_equipo[0][3]."</td>";
            echo"</tr>";
            
            echo"<tr>";
                echo"<td  ALIGN=right>Potencia &nbsp;</td><td>".$priv_equipo[0][4]." - ".$priv_equipo[0][8]."</td>";
            echo"</tr>";
            
            echo"<tr>";
                echo"<td ALIGN=right>Velocidad &nbsp;</td><td>".$priv_equipo[0][5]."</td>";
            echo"</tr>";
            
            echo"<tr>";
                echo"<td  ALIGN=right>Voltaje &nbsp;</td><td>".$priv_equipo[0][6]."</td>";
            echo"</tr>";
            
            echo"<tr>";
                echo"<td  ALIGN=right>Amperaje &nbsp;</td><td>".$priv_equipo[0][7]."</td>";
            echo"</tr>";
          
        }
        else 
        {
            echo"<tr>";
                echo"<td></td>";
            echo"</tr>";
                 
        }
        ?>
        <td></td>
    </tr>
</table>
       