<?php

if($plantas <> null)
{

	echo"<option value=''>Seleccione ...</option>";
	foreach($plantas as $planta)
	{
		echo"<option value='".$planta[0]."'>".$planta[1]."</option>";
	}
}
else
{
	echo"<option value=''></option>";	
}


?>