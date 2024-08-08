<?php 
$contador = 0;
if($listarFcp <> null)
{	
	foreach($listarFcp as $LisFc) { ?>
				
	<tr class="filaFc">
		<td id='llenarFc'><?php echo $LisFc[0]?></td>
		<td><?php echo $LisFc[1]?></td>
		<td><?php echo $LisFc[4]?></td>
		<td><?php echo $LisFc[3]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>