@extends("layouts.painel")

@section("content")
<div class="container">
    <div class="row d-flex justify-content-evenly align-items-center">
        <div class="col-lg-12">
            <div class="card rounded-1 shadow-sm border-1">
                <div class="card-body">
                    <p class="text-center">Tutores</p>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-md btn-primary" type="button">Cadastrar um novo Tutor</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-evenly align-items-center mt-5">
        <div class="col-lg-12">
            <div class="card rounded-1 shadow-sm border-1">
                <div class="card-body">
                    <p class="text-center">Lista de Tutores</p>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="searchInput"
                            placeholder="Pesquise por nome, email ou telefone" onkeyup="searchTable()">
                    </div>

                    <form method="GET" id="filterForm" onsubmit="applyFilters(event)">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="filterNome">Nome</label>
                                <input type="text" class="form-control" id="filterNome" name="filterNome"
                                    placeholder="Filtrar por nome">
                            </div>
                            <div class="col">
                                <label for="filterEmail">Email</label>
                                <input type="email" class="form-control" id="filterEmail" name="filterEmail"
                                    placeholder="Filtrar por email">
                            </div>
                            <div class="col">
                                <label for="filterTelefone">Telefone</label>
                                <input type="text" class="form-control" id="filterTelefone" name="filterTelefone"
                                    placeholder="Filtrar por telefone">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-md btn-primary">Aplicar Filtros</button>
                        </div>
                    </form>

                    <table id="tutorTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th data-field="foto_perfil">Foto</th>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="nome" data-sortable="true">Nome</th>
                                <th data-field="email" data-sortable="true">Email</th>
                                <th data-field="telefone" data-sortable="true">Telefone</th>
                                <th data-field="acao">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($tutores->isEmpty())
                                <tr>
                                    <td colspan="10" class="text-center">Não há Tutores cadastrados no sistema</td>
                                </tr>
                            @else
                                @foreach($tutores as $tutor)
                                    <tr>
                                        <td>
                                            <img src="{{ $tutor->foto_perfil }}" alt="Foto do Pet" width="100" height="100"
                                                class="img-thumbnail">
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
                                                    <span>{{ $pet->nome }}</span>
                                                @endforeach
                                            @endif
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

    function applyFilters(event) {
        event.preventDefault();

        var nomeFilter = document.getElementById("filterNome").value.toUpperCase();
        var emailFilter = document.getElementById("filterEmail").value.toUpperCase();
        var telefoneFilter = document.getElementById("filterTelefone").value.toUpperCase();

        var table, tr, td, i, j, txtValue;
        table = document.getElementById("tutorTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            var showRow = true;

            if (td[1]) {
                txtValue = td[1].textContent || td[1].innerText;
                if (nomeFilter && txtValue.toUpperCase().indexOf(nomeFilter) === -1) {
                    showRow = false;
                }
            }

            if (td[2]) {
                txtValue = td[2].textContent || td[2].innerText;
                if (emailFilter && txtValue.toUpperCase().indexOf(emailFilter) === -1) {
                    showRow = false;
                }
            }

            if (td[3]) {
                txtValue = td[3].textContent || td[3].innerText;
                if (telefoneFilter && txtValue.toUpperCase().indexOf(telefoneFilter) === -1) {
                    showRow = false;
                }
            }

            if (showRow) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
</script>
@endsection