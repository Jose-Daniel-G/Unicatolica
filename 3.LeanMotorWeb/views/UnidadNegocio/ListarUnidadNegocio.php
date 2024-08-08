<?php 
$contador = 0;
if($listarUnidad <> null)
{	
	foreach($listarUnidad as $LisUnidades) { ?>
				
	<tr class="filaUN">
		<td id='llenarUN'><?php echo $LisUnidades[0]?></td>
		<td><?php echo $LisUnidades[1]?></td>
		<td><?php echo $LisUnidades[3]?></td>		
		<td><?php echo $LisUnidades[2]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>