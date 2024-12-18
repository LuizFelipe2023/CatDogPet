<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Servico;

class ServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Servico::factory()->create([
            "nome" => "Banho e Tosa",
            "descricao" => "Serviço de Limpeza e tosagem de Pet",
            "valor_base" => 60
        ]);

        Servico::factory()->create([
            "nome" => "Consulta Veterinária",
            "descricao" => "Consulta para check-up de saúde do pet",
            "valor_base" => 100
        ]);

        Servico::factory()->create([
            "nome" => "Vacinação",
            "descricao" => "Aplicação de vacinas para pets",
            "valor_base" => 80
        ]);

        Servico::factory()->create([
            "nome" => "Tosa Higiênica",
            "descricao" => "Serviço de tosagem higiênica para pets de pelo longo",
            "valor_base" => 50
        ]);

        Servico::factory()->create([
            "nome" => "Corte de Unhas",
            "descricao" => "Corte de unhas para cães e gatos",
            "valor_base" => 30
        ]);

        Servico::factory()->create([
            "nome" => "Check-up Completo",
            "descricao" => "Exames gerais para avaliar a saúde do pet",
            "valor_base" => 150
        ]);

        Servico::factory()->create([
            "nome" => "Desaparecimento de Pulgas e Carrapatos",
            "descricao" => "Tratamento para eliminação de parasitas",
            "valor_base" => 70
        ]);
    }
}
