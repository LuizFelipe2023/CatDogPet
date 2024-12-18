<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\PetController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('tutor')->group(function(){
       Route::get('/',[TutorController::class,'index'])->name('tutor.index');
       Route::get('/{id}',[TutorController::class,'showTutor'])->name("tutor.show");
       Route::get("/create",[TutorController::class,"createTutor"])->name("tutor.create");
       Route::post("/store",[TutorController::class,"storeTutor"])->name("tutor.store");
       Route::get("/edit/{id}",[TutorController::class,"editTutor"])->name("tutor.edit");
       Route::put("/update/{id}",[TutorController::class,"updateTutor"])->name("tutor.update");
       Route::delete("/delete/{id}",[TutorController::class,"deleteTutor"])->name("tutor.delete");
});

Route::prefix("pet")->group(function(){
      Route::get("/",[PetController::class,'index'])->name("pet.index");
      Route::get("/{id}",[PetController::class,"showPet"])->name("pet.show");
      Route::get("/create",[PetController::class,"createPet"])->name("pet.create");
      Route::post("/store",[PetController::class,"storePet"])->name("pet.store");
      Route::get("/edit/{id}",[PetController::class,"editPet"])->name("pet.edit");
      Route::put("/update/{id}",[PetController::class,"updatePet"])->name("pet.update");
      Route::delete("/delete/{id}",[PetController::class,"deletePet"])->name("pet.delete");
});


