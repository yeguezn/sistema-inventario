<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;

Route::controller(ProductController::class)->group(function(){
    Route::get("/", "index");
    Route::get("/create-product", "create");
    Route::post("/store-product", "store");
    Route::get("/edit-product/{id}", "edit");
    Route::put("/update-product/{id}", "update");
    Route::delete("/delete-product/{id}", "destroy");
    Route::get("/edit-productImage/{nombreProducto}/{id}", "editProductImage");
    Route::post("/update-productImage/{id}", "updateProductImage");
});

Route::controller(SaleController::class)->group(function(){
    Route::get("/sale-product/{nombreProducto}/{productoId}", "index");
    Route::post("/finish-sale/{productoId}", "store");
});
