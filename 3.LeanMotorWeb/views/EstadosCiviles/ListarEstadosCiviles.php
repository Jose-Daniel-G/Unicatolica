<?php 
$contador = 0;
if($listarEstCivil <> null)
{	
	foreach($listarEstCivil as $LisEstadosCivil) { ?>
				
	<tr class="filaEstCivil">
		<td id='llenarEstCi'><?php echo $LisEstadosCivil[0]?></td>
		<td><?php echo $LisEstadosCivil[1]?></td>
		<td><?php echo $LisEstadosCivil[2]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>