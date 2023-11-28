<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends Controller
{
    public function consulta(){
        try {
            $listado = Proveedor::all();
    
            return response()->json([
                'listado' => $listado
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error'=> $th->getMessage()
            ], 500);
        }
    }

    public function guardar(Request $request){
        try {
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
            ]);

            if ($validacion->fails()) {
                return response()->json([
                    'success'=> false,
                    'data' => 'Faltan campos requeridos',
                    'result' => $validacion->messages()
                ]);
            }else{
                $resultado = Proveedor::create($request->all());

                return response()->json([
                    'success'=> true,
                    'data' => 'Guardado correctamente',
                    'result' => $resultado
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error'=> $th->getMessage()
            ], 500);
        }
    }

    public function actualizar(Request $request, $id){
        try {
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
            ]);

            if ($validacion->fails()) {
                return response()->json([
                    'success'=> false,
                    'data' => 'Faltan campos requeridos',
                    'result' => $validacion->messages()
                ]);
            }else{
                $productoEncontrado = Proveedor::find($id);

                if ($productoEncontrado) {

                    $productoEncontrado->nombre = $request->nombre;

                    $resultado = $productoEncontrado->save();
                    return response()->json([
                        'success'=> true,
                        'data' => 'Guardado correctamente',
                        'result' => $resultado
                    ]);
                }else{
                    return response()->json([
                        'success'=> false,
                        'data' => 'Registro no encontrado',
                        'result' => $validacion->messages()
                    ], 204);
                }
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error'=> $th->getMessage()
            ], 500);
        }
    }

    public function eliminar($id){
        try {
            
            $productoEncontrado = Proveedor::find($id);

            if ($productoEncontrado) {

                $resultado = $productoEncontrado->delete();
                return response()->json([
                    'success'=> true,
                    'data' => 'Eliminado correctamente',
                    'result' => $resultado
                ]);
            }else{
                return response()->json([
                    'data' => 'Registro no encontrado',
                ], 204);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error'=> $th->getMessage()
            ], 500);
        }
    }
}
