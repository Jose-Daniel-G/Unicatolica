<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa'];?>

<div class="card-body">

    <form method="post" id="frm_BuscarIngresos" action="<?=getUrl("Utilidades", "Utilidades", "ListarIngresos", false, "ajax");?>" autocomplete="off">

        <input type="hidden" id="tipo_documento" name="tipo_documento" value="OI">

        <div class="container-fluid">

            <div class="pb-4 border row">

                <label class="header-blue">Criterios de Búsqueda</label>

                <div class="col-12">
                    <div class="row">

                        <div class="col-1">
                            <input type="radio" name="criterioIng" id="opc_todos" value="Todos">
                            <label for="opc_todos">Todos</label>
                        </div>

                        <div class="col-6">
                            <div id="buscarIngresoDesdeHasta" class="nuevaBusqueda row" style="display: none;">

                                <div class="col-1">
                                    <label label="fecha_desde">Desde</label>
                                </div>

                                <div class="col-5">
                                    <div class="input-group-prepend">
                                        <input type="text" name="fecha_desde" id="fecha_desde" class="form-control text-center datepicker"
                                            placeholder="aaaa-mm-dd" readonly>
                                        <div class="d-flex align-items-center ml-1" style="color: #337ab7; cursor: pointer;">
                                            <i class="fa fa-window-close fa-2x removeDatepicker"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-1">
                                    <label label="fecha_hasta">Hasta</label>
                                </div>

                                <div class="col-5">
                                    <div class="input-group-prepend">
                                        <input type="text" name="fecha_hasta" id="fecha_hasta" class="form-control text-center datepicker fechaAutocompletar"
                                            placeholder="aaaa-mm-dd" readonly>
                                        <div class="d-flex align-items-center ml-1" style="color: #337ab7; cursor: pointer;">
                                            <i class="fa fa-window-close fa-2x removeDatepicker"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-5">
                            <div class="row">

                                <div class="col-7 offset-2">

                                    <div id="menu-ir-a-Ing" class="row" style="display: none;">

                                        <div class="p-0 col-3">
                                            <a id="ir-a-ingreso-cicloVida" class="px-3 py-2 btn btn-primary" title="Ir al Ciclo de Vida" href="" target="_blank">
                                                <i class="fa fa-recycle"></i>
                                            </a>
                                        </div>

                                        <div class="p-0 col-4">
                                            <div class="btn-group" role="group" aria-label="dropdownVer">
                                                <div class="btn-group" role="group">
                                                    <button id="btnDropdownVerIng" type="button" class="px-3 py-2 btn btn-primary dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span>Ver</span>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownVer">
                                                        <div id="dropdownVer">
                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-ingreso-equipoVer" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Ingreso</a>
                                                            </button>

                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-diagnostico-equipoVer" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Diagnóstico</a>
                                                            </button>

                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-preliquidacion-equipoVer" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Preliquidación
                                                                FA - 02</a>
                                                            </button>

                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-pruebas" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Pruebas</a>
                                                            </button>

                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-cotizacion-equipoVer" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Cotización</a>
                                                            </button>

                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-ordenTrabajo-equipoVer" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Orden de Trabajo</a>
                                                            </button>

                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-informeTecnico-equipoVer" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Informe Técnico</a>
                                                            </button>

                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-remision-equipoVer" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Remisión</a>
                                                            </button>
                                                            
                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-factura-equipoVer" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Factura</a>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="p-0 col-4">
                                            <div class="btn-group" role="group" aria-label="dropdownEditar">
                                                <div class="btn-group" role="group">
                                                    <button id="btnDropdownEditarIng" type="button" class="px-3 py-2 btn btn-primary dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span>Editar</span>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownEditar">
                                                        <div id="dropdownEditar">
                                                        <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-ingreso-equipoEditar" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Ingreso</a>
                                                            </button>

                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-diagnostico-equipoEditar" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Diagnóstico</a>
                                                            </button>

                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-preliquidacion-equipoEditar" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Preliquidación
                                                                FA - 02</a>
                                                            </button>

                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-pruebas" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Pruebas</a>
                                                            </button>

                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-cotizacion-equipoEditar" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Cotización</a>
                                                            </button>

                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-ordenTrabajo-equipoEditar" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Orden de Trabajo</a>
                                                            </button>

                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-informeTecnico-equipoEditar" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Informe Técnico</a>
                                                            </button>

                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-remision-equipoEditar" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Remisión</a>
                                                            </button>
                                                            
                                                            <button type="button" class="dropdown-item btn text-dark">
                                                                <a id="ir-a-factura-equipoEditar" class="d-block w-100 text-dark" href="" target="_blank" style="text-decoration: none;">Factura</a>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div>

                                <div class="p-0 col-3">
                                    <button type="submit" class="px-3 py-2 btn btn-primary" id="btnBuscarIngreso" title="Buscar">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <button type="reset" class="px-3 py-2 btn btn-primary" id="btnNuevaBusqueda" title="Nueva búsqueda">
                                        <i class="fa fa-file"></i>
                                    </button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="mt-3 col-6">
                    <div class="row">

                        <div class="col-3">
                            <input type="radio" name="criterioIng" id="opc_cliente" value="Cliente">
                            <label for="empresa">Por Cliente</label>
                        </div>

                        <div class="col-9">
                            <div id="buscarIngresoPorCliente" class="nuevaBusqueda row" style="display: none;">
                                <div class="col-12">
                                    <select name="nit_empresa" id="empresa" class="form-control select2">
                                        <option value="">Seleccione ...</option>
                                        <?php foreach ($empresas as $empresa): ?>
                                        <option value="<?=$empresa[0];?>"><?=$empresa[1];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mt-3 col-5">
                    <div class="row">

                        <div class="col-6">
                            <input type="radio" name="criterioIng" id="opc_ingreso" value="Ingreso">
                            <label for="">Por N° de Ingreso</label>
                        </div>

                        <div class="col-6">
                            <div id="buscarIngresoPorNoIngreso" class="nuevaBusqueda row" style="display: none;">
                                <div class="col-12">
                                    <input type="number" name="numero_ingreso" id="numero_ingreso" class="form-control"
                                        min="1" pattern="^[0-9]+">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mt-3 col-6">
                    <div class="row">

                        <div class="col-6">
                            <input type="radio" name="criterioIng" id="opc_serie" value="Serie">
                            <label for="">Por N° de Serie</label>
                        </div>

                        <div class="col-5">
                            <div id="buscarIngresoPorNoSerie" class="nuevaBusqueda row" style="display: none;">
                                <div class="col-12">
                                    <input type="text" name="numero_serie" id="numero_serie" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="w-100"></div>


                <div class="mt-3 col-6">
                    <div class="row">

                        <div class="col-6">
                            <label for="">Estados del Documento</label>
                        </div>

                        <div class="col-5">
                            <select name="estado_doc" id="estado_doc" class="form-control">
                                <option value="">Seleccione ...</option>
                                <option value="T">Todos</option>
                                <option value="A">Activos</option>
                                <option value="I">Anulados</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="mt-3 col-5">
                    <div class="row">

                        <div class="col-5">
                            <label for="sede">Sede</label>
                        </div>

                        <div class="col-7">
                            <select name="nit_sede" id="sedeIng" data-campo-1="#empresa" class="form-control" 
                                data-url="<?=getUrl("Utilidades", "Utilidades", "buscarConsecutivoSedeYcliente", false, "ajax"); ?>">
                                <option value="">Seleccione ...</option>
                                <?php foreach ($sedes as $sede): ?>
                                <option value="<?=$sede[0];?>"><?=$sede[1];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </form>
</div>

<div class="container">
    <div class="nuevaBusqueda" id="containerTablaModalBuscarIngresos" style="display: none;">
        <div class="table-responsive">
            <table id="tablaModalBuscarIngresos" class="table-bordered table-hover" width="100%;">
        
                <thead class="table text-white bg-primary thead-primary">
                    <tr>
                        <th>N° de Ingreso</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>N° de Serie</th>
                        <th>Nombre Equipo</th>
                        <th>Empresa</th>
                        <th>Potencia</th>
                        <th>Velocidad</th>
                        <th>Voltaje</th>
                        <th>Estado</th>
                    </tr>
                </thead>
        
                <tbody></tbody>
        
            </table>
        </div>
    </div>
</div>

<script>
    $(".select2").select2({
        language: "es",
        width: "100%",
        theme: "bootstrap"
    });
    $(".datepicker").css({
        fontSize: 17,
    });
    $("#fecha_desde").datepicker({
        changeYear: true,
        dateFormat: "yy-mm-dd",
        yearRange: "1940:2040",
        showMonthAfterYear: true,
        onSelect: function (dateText) {
            var fecha1 = dateText.split("-");
            var ano = fecha1[0];
            var mes = fecha1[1];
            var dia = fecha1[2];
            
            var ultimoDia = new Date(ano, mes, 0).getDate();
            var fecha2 = ano + "-" + mes + "-" + ultimoDia;

            if (dia == "01" || dia == "15") {
                $(".fechaAutocompletar").val(fecha2);
            }
        }
    });
    $(".datepicker").datepicker({
        changeYear: true,
        dateFormat: "yy-mm-dd",
        yearRange: "1940:2040",
        showMonthAfterYear: true,
    });
    $(document).on("click", ".removeDatepicker", function () {
        $(this).parent().parent().find("input").val("");
    });
</script>