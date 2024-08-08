<!DOCTYPE html PUBLIC> <html xmlns="http://www.w3.org/1999/xhtml"> 
<head> <meta charset="utf-8" />
 <title>Form Update con Dos Tablas</title> </head>
<body> <form name="up"action="AccionUpCosulta.php" method="post" onsubmit="return valida()">
<h2><strong><em>Actualiza Datos Básicos Afiliado</em></strong></h2>
DOCUMENTO: <input type="text" name="documento"><br> <input type="submit" value="Buscar">
<script>
    function valida(){
    var doc =document.up.documento;
   if (doc.value==""){alert("Ingrese el Documento")
		return false;
		}
}
</script>
<br>
<p><a href='javascript:history.go(-1)'>Inicio</a></p>
</form>
</body> </html>