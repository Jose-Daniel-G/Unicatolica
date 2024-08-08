<?php 
$contador = 0;
if($listarTipoSeg <> null)
{	
	foreach($listarTipoSeg as $LisTipoSeg) { ?>
				
	<tr class="filaTipoSeg">
		<td id='llenarTipoSeg'><?php echo $LisTipoSeg[0]?></td>
		<td><?php echo $LisTipoSeg[1]?></td>
		<td><?php echo $LisTipoSeg[2]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>