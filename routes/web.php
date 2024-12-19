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

Route::prefix('tutor')->group(function () {
    Route::get('/', [TutorController::class, 'index'])->name('tutor.index'); // Lista todos os tutores
    Route::get('/create', [TutorController::class, 'createTutor'])->name('tutor.create'); // Formulário de criação
    Route::post('/store', [TutorController::class, 'storeTutor'])->name('tutor.store'); // Salvar novo tutor
    Route::get('/{id}', [TutorController::class, 'showTutor'])->name('tutor.show'); // Exibe detalhes de um tutor
    Route::get('/edit/{id}', [TutorController::class, 'editTutor'])->name('tutor.edit'); // Formulário de edição
    Route::put('/update/{id}', [TutorController::class, 'updateTutor'])->name('tutor.update'); // Atualizar tutor
    Route::delete('/delete/{id}', [TutorController::class, 'destroyTutor'])->name('tutor.delete'); // Deletar tutor
});

Route::get('/pets', [PetController::class, 'index'])->name('pet.index');
Route::get('/pets/create', [PetController::class, 'createPet'])->name('pet.create');
Route::post('/pets', [PetController::class, 'storePet'])->name('pet.store');
Route::get('/pets/{id}', [PetController::class, 'showPet'])->name('pet.show');
Route::get('/pets/{id}/edit', [PetController::class, 'editPet'])->name('pet.edit');
Route::put('/pets/{id}', [PetController::class, 'updatePet'])->name('pet.update');
Route::delete('/pets/{id}', [PetController::class, 'deletePet'])->name('pet.delete');


