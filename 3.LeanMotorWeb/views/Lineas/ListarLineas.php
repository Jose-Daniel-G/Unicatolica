<?php 
$contador = 0;
if($listarL <> null)
{	
	foreach($listarL as $LisLineas) { ?>
				
	<tr class="filaLineas">
		<td id='llenarM'><?php echo $LisLineas[0]?></td>
		<td><?php echo $LisLineas[1]?></td>
		<td><?php echo $LisLineas[2]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>