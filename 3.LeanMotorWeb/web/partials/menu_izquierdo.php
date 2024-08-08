<div class="sidebar" role="navigation">
    <div class="sidebar-nav collapse navbar-collapse show" id="side-menu-wrapper">
        <ul class="nav navbar-nav navbar-collapse flex-column side-nav list-group" id="side-menu">

            <div class="pt-4 row">
                <div class="col-12">
                    <button class="btn btn-primary btn-block fa fa-search" type="button" id="btnBuscarIngresoGeneral" data-url="<?=getUrl("Utilidades", "Utilidades", "ModalBuscarIngresos", false, "ajax") ?>">
                        <span>Buscar Órdenes de Ingreso</span>
                    </button>
                </div>
            </div>

            <hr class="w-100">

            <div class="pb-4 row">
                <div class="col-12">
                    <button class="btn btn-primary btn-block fa fa-search" type="button" id='btnBuscarDocGeneral' data-url="<?=getUrl("Utilidades", "Utilidades", "ModalBuscarDocumento", false, "ajax") ?>">
                        <span>Buscar Documentos</span>
                    </button>
                </div>
            </div>

            <li class="list-group-item active">
                <a href="index.php/../">
                    <i class="fa fa-home fa-fw"></i>Inicio</a>
            </li>

            <li class="list-group-item">
                <a href="#">
                    <i class="far fa-file-alt"></i> Archivos
                    <span class="fa arrow"></span>
                </a>

                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="#">
                            <i class="fa fa-hands"></i> Seguridad Social
                            <span class="fa arrow"></span>
                        </a>

                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Cc&controlador=Cc&funcion=crearCc">• Caja de
                                    Compensaci&oacute;n</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Fc&controlador=Fc&funcion=crearFc">• Fondo de Cesantías</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Fp&controlador=Fp&funcion=crearFp">• Fondo de Pensiones</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Arl&controlador=Arl&funcion=crearArl">• ARL</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Eps&controlador=Eps&funcion=crearEps">• EPS</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=TipoSeg&controlador=TipoSeg&funcion=crearTipoSeg">• Tipo
                                    Entidades
                                    Seguridad Social</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="#">
                            <i class="fa fa-people-carry"></i> Empleados
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav-second-level list-group nested">
                            <li>
                                <a href="index.php?modulo=Empleados&controlador=Empleados&funcion=crearEmpleado">
                                    • Empleados</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Cargos&controlador=Cargos&funcion=crearCargos">• Cargos</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Profesiones&controlador=Profesiones&funcion=crearProfesiones">•
                                    Profesiones</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Viviendas&controlador=Viviendas&funcion=crearViviendas">•
                                    Viviendas</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=EstadosCiviles&controlador=EstadosCiviles&funcion=crearEstadosCiviles">•
                                    Estados Civiles</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="#">• Ciudades</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="#">
                            <i class="fa fa-users"></i> Terceros
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Clientes&controlador=Clientes&funcion=crearCliente">•
                                    Clientes</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="#">• Proveedores</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="#">
                            <i class="fa fa-calendar-alt"></i> Administración
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=MarcasProductos&controlador=MarcasProductos&funcion=crearMarcasProductos">•
                                    Marcas Productos</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Marcas&controlador=Marcas&funcion=crearMarcas">• Marcas</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=TipoEquipos&controlador=TipoEquipos&funcion=crearTipoEquipos">•
                                    Tipos
                                    de Equipos</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Actividades&controlador=Actividades&funcion=crearActividades">•
                                    Actividades</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="#">• Actividades de Producción</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="#">• Centros de Costo</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="#">• Tipos de Iva</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=UnidadNegocio&controlador=UnidadNegocio&funcion=crearUnidadNegocio">•
                                    Unidades de Negocio</a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </li>


            <li class="list-group-item">
                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="#">• Otros</a>
                    </li>
                </ul>
                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="#">• Procesos SIG</a>
                    </li>
                </ul>
                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="#">• Revisiones</a>
                    </li>
                </ul>
                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="#">• Unidades de Medida</a>
                    </li>
                </ul>
                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="#">• Zonas</a>
                    </li>
                </ul>
            </li>



            <li class="list-group-item">
                <a href="#">
                    <i class="fa fa-book"></i> Documentos
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="#">
                            <i class="fa fa-book"></i> Ingresos
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav-third-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Ingresos&controlador=Ingresos&funcion=crearTR">• Ingreso de
                                    Transformadores FA-06</a>
                            </li>
                        </ul>
                        <ul class="nav-third-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Ingresos&controlador=Ingresos&funcion=crearAC">• Ingreso
                                    Maquinas de Inducci&oacute;n AC - FA-06</a>
                            </li>
                        </ul>
                        <ul class="nav-third-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Ingresos&controlador=Ingresos&funcion=crearDC">• Ingreso
                                    Maquinas DC FA-06</a>
                            </li>
                        </ul>
                        <ul class="nav-third-level list-group nested">
                            <li class="list-group-item">
                            <a href="index.php?modulo=Ingresos&controlador=Ingresos&funcion=crearPT">• Ingreso de Partes
							FA-06</a>
                            </li>
                        </ul>
                        <ul class="nav-third-level list-group nested">
                            <li class="list-group-item">
                            <a href="index.php?modulo=Ingresos&controlador=Ingresos&funcion=crearOT">• Ingreso de
							Outsourcing FA-06</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="#">
                            <i class="fa fa-book"></i> Diagnósticos
                            <span class="fa arrow"></span>
                        </a>

                        <ul class="nav-third-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Diagnosticos&controlador=Diagnosticos&funcion=tiposDiagnosticos">•
                                    Tipos de Diagnósticos</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="#">
                            <i class="fa fa-book"></i> Cotizaciones
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav-third-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Cotizaciones&controlador=Cotizaciones&funcion=crearCotizacion&tipo_doc=CT">•
                                    Cotizaci&oacute;n</a>
                            </li>
                        </ul>
                        <ul class="nav-third-level list-group nested">
                            <li class="list-group-item">
                                <a href="index.php?modulo=Cotizaciones&controlador=Cotizaciones&funcion=crearCotizacion&tipo_doc=CTGER">•
                                    Cotizaci&oacute;n GER</a>
                            </li>
                        </ul>
                    </li>

                    <li class="list-group-item">
                        <a href="index.php?modulo=Remisiones&controlador=Remisiones&funcion=crearRemision&tipo_doc=RM">•
                            Remisión</a>
                    </li>

                    <li class="list-group-item">
                        <a href="index.php?modulo=OrdenTrabajo&controlador=OrdenTrabajo&funcion=crearOrdenTrabajo">•
                            Orden de Trabajo FM-03</a>
                    </li>

                    <li class="list-group-item">
                        <a href="index.php?modulo=Informes&controlador=Informes&funcion=crearInformeTecnico">•
                            Informe Técnico</a>
                    </li>
                    
                    <li class="list-group-item">
                        <a href="index.php?modulo=Preliquidacion&controlador=Preliquidacion&funcion=crearPreliquidacion&tipo_doc=PL">•
                            Preliquidaci&oacute;n FA-02</a>
                    </li>
                    
                    <li class="list-group-item">
                        <a href="index.php?modulo=Factura&controlador=Factura&funcion=crearFactura&tipo_doc=FVC">•
                            Factura</a>
                    </li>
                </ul>
            </li>

            <li class="list-group-item">
                <a href="#">
                    <i class="fa fa-list-alt"></i> Reportes
                    <span class="fa arrow"></span>
                </a>

                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="index.php?modulo=Reportes&controlador=Reportes&funcion=reporteCotizacion">• Cotizaciones</a>
                    </li>
                </ul>

                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="index.php?modulo=Reportes&controlador=Reportes&funcion=reporteFactura">• Facturas</a>
                    </li>
                </ul>
            </li>


            <li class="list-group-item">
                <a href="#">
                    <i class="fa fa-dollar-sign"></i> Costos ABC
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav-second-level list-group nested">
                    <li>
                        <a href="#">• Costos y Gastos Generales</a>
                    </li>
                </ul>
                <ul class="nav-second-level list-group nested">
                    <li>
                        <a href="index.php?modulo=CostosABC&controlador=CostosABC&funcion=crearCostoProduccion">•
                            Consulta Costos de Producción</a>
                    </li>
                </ul>
                <ul class="nav-second-level list-group nested">
                    <li>
                        <a href="#">• Referencias Costos de Almacenamiento</a>
                    </li>
                </ul>
            </li>


            <li class="list-group-item">
                <a href="#">
                    <i class="far fa-calendar-alt"></i> Inventarios
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="index.php?modulo=EntradaBodega&controlador=EntradaBodega&funcion=crearEntradaBodega">•
                            Entradas a Bodega</a>
                    </li>
                </ul>

                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="index.php?modulo=Productos&controlador=Productos&funcion=crearProductos">• Productos</a>
                    </li>
                </ul>

                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="index.php?modulo=Lineas&controlador=Lineas&funcion=crearLineas">• L&iacute;neas</a>
                    </li>
                </ul>

                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="index.php?modulo=Grupos&controlador=Grupos&funcion=crearGrupos">• Grupos</a>
                    </li>
                </ul>

                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="index.php?modulo=GastosDirectos&controlador=GastosDirectos&funcion=crearGastoDirectoFabricacion">• Gasto Directo de Fabricación</a>
                    </li>
                </ul>
            </li>

            <li class="list-group-item">
                <a href="#">
                    <i class="fa fa-key"></i> Seguridad
                    <span class="fa arrow"></span>
                </a>

            </li>


            <li class="list-group-item">
                <a href="#">
                    <i class="fa fa-cogs"></i> Mantenimiento
                    <span class="fa arrow"></span>
                </a>

                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="index.php?modulo=Mantenimiento&controlador=Mantenimiento&funcion=vistaNumeroSerie">• Número de Serie</a>
                    </li>
                </ul>
                
                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="index.php?modulo=Mantenimiento&controlador=Mantenimiento&funcion=vistaNitCliente">• Nit de Cliente</a>
                    </li>
                </ul>

                <ul class="nav-second-level list-group nested">
                    <li class="list-group-item">
                        <a href="index.php?modulo=Mantenimiento&controlador=Mantenimiento&funcion=vistaEditarDatosEquipo">• Editar Datos del Equipo</a>
                    </li>
                </ul>
            </li>

        </ul>

    </div>
</div>