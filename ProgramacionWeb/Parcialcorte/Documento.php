<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
 <html> 
 <head>
 <title>Consultar Empleado</title>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 </head>
<body>
 <h2><strong><em>Consultar Resgistros Empleado</em></strong></h2>
<form name="consult"action="cosultaDocumento.php" method="post" onsubmit="return valida()">
Documento : <input type="text" name="documento"><br>
<script>
    function valida(){
    var doc =document.consult.documento;
   if (doc.value==""){alert("Ingrese el Documento")
		return false;
		}
}
</script>
</select> 
<br> <input type="submit" value=": BUSCAR :"> 
</form>
</body> </html>