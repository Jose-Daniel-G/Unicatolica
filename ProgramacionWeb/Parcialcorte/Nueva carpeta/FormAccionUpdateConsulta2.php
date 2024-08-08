<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Form Update con Dos Tablas</title> </head>
<body>
 <?php $conexion=new mysqli("localhost","root","", "formulario");
 if ($conexion->connect_errno) { 
 echo "Problemas en la conexion a MySQL: " . $conexion->connect_error; }
$sql = "update afiliado set TipoDocumento=?, Documento=?, PrimerNombre=?, SegundoNombre=?  where Documento=?";
/* Sentencia Preparada, etapa 1: preparación */ 
$sentencia = $conexion->prepare($sql);
 if (!$sentencia) {
	 printf("Problemas en la Sentencia Preparada.\n". $conexion->error . "\n"); 
	 } 
	 /* Sentencia preparada, etapa 2: vincular parametros y ejecutar */
	 $sentencia->bind_param("sissi", $_REQUEST['codigo'], $_REQUEST['nombre'], $_REQUEST['horas'],
                                	 $_REQUEST['valor'], $_REQUEST['documentoAnt']);
  if (!$sentencia) { 
  printf("Problemas en la Vinculación de Parámetros.\n". $conexion->error . "\n"); 
  } $sentencia->execute(); if (!$sentencia) { printf("Problemas en el Update.\n". $conexion->error . "\n");
  } else echo "!!El Afiliado fue modificado OK!!<br>";
/* se recomienda el cierre explícito de la Sentencia */ $sentencia->close(); $conexion->close(); ?>
<br /> <br />
<p><a href='javascript:history.go(-1)'>Anterior</a></p>
<p><a href='javascript:history.go(-2)'>Inicio</a></p>
</body> </html>