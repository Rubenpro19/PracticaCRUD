<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Validator;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculo = Vehiculo::all();
        return response()->json($vehiculo);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo_vehiculo' => 'required|string|max:255|min:5',
            'descripcion' => 'sometimes|string|max:255|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Mensaje' => 'Error al crear el vehículo',
                'Error' => $validator->errors(),
            ], 400);
        }

        $vehiculo = Vehiculo::create([
            'tipo_vehiculo' => $request->tipo_vehiculo,
            'descripcion' => $request->descripcion,
        ]);

        return response()->json([
            'Mensaje' => 'Vehiculo creado correctamente',
            'Vehiculo' => $vehiculo,
        ], 200);
    }

    public function show(string $id)
    {
        $vehiculo = Vehiculo::find($id);
        if (!$vehiculo) {
            return response()->json(['Mensaje' => 'Vehiculo no encontrado']);
        }

        return response()->json($vehiculo);
    }

    public function update(Request $request, string $id)
    {
        $vehiculo = Vehiculo::find($id);

        if (!$vehiculo) {
            return response()->json([
                'Mensaje' => 'Vehiculo no encontrado',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'tipo_vehiculo' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Mensaje' => 'Error al actualizar el vehículo',
                'Error' => $validator->errors(),
            ]);
        }

        $vehiculo->update([
            'tipo_vehiculo' => $request->tipo_vehiculo ?? $vehiculo->tipo_vehiculo,
            'descripcion' => $request->descripcion ?? $vehiculo->descripcion,
        ]);

        return response()->json([
            'Mensaje' => 'Vehiculo actualizado con éxito',
            'Vehículo' => $vehiculo,
        ]);
    }

    public function destroy(string $id)
    {
        $vehiculo = Vehiculo::find($id);

        if(!$vehiculo){
            return response()->json([
                'Mensaje' => 'Vehiculo no encontrado',
            ]);
        }

        $vehiculo->delete();
        return response()->json([
            'Mensaje' => 'Vehiculo eliminado correctamente',
        ]);
    }
}
