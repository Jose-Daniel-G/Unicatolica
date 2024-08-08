<?php 
$contador = 0;
if($listarinforme <> null)
{
	echo'<input type="hidden" id="cantEmpleado" value="'.count($listarinforme).'">';
	echo'<input type="hidden" id="estados" value="'.$estados.'">';
foreach($listarinforme as $informe) { ?>
			
<tr class="filaE">
	<td><?php echo ++$contador; ?></td>
	<td><?php echo $informe[1]?></td>
	<td ><?php echo $informe[2]?></td>
	<td ><?php echo $informe[3]?></td>
	<td><?php echo $informe[4]?></td>									
	<td><?php echo $informe[5]?></td>									
	<td><?php echo $informe[6]?></td>									
	<td><?php echo $informe[13]?></td>									
	<td><?php echo $informe[7]?></td>									
	<td><?php echo $informe[14]?></td>									
	<td><?php echo $informe[8]?></td>									
	<td><?php echo $informe[9]?></td>									
	<td><?php echo $informe[10]?></td>									
	<td><?php echo $informe[11]?></td>									
	<td><?php echo $informe[12]?></td>									
	<td><?php echo $informe[15]?></td>									
	<td><?php echo $informe[16]?></td>									
</tr>
	<?php }
}
else
{
	echo"<tr><td>No hay Registros </td></tr>";
}	?>