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
        /* 
        return view('welcome', ['vehiculos' => $vehiculo]); */
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_vehiculo' => 'required|unique:vehiculo|string|max:255',
            'descripcion' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Mensaje' => 'Error al crear el vehículo',
                'Error' => $validator->errors(),
            ], 400);
        }

        $vehiculo = Vehiculo::create([
            'nombre_vehiculo' => $request->nombre_vehiculo,
            'descripcion' => $request->descripcion,
        ]);

        return response()->json([
            'Mensaje' => 'Vehiculo creado correctamente',
            'Vehiculo' => $vehiculo,
        ], 200);

        /* return redirect()->route('vehiculo.index'); */
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
            'nombre_vehiculo' => 'sometimes|unique:vehiculo|string|max:255',
            'descripcion' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Mensaje' => 'Error al actualizar el vehículo',
                'Error' => $validator->errors(),
            ]);
        }

        $vehiculo->update([
            'nombre_vehiculo' => $request->nombre_vehiculo ?? $vehiculo->nombre_vehiculo,
            'descripcion' => $request->descripcion ?? $vehiculo->descripcion,
        ]);

        return response()->json([
            'Mensaje' => 'Vehiculo actualizado con éxito',
            'Vehículo' => $vehiculo,
        ]);

        /* return redirect()->route('vehiculo.index'); */
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

        /* return redirect()->route('vehiculo.index'); */
    }
}
