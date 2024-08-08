<!DOCTYPE HTML PUBLIC"> <html> <head> 
<title>Borrado de registros de una tabla </title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
</head>
<body> <?php
 $conexion=new mysqli("localhost","root","","formulario"); 
   if ($conexion->connect_errno) {
	   echo "Problemas en la conexion a MySQL: " . $conexion->connect_error; 
   }
  $sql = "select TipoDocumento,Documento,PrimerNombre,SegundoNombre,PrimerApellido,SegundoApellido,DirResidencia,Municipio,Departamento,
                         Barrio,Telefono,Celular,Correo,MunNacimiento,DepNacimiento,FechaN,Ocupacion,Riesgo,1Apellido,2Apellido,1Nombre,2Nombre,
						 Sexo,Ndocumento,TipDocumento,FechaExpe

						 from afiliado where Documento='$_REQUEST[documento]'";

$registros=$conexion->query($sql);
 if (!$registros){
	 printf("Problemas en el Select.\n". $conexion->error . "\n"); 
	 }
if ($reg=$registros->fetch_assoc()) {
	
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
	</tr><tr><td style=color:#ffffff bgcolor=#797575 colspan=3>D. NOMBRES Y/O SEXO DEL AFILIADO</td></tr><tr><td>
	Primer Apellido :".$reg['1Apellido']."</td><td>
	Segundo Apellido :".$reg['2Apellido']."</td></tr><tr><td>
	Primer Nombre :".$reg['1Nombre']."</td><td>
	Segundo Nombre :".$reg['2Nombre']."</td><td>
	 Sexo :".$reg['Sexo'].
	"</td></tr><tr><td style=color:#ffffff bgcolor=#797575>E. TIPO Y/O NÚMERO DE DOCUMENTO</td></tr><tr><td>
	 N.documento Anterior:".$reg['Ndocumento']."</td><td>
	 TipDocumento :".$reg['TipDocumento']."</td></td><td>
    Fecha de Expedicion:".$reg['FechaExpe']."</td></tr></table>"; 
	
	
	 $sql = "delete from afiliado where Documento='$_REQUEST[documento]'";

		if (!$conexion->query($sql)) {
		printf("Problemas en el Delete.\n". $conexion->error . "\n"); 
		} echo "<br><strong>REGISTRO ELIMINADO !OK!</strong><br>";
   } else {
   echo "NO existe empleado con ese codigo"."<br>";  }
   $bene= "select Documento,TipoDocumento,NDocumento,Sexo,PrimerApellido,SegundoApellido,PrimerNombre,SegundoNombre,Parentesco,Novedad,Nacionalidad,
	                          DirResidencia,Municipio,Departamento,FechaN,Telefono,Celular,Correo
						           from beneficiario
								   where Documento='$_REQUEST[documento]'";
	$bene2= "select Documento,TipoDocumento,NDocumento,Sexo,PrimerApellido,SegundoApellido,PrimerNombre,SegundoNombre,Parentesco,Novedad,Nacionalidad,
	                          DirResidencia,Municipio,Departamento,FechaN,Telefono,Celular,Correo
						           from beneficiario
								   where Documento='$_REQUEST[documento]'";
								   
   $registros=$conexion->query($bene);
    if (!$registros){
	 printf("Problemas en el Select.\n". $conexion->error . "\n"); 
	 }
if ($reg=$registros->fetch_assoc()) {
	
	 echo "<br><table border=3 bgcolor=#aed2f4><tr><td style=color:#ffffff bgcolor=#797575>
       G. BENEFICIARIO1</td></tr>
       </tr><tr><td>TipoDocumento: ".$reg['TipoDocumento'].
	"</td><td>N.Documento: ".$reg['NDocumento'].
	"</td><td>Sexo: ".$reg['Sexo'].
    "</td></tr><tr><td>Primer Apellido:".$reg['PrimerApellido'].
	"</td><td>Segundo Apellido: ".$reg['SegundoApellido'].
	"</td></tr><tr><td>Primer Nombre : ".$reg['PrimerNombre'].
	"</td><td>Segundo Nombre: ".$reg['SegundoNombre'].
	"</td><td>Parentesco: ".$reg['Parentesco'].
	"</td></tr><tr><td>Parentesco: ".$reg['Novedad'].
	"</td><td>Novedad: ".$reg['Novedad']."</td></tr><tr><td>Nacionalidad:".$reg['Nacionalidad'].
	"</td><td>Direccion: ".$reg['DirResidencia'].
	"</td></tr><tr><td>Municipio: ".$reg['Municipio']."</td><td>Departamento:".$reg['Departamento'].
	"</td></tr><tr><td>Fecha de Nacimiento:".$reg['FechaN'].
	"</td><td>Telefono: ".$reg['Telefono'].
	"</td><td>Celular: ".$reg['Celular'].
	"</td></tr><tr><td>Correo: ".$reg['Correo']."</tr></td></table>";
	   $bene = "delete from beneficiario where Documento='$_REQUEST[documento]'";
	   
	
		if (!$conexion->query($bene2)) {
		printf("Problemas en el Delete.\n". $conexion->error . "\n"); 
		} echo "<br><strong>REGISTRO ELIMINADO !OK!</strong>";
   } else {
   echo "NO existe empleado con ese codigo"."<br>";  }
 if (!$registros){
	 printf("Problemas en el Select.\n". $conexion->error . "\n"); 
	 }
if ($reg=$registros->fetch_assoc()) {
	
	 echo "<br><table border=3 bgcolor=#aed2f4><tr><td style=color:#ffffff bgcolor=#797575>
       G. BENEFICIARIO2</td></tr>
       </tr><tr><td>TipoDocumento: ".$reg['TipoDocumento'].
	"</td><td>N.Documento: ".$reg['NDocumento'].
	"</td><td>Sexo: ".$reg['Sexo'].
    "</td></tr><tr><td>Primer Apellido:".$reg['PrimerApellido'].
	"</td><td>Segundo Apellido: ".$reg['SegundoApellido'].
	"</td></tr><tr><td>Primer Nombre : ".$reg['PrimerNombre'].
	"</td><td>Segundo Nombre: ".$reg['SegundoNombre'].
	"</td><td>Parentesco: ".$reg['Parentesco'].
	"</td></tr><tr><td>Parentesco: ".$reg['Novedad'].
	"</td><td>Novedad: ".$reg['Novedad']."</td></tr><tr><td>Nacionalidad:".$reg['Nacionalidad'].
	"</td><td>Direccion: ".$reg['DirResidencia'].
	"</td></tr><tr><td>Municipio: ".$reg['Municipio']."</td><td>Departamento:".$reg['Departamento'].
	"</td></tr><tr><td>Fecha de Nacimiento:".$reg['FechaN'].
	"</td><td>Telefono: ".$reg['Telefono'].
	"</td><td>Celular: ".$reg['Celular'].
	"</td></tr><tr><td>Correo: ".$reg['Correo']."</tr></td></table>";
	   $bene = "delete from beneficiario where Documento='$_REQUEST[documento]'";
	   
	
		if (!$conexion->query($bene)) {
		printf("Problemas en el Delete.\n". $conexion->error . "\n"); 
		} echo "<br><strong>REGISTRO ELIMINADO !OK!</strong>";
   } else {
   echo "NO existe empleado con ese codigo"."<br>";  }
	
  

   $conexion->close(); ?> <br> <a href="principal.php"><em>Pagina Principal</em></a>
</body> </html>