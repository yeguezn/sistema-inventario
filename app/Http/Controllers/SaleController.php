<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Person;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class SaleController extends Controller
{
    public function index(Int $productoId){

        if (!Product::find($productoId)) {
            return response()->json([
                "message" => "Este producto no existe."
            ]);
        }

        return Inertia::render("saleProduct", [
            "productoId" => $productoId
        ]);
    }

    public function store(Int $productoId, Request $request){

        $persona = Person::where("cedula", $request->cedula)
        ->get();

        if (!persona) {
            
            Person::create([
                "nombre" => $request->nombre,
                "cedula" => $request->cedula,
                "banco" => $request->banco,
                "clave" => $request->clave
            ]);
        }

        $producto = Product::find($productoId);

        if (!$producto || $producto->cantidad <= 0) {
            
            return response()->json([
                "message" => "Producto no encontrado"
            ], 404);
        }

        if ($request->cantidad > $producto->cantidad) {
            return response()->json([
                "message" => "No hay suficientes existencias del producto"
            ], 403);
        }

        Cache::lock("finalizar")->block(10, function() use($request){

            return DB::transaction(function() use($request){

                sleep(5);
            
                $sale = Sale::create([
                    "fecha" => Carbon::now("America/Caracas")->toDateString(),
                    "person_id" => $persona->id,
                    "producto_id" => $producto->id,
                    "cantidad" => $request->cantidad
                ]);

                $producto->cantidad = $producto->cantidad - $request->cantidad;
                $producto->save();

                return $sale;

            });

        });

    }
}
