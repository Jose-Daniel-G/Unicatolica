<?php 
$contador = 0;
if($listarG <> null)
{	
	foreach($listarG as $LisGrupos) { ?>
				
	<tr class="filaGrupos">
		<td id='llenarM'><?php echo $LisGrupos[0]?></td>
		<td><?php echo $LisGrupos[1]?></td>
		<td><?php echo $LisGrupos[2]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>