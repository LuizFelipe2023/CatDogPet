<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\Agendamento_Servico;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Servico;
use App\Models\Pet;
use App\Models\Tutor;

class AgendamentoController extends Controller
{
    private function validateRules(Request $request)
    {
        return $request->validate([
            'inicio' => 'required|date',
            'fim' => 'required|date',
            'pet_id' => 'required|exists:pets,id',
            'status' => 'nullable|in:agendado,cancelado,finalizado',
        ], [
            'inicio.required' => 'O campo Início é obrigatório e deve ser uma data válida.',
            'inicio.date' => 'O campo Início deve ser uma data válida.',
            'fim.required' => 'O campo Fim é obrigatório e deve ser uma data válida.',
            'fim.date' => 'O campo Fim deve ser uma data válida.',
            'pet_id.required' => 'Selecione um pet válido.',
            'pet_id.exists' => 'O pet selecionado não existe.',
            'status.in' => 'O status deve ser um dos seguintes: agendado, cancelado ou finalizado.'
        ]);
    }


    public function index()
    {
        $agendamentos = Agendamento::with('servicos')->get();
        return view('agendamentos.index', compact('agendamentos'));
    }

    public function create()
    {
        $servicos = Servico::all();
        $pets = Pet::with('tutor')->get();
        return view('agendamentos.createAgendamento', compact('servicos', 'pets'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateRules($request);
        } catch (ValidationException $e) {

        } catch (Exception $e) {

        }
    }

}
