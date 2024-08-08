function validacion(){
	

	var docto=document.insertar.documento;
	var pnombre=document.insertar.Pnombre;
	var snombre=document.insertar.Snombre;
	var papellido=document.insertar.pApellido;
	var sapellido=document.insertar.sApellido;
	var direccion=document.insertar.direccion;
	var barrio=document.insertar.barrio;
	var telefono=document.insertar.telefono;
	var celular=document.insertar.celular;
	var correo=document.insertar.correo;
	//----------------------------------------------
	var ocupacion=document.insertar.ocu;
	var papellidop=document.insertar.papellidop;
	var sapellidos=document.insertar.sapellidos;
	var pnombrep=document.insertar.Pnombrep;
	var snombres=document.insertar.Snombres;
	
	//----------------------------------------------
	var doc=document.insertar.ingreso;
	//---------------------------BENEFICIARIO1------
	var Ndoc=document.insertar.ND;
	var apellido0=document.insertar.apellido0;
	var apellido1=document.insertar.apellido2;
	var nombre0=document.insertar.nombre0;
	var nombre1=document.insertar.nombre1;
	var nacionalidad=document.insertar.nacionalidad;
	var direccionr=document.insertar.direccionr;
	var tel=document.insertar.tel;
	var cel=document.insertar.cel;
	var email=document.insertar.email;
	//---------------------------BENEFICIARIO2------
	var Ndoc1=document.insertar.ND1;
	var apellido01=document.insertar.apellido01;
	var apellido02=document.insertar.apellido02;
	var nombre01=document.insertar.nombre01;
	var nombre02=document.insertar.nombre11;
	var nacionalidad1=document.insertar.nacionalidad1;
	var direccionr1=document.insertar.direccionr1;
	var tel1=document.insertar.tel1;
	var cel1=document.insertar.celu;
	var email1=document.insertar.email1;
	if (docto.value==""){alert("Ingrese su Documento")
		return false;
		}
	if (pnombre.value==""){alert("Ingrese su Primer Nombre")
		return false;
		}
	if (snombre.value==""){alert("Ingrese su Segundo Nombre")
		return false;
		}
    if (papellido.value==""){alert("Ingrese su Primer Apellido")
		return false;
		}
	if (sapellido.value==""){alert("Ingrese su Segundo Apellido")
		return false;
		}
	if (direccion.value==""){alert("Ingrese su Direccion")
		return false;
		}
	if (barrio.value==""){alert("Ingrese su Barrio")
		return false;
		}
	if (telefono.value==""){alert("Ingrese su Telefono")
		return false;
		}
	if (celular.value==""){alert("Ingrese su celular")
		return false;
		}
	if (correo.value==""){alert("Ingrese su Correo")
		return false;
		}
    if (ocupacion.value==""){alert("Ingrese su Ocupacion")
		return false;
		}
	if (papellidop.value==""){alert("Ingrese Nuevamente su Primer Apellido")
		return false;
		}
	if (sapellidos.value==""){alert("Ingrese Nuevamente su Segundo Apellido")
		return false;
		}
	if (pnombrep.value==""){alert("Ingrese Nuevamente su Primer Nombre")
		return false;
		}
    if (snombres.value==""){alert("Ingrese Nuevamente su Segundo Nombre")
		return false;
		}
	if (doc.value==""){alert("ingrese su Documento Anterior")
		return false;
		}
	if (Ndoc.value==""){alert("Ingrese el Documento del Beneficiario 1")
		return false;
		}
    if (apellido0.value==""){alert("Ingrese Primer Apellido Beneficiario 1")
		return false;
		}
	if (apellido1.value==""){alert("Ingrese Segundo Apellido Beneficiario 1")
		return false;
		}
	if (nombre0.value==""){alert("Ingrese Primer Nombre Beneficiario 1")
		return false;
		}
	if (nombre1.value==""){alert("Ingrese Segundo Nombre Beneficiario 1")
		return false;
		}
	if (nacionalidad.value==""){alert("Ingrese Nacionalidad Beneficiario 1")
		return false;
		}
	if (direccionr.value==""){alert("Ingrese Direccion Beneficiario 1")
		return false;
		}
	if (tel.value==""){alert("Ingrese Telefono Beneficiario 1")
		return false;
		}
    if (cel.value==""){alert("Ingrese Celular Beneficiario 1")
		return false;
		}
	if (email.value==""){alert("Ingrese Correo Beneficiario 1")
		return false;
		}
	if (Ndoc1.value==""){alert("Ingrese el Documento del Beneficiario 2")
		return false;
		}
	if (apellido01.value==""){alert("Ingrese Primer Apellidol Beneficiario 2")
		return false;
		}
		if (apellido02.value==""){alert("Ingrese Segundo Apellido Beneficiario 2")
		return false;
		}
	if (nombre01.value==""){alert("Ingrese Primer Nombre Beneficiario 2")
		return false;
		}
	if (nombre02.value==""){alert("Ingrese Segundo Nombre Beneficiario 2")
		return false;
		}
	if (nacionalidad1.value==""){alert("Ingrese Nacionalidad Beneficiario 2")
		return false;
		}
	if (direccionr1.value==""){alert("Ingrese Direccion Beneficiario 2")
		return false;
		}
	if (tel1.value==""){alert("Ingrese Telefono Beneficiario 2")
		return false;
		}
    if (cel1.value==""){alert("Ingrese Celular Beneficiario 2")
		return false;
		}
	if (email1.value==""){alert("Ingrese Correo Beneficiario 2")
		return false;
		}
		//valido el interés 


		// var campo = $("select option:selected").val();
		// alert(campo);
		// if(campo === ""){
     // alert("El campo esta vacío")
      // return false;
		// }
 // Las validaciones que necesitas hacer
          
      // var selec=document.getElementsById("select option:selected").selectedIndex;
	 // console.log("selec",selec);
	   // if( selec == null || selec == 0) {
		   // alert("ELIJA")
       // return false;
	   // }
}
