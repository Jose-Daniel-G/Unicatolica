<?php 
$contador = 0;
if($listarCarg <> null)
{	
	foreach($listarCarg as $LisCargos) { ?>
				
	<tr class="filaCargos">
		<td id='llenarCargo'><?php echo $LisCargos[0]?></td>
		<td><?php echo $LisCargos[1]?></td>
		<td><?php echo $LisCargos[2]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>