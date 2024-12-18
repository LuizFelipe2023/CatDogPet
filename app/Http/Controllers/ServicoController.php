<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ServicoController extends Controller
{
    private function validateRules(Request $request)
    {
        return $request->validate([
            "nome" => "required|string|max:500",
            "descricao" => "required|string|max:1000",
            "valor_base" => "required|numeric|min:0.01"
        ], [
            "nome.required" => "O campo nome é obrigatório.",
            "nome.string" => "O campo nome deve ser um texto válido.",
            "nome.max" => "O campo nome deve ter no máximo 500 caracteres.",

            "descricao.required" => "O campo descrição é obrigatório.",
            "descricao.string" => "O campo descrição deve ser um texto válido.",
            "descricao.max" => "O campo descrição deve ter no máximo 1000 caracteres.",

            "valor_base.required" => "O campo valor base é obrigatório.",
            "valor_base.numeric" => "O campo valor base deve ser numérico.",
            "valor_base.min" => "O valor base deve ser maior ou igual a 0,01."
        ]);
    }

    public function index()
    {
        $servicos = Servico::all();
        return view("servicos.index", ["servicos" => $servicos]);
    }

    public function createServico()
    {
        return view("servicos.createServico");
    }

    public function storeServico(Request $request)
    {
        try {
            $validatedData = $this->validateRules($request);

            $servico = Servico::create($validatedData);

            if (!$servico) {
                return redirect()->back()->withErrors([
                    "servico" => "Houve um erro ao criar um novo serviço."
                ]);
            }

            return redirect()->route("servicos.index")->with("success", "Serviço criado com sucesso!");
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                "error" => "Ocorreu um erro inesperado: " . $e->getMessage()
            ])->withInput();
        }
    }

    public function showServico($id)
    {
        try {
            $servico = Servico::findOrFail($id);
            return view("servicos.showServico", ["servico" => $servico]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route("servicos.index")->withErrors([
                "error" => "Serviço não encontrado."
            ]);
        }
    }

    public function editServico($id)
    {
        try {
            $servico = Servico::findOrFail($id);
            return view("servicos.editServico", ["servico" => $servico]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route("servicos.index")->withErrors([
                "error" => "Serviço não encontrado."
            ]);
        }
    }

    public function updateServico(Request $request, $id)
    {
        try {
            $servico = Servico::findOrFail($id);
            $validatedData = $this->validateRules($request);

            $updated = $servico->update($validatedData);

            if (!$updated) {
                return redirect()->back()->withErrors([
                    "servico" => "Houve um erro ao atualizar o serviço."
                ])->withInput();
            }

            return redirect()->route("servicos.index")->with("success", "Serviço atualizado com sucesso!");
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (ModelNotFoundException $e) {
            return redirect()->route("servicos.index")->withErrors([
                "error" => "Serviço não encontrado."
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                "error" => "Ocorreu um erro inesperado: " . $e->getMessage()
            ])->withInput();
        }
    }

    public function destroyServico($id)
    {
        try {
            $servico = Servico::findOrFail($id);
            $deleted = $servico->delete();

            if (!$deleted) {
                return redirect()->route("servicos.index")->withErrors([
                    "servico" => "Houve um erro ao excluir o serviço."
                ]);
            }

            return redirect()->route("servicos.index")->with("success", "Serviço excluído com sucesso!");
        } catch (ModelNotFoundException $e) {
            return redirect()->route("servicos.index")->withErrors([
                "error" => "Serviço não encontrado."
            ]);
        } catch (\Exception $e) {
            return redirect()->route("servicos.index")->withErrors([
                "error" => "Ocorreu um erro inesperado: " . $e->getMessage()
            ]);
        }
    }
}
