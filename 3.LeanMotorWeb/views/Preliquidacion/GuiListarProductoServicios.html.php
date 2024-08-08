<?php

if($servicios <> null)
{
	echo"<table class='table table-table-hover' width='30%' height:'100px'>";
	foreach($servicios as $servicio)
	{
		echo"<tr><td class='listProGer' data-id='".$servicio[0]."' data-desc='".$servicio[1]."' data-iva='".$servicio[2]."'  data-destino='" . $data_fila . "'>".$servicio[1]."</td></tr>";
	}
}
else
{
	echo"NO hay Servicios";
}


?>