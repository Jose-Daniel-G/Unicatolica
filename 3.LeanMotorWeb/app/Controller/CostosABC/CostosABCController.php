<?php

@include_once('../../app/Model/CostosABC/CostosABCModel.php');
@include_once('../../Controller/Utilidades/UtilidadesController.php');
@session_start();
 
class  CostosABCController{        
    
    
    function crearCostoProduccion()
    {		
        $objCosto= new CostosABCModel();  
        $clie="select Nit_Cliente, Razon_Social from clientes where estado='A' order by Razon_Social ";
        $cliente=$objCosto->Consultar($clie);
    
        $umed="select codigo, descripcion from unidades_negocio where estado='A' order by descripcion";
        $uninegocio=$objCosto->Consultar($umed);
        

        //$objCosto->closeConect();
        include_once('../../views/CostosABC/GuiCostosProduccion.html.php');
    }
	
        
        function CalcularManoObra($ayo, $mes, $cliente, $oi, $Uneg)
        {
            if(!isset($valorfinal)){$valorfinal=0;}
            if(!isset($valorH)){$valorH=0;}
            if(!isset($valorHora)){$valorHora=0;}
            $pri_valorHora=array(0,0,0,0,0,0,0,0,0);
            if(!isset($porfiscal)){$porfiscal=0;}           
            $objCostomo= new CostosABCModel();
            $objUtilidades=new UtilidadesController();
           
           // $this->priv_equipo=$objUtilidades->RecuperarPotenciaVelocidadVoltaje($oi);                  
            if($oi<>"")
            {
                $condicion=" and ingreso='$oi' ";
             
            }
            else
            {
                $condicion=" and month(Fecha_Creacion)='$mes' and year(Fecha_Creacion)='$ayo'";
                if($cliente <> "todos")
                {
                    $condicion.=" and clientes.Nit_cliente='$cliente'";
                }
              
            }
            if($Uneg <> "todos")
            {
                $condicion.=" and unidades_negocio.codigo='$Uneg'";
            }
               $consmo="SELECT ingreso_equipos.Numero_Ingreso as Num, unidades_negocio.Descripcion, tiempo_actividades_produccion.Orden_Trabajo, Hora_Ordinaria, Hora_Extra_Diurna, Hora_Extra_Nocturna, 
                            Hora_Festiva_Diurna, Hora_Festiva_Nocturna, Salario_Basico, Porcentaje_Hora_Extra_Diurna, Porcentaje_Hora_Extra_Nocturna, Porcentaje_Hora_Extra_Festiva_Diurna, 
                            Porcentaje_Hora_Extra_Festiva_Nocturna, razon_social, tipos_equipos.Descripcion as destipoE, unidades_negocio.codigo as Uneg
                            FROM tiempo_actividades_produccion, ingreso_equipos, equipos, tipos_equipos, clientes, unidades_negocio
                                where tiempo_actividades_produccion.Ingreso=ingreso_equipos.Numero_Ingreso 
                                    and ingreso_equipos.Numero_Serie=equipos.Numero_Serie
                                    and equipos.Codigo_Tipo_Equipo=tipos_equipos.Codigo_Tipo_Equipo
                                    and equipos.Nit_Cliente=clientes.Nit_Cliente
                                    and tiempo_actividades_produccion.Unidad_Negocio=unidades_negocio.codigo                                   
                                    and ingreso_equipos.Estado='A' $condicion order by unidades_negocio.codigo";
                $mo=$objCostomo->Consultar($consmo);  
                
                $temp_ManObra=array();
                $parafiscal=$objUtilidades->BuscarPorcentajeParafiscales();
               
                echo$porfiscal="1.".$parafiscal;
                //es 1 cuando al incremento se le suma 1  
               if($mo <> NULL)               
               {
                   foreach($mo as $manoObra)               
                    {
                        $vho=$objUtilidades->CalcularValorHoraTrabajoEmpleado($manoObra[8], 0, $manoObra[3], "H");                      
                        $vhed=$objUtilidades->CalcularValorHoraTrabajoEmpleado($manoObra[8], $manoObra[9], $manoObra[4], "H");                      
                        $vhen=$objUtilidades->CalcularValorHoraTrabajoEmpleado($manoObra[8], $manoObra[10], $manoObra[5], "H");                      
                        $vhefd=$objUtilidades->CalcularValorHoraTrabajoEmpleado($manoObra[8], $manoObra[11], $manoObra[6], "H");                      
                        $vhefn=$objUtilidades->CalcularValorHoraTrabajoEmpleado($manoObra[8], $manoObra[12], $manoObra[7], "H");                      
                        $posUneg=  number_format($manoObra[15]);
                        $valorHora=$vho+$vhed+$vhen+$vhefd+$vhefn;

                        $valorH=$valorHora*$porfiscal;
                        $datosmo[$posUneg][]=$valorH;
                        $pri_valorHora[$posUneg]=$pri_valorHora[$posUneg]+$valorH;   //verificar aqui la suma por unudades de negocio
                       
                        //Orden del array Ingreso, cliente, total, potencia, velocidad, voltaje, equipo , unidad_negocio                                     
                        $dato=array($manoObra[0], $manoObra[13],$valorH, '','','',$manoObra[14],$posUneg);
                      
                        array_push($temp_ManObra,$dato);
                         
                    }
                   // dd($pri_valorHora);
                                    
                    $_SESSION['ActMonObra']=$temp_ManObra;
  
                }
                else
                {
                    $pri_valorHora=null;
                }               
        
            
           // $objCostomo->closeConect();
            
            return $pri_valorHora;
        }
        
        function CalcularMateriaPrima( $ayo, $mes, $cliente, $oi, $Uneg)
        {
            $objCosto= new CostosABCModel(); 
            $temp_Mprima=array();            
            $primp=array(0,0,0,0,0,0,0,0,0);
            if($oi<>"")
            {
                $condicion=" and Numero_Ingreso='$oi'";
              
            }
            else
            {
                $condicion=" and month(Fecha_Documento)='$mes' and year(Fecha_Documento)='$ayo'";
                if($cliente<>"todos")
                {
                    $condicion.=" and encabezado_e_s_bodega.Nit_Cliente='$cliente'";
                }
            }
            
            if($Uneg <> "todos")
            {
                $condicion.=" and Unidad_Negocio='$Uneg' ";
            }
                $consmp="select Numero_Ingreso, Razon_Social, encabezado_e_s_bodega.No_Documento, detalle_e_s_bodega.Tipo_Documento, costo, Unidad_Negocio
                                    from detalle_e_s_bodega, encabezado_e_s_bodega, clientes
                                            where detalle_e_s_bodega.No_Documento=encabezado_e_s_bodega.No_Documento 
                                            and detalle_e_s_bodega.Tipo_Documento='SB'
                                            and encabezado_e_s_bodega.Nit_Cliente=clientes.Nit_Cliente and Unidad_Negocio <>'' $condicion  ";
                
                $privmp=$objCosto->Consultar($consmp);
               
                foreach($privmp as $mp)
                {
                     $posUneg=number_format($mp[5],0);
                    //orden de los datos en el array-->  Numero_Ingreso, Razon_Social, No_Documento, Tipo_Documento, costo, Unidad Negocio
                    $dato=array($mp[0], $mp[1], $mp[2], $mp[3], $mp[4],$posUneg);                    
                   
                    array_push($temp_Mprima,$dato);
                    $primp[$posUneg]=$primp[$posUneg]+$mp[4];
                }
               
         
            $_SESSION['RegMatPrima']=$temp_Mprima;
           
            return $primp;
        }
        
         function CalcularGastosDirectos($ayo, $mes, $cliente, $oi, $Unineg)
        {
            $objCosto= new CostosABCModel(); 
           $priv_Vgd=array(0,0,0,0,0,0,0,0);
            $temp_Gdirectos=array();
            $condicion="";
            $posUneg=0;
            if($oi<>"")
            {
                $condicion=" and Numero_ingreso='$oi'";
            }
            else
            {
                $condicion=" and month(Fecha_Documento)='$mes' and year(Fecha_Documento)='$ayo'";
                if($cliente <> "todos")
                {
                    $condicion.=" and clientes.Nit_Cliente='$cliente'";
                }
            }
            
            if($Unineg <> "todos")
            {
                $condicion.=" and Unidad_Negocio='$Unineg'";
            }
            
            $consgd="select Numero_Ingreso, Razon_Social, Fecha_Documento, total, Unidad_Negocio
                                from encabezado_gastosdirectos, clientes 
                                        where encabezado_gastosdirectos.Nit_Cliente=clientes.Nit_Cliente $condicion";
                $priv_gd=$objCosto->Consultar($consgd);  
               
                if($priv_gd <> null)
                {
                    foreach($priv_gd as $gd)
                   {
                        $posUneg=  number_format($gd[4]);
                       //orden de los datos en el array-->  Numero_Ingreso, Razon_Social, No_Documento, Tipo_Documento, costo, Unidad Negocio
                       $dato=array($gd[0], $gd[1], $gd[2], $gd[3],$posUneg);
                       
                       array_push($temp_Gdirectos,$dato);
                       $priv_Vgd[$posUneg]=$priv_Vgd[$posUneg] + $gd[3];
                   }                
                }
                else
                {
                    $dato=array(0, 0,0,0,0,$Unineg);
                    array_push($temp_Gdirectos,$dato);
                    $priv_Vgd=0;
                }                                                
          
            $_SESSION['RegGastosD']=$temp_Gdirectos;
            
            //$objCosto->closeConect();
            return    $priv_Vgd;
        }
        
                
        function  CalcularCostosAlmacenamiento($ayo, $mes, $oi)
        {
            $ObjUtilidades=new UtilidadesController();
            $diasAlmesEstaOI=0;
            $totalCostoAlma=0;
           
            if($oi<>"")
            {
                $fechaRM=$ObjUtilidades->BuscarFechaEntrega($oi);
                $RMmes=  substr($fechaRM, 5,2);
                $RMayo=  substr($fechaRM, 0, 4);
            }
            else
            {
                $RMmes=$mes;
                $RMayo=$ayo;
            }
           
           
            if($RMayo>0 and $RMmes>0)
            {
                
                $L3=$ObjUtilidades->BuscarValorRefereciaCostosAlmacenamiento($RMmes, $RMayo);
                $L2=$L3;
                $ToAlma=$ObjUtilidades->CalcularNoDiasAlmacenamientoTodasOi($RMmes, $RMayo);
                $TotDias =$ToAlma[0];     
                $TotalTama=$ToAlma[1];
                

                $tiempo=$L3 * 0.7;
                $ayo=$L3 * 0.3;

                $UnidadTiempo= $tiempo/$TotDias;
                $UnidadTamayo=$ayo / $TotalTama ;
               if($oi <> "")
               {
                    $diasAlmesEstaOI=$ObjUtilidades->CalcularDiasAlmacenamiento($oi);
                    $tamayoOi=$ObjUtilidades->BuscarTamañoCif($oi);
                    $Ttiempo=$diasAlmesEstaOI*$UnidadTiempo;
                    $Ttamayo=$tamayoOi * $UnidadTamayo;
                    $totalCostoAlma=round(($Ttiempo+$Ttamayo),2);
               }
               else
               {
                   
                  $totalCostoAlma=round($L3,2);
               }
                
                //dd($L3);
            }           
            else
            {
                $totalCostoAlma=0;
            }
            
           
            return $totalCostoAlma;
        }
                        
               
       
        
         function  CalcularCIFdeOI($RMayo, $RMmes, $cliente, $oi, $Uneg)
        {                                       
            $ObjUtilidades= new UtilidadesController();
            $ObjCosto= new CostosABCModel();
            $AcumTi=0;            
            $Vtam=0;
            $Vtam=0;
            $AcumTa=0;            
            $RefCif=0; 
            $RefUneg="";
            $consRefcif="";
            $regCerradas=array();
            $condicion="";           
            $TotalGen=0;
            $TGen=0;
            $dato=array();
            $temp_CifOi=array();
            if($oi <> "")
            {               
                $condicion=" and B.Numero_Ingreso='$oi'";
            }
            else
            {
                
                if($cliente <> "todos")
                {
                    $condicion="  and D.Nit_Cliente='$cliente'";
                }
            }         
                        
            $consCerradas="select Tamayo_Cif, fecha_creada, Fecha_Cierre_CIF, Fecha_Cierre_Virtual, B.Numero_Ingreso, D.unidad_negocio as unidad_negocio, Cli.Razon_Social as Razon_Social, TE.Descripcion as Descripcion
                        from ingreso_equipos as B, orden_trabajo as C, detalle_orden_trabajo as D, clientes as Cli, equipos, tipos_equipos as TE
                            where  B.Numero_Ingreso=C.Numero_Ingreso
                           	and D.Numero_Orden=C.Numero_Orden
                                and B.Numero_Serie=equipos.Numero_Serie
                                and equipos.Nit_Cliente=Cli.Nit_Cliente 
                                and equipos.Codigo_Tipo_Equipo=TE.Codigo_Tipo_Equipo
                                and B.estado='A'                             
                                and (month(B.Fecha_Cierre_CIF)='$RMmes' and year(B.Fecha_Cierre_CIF)='$RMayo' or  month(B.Fecha_Cierre_Virtual)='$RMmes' and year(B.Fecha_Cierre_Virtual)='$RMayo')
                                and D.unidad_negocio='$Uneg' $condicion order by B.Numero_Ingreso ";
                $regCerradas=$ObjCosto->Consultar($consCerradas);  
               
                $consRefcif="select (ValorTiempo), (ValorTamayo) from referencia_cif where mes='$RMmes' and Ayo='$RMayo' and UnNegocio='$Uneg'"; 
                $RefCif=$ObjCosto->Consultar($consRefcif);
               
                if($RefCif <> null)
                {
                    $ValorParticTi=  round($RefCif[0][0],2);
                    $ValorParticTa=  round($RefCif[0][1],2);
                }
                else
                {
                    $regCerradas=NULL;
                }
                
               
                if($regCerradas <> NULL)
                {
                    foreach ($regCerradas as $cerradas)
                    {
                        $posUneg=  number_format($cerradas[5]);
                        if($cerradas[2] <> null)
                        {
                            $Vcierre=  substr($cerradas[2],0,10);
                        }
                        else
                        {
                            $Vcierre=  substr($cerradas[3],0,10);
                        }
                        $Vabre=substr($cerradas[1], 0,10);
                        $DiasCif=$ObjUtilidades->CalcularDiasEntreDosFechas($Vcierre, $Vabre);  
                        if($DiasCif == 0)
                        {
                            $DiasCif=1;
                        }
                        
                        $Vtam+=round($cerradas[0],2);
                        $Vta=round($cerradas[0],2);
                        $AcumTi+=$DiasCif;
                        $AcumTa+=$Vtam;   
                        
                        if($AcumTi <> 0)
                        {
                            $Valor1Dia=$ValorParticTi/$AcumTi;
                        }
                        else
                        {
                            $Valor1Dia=0;
                        }
                        
                        if($AcumTa <> 0)
                        {
                            $Valor1Ta=$ValorParticTa/$AcumTa;
                        }
                        else
                        {
                            $Valor1Ta=0;
                        }
                        $TGen=round(($ValorParticTa/$ValorParticTi),2);
                        $TotalGen=round((($Valor1Dia*$AcumTi)+($Valor1Ta*$AcumTa)),2);
                        $dato=array($cerradas[4], $cerradas[6],$cerradas[7],$TGen,$posUneg);                      
                        array_push($temp_CifOi,$dato);
                    }
                   
                  $_SESSION['RegCifOi'][$posUneg]=$temp_CifOi;
                }
                else
                {
                    $TotalGen=0;
                }
                  //$ObjCosto->closeConect();
                  
                
            return $TotalGen;     
        }
        
        
        function CalcularCif($ayo, $mes, $cliente, $oi, $Uneg)
        {
            $ObjCostos=new CostosABCModel();
            $ObjUtilidades=new UtilidadesController();
            $cerrada= array();
            $condicion="";
            $CifUneg=  array(0,0,0,0,0,0,0,0);
            if($oi <> "")
            {
                //remisionada
                $fechaRM=$ObjUtilidades->BuscarFechaOrdenEjecucion($oi);
                if($fechaRM <> null)
                {
                    //si esta remisina buscar año y mes de cierre
                    $RMmes=  substr($fechaRM,5,2);
                    $RMayo=substr($fechaRM,0,4);
                }
                $condicion=" and B.Numero_Ingreso='$oi'";
            }
            else
            {
                $RMayo=$ayo;
                $RMmes=$mes;
                
                if($cliente <> "todos")
                {
                    $condicion="  and D.Nit_Cliente='$cliente'";
                }
            }
                    
            if($Uneg <> "todos")
            {
                $condicion.=" and D.unidad_negocio='$Uneg' ";
            }
            
            $consCerradas="select Tamayo_Cif, fecha_creada, Fecha_Cierre_CIF, Fecha_Cierre_Virtual, B.Numero_Ingreso, D.unidad_negocio as unidad_negocio, Cli.Razon_Social as Razon_Social, TE.Descripcion as Descripcion
                        from ingreso_equipos as B, orden_trabajo as C, detalle_orden_trabajo as D, clientes as Cli, equipos, tipos_equipos as TE
                            where  B.Numero_Ingreso=C.Numero_Ingreso
                           	and D.Numero_Orden=C.Numero_Orden
                                and B.Numero_Serie=equipos.Numero_Serie
                                and equipos.Nit_Cliente=Cli.Nit_Cliente 
                                and equipos.Codigo_Tipo_Equipo=TE.Codigo_Tipo_Equipo
                                and B.estado='A'                             
                                and (month(B.Fecha_Cierre_CIF)='$RMmes' and year(B.Fecha_Cierre_CIF)='$RMayo' or  month(B.Fecha_Cierre_Virtual)='$RMmes' and year(B.Fecha_Cierre_Virtual)='$RMayo') 
                                and D.unidad_negocio<>'' $condicion group by unidad_negocio order by unidad_negocio ";
             $regCerradas=$ObjCostos->Consultar($consCerradas); 
            
            if($regCerradas <> null)
            {
                foreach($regCerradas as $cerrada)
                {
                    $UN=$cerrada[5];
                     
                    $posUneg=  number_format($UN);
                    $cif=$this->CalcularCIFdeOI($RMayo, $RMmes, $cliente, $oi, $cerrada[5]);
                    $CifUneg[$posUneg]=$CifUneg[$posUneg] +$cif;
                }
               
            }  
           //dd($CifUneg);
          //  $ObjCostos->closeConect();
            return $CifUneg;
            
        }
        
        
        function CalcularLoFacturado($ayo, $mes, $cliente, $oi, $Uneg)
        {
           $ObjCostoas=new CostosABCModel();
           $priv_fact=array(0,0,0,0,0,0,0,0,0);
           $condicion="";
           $dato=array();
           $tempfact=array();
           if($oi <> "")
           {
               $condicion="and A.Numero_Ingreso='$oi' ";
           }
           else
           {
                $condicion=" and month(A.Fecha_Ingreso)='$mes' and year(A.Fecha_Ingreso)='$ayo'";
                if($cliente <> "todos")
                {
                    $condicion.=" and B.Nit_Cliente='$cliente'";
                }
           }
           
           if($Uneg <> "todos")
           {
               $condicion.=" and unidad_negocio='$Uneg'";
           }
           $consFact="select A.Numero_Ingreso, C.Razon_Social, (D.Valor_Unitario * D.Cantidad), E.Unidad_Negocio
                            from ingreso_equipos as A, equipos as B , clientes as C, detalle_documento_venta as D, productos_servicios as E, encabezado_documento_venta as F
                                    where A.Numero_Serie=B.Numero_Serie 
                                    and B.Nit_Cliente=C.Nit_Cliente
                                    and D.Numero_Ingreso=A.Numero_Ingreso
                                    and D.Codigo_Producto=E.Codigo
                                    and D.Numero_Documento=F.Numero_Documento
                                    and D.Tipo_Documento like'FV%'
                                    and A.estado='A' and F.Estado_Documento='A'
                                    $condicion  order by A.Numero_Ingreso";
            $regfact=$ObjCostoas->Consultar($consFact);
            //dd($regfact);
            if($regfact <> null)
            {
                foreach ($regfact as $reg)
                {
                    $posUneg=  number_format($reg[3]);
                    $priv_fact[$posUneg]=$priv_fact[$posUneg]+$reg[2];
                    $dato=array($reg[0], $reg[1], $reg[2],$posUneg);
                    array_push($tempfact, $dato);
                }
                $_SESSION['RegFacturados']=$tempfact;
                
            }
            else
            {
                $priv_fact=null;
            }
          // $ObjCostoas->closeConect();
           return $priv_fact;
        }
        
        function CalcularRentabilidad($tcosto, $tfacturado)
        {
           
            $Renta=array();                                            
          
             for($i=0; $i<count($tcosto); $i++)
             {
               
                if($tfacturado[$i] <>0)
                {
                    // Posicion 1 es rentabolidad en pesos =Rentabilidad
                    // Posicion 2 es rentabolidad en porcentaje (9,1)                    
                    $Renta[1][$i]=$tfacturado[$i] - $tcosto[$i];                    
                    $Renta[2][$i]= round((($tfacturado[$i]-$tcosto[$i])/$tfacturado[$i])*100);                                   
                }              
                else
                {
                    $Renta[1][$i]=0; 
                    $Renta[2][$i]=0;                                            
                }
                                 
             }
           
             return $Renta;
            
        }
        
        function CalcularCostosProduccion()
        {            
            $oi=$_POST['oi'];
            $ayo=$_POST['ayo'];
            $mes=$_POST['mes'];
            $cliente=$_POST['cliente'];
            $Uneg=$_POST['uneg'];                        
            $tablaCostoAlmacenamiento=0;                  
            $Tfact=0;                  
            $total=0;      
            $tablaCostosMO = Array();
            $TablaCifOI = Array();
            $tablaCostoMP = Array();
            $tablaGactosDirect = Array();
            $tablafacturado = Array();
            $objCosto= new CostosABCModel(); 
            $ObjUtilidades= new UtilidadesController(); 
            $consUneg="SELECT Codigo, Descripcion FROM `unidades_negocio` WHERE Estado='A' order by Codigo";
            $Ucosto=$objCosto->Consultar($consUneg);
            $cantUneg=count($Ucosto)+1;  
                 
            $tablaCostosMO=$this->CalcularManoObra($ayo, $mes, $cliente, $oi, $Uneg); 
            $tablaCostoMP=$this->CalcularMateriaPrima($ayo, $mes, $cliente, $oi, $Uneg); 
            $TablaCifOI=  $this->CalcularCif($ayo, $mes, $cliente, $oi, $Uneg);            
            $tablaGactosDirect=$this->CalcularGastosDirectos($ayo, $mes, $cliente, $oi, $Uneg);
            $tablaCostoAlmacenamiento=$this->CalcularCostosAlmacenamiento($ayo, $mes, $oi);
            $tablafacturado=$this->CalcularLoFacturado($ayo, $mes, $cliente, $oi, $Uneg);
            
          
      
            include_once('../../views/CostosABC/listarCostoProduccion.html.php');
    
            //$objCosto->closeConect();                       
        }
   
                
        function VerMO()
        {
            $uneg=$_POST['uneg'];
         
            include_once('../../views/CostosABC/GuiVerMO.html.php');
        }
        
         function VerMP()
        {
            $uneg=$_POST['uneg'];
         
            include_once('../../views/CostosABC/GuiVerMP.html.php');
        }
        
         function VerGD()
        {
            $uneg=$_POST['uneg'];
         
            include_once('../../views/CostosABC/GuiVerGD.html.php');
        }
        
        function VerCif()
        {
           
            $uneg=$_POST['uneg'];
                      
             include_once('../../views/CostosABC/GuiVerCif.html.php');
            
        }
        
        function VerFcaturado()
        {
           
            $uneg=$_POST['uneg'];
                      
             include_once('../../views/CostosABC/GuiVerFact.html.php');
            
        }
        
        function VerPoVeVoEquipo()
        {
            $oi=$_POST['oi'];
            $datosEqui=array();
            $ObjUtilidades= new UtilidadesController(); 
            $datosEqui=$ObjUtilidades->RecuperarPotenciaVelocidadVoltaje($oi);
            include_once('../../views/CostosABC/GuiVerPoVeVoEquipo.html.php');
        }
	 
	
}

?>