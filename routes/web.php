<?php
declare(strict_types=1);
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::resource("pet", PetController::class);
Route::get("/pet/{pet}/update", [PetController::class, 'updateViewPost'])
->name("pet.updateViewPost");
Route::post("/pet/{pet}/update", [PetController::class, 'updatePost'])
->name("pet.updatePost");

Route::get("/", function () {
    return redirect(route("pet.index"), 301);
});
