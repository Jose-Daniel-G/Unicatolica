<?php 
$contador = 0;
if($listarTipoE <> null)
{	
	foreach($listarTipoE as $LisEquipos) { ?>
				
	<tr class="filaEquipos">
		<td id='llenarTE'><?php echo $LisEquipos[0]?></td>
		<td><?php echo $LisEquipos[2]?></td>
		<td><?php echo $LisEquipos[3]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>