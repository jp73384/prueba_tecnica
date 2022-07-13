@extends('master.master')
@section('name')
    <div class="col-lg-6 col-xxl-4 mb-5">
        <div class="card bg-light border-0 h-100">
            <a href="{{ Route('vehiculos') }}">
                <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4">
                        <img src="https://hqrentalsoftware.com/wp-content/uploads/2019/05/fleet-and-inventory-01.svg"
                            alt="" width="100%">
                    </div>
                    <h2 class="fs-4 fw-bold">Vehiculos</h2>
                    <p class="mb-0">Registro el mantenimiento de Vehiculos</p>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-6 col-xxl-4 mb-5">
        <div class="card bg-light border-0 h-100">
            <a href="{{Route('clientes')}}">
                <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                            class="bi bi-collection"></i>
                    </div>
                    <h2 class="fs-4 fw-bold">Usuarios</h2>
                    <p class="mb-0">Mantenimiento usuarios</p>
                </div>
            </a>
        </div>
    </div>
@endsection
