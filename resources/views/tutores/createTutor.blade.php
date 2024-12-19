@extends("layouts.painel")

@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-lg-8">
            <div class="card rounded-3 border-1 shadow-sm mt-5">
                <div class="card-body">
                    <h2 class="text-center mb-4">Cadastro de Novo Tutor</h2>
                    
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
                    <form action="{{ route('tutor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome completo" required value="{{ old('nome') }}">
                                @error('nome')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" name="telefone" id="telefone" class="form-control" placeholder="Digite o telefone" required value="{{ old('telefone') }}">
                                @error('telefone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Digite o e-mail" required value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Digite o endereço completo" required value="{{ old('endereco') }}">
                                @error('endereco')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                            <small class="text-muted">Formatos suportados: JPG, PNG. Tamanho máximo: 2MB.</small>
                            @error('foto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('tutor.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
