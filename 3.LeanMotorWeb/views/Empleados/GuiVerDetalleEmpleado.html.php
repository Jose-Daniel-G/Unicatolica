<table class="table table- table-hover" border='1'>	
	<tr>
		<th width='20%'>Fecha Cambio</th>
		<th width='10%'>Valor</th>
		<th width='40%'>Obsevaciones</th>
		<th width='30%'>Usuario</th>
	</tr>
	

<?php
	if($llenarsalario <> null)
	{
		foreach($llenarsalario as $dsalario)
		{
			echo"<tr>";
				echo"<td width='20%'>".$dsalario[1]."</td>";
				echo"<td width='10%'>".$dsalario[2]."</td>";
				echo"<td width='40%'>".$dsalario[4]."</td>";
				echo"<td width='30%'>".$dsalario[3]."</td>";
			echo"</tr>";
		}
	
	}
	else
	{
		echo"<tr>";
				echo"<td colspan='4'>No hay Registros</td>";				
		echo"</tr>";
	}
	
	?>	
	</table>
	
	<table class="table table- table-hover" border='1'>	
		<tr>
			<th width='20%'>Fecha Novedad</th>
			<th width='10%'>Tipo</th>
			<th width='40%'>Obsevaciones</th>
			<th width='30%'>Usuario</th>
		</tr>
			
	<?php
	if($llenarretiro <> null)
	{
		foreach($llenarretiro as $retiro)
		{
			echo"<tr>";
				echo"<td width='20%'>".$retiro[1]."</td>";
				echo"<td width='10%'>".$retiro[2]."</td>";
				echo"<td width='40%'>".$retiro[4]."</td>";
				echo"<td width='30%'>".$retiro[3]."</td>";
			echo"</tr>";
		}
	}
	else
	{
		echo"<tr>";
				echo"<td colspan='4'>No hay Registros</td>";				
		echo"</tr>";
	}
	
?>
</table>