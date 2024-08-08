<?php 
$contador = 0;
if($listarVivi <> null)
{	
	foreach($listarVivi as $LisVivi) { ?>
				
	<tr class="filaViviendas">
		<td id='llenarViviendas'><?php echo $LisVivi[0]?></td>
		<td><?php echo $LisVivi[1]?></td>
		<td><?php echo $LisVivi[2]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>