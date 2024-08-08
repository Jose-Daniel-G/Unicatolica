<!DOCTYPE html>
<html lang="es">
 <head>
 <meta charset="utf-8"/>
<head> <title>liquidacion AFILIADO</title> </head>
<body> <h3 style="background-color: #48a4ed"><em><strong>LIQUIDACION AFILIADO</strong></em></h3><br> 

<?php $conexion=new mysqli("localhost","root","","formulario"); 

if ($conexion->connect_errno) { 
echo "Problemas en la conexion a MySQL: " . $conexion->connect_error;
 }
$sql = "select TipoDocumento,Documento,PrimerNombre,SegundoNombre,PrimerApellido,SegundoApellido,DirResidencia,Municipio,Departamento,
                         Barrio,Telefono,Celular,Correo,MunNacimiento,DepNacimiento,FechaN,Ocupacion,Riesgo,1Apellido,2Apellido,1Nombre,2Nombre,
						 Sexo,Ndocumento,TipDocumento,FechaExpe         
                          from afiliado 
						  where Documento='$_REQUEST[documento]'";
 $bene = "select Documento,TipoDocumento,NDocumento,Sexo,PrimerApellido,SegundoApellido,PrimerNombre,SegundoNombre,Parentesco,Novedad,Nacionalidad,
	                          DirResidencia,Municipio,Departamento,FechaN,Telefono,Celular,Correo
						           from beneficiario
						  where Documento='$_REQUEST[documento]'";
  $bene1 = "select Documento,TipoDocumento,NDocumento,Sexo,PrimerApellido,SegundoApellido,PrimerNombre,SegundoNombre,Parentesco,Novedad,Nacionalidad,
	                          DirResidencia,Municipio,Departamento,FechaN,Telefono,Celular,Correo
						           from beneficiario1
						  where Documento='$_REQUEST[documento]'";
$registros=$conexion->query($sql);
$regist=$conexion->query($bene);
$registr=$conexion->query($bene1);
 if (!$registros) {
	 printf("Problemas en el Select.\n". $conexion->error . "\n"); 
	 }
if (($reg=$registros->fetch_assoc())&&($regi=$regist->fetch_assoc())) { 
echo "EMPRESA TWINS"; echo "<br>"; $fecha = date("d:m:Y"); 
echo "Dia/Mes/Ano : ".$fecha."<br>"; $fecha = date("h:i:s"." A"); 
echo "Hora : ".$fecha."<br>"; echo " - - - - - - - - - - - - - - - - -"; echo "<br>"."<br>";
  $bruto=0; 
echo  "<table border=2 bgcolor=#aed2f4></tr><tr>
     <td style=color:#ffffff bgcolor=#797575>DATOS ACTUALES DEL AFILIADO</td></tr><tr><td>
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
echo"--------------------------------------------------------------------------------------------------";
   
   echo "<table border=3 bgcolor=#aed2f4><tr><td style=color:#ffffff bgcolor=#797575>
       G. BENEFICIARIO1</td></tr>
       </tr><tr><td>TipoDocumento: ".$regi['TipoDocumento']. 
	"</td><td>N.Documento: ".$regi['NDocumento'].
	"</td><td>Sexo: ".$regi['Sexo'].
    "</td></tr><tr><td>Primer Apellido:".$regi['PrimerApellido'].
	"</td><td>Segundo Apellido: ".$regi['SegundoApellido'].
	"</td></tr><tr><td>Primer Nombre : ".$regi['PrimerNombre'].
	"</td><td>Segundo Nombre: ".$regi['SegundoNombre'].
	"</td><td>Parentesco: ".$regi['Parentesco'].
	"</td></tr><tr><td>Parentesco: ".$regi['Novedad'].
	"</td><td>Novedad: ".$regi['Novedad']."</td></tr><tr><td>Nacionalidad: ".$regi['Nacionalidad'].
	"</td><td>Direccion: ".$regi['DirResidencia'].
	"</td></tr><tr><td>Municipio: ".$regi['Municipio']."</td><td>Departamento:".$regi['Departamento'].
	"</td></tr><tr><td>Fecha de Nacimiento:".$regi['FechaN'].
	"</td><td>Telefono: ".$regi['Telefono'].
	"</td><td>Celular: ".$regi['Celular'].
	"</td></tr><tr><td>Correo: ".$regi['Correo']."</tr></td></table>";
echo"--------------------------------------------------------------------------------------------------";}
 if ($regi=$regist->fetch_assoc()){
   
   echo "<table border=3 bgcolor=#aed2f4><tr><td style=color:#ffffff bgcolor=#797575>
       . BENEFICIARIO2</td></tr>
       </tr><tr><td>TipoDocumento: ".$regi['TipoDocumento']. 
	"</td><td>N.Documento: ".$regi['NDocumento'].
	"</td><td>Sexo: ".$regi['Sexo'].
    "</td></tr><tr><td>Primer Apellido:".$regi['PrimerApellido'].
	"</td><td>Segundo Apellido: ".$regi['SegundoApellido'].
	"</td></tr><tr><td>Primer Nombre : ".$regi['PrimerNombre'].
	"</td><td>Segundo Nombre: ".$regi['SegundoNombre'].
	"</td><td>Parentesco: ".$regi['Parentesco'].
	"</td></tr><tr><td>Parentesco: ".$regi['Novedad'].
	"</td><td>Novedad: ".$regi['Novedad']."</td></tr><tr><td>Nacionalidad: ".$regi['Nacionalidad'].
	"</td><td>Direccion: ".$regi['DirResidencia'].
	"</td></tr><tr><td>Municipio: ".$regi['Municipio']."</td><td>Departamento:".$regi['Departamento'].
	"</td></tr><tr><td>Fecha de Nacimiento:".$regi['FechaN'].
	"</td><td>Telefono: ".$regi['Telefono'].
	"</td><td>Celular: ".$regi['Celular'].
	"</td></tr><tr><td>Correo: ".$regi['Correo']."</tr></td></table>";

}
$conexion->close();
 ?> <br> <a href="pagina3F.php"><em>Pagina Principal</em></a>
</body>
</html>