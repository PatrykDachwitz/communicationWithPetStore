<?php
declare(strict_types=1);
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::resource("pet", PetController::class);

Route::get("/", function () {
    return redirect(route("pet.index"), 301);
});
