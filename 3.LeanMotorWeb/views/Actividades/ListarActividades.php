<?php 
$contador = 0;
if($listarAct <> null)
{	
	foreach($listarAct as $lisAct) { ?>
				
	<tr class="filaAct">
		<td id='llenarAct' width="10%"><?php echo $lisAct[0]?></td>
		<td  width="30%"><?php echo $lisAct[1]?></td>
		<td width="30%"><?php echo $lisAct[5]?></td>
		<td width="30%"><?php echo $lisAct[6]?></td>		
	</tr>
		<?php } 
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}

?>