<?php 
$contador = 0;
if($listarM <> null)
{	
	foreach($listarM as $LisMarcas) { ?>
				
	<tr class="filaMarcas">
		<td id='llenarM'><?php echo $LisMarcas[0]?></td>
		<td><?php echo $LisMarcas[1]?></td>
		<td><?php echo $LisMarcas[3]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>