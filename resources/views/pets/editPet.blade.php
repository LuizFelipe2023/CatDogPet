@extends("layouts.painel")

@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-lg-8">
            <div class="card rounded-3 border-1 shadow-sm mt-5">
                <div class="card-body">
                    <h2 class="text-center mb-4">Atualizar um Pet</h2>

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

                    <form action="{{ route('pet.update', $pet->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome do Pet</label>
                                <input type="text" name="nome" id="nome" class="form-control"
                                    placeholder="Digite o nome do pet" required value="{{ old('nome', $pet->nome) }}">
                                @error('nome')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="raca" class="form-label">Raça</label>
                                <input type="text" name="raca" id="raca" class="form-control"
                                    placeholder="Digite a raça do pet" required value="{{ old('raca', $pet->raca) }}">
                                @error('raca')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="porte" class="form-label">Porte</label>
                                <select name="porte" id="porte" class="form-select" required>
                                    <option value="">Selecione o porte do pet</option>
                                    <option value="gigante" {{ old('porte', $pet->porte) == 'gigante' ? 'selected' : '' }}>Gigante</option>
                                    <option value="grande" {{ old('porte', $pet->porte) == 'grande' ? 'selected' : '' }}>
                                        Grande</option>
                                    <option value="medio" {{ old('porte', $pet->porte) == 'medio' ? 'selected' : '' }}>
                                        Médio</option>
                                    <option value="pequeno" {{ old('porte', $pet->porte) == 'pequeno' ? 'selected' : '' }}>Pequeno</option>
                                    <option value="mini" {{ old('porte', $pet->porte) == 'mini' ? 'selected' : '' }}>Mini
                                    </option>
                                </select>
                                @error('porte')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="peso" class="form-label">Peso (em gramas)</label>
                                <input type="number" name="peso" id="peso" class="form-control"
                                    placeholder="Digite o peso do pet" step="0.001" min="0" required
                                    value="{{ old('peso', $pet->peso) }}">
                                <small class="text-muted">Digite o peso em gramas (exemplo: 0.500 para 500g)</small>
                                @error('peso')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="altura" class="form-label">Altura</label>
                                <input type="number" name="altura" id="altura" class="form-control"
                                    placeholder="Digite a altura do pet" required
                                    value="{{ old('altura', $pet->altura) }}">
                                @error('altura')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tutor_id" class="form-label">Tutor</label>
                                <select name="tutor_id" id="tutor_id" class="form-select" required>
                                    <option value="">Selecione o Tutor</option>
                                    @foreach($tutores as $tutor)
                                        <option value="{{ $tutor->id }}" {{ old('tutor_id', $pet->tutor_id) == $tutor->id ? 'selected' : '' }}>{{ $tutor->nome }}</option>
                                    @endforeach
                                </select>
                                @error('tutor_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                            <input type="file" name="foto_perfil" id="foto_perfil" class="form-control"
                                accept="image/*">
                            <small class="text-muted">Formatos suportados: JPG, PNG. Tamanho máximo: 2MB.</small>
                            @if($pet->foto_perfil)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $pet->foto_perfil) }}" alt="Foto de Perfil"
                                        class="img-thumbnail" width="100">
                                </div>
                            @endif
                            @error('foto_perfil')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pet.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection