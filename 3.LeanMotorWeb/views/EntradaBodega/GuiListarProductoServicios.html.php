<?php

if($servicios <> null)
{
	echo"<table class='table table-table-hover' width='30%' height:'100px'>";
	foreach($servicios as $servicio)
	{
		echo"<tr><td class='listPro_EB' data-id='".$servicio[0]."' data-desc='".$servicio[1]."'
			data-grupo='".$servicio[5]."' data-marca='".$servicio[4]."' data-um='".$servicio[2]."'
			data-ultimo='".$servicio[3]."' data-un='".$servicio[6]."' data-iva='".$servicio[7]."'  
		data-destino='" . $data_fila . "'>".$servicio[1]."</td></tr>";
	}
}
else
{
	echo"NO hay Servicios";
}


?>