@extends('master.master')
@section('name')
    <div class="container" id="divPrincipal">
        <div class="modal" tabindex="-1" id="modalReporte">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <label for="">Descripcion</label>
                                    <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <label for="mantenimiento">Mantenimienos</label>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                @foreach ($mantenimientos as $mantenimiento)
                                                    <tr>
                                                        <td>{{ $mantenimiento->mantenimientos }} <input type="checkbox"
                                                                name="mantenimiento[]"
                                                                value="{{ $mantenimiento->idmantenimientos }}"></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnRegistrar">Registrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Plca</th>
                        <th scope="col">Matricula</th>
                        <th scope="col">Marcas</th>
                        <th scope="col">Modelos</th>
                        <th scope="col">Tipos</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehiculos as $vehiculo)
                        <tr>
                            <th scope="row">{{ $vehiculo->idvehiculos }}</th>
                            <td>{{ $vehiculo->placa }}</td>
                            <td>{{ $vehiculo->matricula }}</td>
                            <td>{{ $vehiculo->marca }}</td>
                            <td>{{ $vehiculo->modelos }}</td>
                            <td>{{ $vehiculo->tipos }}</td>
                            <td>{{ $vehiculo->estado }}</td>
                            @if ($vehiculo->estado == 'Disponible')
                                <td>
                                    <button class="btn btn-primary seleccionar_mantenimiento"
                                        idvehiculo="{{ $vehiculo->idvehiculos }}">Reportar</button>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#divPrincipal').on('click', '.seleccionar_mantenimiento', function() {
            $('#modalReporte').modal('show');
            $('#btnRegistrar').val($(this).attr('idvehiculo'));
        });

        $('#divPrincipal').on('click', '.btn-danger', function() {
            $('#modalReporte').modal('hide');
        });

        $('#divPrincipal').on('click', '.btn-secondary', function() {
            $('#modalReporte').modal('hide');
        });

        $('#divPrincipal').on('click', '#btnRegistrar', function() {

            var mantenimiento = new Object();

            mantenimiento.idvehiculo = $(this).val();
            mantenimiento.descripcion = $('#descripcion').val();

            var tipoMantenimiento = [];

            $('[name="mantenimiento[]"]:checked').map(function() {
                tipoMantenimiento.push({
                    idMantenimiento: this.value
                });
            });

            mantenimiento.tipoMantenimiento = tipoMantenimiento;

            $.ajax({
                url: 'registroReportes',
                type: 'post',
                data: mantenimiento,
                success: function(data) {
                    if (data.error == 0) {
                        var pre = document.createElement('pre');
                        //custom style.
                        pre.style.maxHeight = "400px";
                        pre.style.margin = "0";
                        pre.style.padding = "24px";
                        pre.style.whiteSpace = "pre-wrap";
                        pre.style.textAlign = "justify";
                        pre.appendChild(document.createTextNode('Reporte generado con exito'));
                        //show as confirm
                        alertify.confirm(pre, function() {
                            alertify.success('Correcto');
                            location.reload();
                        }, function() {
                            alertify.success('Correcto');
                            location.reload();
                        }).set({
                            labels: {
                                ok: 'Aceptar',
                                cancel: 'Cerrar'
                            },
                            padding: false
                        });
                    }
                },
                error: function(data) {
                    console.log(data)
                }
            })

        });
    </script>
@endsection
