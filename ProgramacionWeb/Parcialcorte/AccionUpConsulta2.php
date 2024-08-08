<!DOCTYPE html ">
 <html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta charset="utf-8" />
 <title>Form Update con Dos Tablas</title> </head>
<body> <?php
	 $conexion=new mysqli("localhost","root","","formulario"); 
    
if ($conexion->connect_errno) {
	echo "Problemas en la conexion a MySQL: " . $conexion->connect_error;
	}
$sql = "update afiliado set TipoDocumento=?, Documento=?, PrimerNombre=?, SegundoNombre=?, PrimerApellido=?, SegundoApellido=?, DirResidencia=?, Municipio=?, Departamento=?,Barrio=? 
                                  ,Telefono=? ,Celular=? ,Correo=? ,MunNacimiento=? ,DepNacimiento=? ,FechaN=? ,Ocupacion=? ,Riesgo=? ,1Apellido=? ,2Apellido=? ,1Nombre=?, 2Nombre=?,
						           Sexo=? ,Ndocumento=?,TipDocumento=?,FechaExpe=?
							where Documento=? ";
 $bene ="update beneficiario set  Documento=?,TipoDocumento=?, NDocumento=?, Sexo=? ,PrimerApellido=?,SegundoApellido=?,PrimerNombre=?,SegundoNombre=?, Parentesco=?,Novedad=?, Nacionalidad=?,
                            DirResidencia=?, Municipio=?, Departamento=?,FechaN=?,Telefono=? ,Celular=? ,Correo=? 
							where Documento=? ";
 $bene1 ="update beneficiario set  Documento=?,TipoDocumento=?, NDocumento=?, Sexo=? ,PrimerApellido=?,SegundoApellido=?,PrimerNombre=?,SegundoNombre=?, Parentesco=?,Novedad=?, Nacionalidad=?,
                            DirResidencia=?, Municipio=?, Departamento=?,FechaN=?,Telefono=? ,Celular=? ,Correo=? 
							 where Documento=? ";	
											
/* Sentencia Preparada, etapa 1: preparación */
 $sentencia = $conexion->prepare($sql); 

 $sent = $conexion->prepare($bene1);
 if (!$sentencia) {
	 printf("Problemas en la Sentencia Preparada.\n". $conexion->error . "\n"); }
 /* Sentencia preparada, etapa 2: vincular parametros y ejecutar */     /*afiliado*/
 $sentencia->bind_param("sissssssssssssssssssssssssi", $_POST['tipo'],$_POST['doc'],$_POST['pnombre'],$_POST['snombre'],$_POST['pap'],
                                                       $_POST['sap'],$_POST['dir'],$_POST['mu'],$_POST['dep'],$_POST['ba'],
													   $_POST['tel'],$_POST['cel'],$_POST['correo'],$_POST['mun'],$_POST['depn'],
								                       $_POST['fechan'],$_POST['ocu'],$_POST['riesgo'],$_POST['1ap'],$_POST['2ap'],
													   $_POST['1nom'], $_POST['2nom'],$_POST['sexo'],$_POST['ndoc'],$_POST['tip'],$_POST['fechae'],
													   $_POST['documentoAnt']); 
if (!$sentencia) { printf("Problemas en la Vinculación de Parámetros.\n". $conexion->error . "\n"); } $sentencia->execute(); if (!$sentencia) { printf("Problemas en el Update.\n". $conexion->error . "\n"); } else echo "!!El Empleado fue modificado OK!!<br>";
	  $sentencia->close();$senten = $conexion->prepare($bene);
	if (!$senten) { printf("Problemas en la Sentencia Preparada.\n". $conexion->error . "\n"); }
$senten->bind_param("ssisssssssssssssssi",$_POST['doc'],$_POST['tipo0'],$_POST['doc0'],$_POST['sexo0'], $_POST['pap0'], $_POST['sap0'], $_POST['pnombre0'],$_POST['snombre0'],
                                               $_POST['par0'],$_POST['nov0'],$_POST['nacio0'],$_POST['dire0'],$_POST['mu0'],$_POST['dep0'],
											   $_POST['fechan0'], $_POST['tel0'],$_POST['cel0'],$_POST['correo0'],$_POST['documentoAnt']); 

						   
$sent->bind_param("ssisssssssssssssssi",$_POST['doc'],$_POST['tipo0'],$_POST['doc0'],$_POST['sexo0'], $_POST['pap0'], $_POST['sap0'], $_POST['pnombre0'],$_POST['snombre0'],
                                               $_POST['par0'],$_POST['nov0'],$_POST['nacio0'],$_POST['dire0'],$_POST['mu0'],$_POST['dep0'],
											   $_POST['fechan0'], $_POST['tel0'],$_POST['cel0'],$_POST['correo0'],$_POST['documentoAnt']); 
						
						

if (!$senten) { printf("Problemas en la Vinculación de Parámetros.\n". $conexion->error . "\n"); } $senten->execute(); if (!$senten)
	{ printf("Problemas en el Update.\n". $conexion->error . "\n"); } else echo "!!El Empleado fue modificado OK!!<br>";
/* se recomienda el cierre explícito de la Sentencia */
  $senten->close();  $sent->close(); 
 $conexion->close(); ?>
<br /> <br />

<p><a href='javascript:history.go(-2)'>Inicio</a></p>
</body> </html>
