<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/categorias', [\App\Http\Controllers\CategoriasController::class, 'index']);
Route::post('/categorias/{categoria}', [\App\Http\Controllers\CategoriasController::class, 'create']);

Route::get('/estabelecimentos', [\App\Http\Controllers\EstabelecimentosController::class, 'index']);
Route::get('/estabelecimentos/{title}', [\App\Http\Controllers\EstabelecimentosController::class, 'show']);
Route::post('/estabelecimentos', [\App\Http\Controllers\EstabelecimentosController::class, 'store']);

Route::get('/produtos', [\App\Http\Controllers\ProdutosController::class, 'index']);
Route::get('/produtos/{title}', [\App\Http\Controllers\ProdutosController::class, 'show']);
Route::post('/produtos', [\App\Http\Controllers\ProdutosController::class, 'store']);

Route::get('/pedidos', [\App\Http\Controllers\PedidosController::class, 'index']);
Route::get('/pedidos/{title}', [\App\Http\Controllers\PedidosController::class, 'show']);
Route::post('/pedidos', [\App\Http\Controllers\PedidosController::class, 'store']);
/*Route::get('/produtos', function (Request $request) {
    return \App\Models\Produtos::all();
});

Route::get('/pedidos/{produto}', function (Request $request) {
    return \App\Models\Pedidos::all();
});*/
