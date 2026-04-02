<?php

use App\Livewire\Cadastro\Fornecedores\Form as SupplierForm;
use App\Livewire\Cadastro\Fornecedores\Index as SupplierIndex;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('creates a supplier through livewire form', function () {
    Livewire::test(SupplierForm::class)
        ->set('name', 'Contato Fornecedor')
        ->set('social_name', 'Fornecedor Teste LTDA')
        ->set('taxNumber', '12345678901234')
        ->set('email', 'fornecedor@example.com')
        ->set('phone_number', '11999999999')
        ->set('address_zip_code', '01000000')
        ->set('address_street', 'Rua Exemplo')
        ->set('address_number', '100')
        ->set('address_complement', 'Sala 10')
        ->set('address_district', 'Centro')
        ->set('address_city', 'Sao Paulo')
        ->set('address_state', 'SP')
        ->call('save')
        ->assertRedirect(route('suppliers.index'));

    $this->assertDatabaseHas('suppliers', [
        'social_name' => 'Fornecedor Teste LTDA',
        'email' => 'fornecedor@example.com',
    ]);
});

it('updates a supplier through livewire form', function () {
    $supplier = Supplier::query()->create([
        'name' => 'Contato Antigo',
        'social_name' => 'Fornecedor Antigo LTDA',
        'taxNumber' => '11111111111111',
        'email' => 'antigo@example.com',
        'phone_number' => '11988888888',
        'address_zip_code' => '02000000',
        'address_street' => 'Rua Antiga',
        'address_number' => '200',
        'address_complement' => 'Bloco A',
        'address_district' => 'Bairro Antigo',
        'address_city' => 'Sao Paulo',
        'address_state' => 'SP',
    ]);

    Livewire::test(SupplierForm::class, ['supplier' => $supplier])
        ->set('name', 'Contato Novo')
        ->set('social_name', 'Fornecedor Novo LTDA')
        ->set('taxNumber', '22222222222222')
        ->set('email', 'novo@example.com')
        ->set('phone_number', '11977777777')
        ->set('address_zip_code', '03000000')
        ->set('address_street', 'Rua Nova')
        ->set('address_number', '300')
        ->set('address_complement', 'Conjunto 2')
        ->set('address_district', 'Bairro Novo')
        ->set('address_city', 'Campinas')
        ->set('address_state', 'SP')
        ->call('save')
        ->assertRedirect(route('suppliers.index'));

    $this->assertDatabaseHas('suppliers', [
        'id' => $supplier->id,
        'social_name' => 'Fornecedor Novo LTDA',
        'email' => 'novo@example.com',
    ]);
});

it('deletes a supplier from livewire index', function () {
    $supplier = Supplier::query()->create([
        'name' => 'Contato Delete',
        'social_name' => 'Fornecedor Delete LTDA',
        'taxNumber' => '33333333333333',
        'email' => 'delete@example.com',
        'phone_number' => '11966666666',
        'address_zip_code' => '04000000',
        'address_street' => 'Rua Delete',
        'address_number' => '400',
        'address_complement' => 'Sala 4',
        'address_district' => 'Bairro Delete',
        'address_city' => 'Santos',
        'address_state' => 'SP',
    ]);

    Livewire::test(SupplierIndex::class)
        ->call('deleteSupplier', $supplier->id);

    $this->assertSoftDeleted('suppliers', [
        'id' => $supplier->id,
    ]);
});

