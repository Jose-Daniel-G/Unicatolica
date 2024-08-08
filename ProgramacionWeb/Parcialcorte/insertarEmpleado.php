<!DOCTYPE HTML>
 <html> <head> <title>MySQL Accion Insert</title>
 <meta charset="utf-8"> </head>
<body>
     
<?php 	  $caja1=isset($_REQUEST['caja1'])? $_REQUEST['caja1'].", ":"";
          $caja2=isset($_REQUEST['caja2'])? $_REQUEST['caja2'].", ":"";
          $caja3=isset($_REQUEST['caja3'])? $_REQUEST['caja3'].", ":"";
		  $caja4=isset($_REQUEST['caja4'])? $_REQUEST['caja4'].", ":"";
          $caja5=isset($_REQUEST['caja5'])? $_REQUEST['caja5'].", ":"";
          $caja6=isset($_REQUEST['caja6'])? $_REQUEST['caja6']:"";
		  
		  $caja01=isset($_REQUEST['caja01'])? $_REQUEST['caja01'].", ":"";
          $caja02=isset($_REQUEST['caja02'])? $_REQUEST['caja02'].", ":"";
          $caja03=isset($_REQUEST['caja03'])? $_REQUEST['caja03'].", ":"";
		  $caja04=isset($_REQUEST['caja04'])? $_REQUEST['caja04'].", ":"";
          $caja05=isset($_REQUEST['caja05'])? $_REQUEST['caja05'].", ":"";
          $caja06=isset($_REQUEST['caja06'])? $_REQUEST['caja06']:"";
$localh="localhost";
$user="root";
$pass="";
$db="formulario";
$conexion=new mysqli($localh,$user,$pass,$db); 

 

    benefi($conexion,$caja1,$caja2,$caja3,$caja4,$caja5,$caja6);
	function benefi($conexion,$caja1,$caja2,$caja3,$caja4,$caja5,$caja6){
	if ($conexion->connect_errno) { 
    echo "Problemas en la conexion a MySQL: " . $conexion->connect_error; }
	$sql = sprintf(
	"insert into beneficiario(Documento,TipoDocumento,NDocumento,Sexo,PrimerApellido,SegundoApellido,PrimerNombre,SegundoNombre,Parentesco,Novedad,Nacionalidad,
	                          DirResidencia,Municipio,Departamento,FechaN,Telefono,Celular,Correo) values
	(%u,'%s',%u,'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
	    $_POST['documento'],$_REQUEST['dt'],$_REQUEST['ND'],$_REQUEST['tip'],
		$_REQUEST['apellido0'],$_REQUEST['apellido2'],
		$_REQUEST['nombre0'],$_REQUEST['nombre1'],$caja1.$caja2.$caja3.$caja4.$caja5.$caja6,
		$_REQUEST['obj'],$_REQUEST['nacionalidad'],$_REQUEST['direccionr'],$_REQUEST['municipiox'],
		$_REQUEST['departamentox'],$_REQUEST['fechad'],$_REQUEST['tel'],$_REQUEST['cel'],$_REQUEST['email']);
	if (!$conexion->query($sql)) { 
   printf("Problemas en el Insert.\n". $conexion->error ."\n"); 
   } 
   else{ echo "!!REGISTRO EXITOSO!!<br>"; }

	}
	 benefi0($conexion,$caja1,$caja01,$caja02,$caja03,$caja04,$caja05,$caja06);
	function benefi0($conexion,$caja01,$caja02,$caja03,$caja04,$caja05,$caja06){
	if ($conexion->connect_errno) { 
    echo "Problemas en la conexion a MySQL: " . $conexion->connect_error; }
     	$sql = sprintf(
	"insert into beneficiario(Documento,TipoDocumento,NDocumento,Sexo,PrimerApellido,SegundoApellido,PrimerNombre,SegundoNombre,Parentesco,Novedad,Nacionalidad,
	                          DirResidencia,Municipio,Departamento,FechaN,Telefono,Celular,Correo) values
	(%u,'%s',%u,'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
	    $_POST['documento'],$_REQUEST['dt1'],$_REQUEST['ND1'],$_REQUEST['tip1'],
		$_REQUEST['apellido01'],$_REQUEST['apellido02'],
		$_REQUEST['nombre01'],$_REQUEST['nombre11'],$caja01.$caja02.$caja03.$caja04.$caja05.$caja06,
		$_REQUEST['obj1'],$_REQUEST['nacionalidad1'],$_REQUEST['direccionr1'],$_REQUEST['municipioxx'],
		$_REQUEST['departamentoxx'],$_REQUEST['fechad1'],$_REQUEST['tel1'],$_REQUEST['celu'],$_REQUEST['email1']);
			if (!$conexion->query($sql)) { 
   printf("Problemas en el Insert.\n". $conexion->error ."\n"); 
   } 
   else{ echo "!!REGISTRO EXITOSO!!<br>"; }
	 }			
   
  
   $conex=new mysqli("localhost","root","","formulario"); 


if ($conex->connect_errno) { 
    echo "Problemas en la conexion a MySQL: " . $conex->connect_error; }
   
   $afi = sprintf(
   "insert into Afiliado(TipoDocumento,Documento,PrimerNombre,SegundoNombre,PrimerApellido,SegundoApellido,DirResidencia,Municipio,Departamento,
                         Barrio,Telefono,Celular,Correo,MunNacimiento,DepNacimiento,FechaN,Ocupacion,Riesgo,1Apellido,2Apellido,1Nombre,2Nombre,
						 Sexo,Ndocumento,TipDocumento,FechaExpe) values    
   ('%s',%u,'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",$_POST['docto'], 
                        $_POST['documento'],$_POST['Pnombre'], $_POST['Snombre'],
						$_POST['pApellido'],$_POST['sApellido'],$_POST['direccion'],
					    $_POST['mun'],$_POST['departamento'],$_POST['barrio'],
						$_POST['telefono'],$_POST['celular'],$_POST['correo'],
					    $_POST['ciudadn'],$_POST['departamenton'],$_POST['fecha'],
						$_POST['ocu'],$_POST['riesgo'],$_POST['papellidop'],
						$_POST['sapellidos'],$_POST['Pnombrep'],$_POST['Snombres'],
						$_POST['tipo'],$_POST['ingreso'],$_POST['docto1'],$_POST['expedicion']);
						  if (!$conex->query($afi)) { 
						  
   printf("Problemas en el Insert.\n". $conex->error ."\n"); 
   } 
   else{ echo "!!REGISTRO EXITOSO!!<br>"; }
 
    
						

	
						
  
 $conexion->close();
 $conex->close();
?>
<p><a href='javascript:history.go(-2)'>Inicio</a></p>
</body> </html> 
