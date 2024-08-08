<?php 
$contador = 0;
if($listarP <> null)
{	
	foreach($listarP as $LisProductos) { ?>
				
	<tr class="filaProductos">
		<td id='llenarP'><?php echo $LisProductos[0]?></td>
		<td><?php echo $LisProductos[1]?></td>
		<td><?php echo $LisProductos[2]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>