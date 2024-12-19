<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Tutor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Storage;

class TutorController extends Controller
{
    private function validateRules(Request $request, $id = null)
    {
        $rules = [
            "nome" => "required|string|max:500",
            "telefone" => "required|string",
            "email" => "required|email|unique:tutores,email," . ($id ?? "NULL") . "|max:255", // Ignora email único ao editar
            "endereco" => "required|string|max:500",
            "foto_perfil" => "nullable|image|mimes:jpeg,png,jpg,gif|max:10240",
        ];

        $messages = [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O nome deve ser uma string.',
            'nome.max' => 'O nome deve ter no máximo 500 caracteres.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.string' => 'O telefone deve ser uma string.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O email deve ser válido.',
            'email.unique' => 'Este email já está em uso.',
            'email.max' => 'O email não pode ter mais de 255 caracteres.',
            'endereco.required' => 'O campo endereço é obrigatório.',
            'endereco.string' => 'O endereço deve ser uma string.',
            'endereco.max' => 'O endereço não pode ter mais de 500 caracteres.',
            'foto_perfil.image' => 'A foto de perfil deve ser uma imagem.',
            'foto_perfil.mimes' => 'A foto de perfil deve ser nos formatos: jpeg, png, jpg, gif.',
            'foto_perfil.max' => 'A foto de perfil não pode ter mais de 10 MB.',
        ];

        return $request->validate($rules, $messages);
    }

    public function index()
    {
        $tutores = Tutor::with("pets")->get();
        return view("tutores.index", compact("tutores"));
    }

    public function showTutor($id)
    {
        try {
            $tutor = Tutor::findOrFail($id);
            return view("tutores.showTutor", compact('tutor'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('tutor.index')->withErrors(['error' => 'Tutor não encontrado.']);
        }
    }

    public function createTutor()
    {
        return view("tutores.createTutor");
    }

    public function storeTutor(Request $request)
    {
        try {
            $validatedData = $this->validateRules($request);

            if ($request->hasFile('foto_perfil')) {
                $fotoPerfilPath = $request->file('foto_perfil')->store('public/fotos');
                $validatedData['foto_perfil'] = $fotoPerfilPath;
            }

            Tutor::create($validatedData);

            return redirect()->route('tutor.index')->with('success', 'Tutor criado com sucesso!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ocorreu um erro inesperado: ' . $e->getMessage()])->withInput();
        }
    }

    public function editTutor($id)
    {
        try {
            $tutor = Tutor::findOrFail($id);
            return view("tutores.editTutor", compact("tutor"));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('tutor.index')->withErrors(['error' => 'Tutor não encontrado.']);
        }
    }

    public function updateTutor(Request $request, $id)
    {
        try {
            $validatedData = $this->validateRules($request, $id);
            $tutor = Tutor::findOrFail($id);

            if ($request->hasFile('foto_perfil')) {
                if ($tutor->foto_perfil && Storage::exists($tutor->foto_perfil)) {
                    Storage::delete($tutor->foto_perfil);
                }

                $fotoPerfilPath = $request->file('foto_perfil')->store('public/fotos');
                $validatedData['foto_perfil'] = $fotoPerfilPath;
            }

            $tutor->update($validatedData);

            return redirect()->route('tutor.index')->with('success', 'Tutor atualizado com sucesso!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (ModelNotFoundException $e) {
            return redirect()->route('tutor.index')->withErrors(['error' => 'Tutor não encontrado.']);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ocorreu um erro inesperado: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroyTutor($id)
    {
        try {
            $tutor = Tutor::findOrFail($id);

            if ($tutor->foto_perfil && Storage::exists($tutor->foto_perfil)) {
                Storage::delete($tutor->foto_perfil);
            }

            $tutor->delete();

            return redirect()->route('tutor.index')->with('success', 'Tutor deletado com sucesso!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('tutor.index')->withErrors(['error' => 'Tutor não encontrado.']);
        } catch (Exception $e) {
            return redirect()->route('tutor.index')->withErrors(['error' => 'Ocorreu um erro inesperado: ' . $e->getMessage()]);
        }
    }
}
