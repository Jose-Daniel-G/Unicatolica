<?php 
$contador = 0;
if($listarCcp <> null)
{	
	foreach($listarCcp as $LisCc) { ?>
				
	<tr class="filaCc">
		<td id='llenarCc'><?php echo $LisCc[0]?></td>
		<td><?php echo $LisCc[1]?></td>
		<td><?php echo $LisCc[4]?></td>
		<td><?php echo $LisCc[3]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>