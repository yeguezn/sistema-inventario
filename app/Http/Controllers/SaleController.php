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
    public function index(String $nombreProducto, Int $productoId){

        if (!Product::find($productoId)) {
            return Inertia::render("errorPage", [
                "message" => "Este producto no existe."
            ]);
        }

        return Inertia::render("saleProduct", [
            "productoId" => $productoId,
            "nombreProducto" => $nombreProducto
        ]);
    }

    public function store(Int $productoId, Request $request){

        $producto = Product::find($productoId);

        if (!$producto || $producto->cantidad <= 0) {
            
            return Inertia::render([
                "message" => "Producto no encontrado"
            ]);
        }

        if ($producto->cantidad < $request->cantidad) {
            
            return Inertia::render("errorPage", [
                "message" => "Cantidad no disponible"
            ]);
        }

        $requestData = [
            "producto" => $producto,
            "data" => $request
        ];

        Cache::lock("finalizar")->block(10, function() use($requestData){

            $persona = Person::where("cedula", $requestData["data"]->cedula)->first();

            if (!$persona) {
            
                $persona = Person::create([
                    "nombre" => $requestData["data"]->nombre,
                    "cedula" => $requestData["data"]->cedula,
                    "banco" => $requestData["data"]->banco,
                    "clave" => $requestData["data"]->clave
                ]);
            }

            $data = [
                "producto" => $requestData["producto"], 
                "persona" => $persona,
                "cantidad" => $requestData["data"]->cantidad
            ];

            return DB::transaction(function() use($data){

                sleep(5);
            
                $sale = Sale::create([
                    "fecha" => Carbon::now("America/Caracas")->toDateString(),
                    "person_id" => $data["persona"]->id,
                    "product_id" => $data["producto"]->id,
                    "cantidad" => $data["cantidad"]
                ]);

                $data["producto"]->cantidad = $data["producto"]->cantidad - $data["cantidad"];
                $data["producto"]->save();

                return $sale;

            });

        });

        return redirect("/");

    }
}
