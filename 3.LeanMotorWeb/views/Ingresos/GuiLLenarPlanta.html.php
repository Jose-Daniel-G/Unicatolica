<?php

if($Plant <> null)
{
	echo'<option value="0">Seleccione ...</option>';	
	foreach ($Plant as $planta) {
		echo"<option value=".$planta[0].">".$planta[1]."</option>";
	}

}
else
{
	echo'<option value="0">Seleccione ...</option>';
}


?>