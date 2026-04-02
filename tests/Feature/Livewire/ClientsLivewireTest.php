<?php

use App\Livewire\Cadastro\Clientes\Form as ClientForm;
use App\Livewire\Cadastro\Clientes\Index as ClientIndex;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('creates a client through livewire form', function () {
    Livewire::test(ClientForm::class)
        ->set('name', 'Cliente Teste')
        ->set('social_name', 'Empresa Teste LTDA')
        ->set('taxNumber', '00.000.000/0001-00')
        ->set('email', 'cliente@example.com')
        ->set('phone_number', '(11) 99999-9999')
        ->set('address', 'Rua Exemplo, 100')
        ->call('save')
        ->assertRedirect(route('clients.index'));

    $this->assertDatabaseHas('clients', [
        'name' => 'Cliente Teste',
        'email' => 'cliente@example.com',
    ]);
});

it('updates an existing client through livewire form', function () {
    $client = Client::query()->create([
        'name' => 'Cliente Antigo',
        'social_name' => 'Empresa Antiga',
        'taxNumber' => '11.111.111/0001-11',
        'email' => 'antigo@example.com',
        'phone_number' => '(11) 98888-1111',
        'address' => 'Endereco antigo',
    ]);

    Livewire::test(ClientForm::class, ['client' => $client])
        ->set('name', 'Cliente Novo')
        ->set('email', 'novo@example.com')
        ->set('taxNumber', '22.222.222/0001-22')
        ->set('phone_number', '(11) 97777-2222')
        ->set('address', 'Endereco novo')
        ->call('save')
        ->assertRedirect(route('clients.index'));

    $this->assertDatabaseHas('clients', [
        'id' => $client->id,
        'name' => 'Cliente Novo',
        'email' => 'novo@example.com',
    ]);
});

it('deletes a client from livewire index', function () {
    $client = Client::query()->create([
        'name' => 'Cliente Delete',
        'social_name' => null,
        'taxNumber' => '33.333.333/0001-33',
        'email' => 'delete@example.com',
        'phone_number' => '(11) 96666-3333',
        'address' => 'Endereco delete',
    ]);

    Livewire::test(ClientIndex::class)
        ->call('deleteClient', $client->id);

    $this->assertDatabaseMissing('clients', [
        'id' => $client->id,
    ]);
});


