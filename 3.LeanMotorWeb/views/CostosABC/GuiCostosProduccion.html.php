               <div class="card">
                    <div class="card-header">                         
                            <h4>
                                <b>Costos de Produccion</b>
                            </h4>                                                                            
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" name="costoProduccion" method="post">
                                    <table border='0'>
                                        
                                        <tr>
                                            <td width='10%'><label class="font-weight-bold">OI</label></td>
                                            <td width='8%'>
                                                <input type="numbre" name="num_oi" id="num_oi" class="form-control" data-url="<?php echo getUrl("CostosABC", "CostosABC", "VerPoVeVoEquipo", FALSE, "ajax") ?>">                                                 
                                            </td> 
                                            <td colspan='3'> &nbsp;<button type="button" class="btn btn-primary" name="btnoi" id="btnoi" data-toggle="modal" data-url='<?php echo getUrl("Utilidades", "Utilidades", "RecuperarInfoEquipoconOI", FALSE, "ajax")  ?>' data-target="#myModal" title='Mostar Datos de la Oi'><i class='fa fa-search'></i></button>                                               
                                            &nbsp;   &nbsp;<span id="datosequi_oi" ></span>
                                            </td>
                                           
                                        </tr>
                                        <tr><td>&nbsp;</td></tr>
                                        
                                        <tr>
                                            <td><label class="font-weight-bold">Ayo</label></td>
                                            <td><label class="font-weight-bold">Mes</label></td>
                                            <td width='40%'><label class="font-weight-bold">Cliente</label></td>
                                            <td width='30%'> <label class="font-weight-bold">Unidad de Negocio</label></td>
                                            
                                            <td></td>
                                        </tr>    

                                        <tr>
                                            <td><select class="form-control" id="ayo" name="ayo">                                                
                                                <?php  
                                                $ayoact=date('Y');
                                                echo "<option value=" .$ayoact. " selected>" .$ayoact. "</option>";   
                                                for($i=2006; $i<$ayoact; $i++)
                                                {
                                                    echo "<option value=" .$i. ">" .$i. "</option>";                                                   
                                                }
                                                ?>
                                                </select>
                                            </td>


                                            <td><select class="form-control" id="mes" name="mes">                                                
                                                <?php  
                                                $mesact=  date('m');
                                                echo "<option value=" .$mesact. " selected>" .$mesact. "</option>";   
                                                echo "<option value='01'>01</option>";                                                   
                                                echo "<option value='02'>02</option>";                                                   
                                                echo "<option value='03'>03</option>";                                                   
                                                echo "<option value='04'>04</option>";                                                   
                                                echo "<option value='05'>05</option>";                                                   
                                                echo "<option value='06'>06</option>";                                                   
                                                echo "<option value='07'>07</option>";                                                   
                                                echo "<option value='08'>08</option>";                                                   
                                                echo "<option value='09'>09</option>";                                                   
                                                echo "<option value='10'>10</option>";                                                   
                                                echo "<option value='11'>11</option>";                                                   
                                                echo "<option value='12'>12</option>";                                                   
                                                                                                   
                                                
                                                ?>
                                                </select> 
                                            </td>                                              
                                                
                                            <td><select class="form-control" id="cliente" name="cliente"> 
                                                <option value="todos">(Todos)</option>
                                                <?php  
                                                foreach($cliente as $clientes)
                                                {
                                                    echo "<option value=" .$clientes[0]. ">" .$clientes[1]. "</option>";                                                   
                                                }
                                                ?>
                                                </select> 
                                            </td>

                                            <td><select class="form-control" id="unineg" name="unineg">   
                                                  <option value="todos">(Todos)</option>
                                                <?php  
                                                foreach($uninegocio as $unidadnegs)
                                                {
                                                    echo "<option value=" .$unidadnegs[0]. ">" .$unidadnegs[1]. "</option>";                                                   
                                                }
                                                ?>
                                                </select> 
                                            </td>  
                                             <td> 
                                                &nbsp;<button type="button" class="btn btn-primary" name="btncprouccion" id="btncprouccion" data-url='<?php echo getUrl("CostosABC", "CostosABC", "CalcularCostosProduccion", FALSE, "ajax")  ?>' style='cursor:pointer;'/><i class="pe-7s-search pe-1x"></i>Buscar</button>
                                            </td>
                                        </tr>
                                    </table>
                                    
                                    <br>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline table-responsive">
                                                <tbody id="list_costoProduccion">
                                           
                                                </tbody>
                                            </table>
                                                                                      
                                               
                                        </div>
                                    
                                        <div id="ModalVerMO" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-lg" role="document">

                                              <!-- Modal content-->
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title">Unidad de Negocio</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="listaMO"></div>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                </div>
                                              </div>

                                            </div>
                                        </div>
                                    
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div> 

<div id="ModalVerOi" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">DATOS DEL EQUIPO</h4>
      </div>
      <div class="modal-body">
          <div id="listaOi"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
