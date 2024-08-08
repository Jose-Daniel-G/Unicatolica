<?php 
$contador = 0;
if($listarMP <> null)
{	
	foreach($listarMP as $LisMarP) { ?>
				
	<tr class="filaMarP">
		<td id='llenarMaP'><?php echo $LisMarP[0]?></td>
		<td><?php echo $LisMarP[1]?></td>
		<td><?php echo $LisMarP[2]?></td>	
		<!--<td><?php //echo $LisMarP[1]?></td>	-->
		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>