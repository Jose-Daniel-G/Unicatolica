<?php 
$contador = 0;
if($listarArl <> null)
{	
	foreach($listarArl as $LisArl) { ?>
				
	<tr class="filaArl">
		<td id='llenarArl'><?php echo $LisArl[0]?></td>
		<td><?php echo $LisArl[1]?></td>
		<td><?php echo $LisArl[4]?></td>
		<td><?php echo $LisArl[3]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>