<?php 
$contador = 0;
if($listarPro <> null)
{	
	foreach($listarPro as $LisProfe) { ?>
				
	<tr class="filaProfe">
		<td id='llenarProfe'><?php echo $LisProfe[0]?></td>
		<td><?php echo $LisProfe[1]?></td>
		<td><?php echo $LisProfe[2]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>