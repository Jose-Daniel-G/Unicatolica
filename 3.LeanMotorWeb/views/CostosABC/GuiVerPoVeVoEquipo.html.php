<table>
    <?php
  // dd($datosEqui);
    if($datosEqui <> null)
    {
        echo"    Equipo: ".$datosEqui[0][3] ." - Potencia: ".$datosEqui[0][0]." - Velocidad: ".$datosEqui[0][1]. " - Voltaje: ".$datosEqui[0][2];
    }
    
    ?>
    
</table>