<html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Form Update con Dos Tablas</title> </head>
<body onLoad="activarPrimerControl()">
<?php $conexion=new mysqli("localhost","root","","formulario");
 if ($conexion->connect_errno) 
 { 
echo "Problemas en la conexion a MySQL: " . $conexion->connect_error; }
$sql = "select * from afiliado        where Documento=?";
/* Sentencia Preparada, etapa 1: preparación */ 
$sentencia = $conexion->prepare($sql); if (!$sentencia) { 
printf("Problemas en la Sentencia Preparada.\n". $conexion->error . "\n"); 
} 
/* Sentencia preparada, etapa 2: vincular parametros y ejecutar */
 $documento = $_REQUEST['documento'];
 $sentencia->bind_param("i", $documento); 
 if (!$sentencia) { 
 printf("Problemas en la Vinculación de Parámetros.\n". $conexion->error . "\n");
 } $sentencia->execute(); if (!$sentencia) { 
 printf("Problemas en la Ejecución.\n". $conexion->error . "\n"); 
 }
 /* Sentencia preparada, etapa 3: Obtener Resultado */ $registros=$sentencia->get_result(); if (!$registros) { 
 printf("Problemas en el Select.\n". $conexion->error . "\n"); }
if ($regempleado=$registros->fetch_assoc()) { ?>
 <script language="JavaScript"> function activarPrimerControl() {
// var categoria = "<?php echo htmlentities($regempleado['Categoria'], ENT_COMPAT, 'utf-8'); ?>";
// alert(categoria);
// if (categoria.length > 0) document.getElementById(categoria).selected=true;
// } </script>
<form action="FormAccionUpdateConsulta2.php" method="post">
<h2><strong><em>Actualiza Datos Basicos Empleado</em></strong></h2>

Documento: <input type="text" name="codigo" value="<?php echo $regempleado['Documento'] ?>" ><br> 
PrimerNombre: <input type="text" name="horas" value="<?php echo $regempleado['PrimerNombre'] ?>"><br> 
SegundoNombre: <input type="text" name="valor" value="<?php echo $regempleado['SegundoNombre'] ?>"><br>


</select> <br><br>
<input type="submit" value="Modificar"> <br>
<input type="hidden" name="documentoAnt" value="<?php echo $regempleado['Documento'] ?>">
</form> <?php } else { echo "No existe Empleado"; } /* se recomienda el cierre explícito de la Sentencia */ 
$sentencia->close(); $conexion->close(); ?> <br /> <br /> <p><a href='javascript:history.go(-1)'>Anterior</a></p>
<p><a href='javascript:history.go(-2)'>Inicio</a></p>
</body> </html>