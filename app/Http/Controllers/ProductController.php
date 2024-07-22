<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateProductImageRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Product::all();
        return Inertia::render("index", [
            "productos" => $productos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("createProduct");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $archivo = $request->file("imagen");
        $archivoExtension = $archivo->getClientOriginalExtension();
        $nombreArchivo = Str::random(20); //Genera una cadena de texto con carácteres aleatorios
        $nombreArchivo = "$nombreArchivo.$archivoExtension";
        
        $nuevoProducto = Product::create([
            "codigo" => $request->codigo,
            "nombre" => $request->nombre,
            "imagen" => $nombreArchivo,
            "cantidad" => $request->cantidad,
            "precio" => $request->precio
        ]);

        if ($nuevoProducto) {
            $archivo->move(public_path("uploads"), $nombreArchivo);
        }

        return redirect("/");
    }

    /**
     * Display the specified resource.
     */
    public function editProductImage(String $nombreProducto, Int $id)
    {
        return Inertia::render("editProductImage", [
            "nombreProducto" => $nombreProducto,
            "productoId" => $id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Int $id)
    {
        $producto = Product::find($id);

        if (!$producto) {
            return Inertia::render("errorPage", [

                "message" => "Este producto no existe."

            ]);
        }

        return Inertia::render("editProduct", [
            "producto" => $producto
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Int $id, UpdateProductRequest $request)
    {

        $producto = Product::find($id);

        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        $producto->save();

        return redirect("/");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Int $id)
    {
        $producto = Product::find($id);

        if (!$producto) {
            return Inertia::render("errorPage", [

                "message" => "Este producto no existe."

            ]);
        }

        $rutaImagen = public_path("uploads/$producto->imagen");

        if (File::exists($rutaImagen)){

            File::delete($rutaImagen);
            
        }

        $producto->delete();

        return redirect("/");
    }

    public function updateProductImage(Int $id, UpdateProductImageRequest $request){

        $producto = Product::find($id);

        if (!$producto) {
            return Inertia::render("errorPage", [

                "message" => "Este producto no existe."

            ]);
        }

        $rutaImagen = public_path("uploads/$producto->imagen");

        if (File::exists($rutaImagen)){

            File::delete($rutaImagen);
            
        }

        $archivo = $request->file("imagen");
        $archivoExtension = $archivo->getClientOriginalExtension();
        $nombreArchivo = Str::random(20);
        $nombreArchivo = "$nombreArchivo.$archivoExtension";

        $archivo->move(public_path("uploads"), $nombreArchivo);
        
        $producto->imagen = $nombreArchivo;
        $producto->save();

        return redirect("/");

    }
}