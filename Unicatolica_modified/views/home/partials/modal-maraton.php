<!-- MODAL MARATÓN PROGRAMACIÓN -->
<div class="modal fade" id="maraton-program" tabindex="-1" role="dialog" aria-labelledby="maraton-programLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="text-center modal-header">
                <h2 class="w-100 modal-title" id="maraton-programLabel">Selección de participantes</h2>
                <button type="button" class="text-danger close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-window-close fa-2x"></i>
                </button>
            </div>

            <form method="post" id="formMaraton">
                <div class="container">
                    <div class="form-group row mt-4">
                        <label for="selectEstudiantes" class="col-3 col-form-label">Estudiante:</label>
                        <div class="col-9">
                            <select name="nombreEstudiante[]" id="selectEstudiantes" class="select2 form-control"></select>
                        </div>
                    </div>

                    <div class="text-center row mt-3">
                        <div class="col-12">
                            <button type="button" id="botonAgregarEstudiante" class="text-white btn" style="background: #428BCA;">
                                <i class="fa fa-sign-out-alt fa-3x fa-rotate-90"></i>
                            </button>
                        </div>
                        <div class="col-12 mt-2">
                            <p>Agregar</p>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <div class="col-12">
                            <table id="tablaAgregarEstudiante" class="table table-hover">
                                <thead class="text-white" style="background: #428BCA;">
                                    <tr>
                                        <th>idEstudiante</th>
                                        <th>Participantes</th>
                                        <th></th>
                                        <th>idRegistro</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group row text-center mt-4">
                        <div class="col-12">
                            <input type="submit" id="inscribirEstudiante" class="text-white btn" style="background: #428BCA;" value="Inscribir">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
