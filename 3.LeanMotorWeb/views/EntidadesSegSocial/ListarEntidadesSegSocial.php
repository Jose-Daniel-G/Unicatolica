<?php 
$contador = 0;
if($listarSeg <> null)
{	
	foreach($listarSeg as $LisSeg) { ?>
				
	<tr class="filaSegSocial">
		<td id='llenarEntidadesSegSocial'><?php echo $LisSeg[0]?></td>
		<td><?php echo $LisSeg[1]?></td>
		<td><?php echo $LisSeg[4]?></td>
		<td><?php echo $LisSeg[3]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>