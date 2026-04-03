<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            [
                'name' => 'Mercado Bom Preco',
                'social_name' => 'Bom Preco Comercio de Alimentos LTDA',
                'taxNumber' => '12123456000101',
                'email' => 'compras@bompreco.com.br',
                'phone_number' => '11987654321',
                'address' => 'Rua das Acacias, 120 - Centro - Sao Paulo/SP',
            ],
            [
                'name' => 'Padaria Sol Nascente',
                'social_name' => 'Padaria Sol Nascente LTDA',
                'taxNumber' => '45123456000102',
                'email' => 'contato@solnascente.com.br',
                'phone_number' => '21991234567',
                'address' => 'Avenida Brasil, 455 - Tijuca - Rio de Janeiro/RJ',
            ],
            [
                'name' => 'Restaurante Sabor da Casa',
                'social_name' => 'Sabor da Casa Refeicoes LTDA',
                'taxNumber' => '78123456000103',
                'email' => 'pedidos@sabordacasa.com.br',
                'phone_number' => '31992345678',
                'address' => 'Rua Goias, 800 - Centro - Belo Horizonte/MG',
            ],
            [
                'name' => 'Hotel Mar Azul',
                'social_name' => 'Mar Azul Hospedagem LTDA',
                'taxNumber' => '23123456000104',
                'email' => 'suprimentos@hotelmarazul.com.br',
                'phone_number' => '48993456789',
                'address' => 'Rua das Palmeiras, 77 - Centro - Florianopolis/SC',
            ],
            [
                'name' => 'Lanchonete Ponto Certo',
                'social_name' => 'Ponto Certo Alimentos LTDA',
                'taxNumber' => '56123456000105',
                'email' => 'financeiro@pontocerto.com.br',
                'phone_number' => '62994567890',
                'address' => 'Avenida Independencia, 990 - Setor Central - Goiania/GO',
            ],
        ];

        foreach ($clients as $client) {
            Client::firstOrCreate(
                ['taxNumber' => $client['taxNumber']],
                ['id' => (string) Str::uuid(), ...$client]
            );
        }
    }
}

