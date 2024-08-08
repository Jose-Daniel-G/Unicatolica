<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta charset="utf-8" /> 
<title>Form Update con Dos Tablas</title> </head>
<body onLoad="activarPrimerControl()">
<?php $conexion=new mysqli("localhost","root","","formulario");
 if ($conexion->connect_errno) {
	echo "Problemas en la conexion a MySQL: " . $conexion->connect_error; 
	}

$bene0 = "select * from beneficiario  
      where Documento=?";
	 $sql = "select * from afiliado  
      where Documento=?";
$bene1 = "select * from beneficiario  
      where Documento=?";
/* Sentencia Preparada, etapa 1: preparación */
     $sentencia = $conexion->prepare($sql);
 if (!$sentencia) {
	 printf("Problemas en la Sentencia Preparada.\n". $conexion->error . "\n");
	 }
	 /* Sentencia preparada, etapa 2: vincular parametros y ejecutar */
	 $documento = $_REQUEST['documento']; $sentencia->bind_param("i", $documento);
	 if (!$sentencia){ 
	 printf("Problemas en la Vinculación de Parámetros.\n". $conexion->error . "\n"); 
	 } 
	 $sentencia->execute(); 
	 if (!$sentencia) { 
	 printf("Problemas en la Ejecución.\n". $conexion->error . "\n"); 
	 }
	 /* Sentencia preparada, etapa 3: Obtener Resultado */
	 $registros=$sentencia->get_result();
	 if (!$registros) { 
	 printf("Problemas en el Select.\n". $conexion->error . "\n");
	 }
	  $senten = $conexion->prepare($bene0);
	 $docu = $_REQUEST['documento']; 
	 $senten->bind_param("i", $docu);
	 $senten->execute();
	 $regis=$senten->get_result();
	 $sentence= $conexion->prepare($bene1);$sentence->bind_param("i", $documento);
	 $sentence->execute();$regist=$sentence->get_result(); 
if (($regempleado=$registros->fetch_assoc())&&($regem=$regis->fetch_assoc())){ 
?>
<form action="AccionUpConsulta2.php" method="post"><tr><td>
<table border="3" bgcolor="#aed2f4"><tr><td style="color:#ffffff" bgcolor="#797575">
<strong><em>Actualizar Datos Basicos Afiliado</em></strong></td></tr>
    <tr><td> TipoDocumento: <input type="radio" name="tipo" value="RC">RC
                            <input type="radio" name="tipo" value="TI">TI
	                        <input type="radio" name="tipo" value="CC">CC
    </td><td>Documento: <input type="text" name="doc" value="<?php echo $regempleado['Documento'] ?>" >
</td></tr><td>Primer Nombre: <input type="text" name="pnombre" value="<?php echo $regempleado['PrimerNombre'] ?>">
</td><td> Segundo Nombre: <input type="text" name="snombre" value="<?php echo $regempleado['SegundoNombre'] ?>">
</td></tr><tr><td> Primer Apellido: <input type="text" name="pap" value="<?php echo $regempleado['PrimerApellido'] ?>">
</td><td> Segundo Apellido: <input type="text" name="sap" value="<?php echo $regempleado['SegundoApellido'] ?>">
</td></tr><tr><td colspan="3"> Direccion Residencia: <input type="text" name="dir" value="<?php echo $regempleado['DirResidencia'] ?>">
</td></tr><tr><td> Municipio: <select name="mu"><option value="Cali">Cali</option><option value="Palmira">Palmira</option><option value="Jamundi">Jamundi</option></select>
</td><td> Departamento: <select name="dep" ><option value="Valle">Valle</option><option value="Cauca">Cauca</option><option value="Narino">Narino</option></select>
</td><td> Barrio: <input type="text" name="ba" value="<?php echo $regempleado['Barrio'] ?>">
</td></tr><tr><td> Telefono: <input type="text" name="tel" value="<?php echo $regempleado['Telefono'] ?>">
</td><td> Celular: <input type="text" name="cel" value="<?php echo $regempleado['Celular'] ?>">
</td><td>  Correo: <input type="text" name="correo" value="<?php echo $regempleado['Correo'] ?>">
</td></tr><tr><td> MunNacimiento: <select name="mun"><option value="Cali">Cali</option><option value="Palmira">Palmira</option><option value="Jamundi">Jamundi</option></select>
</td><td> DepNacimiento: <select name="depn"><option value="Valle">Valle</option><option value="Cauca">Cauca</option><option value="Narino">Narino</option></select>
</td><td> FechaN: <input type="date" name="fechan" value="<?php echo $regempleado['FechaN'] ?>">
</td></tr><tr><td>  Ocupacion: <input type="text" name="ocu" value="<?php echo $regempleado['Ocupacion'] ?>">
</td><td> Riesgo: <input type="text" name="riesgo" value="<?php echo $regempleado['Riesgo'] ?>">
</td></tr><tr><td>  Primer Apellido: <input type="text" name="1ap" value="<?php echo $regempleado['1Apellido'] ?>">
</td><td> Segundo Apellido: <input type="text" name="2ap" value="<?php echo $regempleado['2Apellido'] ?>">
</td><td>  Pirmer Nombre: <input type="text" name="1nom" value="<?php echo $regempleado['1Nombre'] ?>">
</td></tr><tr><td> Segundo Nombre: <input type="text" name="2nom" value="<?php echo $regempleado['2Nombre'] ?>">
</td><td> Sexo: <input type="text" name="sexo" value="<?php echo $regempleado['Sexo'] ?>">
</td><td> Numero documento: <input type="text" name="ndoc" value="<?php echo $regempleado['Ndocumento'] ?>">
</td></tr><tr><td> TipoDocumento: <input type="text" name="tip" value="<?php echo $regempleado['TipDocumento'] ?>">
</td><td> FechaExpe: <input type="text" name="fechae" value="<?php echo $regempleado['FechaExpe'] ?>">
</td></tr></table>
<table border="3" bgcolor="#aed2f4">
 <tr><td style="color:#ffffff" bgcolor="#797575">
   <em>Beneficiario 1</em></strong></td><tr>
  <tr><td> TipoDocumento: <input type="radio" name="tipo0" value="RC">RC
                          <input type="radio" name="tipo0" value="TI">TI
	                      <input type="radio" name="tipo0" value="CC">CC
    </td><td>NDocumento: <input type="text" name="doc0" value="<?php echo $regem['NDocumento'] ?>" >
	</td></tr><tr><td> Primer Apellido: <input type="text" name="pap0" value="<?php echo $regem['PrimerApellido'] ?>">
	</td><td> Segundo Apellido: <input type="text" name="sap0" value="<?php echo $regem['SegundoApellido'] ?>">
</td></tr><td>Primer Nombre: <input type="text" name="pnombre0" value="<?php echo $regem['PrimerNombre'] ?>">
</td><td> Segundo Nombre: <input type="text" name="snombre0" value="<?php echo $regem['SegundoNombre'] ?>">
</td><td> Sexo: <input type="text" name="sexo0" value="<?php echo $regem['Sexo'] ?>">
</td></tr><tr><td> Parentesco: <input type="text" name="par0" value="<?php echo $regem['Parentesco'] ?>">
</td><td>Novedad: <input type="radio" name="nov0" value = "Ingreso">
	  Ingreso<input type="radio" name="nov0" value = "Actualizacion">
	  Actualización<input type="radio" name="nov0" value = "Retiro">Retiro
</td><td>Nacionalidad: <input type="text" name="nacio0" value="<?php echo $regem['Nacionalidad'] ?>">
</td></tr><tr><td>DirResidencia: <input type="text" name="dire0" value="<?php echo $regem['DirResidencia'] ?>">
</td><td>Municipio: <select name="mu0"><option value="Cali">Cali</option><option value="Palmira">Palmira</option><option value="Jamundi">Jamundi</option></select>
</td><td>Departamento: <select name="dep0"><option value="Valle">Valle</option><option value="Cauca">Cauca</option><option value="Narino">Narino</option></select>
</td></tr><tr><td>FechaN: <input type="date" name="fechan0" value="<?php echo $regem['FechaN'] ?>">
</td><td>Telefono: <input type="text" name="tel0" value="<?php echo $regem['Telefono'] ?>">
</td><td>Celular: <input type="text" name="cel0" value="<?php echo $regem['Celular'] ?>">
</td></tr><tr><td>Correo: <input type="text" name="correo0" value="<?php echo $regem['Correo'] ?>">
</table>
<?php }if ($regem=$regis->fetch_assoc()){ ?>
<table border="3" bgcolor="#aed2f4">
 <tr><td style="color:#ffffff" bgcolor="#797575">
  <em>Beneficiario 2</em></strong></td><tr>
  <tr><td> TipoDocumento: <input type="radio" name="tipo0" value="RC">RC
                          <input type="radio" name="tipo0" value="TI">TI
	                      <input type="radio" name="tipo0" value="CC">CC
    </td><td>NDocumento: <input type="text" name="doc0" value="<?php echo $regem['NDocumento'] ?>" >
	</td></tr><tr><td> Primer Apellido: <input type="text" name="pap0" value="<?php echo $regem['PrimerApellido'] ?>">
	</td><td> Segundo Apellido: <input type="text" name="sap0" value="<?php echo $regem['SegundoApellido'] ?>">
</td></tr><td>Primer Nombre: <input type="text" name="pnombre0" value="<?php echo $regem['PrimerNombre'] ?>">
</td><td> Segundo Nombre: <input type="text" name="snombre0" value="<?php echo $regem['SegundoNombre'] ?>">
</td><td> Sexo: <input type="text" name="sexo0" value="<?php echo $regem['Sexo'] ?>">
</td></tr><tr><td> Parentesco: <input type="text" name="par0" value="<?php echo $regem['Parentesco'] ?>">
</td><td>Novedad: <input type="radio" name="nov0" value = "Ingreso">
	  Ingreso<input type="radio" name="nov0" value = "Actualizacion">
	  Actualización<input type="radio" name="nov0" value = "Retiro">Retiro
</td><td>Nacionalidad: <input type="text" name="nacio0" value="<?php echo $regem['Nacionalidad'] ?>">
</td></tr><tr><td>DirResidencia: <input type="text" name="dire0" value="<?php echo $regem['DirResidencia'] ?>">
</td><td>Municipio: <select name="mu0"><option value="Cali">Cali</option><option value="Palmira">Palmira</option><option value="Jamundi">Jamundi</option></select>
</td><td>Departamento: <select name="dep0"><option value="Valle">Valle</option><option value="Cauca">Cauca</option><option value="Narino">Narino</option></select>
</td></tr><tr><td>FechaN: <input type="date" name="fechan0" value="<?php echo $regem['FechaN'] ?>">
</td><td>Telefono: <input type="text" name="tel0" value="<?php echo $regem['Telefono'] ?>">
</td><td>Celular: <input type="text" name="cel0" value="<?php echo $regem['Celular'] ?>">
</td></tr><tr><td>Correo: <input type="text" name="correo0" value="<?php echo $regem['Correo'] ?>">
</table>

</select> <br><br>
<input type="submit" value="Modificar"> <br>
<input type="hidden" name="documentoAnt" value="<?php echo $regempleado['Documento'] ?>">
</form> <?php } else { echo "No existe Afiliado"; } 
/* se recomienda el cierre explícito de la Sentencia */ 
$sentencia->close();
 $senten->close();
 $sentence->close(); 
$conexion->close(); ?>  <br /> <br /> 
<p><a href='javascript:history.go(-1)'>Anterior</a></p>
<p><a href='javascript:history.go(-2)'>Inicio</a></p>
</body> </html>