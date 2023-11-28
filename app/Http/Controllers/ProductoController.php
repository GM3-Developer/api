<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ValidatedInput;

class ProductoController extends Controller
{
    public function consulta(){
        try {
            $listado = Producto::query()->join(
                'proveedor',
                'producto.id_proveedor',
                '=',
                'proveedor.id_proveedor'
            )->select(
                'producto.*',
                'proveedor.nombre'
            )->get();
    
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
                'marca' => 'required',
                'modelo' => 'required',
                'tipo_producto' => 'required',
                'precio_costo' => 'required',
                'precio_unitario' => 'required',
                'precio_mayoreo' => 'required',
                'id_proveedor' => 'required',
            ]);

            if ($validacion->fails()) {
                return response()->json([
                    'success'=> false,
                    'data' => 'Faltan campos requeridos',
                    'result' => $validacion->messages()
                ]);
            }else{
                $resultado = Producto::create($request->all());

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
                'marca' => 'required',
                'modelo' => 'required',
                'tipo_producto' => 'required',
                'precio_costo' => 'required',
                'precio_unitario' => 'required',
                'precio_mayoreo' => 'required',
                'id_proveedor' => 'required'
            ]);

            if ($validacion->fails()) {
                return response()->json([
                    'success'=> false,
                    'data' => 'Faltan campos requeridos',
                    'result' => $validacion->messages()
                ]);
            }else{
                $productoEncontrado = Producto::find($id);

                if ($productoEncontrado) {

                    $productoEncontrado->marca = $request->marca;
                    $productoEncontrado->modelo = $request->modelo;
                    $productoEncontrado->tipo_producto = $request->tipo_producto;
                    $productoEncontrado->precio_costo = $request->precio_costo;
                    $productoEncontrado->precio_unitario = $request->precio_unitario;
                    $productoEncontrado->precio_mayoreo = $request->precio_mayoreo;
                    $productoEncontrado->id_proveedor = $request->id_proveedor;

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
            
            $productoEncontrado = Producto::find($id);

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
