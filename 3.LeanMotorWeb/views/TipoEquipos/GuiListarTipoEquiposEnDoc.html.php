<?php

if($tipo_Equipos <> null)
{
	echo"<table class='table table-table-hover' width='30%' height:'100px'>";
	foreach($tipo_Equipos as $tequi)
	{
		echo"<tr class='listarTipoEquiDoc' data-id='".$tequi[0]."' data-desc='".$tequi[1]."'><td><a>".$tequi[1]."</a></td></tr>";
	}
}
else
{
	echo"No hay Regitros";
}


?>