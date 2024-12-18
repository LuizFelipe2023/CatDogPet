@extends("layouts.painel")

@section("content")
<div class="container">
    <div class="row d-flex justify-content-evenly align-items-center">
        <div class="col-lg-12">
            <div class="card rounded-1 shadow-sm border-1">
                <div class="card-body">
                    <p class="text-center">Pets</p>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-md btn-primary" type="button">Cadastrar um novo Pet</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-evenly align-items-center mt-5">
        <div class="col-lg-12">
            <div class="card rounded-1 shadow-sm border-1">
                <div class="card-body">
                    <p class="text-center">Lista de Pets</p>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="searchInput"
                            placeholder="Pesquise por nome, raça, porte, peso ou altura" onkeyup="searchTable()">
                    </div>
                    <form method="GET" id="filterForm" onsubmit="applyFilters(event)">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="filterNome">Nome</label>
                                <input type="text" class="form-control" id="filterNome" name="filterNome"
                                    placeholder="Filtrar por nome">
                            </div>
                            <div class="col">
                                <label for="filterRaca">Raça</label>
                                <input type="text" class="form-control" id="filterRaca" name="filterRaca"
                                    placeholder="Filtrar por raça">
                            </div>
                            <div class="col">
                                <label for="filterPorte">Porte</label>
                                <input type="text" class="form-control" id="filterPorte" name="filterPorte"
                                    placeholder="Filtrar por porte">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-md btn-primary">Aplicar Filtros</button>
                        </div>
                    </form>
                    <table id="petTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th data-field="foto_perfil">Foto</th>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="nome" data-sortable="true">Nome</th>
                                <th data-field="raca" data-sortable="true">Raça</th>
                                <th data-field="porte" data-sortable="true">Porte</th>
                                <th data-field="peso" data-sortable="true">Peso</th>
                                <th data-field="altura" data-sortable="true">Altura</th>
                                <th data-field="tutor">Tutor</th>
                                <th data-field="acao">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($pets->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center">Não há Pets cadastrados no sistema</td>
                                </tr>
                            @else
                                @foreach($pets as $pet)
                                    <tr>
                                        <td>
                                            <img src="{{ $pet->foto_perfil }}" alt="Foto do Pet" width="100" height="100" class="img-thumbnail">
                                        </td>
                                        <td>{{ $pet->id }}</td>
                                        <td>{{ $pet->nome }}</td>
                                        <td>{{ $pet->raca }}</td>
                                        <td>{{ $pet->porte }}</td>
                                        <td>{{ $pet->peso }}</td>
                                        <td>{{ $pet->altura }}</td>
                                        <td>{{ $pet->tutor->nome }}</td>
                                        <td>
                                            <a href="{{ route('pet.edit', $pet->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                            <a href="{{ route('pet.delete', $pet->id) }}" class="btn btn-danger btn-sm">Excluir</a>
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

    function applyFilters(event) {
        event.preventDefault();

        var nomeFilter = document.getElementById("filterNome").value.toUpperCase();
        var racaFilter = document.getElementById("filterRaca").value.toUpperCase();
        var porteFilter = document.getElementById("filterPorte").value.toUpperCase();

        var table, tr, td, i, j, txtValue;
        table = document.getElementById("petTable");
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
                if (racaFilter && txtValue.toUpperCase().indexOf(racaFilter) === -1) {
                    showRow = false;
                }
            }

            if (td[3]) {
                txtValue = td[3].textContent || td[3].innerText;
                if (porteFilter && txtValue.toUpperCase().indexOf(porteFilter) === -1) {
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
