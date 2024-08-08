<?php 
$contador = 0;
if($listarEps <> null)
{	
	foreach($listarEps as $LisEps) { ?>
				
	<tr class="filaEps">
		<td id='llenarEps'><?php echo $LisEps[0]?></td>
		<td><?php echo $LisEps[1]?></td>
		<td><?php echo $LisEps[4]?></td>
		<td><?php echo $LisEps[3]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>