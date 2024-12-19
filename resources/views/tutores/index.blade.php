@extends("layouts.painel")

@section("content")
<div class="container">
    <div class="row d-flex justify-content-center align-items-center mb-4">
        <div class="col-lg-12">
            <div class="card rounded-1 shadow-sm border-1">
                <div class="card-body">
                    <p class="text-center display-5 font-weight-bold">Gestão de Tutores</p>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('tutor.create') }}" class="btn btn-md btn-primary" role="button">
                            Cadastrar um novo Tutor
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    <div class="row d-flex justify-content-center align-items-center mt-5">
        <div class="col-lg-12">
            <div class="card rounded-1 shadow-sm border-1">
                <div class="card-body">
                    <p class="text-center font-weight-bold">Lista de Tutores</p>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="searchInput"
                            placeholder="Pesquise por nome, email ou telefone" onkeyup="searchTable()">
                    </div>

                    <table id="tutorTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Pets</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($tutores->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center">Não há Tutores cadastrados no sistema</td>
                                </tr>
                            @else
                                @foreach($tutores as $tutor)
                                    <tr>
                                        <td>
                                        <img src="{{ asset('storage/' . $tutor->foto_perfil) }}" alt="Foto do Tutor" width="100"
                                        height="100" class="img-thumbnail rounded-circle">
                                        </td>
                                        <td>{{ $tutor->id }}</td>
                                        <td>{{ $tutor->nome }}</td>
                                        <td>{{ $tutor->email }}</td>
                                        <td>{{ $tutor->telefone }}</td>
                                        <td>
                                            @if($tutor->pets->isEmpty())
                                                <span>Não há pets cadastrados</span>
                                            @else
                                                @foreach($tutor->pets as $pet)
                                                    <span class="badge bg-secondary">{{ $pet->nome }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('tutor.edit', $tutor->id) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i> Editar
                                            </a>

                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $tutor->id }}">
                                                <i class="bi bi-trash"></i> Apagar
                                            </button>

                                            <!-- Modal de Exclusão -->
                                            <div class="modal fade" id="deleteModal{{ $tutor->id }}" tabindex="-1"
                                                aria-labelledby="deleteModalLabel{{ $tutor->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel{{ $tutor->id }}">
                                                                Confirmar Exclusão</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Tem certeza de que deseja excluir o tutor
                                                            <strong>{{ $tutor->nome }}</strong>? Essa ação não poderá ser
                                                            desfeita.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('tutor.delete', $tutor->id) }}"
                                                                method="POST">
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
        table = document.getElementById("tutorTable");
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