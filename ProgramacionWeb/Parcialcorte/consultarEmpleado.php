<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
 <head>
 <title>MySQL Accion Consulta Insert</title> 
 <meta charset="utf-8">
 </head>
<body> <?php $conexion=new mysqli("localhost","root","","formulario");

 if($conexion->connect_errno) { 
 echo "Problemas en la conexion a MySQL: " . $conexion->connect_error; }
$sql = "select * from afiliado order by Documento";$consulta=$conexion->query($sql);
$bene = "select * from beneficiario order by Documento"; $consul=$conexion->query($bene);
$bene2 = "select * from beneficiario1 order by Documento"; $consult=$conexion->query($bene2);
 if (!$consulta) { 
printf("Problemas en el Select.\n". $conexion->error . "\n"); 
}
while (($reg = $consulta->fetch_assoc())&&($regi=$consul->fetch_assoc())) {
  echo  "<table border=2 bgcolor=#aed2f4></tr><tr>
       <td style=color:#ffffff bgcolor=#797575>DATOS ACTUALES DEL AFILIADO</td></tr>
  <tr><td>
     TipoDocumento:".$reg['TipoDocumento']."</td><td>Documento: ".$reg['Documento'].
	"</td></tr><tr><td>Primer Nombre : ".$reg['PrimerNombre'].
	"</td><td>Segundo Nombre: ".$reg['SegundoNombre'].
    "</td></tr><tr><td>Primer Apellido:".$reg['PrimerApellido'].
	"</td><td>Segundo Apellido:".$reg['SegundoApellido'].
	"</td></tr></td><td style=color:#ffffff bgcolor=#797575>
	A.DATOS UBICACION AFILIADO</td>
     <tr><td colspan=3>Direccion de Residencia:".$reg['DirResidencia'].
	"</td></tr><tr><td>Municipio: ".$reg['Municipio'].
	"</td><td>Departamento:".$reg['Departamento'].
	"</td><td>Barrio y/o vereda:".$reg['Barrio'].
	"<tr></td><td>Telefono:".$reg['Telefono'].
	"</td><td>Celular:".$reg['Celular'].
	"</td><tr></td><td>Correo Electronico:".$reg['Correo'].
	"</td></tr><tr>
	<td style=color:#ffffff bgcolor=#797575 colspan=3>B.FECHA Y/O LUGAR DE NACIMIENTO</td>
	</tr><tr><td>Municipio de Nacimiento:".$reg['MunNacimiento'].
	"</td><td>
	Departamento de Nacimiento:".$reg['DepNacimiento']."</td>
	<td>Fecha de Nacimiento:".$reg['FechaN']."</td>
	</tr><tr><td style=color:#ffffff bgcolor=#797575>C. OCUPACION U OFICIO
	<td>Ocupacion:".$reg['Ocupacion']."<td>
	 Riesgo:".$reg['Riesgo']."</td>
	</tr><tr>"; 
	
	      echo "<br><table border=3 bgcolor=#aed2f4><tr><td style=color:#ffffff bgcolor=#797575>
       G. BENEFICIARIO1</td></tr>
       </tr><tr><td>TipoDocumento: ".$regi['Tipodocumento'].
	"</td><td>N.Documento: ".$regi['NDocumento'].
	"</td><td>Sexo".$regi['Sexo'].
    "</td></tr><tr><td>Primer Apellido:".$regi['PrimerApellido'].
	"</td><td>Segundo Apellido: ".$regi['SegundoApellido'].
	"</td></tr><tr><td>Primer Nombre : ".$regi['PrimerNombre'].
	"</td><td>Segundo Nombre: ".$regi['SegundoNombre'].
	"</td><td>Parentesco: ".$regi['Parentesco'].
	"</td></tr><tr><td>Parentesco: ".$regi['Novedad'].
	"</td><td>Novedad: ".$regi['Novedad']."</td></tr><tr><td>Nacionalidad:".$regi['Nacionalidad'].
	"</td><td>Direccion: ".$regi['DirResidencia'].
	"</td></tr><tr><td>Municipio: ".$regi['Municipio']."</td><td>Departamento:".$regi['Departamento'].
	"</td></tr><tr><td>Fecha de Nacimiento:".$regi['FechaN'].
	"</td><td>Telefono: ".$regi['Telefono'].
	"</td><td>Celular: ".$regi['Celular'].
	"</td></tr><tr><td>Correo: ".$regi['Correo']."</tr></td></table>";
if ($regis=$consul->fetch_assoc()) {
	echo "<table border=3 bgcolor=#aed2f4><tr><td style=color:#ffffff bgcolor=#797575>
       G. BENEFICIARIO2</td></tr>
       </tr><tr><td>TipoDocumento: ".$regis['Tipodocumento'].
	"</td><td>N.Documento: ".$regis['NDocumento'].
	"</td><td>Sexo".$regis['Sexo'].
    "</td></tr><tr><td>Primer Apellido:".$regis['PrimerApellido'].
	"</td><td>Segundo Apellido: ".$regis['SegundoApellido'].
	"</td></tr><tr><td>Primer Nombre : ".$regis['PrimerNombre'].
	"</td><td>Segundo Nombre: ".$regis['SegundoNombre'].
	"</td><td>Parentesco: ".$regis['Parentesco'].
	"</td></tr><tr><td>Parentesco: ".$regis['Novedad'].
	"</td><td>Novedad: ".$regis['Novedad']."</td></tr><tr><td>Nacionalidad:".$regis['Nacionalidad'].
	"</td><td>Direccion: ".$regis['DirResidencia'].
	"</td></tr><tr><td>Municipio: ".$regi['Municipio']."</td><td>Departamento:".$regis['Departamento'].
	"</td></tr><tr><td>Fecha de Nacimiento:".$regis['FechaN'].
	"</td><td>Telefono: ".$regis['Telefono'].
	"</td><td>Celular: ".$regis['Celular'].
	"</td></tr><tr><td>Correo: ".$regis['Correo']."</tr></td></table>";
	  echo "<br>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -<br>";
 }
}
$conexion->close();
?> </br> <a href='javascript:history.go(-1)'><input type="button" value="Pagina Principal"></a>
</body> </html>
-