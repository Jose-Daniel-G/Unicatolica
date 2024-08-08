<?php

if($contactos <> null)
{
	echo'<option value="0">Seleccione ...</option>';	
	foreach ($contactos as $contacto) {
		echo"<option value=".$contacto[0].">".$contacto[0]."</option>";
	}

}
else
{
	echo'<option value="0">Seleccione ...</option>';
}


?>