@extends("layouts.painel")

@section("content")
<div class="container">
    <div class="row d-flex justify-content-center align-items-center mb-4">
        <div class="col-lg-12">
            <div class="card rounded-1 shadow-sm border-1">
                <div class="card-body">
                    <p class="text-center display-5 font-weight-bold">Gestão de Pets</p>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('pet.create') }}" class="btn btn-md btn-primary" role="button">
                            Cadastrar um novo Pet
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center align-items-center mt-5">
        <div class="col-lg-12">
            <div class="card rounded-1 shadow-sm border-1">
                <div class="card-body">
                    <p class="text-center font-weight-bold">Lista de Pets</p>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="searchInput"
                            placeholder="Pesquise por nome, raça ou porte" onkeyup="searchTable()">
                    </div>

                    <table id="petTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Raça</th>
                                <th>Porte</th>
                                <th>Peso</th>
                                <th>Altura</th>
                                <th>Tutor</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($pets->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center">Não há pets cadastrados no sistema</td>
                                </tr>
                            @else
                                @foreach($pets as $pet)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . $pet->foto_perfil) }}" alt="Foto do Pet"
                                                 class="img-thumbnail rounded-circle" style="max-width: 80px; height: auto;">
                                        </td>
                                        <td>{{ $pet->id }}</td>
                                        <td>{{ $pet->nome }}</td>
                                        <td>{{ $pet->raca }}</td>
                                        <td>{{ $pet->porte }}</td>
                                        <td>{{ $pet->peso }} kg</td>
                                        <td>{{ $pet->altura }} cm</td>
                                        <td>{{ $pet->tutor->nome }}</td>
                                        <td>
                                            <a href="{{ route('pet.edit', $pet->id) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i> Editar
                                            </a>

                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $pet->id }}">
                                                <i class="bi bi-trash"></i> Apagar
                                            </button>

                                            <div class="modal fade" id="deleteModal{{ $pet->id }}" tabindex="-1"
                                                aria-labelledby="deleteModalLabel{{ $pet->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel{{ $pet->id }}">
                                                                Confirmar Exclusão</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Tem certeza de que deseja excluir o pet
                                                            <strong>{{ $pet->nome }}</strong>? Essa ação não poderá ser
                                                            desfeita.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('pet.delete', $pet->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Apagar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function searchTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("petTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            for (var j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }
</script>
@endsection
