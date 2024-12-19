<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Models\Pet;
use App\Models\Tutor;

class PetController extends Controller
{
    private function validateRules(Request $request)
    {
        return $request->validate([
            'nome' => 'required|string|max:500',
            'raca' => 'required|string|max:500',
            'porte' => 'nullable|in:gigante,grande,medio,pequeno,mini',
            'peso' => 'nullable|numeric',
            'altura' => 'nullable|numeric',
            'tutor_id' => 'required|exists:tutores,id',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ], [
            'nome.required' => 'O nome do pet é obrigatório.',
            'nome.string' => 'O nome do pet deve ser uma string.',
            'nome.max' => 'O nome do pet não pode ter mais de 500 caracteres.',

            'raca.required' => 'A raça do pet é obrigatória.',
            'raca.string' => 'A raça do pet deve ser uma string.',
            'raca.max' => 'A raça do pet não pode ter mais de 500 caracteres.',

            'porte.in' => 'O porte do pet deve ser um dos seguintes: gigante, grande, medio, pequeno, mini.',
            'peso.numeric' => 'O peso do pet deve ser um número.',
            'altura.numeric' => 'A altura do pet deve ser um número.',

            'tutor_id.required' => 'O tutor do pet é obrigatório.',
            'tutor_id.exists' => 'O tutor informado não existe.',

            'foto_perfil.image' => 'A foto de perfil do pet deve ser uma imagem.',
            'foto_perfil.mimes' => 'A foto de perfil do pet deve ser nos formatos: jpeg, png, jpg, gif.',
            'foto_perfil.max' => 'A foto de perfil do pet não pode ter mais de 10 MB.',
        ]);
    }

    public function index()
    {
        $pets = Pet::all();
        return view("pets.index", ["pets" => $pets]);
    }

    public function showPet($id)
    {
        try {
            $pet = Pet::findOrFail($id);
            return view("pets.showPet", ["pet" => $pet]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pet.index')->withErrors(['error' => 'Pet não encontrado.']);
        }
    }

    public function createPet()
    {
        $tutores = Tutor::all();
        return view("pets.createPet", ['tutores' => $tutores]);
    }

    public function storePet(Request $request)
    {
        try {
            $validatedData = $this->validateRules($request);

            if ($request->hasFile('foto_perfil') && $request->file('foto_perfil')->isValid()) {
                $originalFileName = $request->foto_perfil->getClientOriginalName();
                $imagePath = $request->foto_perfil->storeAs('pet_images', $originalFileName, 'public');
                $validatedData['foto_perfil'] = $imagePath;
            }

            $pet = Pet::create($validatedData);

            if (!$pet) {
                return redirect()->back()->withErrors(['error' => 'Erro ao criar o pet.']);
            }

            return redirect()->route('pet.index')->with('success', 'Pet criado com sucesso!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator->errors())
                ->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ocorreu um erro inesperado: ' . $e->getMessage()]);
        }
    }


    public function editPet($id)
    {
        try {
            $tutores = Tutor::all();
            $pet = Pet::findOrFail($id);
            return view("pets.editPet", ["pet" => $pet, "tutores" => $tutores]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pet.index')->withErrors(['error' => 'Pet não encontrado.']);
        }
    }

    public function updatePet(Request $request, $id)
    {
        try {
            $validatedData = $this->validateRules($request);
            $pet = Pet::findOrFail($id);

            if ($request->hasFile('foto_perfil') && $request->file('foto_perfil')->isValid()) {
                if ($pet->foto_perfil && \Storage::exists('public/' . $pet->foto_perfil)) {
                    \Storage::delete('public/' . $pet->foto_perfil);
                }
                $originalFileName = $request->foto_perfil->getClientOriginalName();
                $imagePath = $request->foto_perfil->storeAs('pet_images', $originalFileName, 'public');
                $validatedData['foto_perfil'] = $imagePath;
            }

            $pet->update($validatedData);

            return redirect()->route('pets.index')->with('success', 'Pet atualizado com sucesso!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator->errors())
                ->withInput();
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pet.index')->withErrors(['error' => 'Pet não encontrado.']);
        } catch (Exception $e) {
            return redirect()->route('pet.index')->withErrors(['error' => 'Ocorreu um erro inesperado: ' . $e->getMessage()]);
        }
    }


    public function deletePet($id)
    {
        try {
            $pet = Pet::findOrFail($id);
            $pet->delete();
            return redirect()->route('pet.index')->with('success', 'Pet deletado com sucesso!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pet.index')->withErrors(['error' => 'Pet não encontrado.']);
        } catch (Exception $e) {
            return redirect()->route('pet.index')->withErrors(['error' => 'Ocorreu um erro inesperado: ' . $e->getMessage()]);
        }
    }
}
