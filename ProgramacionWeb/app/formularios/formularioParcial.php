<!DOCTYPE html><html><head><title>Validacion del Form</title>
</head><body><?php 
echo"<br><br><strong>1.INFORMACION A ACTUALIZAR</strong><br>";
$selec=!empty ($_POST['selec'])?$_POST['selec']:"";
 switch($selec){
	 case "empleador": $selec = " -Empleador";break;
	 case "afiliado": $selec = " -Afiliado";break;
	 default : $selec = "?";
 }
 echo"<br>".$selec;
$a=!empty ($_POST['a'])?$_POST['a']:"";
 switch($a){
	 case "Dato": $a = " -Datos ubicacion Afiliado";break;
	 case "Tipo": $a = " -Tipo de dato y/o numero de documento";break;
	 case "empleado": $a = " -Fallecimiento del empleado";break;
	 default : $a = "?";
 }
 echo"<br>".$a;
$b=!empty ($_POST['b'])?$_POST['b']:"";
 switch($b){
     case "fecha": $b = " -Fecha y/o lugar de nacimiento";break;
	 case "expedicion": $b = " -Fecha de expedicion cedula de ciudadania";break;
	 case "emplea": $b = " -Actualizacion de datos empleador";break;
     default : $b = "?";	 
}
echo"<br>".$b;
$c=!empty ($_POST['c'])?$_POST['c']:"";
switch($c){	 
     case "ocupacion": $c = " -Ocupacion u oficio";break;
	 case "beneficiarios": $c = " -Beneficiarios";break;
	 default : $c = "?";
}
echo"<br>".$c;
$d=!empty ($_POST['d'])?$_POST['d']:"";
switch($d){
	 case "Nys": $d = " -Nombre y/o sexo del afiliado";break; 
	 case "nationality": $d = " -Nacionalidad";break; 
	 default : $d = "?";
 }
 echo"<br>".$d,"<br>";
 
 $pnombre = !empty ($_POST['Pnombre'])?$_POST['Pnombre']:"";
 $snombre = !empty ($_POST['Snombre'])?$_POST['Snombre']:"";
 $papellido= !empty ($_POST['pApellido'])?$_POST['pApellido']:"";
 $sapellido= !empty ($_POST['sApellido'])?$_POST['sApellido']:"";
 $documento= !empty ($_POST['documento'])?$_POST['documento']:"";
 $docto= !empty ($_POST['docto'])?$_POST['docto']:"";
 //$docto = $_POST['docto'];
 switch ($docto){
	       case "RC": $docto = "Registro civil";break;
           case "TI": $docto = "Tarjeta identidad";break;
		   case "CC": $docto = "Cedula Ciudadania";break;
		   default : $docto = "??";
		    }
			echo "---------------------------------------<br>
			       2.Datos actuales Afiliado</strong>
				  <br>---------------------------------------";
			echo"<br><strong>Tipo Documento:</strong> ".$docto;
			echo"<br><strong>Numero de Documento Registrado:</strong> ".$documento,
			"<br><strong>Primer Nombre:</strong>".$pnombre,
			"<br><strong>Segundo Nombre:</strong>".$snombre,"<strong><br>Primer Apellido:</strong>".$papellido,"<strong><br>Segundo Apellido:</strong>".$sapellido;
$direccion= !empty ($_POST['direccion'])?$_POST['direccion']:"";
$mun=!empty ($_POST['mun'])?$_POST['mun']:"";
$dptamento = !empty ($_POST['departamento'])?$_POST['departamento']:"";
$barrio= !empty ($_POST['barrio'])?$_POST['barrio']:"";
$telefono=!empty ($_POST['telefono'])?$_POST['telefono']:"";
$celular=!empty ($_POST['celular'])?$_POST['celular']:"";
$email0=!empty ($_POST['correo'])?$_POST['correo']:"";
echo "<br>---------------------------------------<br>
            3.Detalle de la informacion a actualizar<br>---------------------------------------<br>A.Datos de ubicación afiliado<br><strong>Direccion:</strong>".$direccion,
     "<br><strong>Municipio:</strong>".$mun,
	 "<br><strong>Departamento:</strong>".$dptamento,
	 "<br><strong>Barrio:</strong>".$barrio,
	 "<br><strong>Telefono:</strong>".$telefono,
	 "<br><strong>Celular:</strong>".$celular,
	 "<br><strong>Correo electronico:</strong>".$email0
	 ;
$ciudadn=!empty ($_POST['ciudadn'])?$_POST['ciudadn']:"";
$dptamenton = !empty ($_POST['departamenton'])?$_POST['departamenton']:"";

$fecha=$_POST['fecha'];
	echo"<br>---------------------------------------------------<br>B.FECHA Y/O LUGAR DE NACIMIENTO<br><strong>Municipio:</strong>".$ciudadn,
	    "<br><strong>Departamento:</strong>".$dptamenton,
		"<br><strong>Fecha:</strong>".$fecha;	

$ocupacion=!empty ($_POST['ocu'])?$_POST['ocu']:"";
$riesgo=!empty ($_POST['riesgo'])?$_POST['riesgo']:"";
 switch ($riesgo){
	       case "bajo": $riesgo = "Bajo";break;
	       case "medio": $riesgo= "Medio";break;
           case "alto": $riesgo = "Alto";break;
		  
		   default : $riesgo = "??";
		    }
			echo"<br>---------------------------------------------------<br>C. OCUPACIION U OFICIO<br><strong>Ocupacion u Oficio:</strong>".$ocupacion,
			     "<br><strong>Riesgo:</strong>".$riesgo;
	$apellido=!empty ($_POST['papellidop'])?$_POST['papellidop']:"";
	$apellidoU=!empty ($_POST['sapellidos'])?$_POST['sapellidos']:"";
	$nombre=!empty ($_POST['Pnombrep'])?$_POST['Pnombrep']:"";
	$nombre2=!empty ($_POST['Snombres'])?$_POST['Snombres']:"";	
	$sexo=!empty ($_POST['tipo'])?$_POST['tipo']:"";
	 switch ($sexo){
	       case "sexoM": $sexo = "Masculino";break;
	       case "sexoF": $sexo= "femenino";break;
		  
		   default : $sexo = "??";
		    }
    echo"<br>---------------------------------------------------<br>D. NOMBRES Y/O SEXO DEL AFILIADO<br><strong>Primer apellido:</strong>".$apellido,
	    "<br><strong>Segundo apellido:</strong>".$apellidoU,"<br><strong>Primer Nombre:</strong>".$nombre,
		"<br><strong>Segundo Nombre:</strong>".$nombre2,"<br><strong>Sexo:</strong>".$sexo;
		$docmento=!empty ($_POST['ingreso'])?$_POST['ingreso']:"";
		$docante=!empty ($_POST['docto1'])?$_POST['docto1']:"";
		$date=!empty ($_POST['expedicion'])?$_POST['expedicion']:"";
        switch ($docante){
	       case "RC": $docante = "Registo civil";break;
	       case "TI": $docante= "Tarjeta de identidad";break;
           case "CC": $docante = "Cedula de ciudadania";break;
		  
		   default : $docante = "??";
		    }
	echo"<br>---------------------------------------------------<br>E. TIPO Y/O NÚMERO DE DOCUMENTO<br><strong>Numero De Documento Anterior :</strong>".$docmento,
	    "<br><strong>Tipo de Documento Anterior:</strong>".$docante,"<br>---------------------------------------------------<br>F. Fecha de expedicion cedula:".$date;
	$apellido0=!empty ($_POST['apellido0'])?$_POST['apellido0']:"";
	$apellidoun=!empty ($_POST['apellido2'])?$_POST['apellido2']:"";
	$nombre0=!empty ($_POST['nombre0'])?$_POST['nombre0']:"";
	$nombre1=!empty ($_POST['nombre1'])?$_POST['nombre1']:"";	
	
	$ndoc=!empty ($_POST['ND'])?$_POST['ND']:"";
		  $tdocto=!empty ($_POST['dt'])?$_POST['dt']:""; 
			   switch ($tdocto){
	       case "RC": $tdocto = "Registo civil";break;
	       case "TI": $tdocto= "Tarjeta de identidad";break;
           case "CC": $tdocto = "Cedula de ciudadania";break;
		  
		   default : $tdocto = "??";
		    }
			$sexou=!empty($_REQUEST['tip'])? $_REQUEST['tip']:"";
	 switch ($sexou){
	       case "M": $sexou = "Masculino";break;
	       case "F": $sexou= "femenino";break;
		  
		   default : $sexou = "??";
		    }
		echo"<br>---------------------------------------------------<br>G. BENEFICIARIO<br><strong>Tipo de Documento:</strong>".$tdocto,
		    "<br><strong> Número de documento:</strong>".$ndoc,"<br><strong>Sexo:</strong>".$sexou,
			"<br><strong> Primer Apellido:</strong>".$apellido0,"<br><strong> Segundo Apellido:</strong>".$apellidoun,
			"<br><strong> Primer Nombre:</strong>".$nombre0,"<br><strong> Segundo Nombre:</strong>".$nombre1;
			
	   echo "<br><strong>Parentesco:</strong>";
		  $caja1=isset($_REQUEST['caja1'])? $_REQUEST['caja1'].", ":"";
          $caja2=isset($_REQUEST['caja2'])? $_REQUEST['caja2'].", ":"";
          $caja3=isset($_REQUEST['caja3'])? $_REQUEST['caja3'].", ":"";
		  $caja4=isset($_REQUEST['caja4'])? $_REQUEST['caja4'].", ":"";
          $caja5=isset($_REQUEST['caja5'])? $_REQUEST['caja5'].", ":"";
          $caja6=isset($_REQUEST['caja6'])? $_REQUEST['caja6']:"";
		  echo"".$caja1.$caja2.$caja3.$caja4.$caja5.$caja6;
		  
		$tnovedad=!empty ($_POST['obj'])?$_POST['obj']:""; 
			   switch ($tnovedad){
	       case "a": $tnovedad = "Ingreso";break;
	       case "b": $tnovedad= "Actualizacion";break;
           case "c": $tnovedad = "Retiro";break;
		  
		   default : $tnovedad = "??";
		    }
		 
		 $nacionalidad=!empty ($_POST['nacionalidad'])?$_POST['nacionalidad']:"";
		 $direcciont=!empty ($_POST['direccionr'])?$_POST['direccionr']:"";	
		 $municipio=!empty ($_POST['municipiox'])?$_POST['municipiox']:"";
         $dpta = !empty ($_POST['departamento'])?$_POST['departamento']:"";
		 $fechad=!empty ($_POST['fechad'])?$_POST['fechad']:"";
		 $telefono0=!empty ($_POST['tel'])?$_POST['tel']:"";
		 $celular0=!empty ($_POST['cel'])?$_POST['cel']:"";
		 $correo=!empty ($_POST['email'])?$_POST['email']:"";
		 echo "<br><strong>Tipo de Novedad: </strong>".$tnovedad,
		       "<br><strong>Nacionalidad: </strong>".$nacionalidad,
			   "<br><strong>Direccion Residencia: </strong>".$direcciont,
			   "<br><strong>Municipio: </strong>".$municipio,
			   "<br><strong>Departamento: </strong>".$dpta,"<br><strong>Fecha de Nacimiento:</strong>".$fechad,
			   "<br><strong>Telefono: </strong>".$telefono0,"<br><strong>Celular: </strong>".$celular0,"<br><strong>Correo electronico: </strong>".$correo;
			   
 $nacio=!empty ($_POST['nacio'])?$_POST['nacio']:"";
 $defun=!empty ($_POST['defun'])?$_POST['defun']:"";
 $regis=!empty ($_POST['regis'])?$_POST['regis']:"";
 $ingreso1=!empty ($_POST['ingreso1'])?$_POST['ingreso1']:"";
       echo "<br>---------------------------------------------------<br>H.Nacionalidad<br><strong><br>Nacionalidad: </strong>".$nacio,
		       "<br><strong>I.Fallecimiento de afiliado<br>Fecha de defuncion: </strong>".$defun,
			   "<br><strong>Fecha de Registo: </strong>".$regis;
 $docto1=!empty ($_POST['ingreso1'])?$_POST['ingreso1']:"";
 $docto2=!empty ($_POST['docto2'])?$_POST['docto2']:"";
 switch ($docto2){
	       case "RC": $docto2 = "Registro civil";break;
           case "TI": $docto2 = "Tarjeta identidad";break;
		   case "CC": $docto2 = "Cedula Ciudadania";break;
		   default : $docto2 = "??";
		    }
$docto3=!empty ($_POST['docto3'])?$_POST['docto3']:"";
switch ($docto3){
	       case "Pública": $docto3 = "Pública";break;
		   case "Privada": $docto3 = "Privada";break;
		   default : $docto3 = "??";
		    }
 $codigo=!empty ($_POST['codigo'])?$_POST['codigo']:"";
 $razon=!empty ($_POST['razon'])?$_POST['razon']:"";
 $dir=!empty ($_POST['dir'])?$_POST['dir']:"";
 $bar=!empty ($_POST['bar'])?$_POST['bar']:"";
 $muni=!empty ($_POST['mun'])?$_POST['mun']:"";
 $dep=!empty ($_POST['dep'])?$_POST['dep']:"";
 $tel=!empty ($_POST['tel'])?$_POST['tel']:"";
 $cel=!empty ($_POST['cel'])?$_POST['cel']:"";
 $suc=!empty ($_POST['suc'])?$_POST['suc']:"";
 $email=!empty ($_POST['email1'])?$_POST['email1']:"";
  echo"<br>---------------------------------------------------<br>J.ACTIVACION DE DATOS DEL EMPLEADOR (DATOS DE UBICACIÓN Y/O NOMBRE O RAZON SOCIAL)<br><strong>Numero de Documento:</strong>".$docto1,
      "<br><strong>Tipo de documento:</strong>".$docto2,
	  "<br><strong>Naturaleza:</strong>".$docto3,
      "<br><strong>Codigo:</strong>".$codigo,
      "<br><strong>Razón social:</strong>".$razon,
       "<br><strong>Dirección:</strong>".$dir,
	   "<br><strong>Barrio:</strong>".$bar,
	   "<br><strong>Municipio:</strong>".$muni,
	   "<br><strong>Departamento:</strong>".$dep,
	   "<br><strong>Telefono:</strong>".$tel,
	   "<br><strong>Celular:</strong>".$cel,
	   "<br><strong>Sucursal:</strong>".$suc,
	   "<br><strong>Email:</strong>".$email;
	   
			   
			   

 $archivo=fopen("datos.txt","a")or die("Problema en la creacion");
 fputs($archivo, ''.$selec);fputs($archivo,"\n *".$a);fputs($archivo,"\n *".$b);fputs($archivo,"\n *".$c);fputs($archivo,"\n *".$d);
 fputs($archivo,"\n----------------------------------");
 fputs($archivo,"\n2.Datos actuales Afiliado ");
 fputs($archivo,"\n Documento : ".$docto);fputs($archivo,"\t N. Documento Registrado : ".$documento);
 fputs($archivo,"\n Primer Nombre: ".$pnombre);fputs($archivo,"\t Segundo Nombre: ".$snombre);
 fputs($archivo,"\n Primer Apellido: ".$papellido);fputs($archivo,"\tSegundo Apellido: ".$sapellido);
 fputs($archivo,"\n----------------------------------");
 fputs($archivo,"\n 3.DETALLE DE LA INFORMACION ACTUALIZAR");
 fputs($archivo,"\n Direccion: ".$direccion);fputs($archivo,"\n Municipio: ".$mun);fputs($archivo,"\n Departamento: ".$dptamento );
 fputs($archivo,"\n Barrio y/o Vereda: ".$barrio);
 fputs($archivo,"\n Telefono: ".$telefono );
 fputs($archivo,"\n Celular: ".$celular );
 fputs($archivo,"\n Correo electronico: ".$email0);
 fputs($archivo,"\n Municipio: ".$ciudadn);fputs($archivo,"\n Departamento: ".$dptamenton );
 fputs($archivo,"\n Fecha: ".$fecha );
 fputs($archivo,"\n Ocupacion u oficio: ".$ocupacion);
 fputs($archivo,"\t Riesgo: ".$riesgo);
 fputs($archivo,"\n Primer Apellido: ".$apellido);fputs($archivo,"\t Segundo Apellido: ".$apellidoU);
 fputs($archivo,"\n Primer Nombre: ".$nombre);fputs($archivo,"\t Segundo Nombre: ".$nombre2);
 fputs($archivo,"\t Sexo: ".$sexo);
 fputs($archivo,"\n Numero de Documento Anterior: ".$docmento);
 fputs($archivo,"\n Tipo de Documento Anterior: ".$docante);
 fputs($archivo,"\n Fecha de expedicion: ".$date);
 fputs($archivo,"\n Tipo de Documento: ".$tdocto);
 fputs($archivo,"\n Numero de documento ".$ndoc);
 fputs($archivo,"\n Sexo ".$sexou);
 fputs($archivo,"\n Primer Apellido: ".$apellido0);fputs($archivo,"\tSegundo Apellido: ".$apellidoun);
 fputs($archivo,"\n Primer Nombre: ".$nombre0);fputs($archivo,"\t Segundo Nombre: ".$nombre1);
 fputs($archivo,"\n Parentesco: ".$caja1.$caja2.$caja3.$caja4.$caja5.$caja6); fputs($archivo,"\tTipo de novedad:".$tnovedad);
 fputs($archivo,"\n Nacionalidad:".$nacionalidad); fputs($archivo,"\t Direccion de residencia:".$direcciont);
 fputs($archivo,"\n Municipio: ".$municipio);fputs($archivo,"\t Departamento:".$dpta);
 fputs($archivo,"\n Fecha de nacimiento:".$fechad);fputs($archivo,"\n Telefono: ".$telefono0);fputs($archivo,"\t Celular: ".$celular0);
 fputs($archivo,"\n Nacionalidad: ".$nacio);fputs($archivo,"\n Fecha de defuncion: ".$nacio);
 fputs($archivo,"\n Fecha de inscripcion de resgistro: ".$nacio);
 fputs($archivo,"\n Numero de Documento: ".$docto1);
 fputs($archivo,"\n Tipo de Documento: ".$docto2); 
 fputs($archivo,"\n Naturaleza: ".$docto3); fputs($archivo,"\n Codigo: ".$codigo);
 fputs($archivo,"\n Razon social: ".$razon); fputs($archivo,"\n Direccion:: ".$dir);fputs($archivo,"\n Barrio: ".$bar);fputs($archivo,"\n Municipio: ".$muni);
 fputs($archivo,"\n Departamento: ".$dep);fputs($archivo,"\n Telefono: ".$tel);fputs($archivo,"\n Celular: ".$cel);fputs($archivo,"\n Sucursal:: ".$suc);
 fputs($archivo,"\n Correo: ".$email);
 fputs($archivo,"\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
 fputs($archivo,"\n");
 fclose($archivo);

 echo "<br> <br>los datos se cargaron correctamente.";
  ?><br>
<input type="button" value="Datos" onclick=" window.location.href=('Lectura.txt');"/>
 </body></html>