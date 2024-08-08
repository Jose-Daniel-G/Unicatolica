<?php 
$contador = 0;
if($listarFpp <> null)
{	
	foreach($listarFpp as $LisFp) { ?>
				
	<tr class="filaFp">
		<td id='llenarFp'><?php echo $LisFp[0]?></td>
		<td><?php echo $LisFp[1]?></td>
		<td><?php echo $LisFp[4]?></td>
		<td><?php echo $LisFp[3]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>