
<!DOCTYPE html>
<html lang="en">
<head>
<script type text="text/javascript" src="script.js"></script>
<title> JD Twins</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<meta name="keywords" content=" volunteer enrollment form Widget a Flat Responsive Widget,
Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); 
} </script>
<!-- Meta tag Keywords -->
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" /><!-- Style-CSS -->
</head>
<body>
	<section class="agile-volt">
		<div class="agile-voltheader">
			<h1>Formulario <label>Atualizacion</label> de Datos</h1>
		</div>
		<div class="agile-voltsub">
			<p style="text-align:center"><strong>Sistema General de Penciones</strong></p>
				<form name="insertar" action="insertarEmpleado.php" method="get" onsubmit="return validacion()" id="valida">
				
                    <table border="1" ><tr>
                <td style="color:#ffffff" bgcolor="#797575">2. DATOS ACTUALES DEL AFILIADO</td></tr>
                <tr><td>
               <p> Tipo de Documento<br>
                   <input type="radio" name="docto" value="RC">Registro civil
                   <input type="radio" name="docto" value="TI">Tarjeta de identidad
                    <br><input type="radio" name="docto" value="CC">Cedula de Ciudadania</p>
                 </td>
              <td><p>Numero de Documento Registrado</p><input type="text" name="documento" ></td>
              </tr><tr>
              <td><p>Primer Nombre:</p> <input type="text" name="Pnombre" id="Pnombre"></td>
              <td><p>Segundo nombre:</p><input type="text" name="Snombre" id="snombre"></td>
 </tr><tr>
 <td><p>Primer apellido</p><input type="text" name="pApellido" id="pApellido"></td>
 <td><p>Segundo apellido</p><input type="text" name="sApellido" id="sApellido"></td>
 </tr><tr></td></table>
   <table border="1"><tr><td style="color:#ffffff" bgcolor="#797575" colspan="3">3.DETALLE DE LA INFORMACION ACTUALIZAR</td></tr><tr>
   <td style="color:#ffffff" bgcolor="#797575"  colspan="3">A.DATOS UBICACION AFILIADO</td></tr>
   <tr><td colspan="3"><p>Dirección de Residencia</p><input type="text" name="direccion" id="direccion"></td></tr><tr><td>
	<p>Municipio
     <select id="mun" name="mun">
	  <option value="">Seleccione</option>
	  <option value="Cali">Cali</option>
	  <option value="Palmira">Palmira</option>
	  <option value="Jamundi">Jamundi.</option></p>
	 </td><td><p></select>Departamento<select name="departamento">
	 <option value="Valle">Valle</option>
	 <option value="Cauca">Cauca</option>
	 <option value="Narino">Nariño</option>
	  </select></p>
 </td>
    <td><p>Barrio y/o Vereda<input type="text" name="barrio" id="barrio"></p></td><tr>
	<td><p>Telefono <input type="text" name="telefono"id="telefono"></p></td>
	<td><p>Celular<input type="text" name="celular"id="celular"></p></td>
	<td><p>Correo Electronico<input type="text" name="correo"id="correo"></p></td>
	</tr></table>
	<table border="1" ><tr>
	<td style="color:#ffffff" bgcolor="#797575" colspan="3">B.FECHA Y/O LUGAR DE NACIMIENTO</td>
	</tr><tr><td colspan="3"><p>Municipio
     <select name="ciudadn">
	   <option value="cali">Cali</option>
	   <option value="palmira">Palmira</option>
	   <option value="jamundi">Jamundi.</option>
	 </p></td><td><p></select>
	 Departamento<select name="departamenton">
	 <option value="Valle">Valle</option>
	 <option value="Cauca">Cauca</option>
	 <option value="Narino">Nariño</option>
	  </select></p></td><td><p>Fecha de Nacimiento <input type="date" name="fecha"></p></td>
     </tr></table><table border="1" ><tr>
	<td style="color:#ffffff" bgcolor="#797575">C. OCUPACION U OFICIO</td>
	<tr><td><p>Ocupacion u oficio<input type="text" name="ocu" id="ocu"></p></td>
	<td><p>Clase de riesgo
	<input type="radio" name="riesgo" value="bajo">Bajo
	<input type="radio" name="riesgo" value="medio">Medio
	<input type="radio" name="riesgo" value="alto">Alto</td></p></tr></table>
	</tr><tr><td><table border="1" ><tr>
	<td style="color:#ffffff" bgcolor="#797575" colspan="3">D. NOMBRES Y/O SEXO DEL AFILIADO</td></tr><tr>
    <td><p>Primer apellido:<input type="text" name="papellidop" id="apellidop"></p></td>
    <td><p>Segundo apellido:<input type="text" name="sapellidos" id="apellidos"></p></td>
    </tr><tr>
    <td><p>Primer Nombre:<input type="text" name="Pnombrep" id="nombre"></p></td>
    <td><p>Segundo nombre:<input type="text" name="Snombres" id="snombre"></p></td>
	<td><p>Sexo<br>
	<input type="radio" name="tipo" value="Masculino">Masculino<br>
	<input type="radio" name="tipo" value="Femenino">Femenino</td></p>
   </table>
	<table border="1"><tr><td style="color:#fff" bgcolor="#797575"colspan="3">E. TIPO Y/O NÚMERO DE DOCUMENTO</td></tr>
	   <tr><td><p>Número de Documento<br>anterior<input type="text" name="ingreso" id="ingreso"></p></td>
	   <td><p>Tipo de Documento Anterior<br>
	   <input type="radio" name="docto1" value="RC">RC
       <input type="radio" name="docto1" value="TI">TI
	   <input type="radio" name="docto1" value="CC">CC</p>
	   </td></td>
	   <td><p>Fecha expedicion cédula<input type="date" name="expedicion"></p>
	   </td></tr></table>
<table border="1"><tr><td style="color:#fff" bgcolor="#797575">
 
        BENEFICIARIO 1</td></tr>
       <tr><td><p> Tipo de Documento<br>
	   <input type="radio" name="dt" value="RC">RC
	   <input type="radio" name="dt" value="TI">TI
	   <input type="radio" name="dt" value="CC">CC</p>
	   </td><td><p>
	   Número de documento<input type="text" name="ND" id="ND"><p></td>
	   <td><p>Sexo<br> <input type="radio" name="tip" value="Masculino">Masculino<br><input type="radio" name="tip" value="Femenino">Femenino</p></td></tr><tr>
	   <td><p>Primer Apellido:<input type="text" name="apellido0" id="a"></p></td>
	   <td><p>Segundo Apellido:<input type="text" name="apellido2" id="b"></p></td>
	  
	   <td><p>Primer Nombre:<input type="text" name="nombre0" id="c"></p></td> </tr><tr>
	   <td><p>Segundo Nombre:<input type="text" name="nombre1" id="d"></p></td>
  <td><p>Parentesco 
     1<input type="checkbox" name="caja1" value="1"/>
	 2<input type="checkbox" name="caja2" value="2"/>
	 3<input type="checkbox" name="caja3" value="3"/>
	 4<input type="checkbox" name="caja4" value="4"/> 
	 5<input type="checkbox" name="caja5" value="5"/>
	 6<input type="checkbox" name="caja6" value="6"/>
      </p></td>
	  <td><p>
	  Tipo de Novedad:<br><input type="radio" name="obj" value = "Ingreso">
	  Ingreso<br><input type="radio" name="obj" value = "Actualizacion">
	  Actualización<br><input type="radio" name="obj" value = "Retiro">Retiro</p></td>
  </tr><tr><td><p>Nacionalidad 
       <input type="text" name="nacionalidad" id = "nacionalidad"></td></p><td>
	   <p>Direccion Residencia
	   <input type="text" name="direccionr" id="direccionr"></p></td></tr>
	   <td><p>Municipio 
       <select name="municipiox">
	     <option value="cali">Cali</option>
	     <option value="palmira">Palmira</option>
	     <option value="jamundi">Jamundi.</option></p></td><td>
	   </select><p>Departamento<select name="departamentox">
	 <option value="Valle">Valle</option>
	 <option value="Cauca">Cauca</option>
	 <option value="Narino">Nariño</option>
	  </select></p>
	  </td><td><p>Fecha de Nacimiento <input type="date" name="fechad"></p></td></tr>
	  <tr><td><p>Telefono <input type="text" name="tel"id="telef"></p>
	  </td><td><p>Celular<input type="text" name="cel"id="cel"></p>
	  </td><td><p>Correo Electronico<input type="text" name="email"id="email"></td></p></tr></table>
	<br><table border="1"><tr><td style="color:#ffffff" bgcolor="#797575">
 
       BENEFICIARIO 2</td></tr>
       <tr><td> <p>Tipo de Documento
	   <input type="radio" name="dt1" value="RC">RC
	   <input type="radio" name="dt1" value="TI">TI
	   <input type="radio" name="dt1" value="CC">CC</p>
	   </td><td>
	   <p>Número de documento<input type="text" name="ND1" id="ND1"></p></td>
	   <td><p>Sexo<br><input type="radio" name="tip1" value="Masculino">Masculino<br><input type="radio" name="tip1" value="Femenino">Femenino</p></td><tr>
	   <tr><td><p>Primer Apellido: <input type="text" name="apellido01" id="a"></p></td>
	   <td><p>Segundo Apellido:<input type="text" name="apellido02" id="b"></p></td>
	   <td><p>Primer Nombre:<input type="text" name="nombre01" id="c"></p></td></tr><tr>
	   <td><p>Segundo Nombre:<input type="text" name="nombre11" id="d"></p> </td>
    <td><p>Parentesco 
     1<input type="checkbox" name="caja01" value="1"/>
	 2<input type="checkbox" name="caja02" value="2"/>
	 3<input type="checkbox" name="caja03" value="3"/>
	 4<input type="checkbox" name="caja04" value="4"/> 
	 5<input type="checkbox" name="caja05" value="5"/>
	 6<input type="checkbox" name="caja06" value="6"/></p>
      </td><td><p>
	  Tipo de Novedad:<br><input type="radio" name="obj1" value = "Ingreso">
	  Ingreso<br><input type="radio" name="obj1" value = "Actualizacion">
	  Actualización<br><input type="radio" name="obj1" value = "Retiro">Retiro</p></td></tr><tr>
      <td><p>Nacionalidad 
        <input type="text" name="nacionalidad1" id = "nacionalidad1"></p>
		</td><td><p>Direccion Residencia
	   <input type="text" name="direccionr1" id="direccionr1"></p>
	   </td></tr><tr>
	   <td><p>Municipio 
       <select name="municipioxx">
	     <option value="cali">Cali</option>
	     <option value="palmira">Palmira</option>
	     <option value="jamundi">Jamundi.</option></p>
	   </select></td><td><p>Departamento<select name="departamentoxx">
	 <option value="Valle">Valle</option>
	 <option value="Cauca">Cauca</option>
	 <option value="Narino">Nariño</option></p>
	  </select>
	  </td><td><p>Fecha de Nacimiento <input type="date" name="fechad1"></p></td></tr>
	  <tr><td><p>Telefono <input type="text" name="tel1"id="tele"></p>
	  </td><td><p>Celular<input type="text" name="celu"id="celu"></p></td>
	  <td><p>Correo Electronico<input type="text" name="email1"id="email1"></p></td></tr></table>			
				
					<script>(function(){
						var validaRadio=function(e){
						if(insertar.docto[0].checked==true){}else{alert("completa el campo Tipo documento");e.preventDefault()}
					     };
					var validar=function(e){validaRadio(e);}
					insertar.addEventListener("submit", validar);
					}</script>
				<input type="submit" value="confirmar">
               <a href='javascript:history.go(-1)'><input type="button" value="Pagina Principal"></a>
				</form>
	<script>  if (document.insertar.mun.selectedIndex==0){ 
      	alert("Debe seleccionar un motivo de su contacto.") 
      	document.insertar.mun.focus() 
      	return 0; 
   	} 
	alert("Muchas gracias por enviar el formulario"); 
   	document.insertar.submit();} </script>
		</div>
	<div class="agile-copyright">
				<footer> 2017 Empresa JD Tiwns.All Rights Reserved.Designed by Brothers Grijalba</a></footer>
			</div>
	</section>
</body>
</html>
