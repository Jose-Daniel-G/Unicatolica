    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Eliminar Equipo</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
     <div class="card">
        <div class="card-header">
            Est&aacute; seguro de eliminar el Equipo:
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Numero_Serie</label>
                        <label><?php foreach($Equipo as $Equipos){} echo $Equipos['Numero_Serie']; ?></label>
                    </div>
                    
                    <button>
                        <?php
                        echo"<a href='index.php?modulo=Ingresos&controlador=IngresosEquiDc&funcion=postEliminar&Numero_Serie=".$Equipos['Numero_Serie']."'>S&iacute;, estoy seguro</a>";
                        ?>
                    </button>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <button><a href='index.php?modulo=Ingresos&controlador=IngresosEquiDc&funcion=postEliminar&Numero_Serie=".$Equipos['Numero_Serie']."'); ?>
                        No, cambi&eacute; de opini&oacute;n</a></button>
                    </div>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div> 
    </div>