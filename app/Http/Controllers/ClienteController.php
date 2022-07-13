<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Alta_reservacion;
use App\Models\Reservacion;

class ClienteController extends Controller
{
    public function clientes()
    {
        $clientes = Cliente::join('direccion', 'direccion.iddireccion', 'clientes.idclientes')
            ->join('reservacion', 'reservacion.idcliente', 'clientes.idclientes')
            ->get();


        return view('clientes.cliente', ['clientes' => $clientes]);
    }

    public function registrarReservacion(Request $request)
    {

        try {

            DB::beginTransaction();

            $alta_reservacion = new Alta_reservacion;

            $alta_reservacion->costoKilometro = $request->costoKilometro;
            $alta_reservacion->kilometrosReocrridos = $request->kilometrosReocrridos;
            $alta_reservacion->recargos = $request->recargos;
            $alta_reservacion->idreservacion = $request->idreservacion;

            $alta_reservacion->save();

            $vehiculo = Reservacion::find($request->idreservacion);

            $vehiculo->fecha_alta =  date('Y-m-d H:i:s');
            $vehiculo->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return ['error' => 1, 'mensaje' => $th];
        }
        return ['error' => 0, 'mensaje' => 'Registro exitoso'];
    }
}
