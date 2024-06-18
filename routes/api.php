<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post("/auth/register",[UserController::class,'createUser'])->name("createUser");
Route::get("/tickets/na-placa-do-dev/{id}",[UserController::class,'searchTiket'])->name("searchTiket");


Route::get('phpmyinfo', function () {
    phpinfo(); 
})->name('phpmyinfo');

Route::get('/getfile/{name}', function ($name) {
    $media = User::where("photo",$name)->first();
    if ($media) {
        $valor = Storage::download("public/$media->photo");
        return $valor;
    }
    return response([
        'message' => 'File not found',
        'deuErro' => true,
    ], 200);
    
});

