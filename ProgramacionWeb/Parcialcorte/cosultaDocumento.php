<!DOCTYPE HTML > <html> 
<head> 
<title>consultar por codigo</title>
</head>
<body> 
<?php $conexion=new mysqli("localhost","root","","formulario"); 
  if ($conexion->connect_errno) { 
  echo "Problemas en la conexion a MySQL: " . $conexion->connect_error; 
  }
 $sql = "select * from afiliado where Documento=?";
       $docu = $_REQUEST['documento'];
        $sentencia = $conexion->prepare($sql); 
		$sentencia->bind_param("i", $docu);
        $sentencia->execute(); 
		$regist=$sentencia->get_result();
		
$bene = "select * from beneficiario where Documento=?";
		 $consul=$conexion->prepare($bene);
		 $consul->bind_param("i", $docu);
		 $consul->execute();
		  $registros=$consul->get_result();		

     if ((!$registros)&&(!$regist)) { 
	 printf("Problemas en el Select.\n". $conexion->error . "\n");
	 }	 
 if (!$sentencia) { 
printf("Problemas en el Select.\n". $conexion->error . "\n"); 
}

 if(($reg=$regist->fetch_assoc())&&($regi = $registros->fetch_assoc())) {
	 echo  "<table border=2 bgcolor=#aed2f4><tr>
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
	 <td>Ocupacion:".$reg['Ocupacion']."<td></td></tr></table>";
	 
	 
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
	"</td></tr><tr><td>Novedad: ".$regi['Novedad']."</td></tr><tr><td>Nacionalidad:".$regi['Nacionalidad'].
	"</td><td>Direccion: ".$regi['DirResidencia'].
	"</td></tr><tr><td>Municipio: ".$regi['Municipio']."</td><td>Departamento:".$regi['Departamento'].
	"</td></tr><tr><td>Fecha de Nacimiento:".$regi['FechaN'].
	"</td><td>Telefono: ".$regi['Telefono'].
	"</td><td>Celular: ".$regi['Celular'].
	"</td></tr><tr><td>Correo: ".$regi['Correo']."</tr></td></table>";
	}

   if($regi = $registros->fetch_assoc()) {
   echo "<br><table border=3 bgcolor=#aed2f4><tr><td style=color:#ffffff bgcolor=#797575>
       G. BENEFICIARIO2</td></tr>
       </tr><tr><td>TipoDocumento: ".$regi['Tipodocumento'].
	"</td><td>N.Documento: ".$regi['NDocumento'].
	"</td><td>Sexo".$regi['Sexo'].
    "</td></tr><tr><td>Primer Apellido:".$regi['PrimerApellido'].
	"</td><td>Segundo Apellido: ".$regi['SegundoApellido'].
	"</td></tr><tr><td>Primer Nombre : ".$regi['PrimerNombre'].
	"</td><td>Segundo Nombre: ".$regi['SegundoNombre'].
	"</td><td>Parentesco: ".$regi['Parentesco'].
	"</td></tr><tr><td>Novedad: ".$regi['Novedad']."</td></tr><tr><td>Nacionalidad:".$regi['Nacionalidad'].
	"</td><td>Direccion: ".$regi['DirResidencia'].
	"</td></tr><tr><td>Municipio: ".$regi['Municipio']."</td><td>Departamento:".$regi['Departamento'].
	"</td></tr><tr><td>Fecha de Nacimiento:".$regi['FechaN'].
	"</td><td>Telefono: ".$regi['Telefono'].
	"</td><td>Celular: ".$regi['Celular'].
	"</td></tr><tr><td>Correo: ".$regi['Correo']."</tr></td></table>";
    
	   echo "<br>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -<br>";
   } else { echo "NO existe Afiliado con ese Documento"."<br>";
  } /* se recomienda el cierre explícito de la Sentencia */
    $sentencia->close(); 
   $consul->close();
  $conexion->close();
   ?> <br>
   <p><a href='javascript:history.go(-2)'>Pagina Principal</a></p>
 </body> 
</html>