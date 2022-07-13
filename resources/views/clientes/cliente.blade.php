@extends('master.master')
@section('name')
    <div class="container" id="divPrincipal">
        <div class="modal" tabindex="-1" id="modalReservacion">
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
                                <div class="col-md-6 col-xs-6">
                                    <label for="">Costo Kilometro</label>
                                    <input type="number" class="form-control" id="costoKilometro">
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <label for="">Kilometro recorrido</label>
                                    <input type="number" class="form-control" id="kilometro">
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <label for="">Recargos</label>
                                    <input type="number" class="form-control" id="recargos">
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
                        <th scope="col">Nombre</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Direccion Origen</th>
                        <th scope="col">Referencia Origen</th>
                        <th scope="col">Coordenadas</th>
                        <th scope="col">Fecha Solicitud</th>
                        <th scope="col">Fecha Alta</th>
                        <th scope="col">Direccion Destino</th>
                        <th scope="col">Referencia</th>
                        <th scope="col">Coordenadas</th>
                        <th scope="col">Alta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->idclientes }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ $cliente->direccionOrigen }}</td>
                            <td>{{ $cliente->referenciaOrigen }}</td>
                            <td>{{ $cliente->latitudOrigen }} {{ $cliente->longitudOrigen }}</td>
                            <td>{{ $cliente->fechasolicitud }}</td>
                            <td>{{ $cliente->fecha_alta }}</td>
                            <td>{{ $cliente->direccionDestino }}</td>
                            <td>{{ $cliente->referenciaDestino }}</td>
                            <td>{{ $cliente->latitudDestino }} {{ $cliente->longitudDestino }}</td>
                            @if (!$cliente->fecha_alta)
                                <td>
                                    <button class="btn btn-success seleccionarCliente"
                                        idreservacion="{{ $cliente->idreservacion }}">Dar de alta</button>
                                </td>
                                @else
                                <td>
                                    <button class="btn btn-warning">Antendida</button>
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

        $('#divPrincipal').on('click', '.seleccionarCliente', function() {
            $('#modalReservacion').modal('show');
            $('#btnRegistrar').val($(this).attr('idreservacion'));
        });

        $('#divPrincipal').on('click', '.btn-danger', function() {
            $('#modalReservacion').modal('hide');
        });

        $('#divPrincipal').on('click', '.btn-secondary', function() {
            $('#modalReservacion').modal('hide');
        });

        $('#divPrincipal').on('click', '#btnRegistrar', function() {

            var reservacion = new Object();

            reservacion.idreservacion = $(this).val();
            reservacion.costoKilometro = $('#costoKilometro').val();
            reservacion.kilometrosReocrridos = $('#kilometro').val();
            reservacion.recargos = $('#recargos').val();

            $.ajax({
                url: 'registrarReservacion',
                type: 'post',
                data: reservacion,
                success: function(data) {
                    console.log(data);
                    if (data.error == 0) {
                        var pre = document.createElement('pre');
                        //custom style.
                        pre.style.maxHeight = "400px";
                        pre.style.margin = "0";
                        pre.style.padding = "24px";
                        pre.style.whiteSpace = "pre-wrap";
                        pre.style.textAlign = "justify";
                        pre.appendChild(document.createTextNode('Cliente dado de alta'));
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
