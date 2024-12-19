@extends('layouts.painel')

@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-lg-8">
            <div class="card rounded-3 border-1 shadow-sm mt-5">
                <div class="card-body">
                    <h2 class="text-center mb-4">Cadastro de um Novo Agendamento</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Por favor, corrija os seguintes erros:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <hr>
                    <form action="{{ route('agendamento.store') }}" method="POST">
                        @csrf
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="inicio" class="form-label">Início:</label>
                                <input type="datetime-local" name="inicio" id="inicio" class="form-control" required
                                    value="{{ old('inicio') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="fim" class="form-label">Fim:</label>
                                <input type="datetime-local" name="fim" id="fim" class="form-control" required
                                    value="{{ old('fim') }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="pet_id" class="form-label">Pet</label>
                            <select name="pet_id" id="pet_id" class="form-select" required>
                                <option value="">Selecione o Pet</option>
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
                                        {{ $pet->nome }} (Tutor: {{ $pet->tutor->nome }})
                                    </option>
                                @endforeach
                            </select>
                            @error('pet_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <input type="hidden" name="status" id="status" value="agendado">
                            </div>
                            <div class="col-md-12">
                                <label for="preco_final" class="form-label">Preço Final</label>
                                <input type="number" name="preco_final" id="preco_final" class="form-control" required
                                    step="0.01" min="0" value="{{ old('preco_final') }}">
                                <small class="text-muted">Digite o preço final do agendamento</small>
                                @error('preco_final')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('agendamento.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
