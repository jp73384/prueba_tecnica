<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vehiculos;
use App\Models\Mantenimiento;
use App\Models\Reporte;
use App\Models\Asignacion_Mantenimiento;

class VehiculoController extends Controller
{
    public function vehiculos(){

        $vehiculos = Vehiculos::join('marcas', 'marcas.idmarcas', 'vehiculos.idmarcas')
        ->join('modelos', 'modelos.idmodelos', 'vehiculos.idmodelos')
        ->join('tipos', 'tipos.idtipos', 'vehiculos.idtipos')
        ->join('estado', 'estado.idestado', 'vehiculos.idestado')
        ->get();

        $mantenimientos = Mantenimiento::get();

        return view('vehiculos.vehiculos',[
            'vehiculos' => $vehiculos,
            'mantenimientos' => $mantenimientos
        ]);
    }

    public function registroReportes(Request $request){
        
        try {
            DB::beginTransaction();

            $reporte = new Reporte;

            $reporte->reporte = $request->descripcion;
            $reporte->idvehiculos = $request->idvehiculo;

            $reporte->save();

            for($i=0; $i<count($request->tipoMantenimiento); $i++){
                $asignacion = new Asignacion_Mantenimiento;
                $asignacion->idreportes = $reporte->idreportes;
                $asignacion->idmantenimientos = $request->tipoMantenimiento[$i]['idMantenimiento'];
                $asignacion->save();
            }

            $vehiculo = Vehiculos::find($request->idvehiculo);

            $vehiculo->idestado =  2;
            $vehiculo->save();


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return ['error'=>1, 'mensaje'=>$th];
        }

        return ['error'=>0, 'mensaje'=>'Registro exitoso'];

    }
}
